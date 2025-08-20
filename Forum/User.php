<?php

declare(strict_types=1);

namespace Forum;

use PDO;
use DateTime;

class User
{
    private PDO $db;
    
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    
    public function create(array $userData): ?int
    {
        $stmt = $this->db->prepare("
            INSERT INTO forum_users (username, email, password_hash, rank_title, join_date) 
            VALUES (?, ?, ?, ?, NOW())
        ");
        
        $passwordHash = password_hash($userData['password'], PASSWORD_DEFAULT);
        $rankTitle = $userData['rank_title'] ?? 'Bearcub';
        
        $result = $stmt->execute([
            $userData['username'],
            $userData['email'],
            $passwordHash,
            $rankTitle
        ]);
        
        return $result ? (int) $this->db->lastInsertId() : null;
    }
    
    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("
            SELECT id, username, email, password_hash, post_count, rank_title, 
                   join_date, last_visit, last_activity, signature, is_active, 
                   is_moderator, is_admin, remember_token
            FROM forum_users 
            WHERE email = ? AND is_active = 1
        ");
        
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $user ?: null;
    }
    
    public function findByUsername(string $username): ?array
    {
        $stmt = $this->db->prepare("
            SELECT id, username, email, password_hash, post_count, rank_title, 
                   join_date, last_visit, last_activity, signature, is_active, 
                   is_moderator, is_admin, remember_token
            FROM forum_users 
            WHERE username = ? AND is_active = 1
        ");
        
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $user ?: null;
    }
    
    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT id, username, email, password_hash, post_count, rank_title, 
                   join_date, last_visit, last_activity, signature, is_active, 
                   is_moderator, is_admin, remember_token
            FROM forum_users 
            WHERE id = ? AND is_active = 1
        ");
        
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $user ?: null;
    }
    
    public function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
    
    public function updateLastActivity(int $userId): bool
    {
        $stmt = $this->db->prepare("
            UPDATE forum_users 
            SET last_activity = NOW(), last_visit = NOW()
            WHERE id = ?
        ");
        
        return $stmt->execute([$userId]);
    }
    
    public function updateRememberToken(int $userId, ?string $token): bool
    {
        $stmt = $this->db->prepare("
            UPDATE forum_users 
            SET remember_token = ? 
            WHERE id = ?
        ");
        
        return $stmt->execute([$token, $userId]);
    }
    
    public function findByRememberToken(string $token): ?array
    {
        $stmt = $this->db->prepare("
            SELECT id, username, email, password_hash, post_count, rank_title, 
                   join_date, last_visit, last_activity, signature, is_active, 
                   is_moderator, is_admin, remember_token
            FROM forum_users 
            WHERE remember_token = ? AND is_active = 1
        ");
        
        $stmt->execute([$token]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $user ?: null;
    }
    
    public function incrementPostCount(int $userId): bool
    {
        $stmt = $this->db->prepare("
            UPDATE forum_users 
            SET post_count = post_count + 1 
            WHERE id = ?
        ");
        
        return $stmt->execute([$userId]);
    }
    
    public function updateSignature(int $userId, string $signature): bool
    {
        $stmt = $this->db->prepare("
            UPDATE forum_users 
            SET signature = ? 
            WHERE id = ?
        ");
        
        return $stmt->execute([$signature, $userId]);
    }
    
    public function emailExists(string $email): bool
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) FROM forum_users WHERE email = ?
        ");
        
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }
    
    public function usernameExists(string $username): bool
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) FROM forum_users WHERE username = ?
        ");
        
        $stmt->execute([$username]);
        return $stmt->fetchColumn() > 0;
    }
    
    public function getRankTitle(int $postCount): string
    {
        if ($postCount >= 2000) return 'Guru';
        if ($postCount >= 1000) return 'Graduate';
        if ($postCount >= 500) return 'Apprentice';
        if ($postCount >= 200) return 'Amateur';
        if ($postCount >= 50) return 'Novice';
        return 'Bearcub';
    }
    
    public function updateRank(int $userId): bool
    {
        $stmt = $this->db->prepare("
            UPDATE forum_users 
            SET rank_title = ? 
            WHERE id = ?
        ");
        
        $user = $this->findById($userId);
        if (!$user) return false;
        
        $newRank = $this->getRankTitle((int) $user['post_count']);
        
        return $stmt->execute([$newRank, $userId]);
    }
}