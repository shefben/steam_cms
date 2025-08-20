<?php

declare(strict_types=1);

namespace Forum;

use PDO;

class UserProfile
{
    private PDO $db;
    private Auth $auth;
    
    public function __construct(PDO $db, Auth $auth)
    {
        $this->db = $db;
        $this->auth = $auth;
    }
    
    public function getProfile(string $username): ?array
    {
        $stmt = $this->db->prepare("
            SELECT u.id, u.username, u.email, u.post_count, u.rank_title, 
                   u.join_date, u.last_visit, u.last_activity, u.signature, 
                   u.is_moderator, u.is_admin, u.is_banned, u.ban_reason,
                   COUNT(CASE WHEN uw.is_active = 1 THEN 1 END) as active_warnings
            FROM forum_users u
            LEFT JOIN forum_user_warnings uw ON u.id = uw.user_id
            WHERE u.username = ? AND u.is_active = 1
            GROUP BY u.id
        ");
        
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user) {
            return null;
        }
        
        // Get user's recent posts
        $user['recent_posts'] = $this->getRecentPosts((int) $user['id'], 5);
        
        // Get user's threads
        $user['recent_threads'] = $this->getRecentThreads((int) $user['id'], 5);
        
        // Get moderated boards if user is moderator
        if ($user['is_moderator'] || $user['is_admin']) {
            $user['moderated_boards'] = $this->getModeratedBoards((int) $user['id']);
        }
        
        return $user;
    }
    
