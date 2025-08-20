<?php

declare(strict_types=1);

namespace Forum;

use PDO;

class Forum
{
    private PDO $db;
    private Auth $auth;
    
    public function __construct(PDO $db, Auth $auth)
    {
        $this->db = $db;
        $this->auth = $auth;
    }
    
    public function getCategories(): array
    {
        $stmt = $this->db->prepare("
            SELECT id, name, description, display_order 
            FROM forum_categories 
            WHERE is_active = 1 
            ORDER BY display_order ASC, name ASC
        ");
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getBoardsByCategory(int $categoryId): array
    {
        $stmt = $this->db->prepare("
            SELECT b.id, b.name, b.description, b.topic_count, b.post_count, 
                   b.last_post_date, b.last_post_user, b.display_order
            FROM forum_boards b
            WHERE b.category_id = ? AND b.is_active = 1
            ORDER BY b.display_order ASC, b.name ASC
        ");
        
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getAllBoards(): array
    {
        $stmt = $this->db->prepare("
            SELECT b.id, b.name, b.description, b.topic_count, b.post_count, 
                   b.last_post_date, b.last_post_user, b.display_order,
                   c.name as category_name
            FROM forum_boards b
            JOIN forum_categories c ON b.category_id = c.id
            WHERE b.is_active = 1 AND c.is_active = 1
            ORDER BY c.display_order ASC, b.display_order ASC, b.name ASC
        ");
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getBoardInfo(int $boardId): ?array
    {
        $stmt = $this->db->prepare("
            SELECT b.id, b.name, b.description, b.topic_count, b.post_count, 
                   b.last_post_date, b.last_post_user, b.display_order,
                   c.name as category_name, c.id as category_id
            FROM forum_boards b
            JOIN forum_categories c ON b.category_id = c.id
            WHERE b.id = ? AND b.is_active = 1 AND c.is_active = 1
        ");
        
        $stmt->execute([$boardId]);
        $board = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $board ?: null;
    }
    
    public function getThreads(int $boardId, int $page = 1, int $perPage = 25): array
    {
        $offset = ($page - 1) * $perPage;
        
        $stmt = $this->db->prepare("
            SELECT t.id, t.title, t.author_username, t.post_count, t.view_count,
                   t.is_pinned, t.is_locked, t.last_post_date, t.last_post_user,
                   t.created_at, p.id as first_post_id
            FROM forum_threads t
            LEFT JOIN forum_posts p ON t.first_post_id = p.id
            WHERE t.board_id = ? AND t.is_active = 1
            ORDER BY t.is_pinned DESC, t.last_post_date DESC
            LIMIT ? OFFSET ?
        ");
        
        $stmt->execute([$boardId, $perPage, $offset]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getThreadCount(int $boardId): int
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) FROM forum_threads 
            WHERE board_id = ? AND is_active = 1
        ");
        
        $stmt->execute([$boardId]);
        return (int) $stmt->fetchColumn();
    }
    
    public function getThread(int $threadId): ?array
    {
        $stmt = $this->db->prepare("
            SELECT t.id, t.board_id, t.title, t.author_id, t.author_username, 
                   t.post_count, t.view_count, t.is_pinned, t.is_locked, 
                   t.created_at, t.updated_at,
                   b.name as board_name, b.category_id,
                   c.name as category_name
            FROM forum_threads t
            JOIN forum_boards b ON t.board_id = b.id
            JOIN forum_categories c ON b.category_id = c.id
            WHERE t.id = ? AND t.is_active = 1
        ");
        
        $stmt->execute([$threadId]);
        $thread = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($thread) {
            // Increment view count
            $this->incrementThreadViews($threadId);
        }
        
        return $thread ?: null;
    }
    
    public function getPosts(int $threadId, int $page = 1, int $perPage = 25): array
    {
        $offset = ($page - 1) * $perPage;
        
        $stmt = $this->db->prepare("
            SELECT p.id, p.author_id, p.author_username, p.content, p.formatted_content,
                   p.post_number, p.is_first_post, p.edit_count, p.edited_at, 
                   p.edited_by, p.created_at,
                   u.post_count as author_post_count, u.rank_title, u.join_date, u.signature
            FROM forum_posts p
            LEFT JOIN forum_users u ON p.author_id = u.id
            WHERE p.thread_id = ? AND p.is_active = 1
            ORDER BY p.post_number ASC
            LIMIT ? OFFSET ?
        ");
        
        $stmt->execute([$threadId, $perPage, $offset]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getPostCount(int $threadId): int
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) FROM forum_posts 
            WHERE thread_id = ? AND is_active = 1
        ");
        
        $stmt->execute([$threadId]);
        return (int) $stmt->fetchColumn();
    }
    
    public function createThread(int $boardId, string $title, string $content): ?int
    {
        if (!$this->auth->isLoggedIn()) {
            return null;
        }
        
        $user = $this->auth->getCurrentUser();
        if (!$user || $this->auth->isUserBanned((int) $user['id'], $boardId)) {
            return null;
        }
        
        if (!$this->auth->hasPermission('can_create_threads', $boardId)) {
            return null;
        }
        
        try {
            $this->db->beginTransaction();
            
            // Create thread
            $stmt = $this->db->prepare("
                INSERT INTO forum_threads (board_id, title, author_id, author_username, created_at, updated_at)
                VALUES (?, ?, ?, ?, NOW(), NOW())
            ");
            
            $stmt->execute([$boardId, $title, (int) $user['id'], $user['username']]);
            $threadId = (int) $this->db->lastInsertId();
            
            // Create first post
            $postId = $this->createPost($threadId, $content, true);
            
            if (!$postId) {
                $this->db->rollBack();
                return null;
            }
            
            // Update thread with first post ID
            $updateStmt = $this->db->prepare("
                UPDATE forum_threads 
                SET first_post_id = ?, last_post_id = ?, last_post_date = NOW(), last_post_user = ?
                WHERE id = ?
            ");
            
            $updateStmt->execute([$postId, $postId, $user['username'], $threadId]);
            
            // Update board counts
            $this->updateBoardCounts($boardId);
            
            $this->db->commit();
            return $threadId;
            
        } catch (\Exception $e) {
            $this->db->rollBack();
            return null;
        }
    }
    
    public function createPost(int $threadId, string $content, bool $isFirstPost = false): ?int
    {
        if (!$this->auth->isLoggedIn()) {
            return null;
        }
        
        $user = $this->auth->getCurrentUser();
        if (!$user) {
            return null;
        }
        
        // Get thread info
        $thread = $this->getThread($threadId);
        if (!$thread || $thread['is_locked']) {
            return null;
        }
        
        if ($this->auth->isUserBanned((int) $user['id'], (int) $thread['board_id'])) {
            return null;
        }
        
        if (!$this->auth->hasPermission('can_post', (int) $thread['board_id'])) {
            return null;
        }
        
        // Get next post number
        $postNumber = $this->getNextPostNumber($threadId);
        
        // Format content (implement BB code parsing here)
        $formattedContent = $this->formatPostContent($content);
        
        $stmt = $this->db->prepare("
            INSERT INTO forum_posts (thread_id, board_id, author_id, author_username, 
                                   content, formatted_content, post_number, is_first_post, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        
        $result = $stmt->execute([
            $threadId,
            (int) $thread['board_id'],
            (int) $user['id'],
            $user['username'],
            $content,
            $formattedContent,
            $postNumber,
            $isFirstPost ? 1 : 0
        ]);
        
        if ($result) {
            $postId = (int) $this->db->lastInsertId();
            
            // Update thread last post info
            $updateStmt = $this->db->prepare("
                UPDATE forum_threads 
                SET post_count = post_count + 1, last_post_id = ?, 
                    last_post_date = NOW(), last_post_user = ?, updated_at = NOW()
                WHERE id = ?
            ");
            
            $updateStmt->execute([$postId, $user['username'], $threadId]);
            
            // Update user post count
            $this->auth->getCurrentUser(); // Refresh user data
            $userModel = new User($this->db);
            $userModel->incrementPostCount((int) $user['id']);
            $userModel->updateRank((int) $user['id']);
            
            // Update board counts
            $this->updateBoardCounts((int) $thread['board_id']);
            
            return $postId;
        }
        
        return null;
    }
    
    private function getNextPostNumber(int $threadId): int
    {
        $stmt = $this->db->prepare("
            SELECT COALESCE(MAX(post_number), 0) + 1 
            FROM forum_posts 
            WHERE thread_id = ?
        ");
        
        $stmt->execute([$threadId]);
        return (int) $stmt->fetchColumn();
    }
    
    private function formatPostContent(string $content): string
    {
        // Implement BB code parsing similar to the original forum
        $formatted = htmlspecialchars($content, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        
        // Bold: b[text]b
        $formatted = preg_replace('/b\[(.*?)\]b/s', '<b>$1</b>', $formatted);
        
        // Italic: i[text]i
        $formatted = preg_replace('/i\[(.*?)\]i/s', '<i>$1</i>', $formatted);
        
        // Underline: u[text]u
        $formatted = preg_replace('/u\[(.*?)\]u/s', '<u>$1</u>', $formatted);
        
        // Strikethrough: -[text]-
        $formatted = preg_replace('/-\[(.*?)\]-/s', '<strike>$1</strike>', $formatted);
        
        // Quote: q[text]q
        $formatted = preg_replace('/q\[(.*?)\]q/s', '<blockquote>$1</blockquote>', $formatted);
        
        // Code: c[text]c
        $formatted = preg_replace('/c\[(.*?)\]c/s', '<code>$1</code>', $formatted);
        
        // Bullet: +[text]+
        $formatted = preg_replace('/\+\[(.*?)\]\+/s', '<li>$1</li>', $formatted);
        
        // Colors: 1{text}1, 2{text}2, etc.
        $colors = [
            '1' => '#d6e4e2',
            '2' => '#eecfcc',
            '3' => '#cceed2',
            '4' => '#cfd5f5'
        ];
        
        foreach ($colors as $num => $color) {
            $formatted = preg_replace('/' . $num . '\{(.*?)\}' . $num . '/s', '<font color="' . $color . '">$1</font>', $formatted);
        }
        
        // Convert line breaks
        $formatted = nl2br($formatted);
        
        return $formatted;
    }
    
    private function incrementThreadViews(int $threadId): void
    {
        $stmt = $this->db->prepare("
            UPDATE forum_threads 
            SET view_count = view_count + 1 
            WHERE id = ?
        ");
        
        $stmt->execute([$threadId]);
    }
    
    private function updateBoardCounts(int $boardId): void
    {
        // Update topic count
        $stmt = $this->db->prepare("
            UPDATE forum_boards 
            SET topic_count = (
                SELECT COUNT(*) FROM forum_threads 
                WHERE board_id = ? AND is_active = 1
            ),
            post_count = (
                SELECT COUNT(*) FROM forum_posts 
                WHERE board_id = ? AND is_active = 1
            )
            WHERE id = ?
        ");
        
        $stmt->execute([$boardId, $boardId, $boardId]);
        
        // Update last post info
        $lastPostStmt = $this->db->prepare("
            SELECT p.id, p.created_at, p.author_username
            FROM forum_posts p
            WHERE p.board_id = ? AND p.is_active = 1
            ORDER BY p.created_at DESC
            LIMIT 1
        ");
        
        $lastPostStmt->execute([$boardId]);
        $lastPost = $lastPostStmt->fetch(PDO::FETCH_ASSOC);
        
        if ($lastPost) {
            $updateLastStmt = $this->db->prepare("
                UPDATE forum_boards 
                SET last_post_id = ?, last_post_date = ?, last_post_user = ?
                WHERE id = ?
            ");
            
            $updateLastStmt->execute([
                $lastPost['id'],
                $lastPost['created_at'],
                $lastPost['author_username'],
                $boardId
            ]);
        }
    }
    
    public function getBoardModerators(int $boardId): array
    {
        $stmt = $this->db->prepare("
            SELECT u.id, u.username, u.rank_title, u.post_count
            FROM forum_users u
            JOIN forum_moderators m ON u.id = m.user_id
            WHERE (m.board_id = ? OR m.board_id IS NULL) AND u.is_active = 1
            ORDER BY u.username ASC
        ");
        
        $stmt->execute([$boardId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}