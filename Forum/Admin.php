<?php

declare(strict_types=1);

namespace Forum;

use PDO;

class Admin
{
    private PDO $db;
    private Auth $auth;
    
    public function __construct(PDO $db, Auth $auth)
    {
        $this->db = $db;
        $this->auth = $auth;
    }
    
    // Category Management
    public function createCategory(string $name, string $description = '', int $displayOrder = 0): ?int
    {
        if (!$this->auth->isAdmin()) {
            return null;
        }
        
        $stmt = $this->db->prepare("
            INSERT INTO forum_categories (name, description, display_order, created_at)
            VALUES (?, ?, ?, NOW())
        ");
        
        $result = $stmt->execute([$name, $description, $displayOrder]);
        return $result ? (int) $this->db->lastInsertId() : null;
    }
    
    public function updateCategory(int $categoryId, array $data): bool
    {
        if (!$this->auth->isAdmin()) {
            return false;
        }
        
        $allowedFields = ['name', 'description', 'display_order', 'is_active'];
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
        
        $params[] = $categoryId;
        
        $stmt = $this->db->prepare("
            UPDATE forum_categories 
            SET " . implode(', ', $updateFields) . ", updated_at = NOW()
            WHERE id = ?
        ");
        
        return $stmt->execute($params);
    }
    
    public function deleteCategory(int $categoryId): bool
    {
        if (!$this->auth->isAdmin()) {
            return false;
        }
        
        // Check if category has boards
        $stmt = $this->db->prepare("
            SELECT COUNT(*) FROM forum_boards WHERE category_id = ?
        ");
        $stmt->execute([$categoryId]);
        
        if ($stmt->fetchColumn() > 0) {
            return false; // Cannot delete category with boards
        }
        
        $deleteStmt = $this->db->prepare("
            DELETE FROM forum_categories WHERE id = ?
        ");
        
        return $deleteStmt->execute([$categoryId]);
    }
    
    // Board Management
    public function createBoard(int $categoryId, string $name, string $description = '', int $displayOrder = 0): ?int
    {
        if (!$this->auth->hasPermission('can_manage_boards')) {
            return null;
        }
        
        $stmt = $this->db->prepare("
            INSERT INTO forum_boards (category_id, name, description, display_order, created_at)
            VALUES (?, ?, ?, ?, NOW())
        ");
        
        $result = $stmt->execute([$categoryId, $name, $description, $displayOrder]);
        return $result ? (int) $this->db->lastInsertId() : null;
    }
    
    public function updateBoard(int $boardId, array $data): bool
    {
        if (!$this->auth->hasPermission('can_manage_boards')) {
            return false;
        }
        
        $allowedFields = ['category_id', 'name', 'description', 'display_order', 'is_active'];
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
        
        $params[] = $boardId;
        
        $stmt = $this->db->prepare("
            UPDATE forum_boards 
            SET " . implode(', ', $updateFields) . ", updated_at = NOW()
            WHERE id = ?
        ");
        
        return $stmt->execute($params);
    }
    
    public function deleteBoard(int $boardId): bool
    {
        if (!$this->auth->hasPermission('can_manage_boards')) {
            return false;
        }
        
        // This will cascade delete threads and posts
        $stmt = $this->db->prepare("
            DELETE FROM forum_boards WHERE id = ?
        ");
        
        return $stmt->execute([$boardId]);
    }
    
    // User Management
    public function banUser(int $userId, ?int $boardId, string $reason, string $banType = 'permanent', ?string $expiresAt = null): bool
    {
        return $this->auth->banUser($userId, $boardId, $reason, $banType, $expiresAt);
    }
    
    public function unbanUser(int $userId, ?int $boardId = null): bool
    {
        return $this->auth->unbanUser($userId, $boardId);
    }
    
    public function warnUser(int $userId, int $warningType, string $reason, ?int $boardId = null, ?int $postId = null, int $points = 1): bool
    {
        if (!$this->auth->hasPermission('can_warn_users', $boardId)) {
            return false;
        }
        
        $currentUser = $this->auth->getCurrentUser();
        if (!$currentUser) {
            return false;
        }
        
        $warningTypes = ['spam', 'inappropriate_content', 'harassment', 'off_topic', 'other'];
        if (!in_array($warningType, $warningTypes)) {
            return false;
        }
        
        $stmt = $this->db->prepare("
            INSERT INTO forum_user_warnings (user_id, warned_by_user_id, board_id, post_id, warning_type, reason, points, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        
        $result = $stmt->execute([
            $userId,
            (int) $currentUser['id'],
            $boardId,
            $postId,
            $warningTypes[$warningType],
            $reason,
            $points
        ]);
        
        if ($result) {
            // Update user warning points
            $updateStmt = $this->db->prepare("
                UPDATE forum_users 
                SET warning_points = warning_points + ?
                WHERE id = ?
            ");
            
            $updateStmt->execute([$points, $userId]);
            
            // Log the action
            $this->logModerationAction('warn_user', 'user', $userId, $boardId, $reason);
        }
        
        return $result;
    }
    
    public function promoteUser(int $userId, string $role): bool
    {
        if (!$this->auth->isAdmin()) {
            return false;
        }
        
        $validRoles = ['user', 'moderator', 'admin'];
        if (!in_array($role, $validRoles)) {
            return false;
        }
        
        $isModerator = in_array($role, ['moderator', 'admin']) ? 1 : 0;
        $isAdmin = $role === 'admin' ? 1 : 0;
        
        $stmt = $this->db->prepare("
            UPDATE forum_users 
            SET is_moderator = ?, is_admin = ?, updated_at = NOW()
            WHERE id = ?
        ");
        
        return $stmt->execute([$isModerator, $isAdmin, $userId]);
    }
    
    public function assignBoardModerator(int $userId, int $boardId): bool
    {
        if (!$this->auth->hasPermission('can_manage_moderators')) {
            return false;
        }
        
        $stmt = $this->db->prepare("
            INSERT IGNORE INTO forum_moderators (user_id, board_id, created_at)
            VALUES (?, ?, NOW())
        ");
        
        return $stmt->execute([$userId, $boardId]);
    }
    
    public function removeBoardModerator(int $userId, int $boardId): bool
    {
        if (!$this->auth->hasPermission('can_manage_moderators')) {
            return false;
        }
        
        $stmt = $this->db->prepare("
            DELETE FROM forum_moderators 
            WHERE user_id = ? AND board_id = ?
        ");
        
        return $stmt->execute([$userId, $boardId]);
    }
    
    // Content Moderation
    public function deletePost(int $postId, string $reason = ''): bool
    {
        if (!$this->auth->hasPermission('can_delete_posts')) {
            return false;
        }
        
        // Get post info
        $stmt = $this->db->prepare("
            SELECT p.id, p.thread_id, p.board_id, p.is_first_post, p.author_id
            FROM forum_posts p
            WHERE p.id = ?
        ");
        
        $stmt->execute([$postId]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$post) {
            return false;
        }
        
        // Check if user can moderate this board
        if (!$this->auth->canModerateBoard((int) $post['board_id'])) {
            return false;
        }
        
        try {
            $this->db->beginTransaction();
            
            // If this is the first post, delete the entire thread
            if ($post['is_first_post']) {
                $this->deleteThread((int) $post['thread_id'], $reason);
            } else {
                // Just mark the post as deleted
                $deleteStmt = $this->db->prepare("
                    UPDATE forum_posts 
                    SET is_active = 0, updated_at = NOW()
                    WHERE id = ?
                ");
                
                $deleteStmt->execute([$postId]);
                
                // Update thread post count
                $updateThreadStmt = $this->db->prepare("
                    UPDATE forum_threads 
                    SET post_count = post_count - 1, updated_at = NOW()
                    WHERE id = ?
                ");
                
                $updateThreadStmt->execute([(int) $post['thread_id']]);
                
                // Update user post count
                $userModel = new User($this->db);
                $updateUserStmt = $this->db->prepare("
                    UPDATE forum_users 
                    SET post_count = post_count - 1
                    WHERE id = ?
                ");
                
                $updateUserStmt->execute([(int) $post['author_id']]);
                $userModel->updateRank((int) $post['author_id']);
            }
            
            // Log the action
            $this->logModerationAction('delete_post', 'post', $postId, (int) $post['board_id'], $reason);
            
            $this->db->commit();
            return true;
            
        } catch (\Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
    
    public function lockThread(int $threadId, string $reason = ''): bool
    {
        if (!$this->auth->hasPermission('can_lock_threads')) {
            return false;
        }
        
        $stmt = $this->db->prepare("
            UPDATE forum_threads 
            SET is_locked = 1, updated_at = NOW()
            WHERE id = ?
        ");
        
        $result = $stmt->execute([$threadId]);
        
        if ($result) {
            $this->logModerationAction('lock_thread', 'thread', $threadId, null, $reason);
        }
        
        return $result;
    }
    
    public function unlockThread(int $threadId, string $reason = ''): bool
    {
        if (!$this->auth->hasPermission('can_lock_threads')) {
            return false;
        }
        
        $stmt = $this->db->prepare("
            UPDATE forum_threads 
            SET is_locked = 0, updated_at = NOW()
            WHERE id = ?
        ");
        
        $result = $stmt->execute([$threadId]);
        
        if ($result) {
            $this->logModerationAction('unlock_thread', 'thread', $threadId, null, $reason);
        }
        
        return $result;
    }
    
    public function pinThread(int $threadId, string $reason = ''): bool
    {
        if (!$this->auth->hasPermission('can_pin_threads')) {
            return false;
        }
        
        $stmt = $this->db->prepare("
            UPDATE forum_threads 
            SET is_pinned = 1, updated_at = NOW()
            WHERE id = ?
        ");
        
        $result = $stmt->execute([$threadId]);
        
        if ($result) {
            $this->logModerationAction('pin_thread', 'thread', $threadId, null, $reason);
        }
        
        return $result;
    }
    
    public function unpinThread(int $threadId, string $reason = ''): bool
    {
        if (!$this->auth->hasPermission('can_pin_threads')) {
            return false;
        }
        
        $stmt = $this->db->prepare("
            UPDATE forum_threads 
            SET is_pinned = 0, updated_at = NOW()
            WHERE id = ?
        ");
        
        $result = $stmt->execute([$threadId]);
        
        if ($result) {
            $this->logModerationAction('unpin_thread', 'thread', $threadId, null, $reason);
        }
        
        return $result;
    }
    
    public function deleteThread(int $threadId, string $reason = ''): bool
    {
        if (!$this->auth->hasPermission('can_delete_threads')) {
            return false;
        }
        
        // Get thread info
        $stmt = $this->db->prepare("
            SELECT board_id FROM forum_threads WHERE id = ?
        ");
        
        $stmt->execute([$threadId]);
        $thread = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$thread || !$this->auth->canModerateBoard((int) $thread['board_id'])) {
            return false;
        }
        
        // Mark thread as deleted (cascade will handle posts)
        $deleteStmt = $this->db->prepare("
            UPDATE forum_threads 
            SET is_active = 0, updated_at = NOW()
            WHERE id = ?
        ");
        
        $result = $deleteStmt->execute([$threadId]);
        
        if ($result) {
            $this->logModerationAction('delete_thread', 'thread', $threadId, (int) $thread['board_id'], $reason);
        }
        
        return $result;
    }
    
    // Statistics and Reports
    public function getDashboardStats(): array
    {
        if (!$this->auth->isModerator()) {
            return [];
        }
        
        $stats = [];
        
        // Basic counts
        $stmt = $this->db->query("
            SELECT 
                (SELECT COUNT(*) FROM forum_users WHERE is_active = 1) as total_users,
                (SELECT COUNT(*) FROM forum_categories WHERE is_active = 1) as total_categories,
                (SELECT COUNT(*) FROM forum_boards WHERE is_active = 1) as total_boards,
                (SELECT COUNT(*) FROM forum_threads WHERE is_active = 1) as total_threads,
                (SELECT COUNT(*) FROM forum_posts WHERE is_active = 1) as total_posts
        ");
        
        $stats = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Recent registrations (last 30 days)
        $stmt = $this->db->query("
            SELECT COUNT(*) as recent_registrations
            FROM forum_users 
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
        ");
        
        $stats['recent_registrations'] = $stmt->fetchColumn();
        
        // Active bans
        $stmt = $this->db->query("
            SELECT COUNT(*) as active_bans
            FROM forum_user_bans 
            WHERE is_active = 1 AND (expires_at IS NULL OR expires_at > NOW())
        ");
        
        $stats['active_bans'] = $stmt->fetchColumn();
        
        // Recent warnings (last 7 days)
        $stmt = $this->db->query("
            SELECT COUNT(*) as recent_warnings
            FROM forum_user_warnings 
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
        ");
        
        $stats['recent_warnings'] = $stmt->fetchColumn();
        
        return $stats;
    }
    
    public function getModerationLog(int $page = 1, int $perPage = 50): array
    {
        if (!$this->auth->hasPermission('can_view_mod_log')) {
            return [];
        }
        
        $offset = ($page - 1) * $perPage;
        
        $stmt = $this->db->prepare("
            SELECT ml.*, u.username as moderator_username, b.name as board_name
            FROM forum_moderation_log ml
            JOIN forum_users u ON ml.moderator_id = u.id
            LEFT JOIN forum_boards b ON ml.board_id = b.id
            ORDER BY ml.created_at DESC
            LIMIT ? OFFSET ?
        ");
        
        $stmt->execute([$perPage, $offset]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    private function logModerationAction(string $actionType, string $targetType, int $targetId, ?int $boardId, string $reason): void
    {
        $currentUser = $this->auth->getCurrentUser();
        if (!$currentUser) {
            return;
        }
        
        $stmt = $this->db->prepare("
            INSERT INTO forum_moderation_log (moderator_id, action_type, target_type, target_id, board_id, reason, created_at)
            VALUES (?, ?, ?, ?, ?, ?, NOW())
        ");
        
        $stmt->execute([
            (int) $currentUser['id'],
            $actionType,
            $targetType,
            $targetId,
            $boardId,
            $reason
        ]);
    }
    
    // Settings Management
    public function updateSetting(string $key, string $value, string $type = 'string'): bool
    {
        if (!$this->auth->isAdmin()) {
            return false;
        }
        
        $stmt = $this->db->prepare("
            INSERT INTO forum_settings (setting_key, setting_value, setting_type, updated_at)
            VALUES (?, ?, ?, NOW())
            ON DUPLICATE KEY UPDATE 
            setting_value = VALUES(setting_value), 
            setting_type = VALUES(setting_type),
            updated_at = NOW()
        ");
        
        return $stmt->execute([$key, $value, $type]);
    }
    
    public function getSetting(string $key, mixed $default = null): mixed
    {
        $stmt = $this->db->prepare("
            SELECT setting_value, setting_type 
            FROM forum_settings 
            WHERE setting_key = ?
        ");
        
        $stmt->execute([$key]);
        $setting = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$setting) {
            return $default;
        }
        
        return match($setting['setting_type']) {
            'integer' => (int) $setting['setting_value'],
            'boolean' => (bool) $setting['setting_value'],
            'json' => json_decode($setting['setting_value'], true),
            default => $setting['setting_value']
        };
    }
}