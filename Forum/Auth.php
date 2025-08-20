<?php

declare(strict_types=1);

namespace Forum;

use PDO;

class Auth
{
    private PDO $db;
    private User $userModel;
    private ?array $currentUser = null;
    
    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->userModel = new User($db);
        
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Load current user from session
        $this->loadUserFromSession();
    }
    
    public function login(string $email, string $password, bool $rememberMe = false): bool
    {
        $user = $this->userModel->findByEmail($email);
        
        if (!$user || !$this->userModel->verifyPassword($password, $user['password_hash'])) {
            return false;
        }
        
        // Check if user is banned
        if ($this->isUserBanned((int) $user['id'])) {
            return false;
        }
        
        // Set session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = (bool) $user['is_admin'];
        $_SESSION['is_moderator'] = (bool) $user['is_moderator'];
        
        $this->currentUser = $user;
        
        // Handle remember me
        if ($rememberMe) {
            $rememberToken = bin2hex(random_bytes(32));
            $this->userModel->updateRememberToken((int) $user['id'], $rememberToken);
            setcookie('remember_token', $rememberToken, time() + (86400 * 30), '/'); // 30 days
        }
        
        // Update last activity
        $this->userModel->updateLastActivity((int) $user['id']);
        
        return true;
    }
    
    public function logout(): void
    {
        if ($this->currentUser) {
            $this->userModel->updateRememberToken((int) $this->currentUser['id'], null);
        }
        
        session_destroy();
        setcookie('remember_token', '', time() - 3600, '/');
        $this->currentUser = null;
    }
    
    public function register(array $userData): ?int
    {
        // Validate data
        if (!$this->validateRegistrationData($userData)) {
            return null;
        }
        
        return $this->userModel->create($userData);
    }
    
    public function getCurrentUser(): ?array
    {
        return $this->currentUser;
    }
    
    public function isLoggedIn(): bool
    {
        return $this->currentUser !== null;
    }
    
    public function isAdmin(): bool
    {
        return $this->currentUser && (bool) $this->currentUser['is_admin'];
    }
    
    public function isModerator(): bool
    {
        return $this->currentUser && ((bool) $this->currentUser['is_moderator'] || (bool) $this->currentUser['is_admin']);
    }
    
    public function canModerateBoard(int $boardId): bool
    {
        if (!$this->isLoggedIn()) {
            return false;
        }
        
        if ($this->isAdmin()) {
            return true;
        }
        
        if (!$this->isModerator()) {
            return false;
        }
        
        // Check if user is moderator for this specific board or global moderator
        $stmt = $this->db->prepare("
            SELECT COUNT(*) FROM forum_moderators 
            WHERE user_id = ? AND (board_id = ? OR board_id IS NULL)
        ");
        
        $stmt->execute([(int) $this->currentUser['id'], $boardId]);
        return $stmt->fetchColumn() > 0;
    }
    
    public function hasPermission(string $permission, ?int $boardId = null): bool
    {
        if (!$this->isLoggedIn()) {
            return false;
        }
        
        $roleType = 'user';
        if ($this->isAdmin()) {
            $roleType = 'admin';
        } elseif ($this->isModerator()) {
            $roleType = 'moderator';
        }
        
        // Check for specific board permission first, then global
        $stmt = $this->db->prepare("
            SELECT permission_value FROM forum_permissions 
            WHERE role_type = ? AND permission_name = ? AND (board_id = ? OR board_id IS NULL)
            ORDER BY board_id ASC
            LIMIT 1
        ");
        
        $stmt->execute([$roleType, $permission, $boardId]);
        $result = $stmt->fetchColumn();
        
        return $result !== false ? (bool) $result : false;
    }
    
    public function isUserBanned(int $userId, ?int $boardId = null): bool
    {
        $query = "
            SELECT COUNT(*) FROM forum_user_bans 
            WHERE user_id = ? AND is_active = 1 
            AND (expires_at IS NULL OR expires_at > NOW())
        ";
        
        $params = [$userId];
        
        if ($boardId !== null) {
            $query .= " AND (board_id = ? OR board_id IS NULL)";
            $params[] = $boardId;
        } else {
            $query .= " AND board_id IS NULL";
        }
        
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        
        return $stmt->fetchColumn() > 0;
    }
    
    public function banUser(int $userId, ?int $boardId = null, string $reason = '', string $banType = 'permanent', ?string $expiresAt = null): bool
    {
        if (!$this->canBanUsers($boardId)) {
            return false;
        }
        
        $stmt = $this->db->prepare("
            INSERT INTO forum_user_bans (user_id, banned_by_user_id, board_id, reason, ban_type, expires_at)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        
        $result = $stmt->execute([
            $userId,
            (int) $this->currentUser['id'],
            $boardId,
            $reason,
            $banType,
            $expiresAt
        ]);
        
        if ($result) {
            // Update user's ban status
            $updateStmt = $this->db->prepare("
                UPDATE forum_users 
                SET is_banned = TRUE, ban_reason = ?, banned_until = ?
                WHERE id = ?
            ");
            
            $updateStmt->execute([$reason, $expiresAt, $userId]);
            
            // Log the action
            $this->logModerationAction('ban_user', 'user', $userId, $boardId, $reason);
        }
        
        return $result;
    }
    
    public function unbanUser(int $userId, ?int $boardId = null): bool
    {
        if (!$this->canBanUsers($boardId)) {
            return false;
        }
        
        // Deactivate the ban
        $query = "
            UPDATE forum_user_bans 
            SET is_active = FALSE 
            WHERE user_id = ? AND is_active = TRUE
        ";
        
        $params = [$userId];
        
        if ($boardId !== null) {
            $query .= " AND board_id = ?";
            $params[] = $boardId;
        } else {
            $query .= " AND board_id IS NULL";
        }
        
        $stmt = $this->db->prepare($query);
        $result = $stmt->execute($params);
        
        if ($result) {
            // Update user's ban status if no active bans remain
            $activeBans = $this->isUserBanned($userId);
            if (!$activeBans) {
                $updateStmt = $this->db->prepare("
                    UPDATE forum_users 
                    SET is_banned = FALSE, ban_reason = NULL, banned_until = NULL
                    WHERE id = ?
                ");
                
                $updateStmt->execute([$userId]);
            }
            
            // Log the action
            $this->logModerationAction('unban_user', 'user', $userId, $boardId, 'User unbanned');
        }
        
        return $result;
    }
    
    private function canBanUsers(?int $boardId = null): bool
    {
        if (!$this->isModerator()) {
            return false;
        }
        
        if ($boardId === null) {
            return $this->isAdmin(); // Only admins can issue global bans
        }
        
        return $this->canModerateBoard($boardId);
    }
    
    private function logModerationAction(string $actionType, string $targetType, int $targetId, ?int $boardId, string $reason): void
    {
        $stmt = $this->db->prepare("
            INSERT INTO forum_moderation_log (moderator_id, action_type, target_type, target_id, board_id, reason)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        
        $stmt->execute([
            (int) $this->currentUser['id'],
            $actionType,
            $targetType,
            $targetId,
            $boardId,
            $reason
        ]);
    }
    
    private function loadUserFromSession(): void
    {
        if (isset($_SESSION['user_id'])) {
            $this->currentUser = $this->userModel->findById((int) $_SESSION['user_id']);
            if ($this->currentUser) {
                $this->userModel->updateLastActivity((int) $this->currentUser['id']);
            }
        } elseif (isset($_COOKIE['remember_token'])) {
            $user = $this->userModel->findByRememberToken($_COOKIE['remember_token']);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['is_admin'] = (bool) $user['is_admin'];
                $_SESSION['is_moderator'] = (bool) $user['is_moderator'];
                $this->currentUser = $user;
                $this->userModel->updateLastActivity((int) $user['id']);
            }
        }
    }
    
    private function validateRegistrationData(array $data): bool
    {
        // Check required fields
        if (!isset($data['username']) || !isset($data['email']) || !isset($data['password'])) {
            return false;
        }
        
        // Validate email
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        
        // Check if email already exists
        if ($this->userModel->emailExists($data['email'])) {
            return false;
        }
        
        // Check if username already exists
        if ($this->userModel->usernameExists($data['username'])) {
            return false;
        }
        
        // Validate username length
        if (strlen($data['username']) < 3 || strlen($data['username']) > 50) {
            return false;
        }
        
        // Validate password length
        if (strlen($data['password']) < 6) {
            return false;
        }
        
        return true;
    }
}