    public function updateProfile(int $userId, array $data): bool
    {
        $currentUser = $this->auth->getCurrentUser();
        if (!$currentUser || ((int) $currentUser['id'] !== $userId && !$this->auth->isAdmin())) {
            return false;
        }
        
        $allowedFields = ['signature'];
        $updateFields = [];
        $params = [];
        
        foreach ($allowedFields as $field) {
            if (isset($data[$field])) {
                $updateFields[] = "$field = ?";
                $params[] = $data[$field];
            }
        }
        
        if (empty($updateFields)) {
            return false;
        }
        
        $params[] = $userId;
        
        $stmt = $this->db->prepare("
            UPDATE forum_users 
            SET " . implode(', ', $updateFields) . ", updated_at = NOW()
            WHERE id = ?
        ");
        
        return $stmt->execute($params);
    }
    
    public function changePassword(int $userId, string $currentPassword, string $newPassword): bool
    {
        $currentUser = $this->auth->getCurrentUser();
        if (!$currentUser || (int) $currentUser['id'] !== $userId) {
            return false;
        }
        
        // Verify current password
        $userModel = new User($this->db);
        $user = $userModel->findById($userId);
        
        if (!$user || !$userModel->verifyPassword($currentPassword, $user['password_hash'])) {
            return false;
        }
        
        // Update password
        $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
        
        $stmt = $this->db->prepare("
            UPDATE forum_users 
            SET password_hash = ?, updated_at = NOW()
            WHERE id = ?
        ");
        
        return $stmt->execute([$newHash, $userId]);
    }
    
    public function getPrivateMessages(int $userId, string $folder = 'inbox', int $page = 1, int $perPage = 25): array
    {
        $offset = ($page - 1) * $perPage;
        
        $whereCondition = match($folder) {
            'inbox' => 'pm.to_user_id = ? AND pm.is_deleted_by_recipient = 0',
            'sent' => 'pm.from_user_id = ? AND pm.is_deleted_by_sender = 0',
            default => 'pm.to_user_id = ? AND pm.is_deleted_by_recipient = 0'
        };
        
        $stmt = $this->db->prepare("
            SELECT pm.id, pm.subject, pm.content, pm.is_read, pm.created_at, pm.read_at,
                   from_user.username as from_username,
                   to_user.username as to_username
            FROM forum_private_messages pm
            JOIN forum_users from_user ON pm.from_user_id = from_user.id
            JOIN forum_users to_user ON pm.to_user_id = to_user.id
            WHERE $whereCondition
            ORDER BY pm.created_at DESC
            LIMIT ? OFFSET ?
        ");
        
        $stmt->execute([$userId, $perPage, $offset]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function sendPrivateMessage(int $fromUserId, int $toUserId, string $subject, string $content): bool
    {
        $currentUser = $this->auth->getCurrentUser();
        if (!$currentUser || (int) $currentUser['id'] !== $fromUserId) {
            return false;
        }
        
        if (!$this->auth->hasPermission('can_send_private_messages')) {
            return false;
        }
        
        $stmt = $this->db->prepare("
            INSERT INTO forum_private_messages (from_user_id, to_user_id, subject, content, created_at)
            VALUES (?, ?, ?, ?, NOW())
        ");
        
        return $stmt->execute([$fromUserId, $toUserId, $subject, $content]);
    }
    
    public function markMessageAsRead(int $messageId, int $userId): bool
    {
        $stmt = $this->db->prepare("
            UPDATE forum_private_messages 
            SET is_read = 1, read_at = NOW()
            WHERE id = ? AND to_user_id = ?
        ");
        
        return $stmt->execute([$messageId, $userId]);
    }
    
    public function getUnreadMessageCount(int $userId): int
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) 
            FROM forum_private_messages 
            WHERE to_user_id = ? AND is_read = 0 AND is_deleted_by_recipient = 0
        ");
        
        $stmt->execute([$userId]);
        return (int) $stmt->fetchColumn();
    }
    
    private function getRecentPosts(int $userId, int $limit): array
    {
        $stmt = $this->db->prepare("
            SELECT p.id, p.content, p.created_at, p.thread_id,
                   t.title as thread_title, t.board_id,
                   b.name as board_name
            FROM forum_posts p
            JOIN forum_threads t ON p.thread_id = t.id
            JOIN forum_boards b ON t.board_id = b.id
            WHERE p.author_id = ? AND p.is_active = 1
            ORDER BY p.created_at DESC
            LIMIT ?
        ");
        
        $stmt->execute([$userId, $limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    private function getRecentThreads(int $userId, int $limit): array
    {
        $stmt = $this->db->prepare("
            SELECT t.id, t.title, t.post_count, t.view_count, t.created_at,
                   t.board_id, b.name as board_name
            FROM forum_threads t
            JOIN forum_boards b ON t.board_id = b.id
            WHERE t.author_id = ? AND t.is_active = 1
            ORDER BY t.created_at DESC
            LIMIT ?
        ");
        
        $stmt->execute([$userId, $limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    private function getModeratedBoards(int $userId): array
    {
        $stmt = $this->db->prepare("
            SELECT b.id, b.name, b.description
            FROM forum_boards b
            JOIN forum_moderators m ON (b.id = m.board_id OR m.board_id IS NULL)
            WHERE m.user_id = ? AND b.is_active = 1
            ORDER BY b.name ASC
        ");
        
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getUserStats(int $userId): array
    {
        // Get basic stats
        $stmt = $this->db->prepare("
            SELECT 
                (SELECT COUNT(*) FROM forum_posts WHERE author_id = ? AND is_active = 1) as total_posts,
                (SELECT COUNT(*) FROM forum_threads WHERE author_id = ? AND is_active = 1) as total_threads,
                (SELECT AVG(post_count) FROM forum_threads WHERE author_id = ? AND is_active = 1) as avg_replies_per_thread
        ");
        
        $stmt->execute([$userId, $userId, $userId]);
        $stats = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Get posts per day (last 30 days)
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as posts_last_30_days
            FROM forum_posts 
            WHERE author_id = ? AND is_active = 1 
            AND created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
        ");
        
        $stmt->execute([$userId]);
        $recentActivity = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return array_merge($stats, $recentActivity);
    }
    
    public function searchUsers(string $query, int $page = 1, int $perPage = 20): array
    {
        $offset = ($page - 1) * $perPage;
        
        $stmt = $this->db->prepare("
            SELECT id, username, rank_title, post_count, join_date, last_activity
            FROM forum_users 
            WHERE (username LIKE ? OR email LIKE ?) AND is_active = 1
            ORDER BY username ASC
            LIMIT ? OFFSET ?
        ");
        
        $searchTerm = "%$query%";
        $stmt->execute([$searchTerm, $searchTerm, $perPage, $offset]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}