<?php

declare(strict_types=1);

namespace Forum;

use PDO;
use Twig\Environment as TwigEnvironment;

class ForumController
{
    private PDO $db;
    private TwigEnvironment $twig;
    private Auth $auth;
    private Forum $forum;
    private Admin $admin;
    private UserProfile $userProfile;
    
    public function __construct(PDO $db, TwigEnvironment $twig)
    {
        $this->db = $db;
        $this->twig = $twig;
        $this->auth = new Auth($db);
        $this->forum = new Forum($db, $this->auth);
        $this->admin = new Admin($db, $this->auth);
        $this->userProfile = new UserProfile($db, $this->auth);
    }
    
    // Main forum index
    public function index(): string
    {
        $boards = $this->forum->getAllBoards();
        $currentUser = $this->auth->getCurrentUser();
        
        $templateData = [
            'boards' => $boards,
            'current_user' => $currentUser,
            'unread_message_count' => $currentUser ? $this->userProfile->getUnreadMessageCount((int) $currentUser['id']) : 0,
            'site_title' => 'Steam Support Forums',
            'theme_path' => '/themes/2002_forum',
            'banner_ad' => $this->getBannerAd(),
            'load_time' => $this->getLoadTime()
        ];
        
        return $this->twig->render('forum/index.twig', $templateData);
    }
    
    // Board view
    public function board(int $boardId, int $page = 1): string
    {
        $board = $this->forum->getBoardInfo($boardId);
        if (!$board) {
            throw new \Exception('Board not found', 404);
        }
        
        $perPage = 25;
        $threads = $this->forum->getThreads($boardId, $page, $perPage);
        $totalThreads = $this->forum->getThreadCount($boardId);
        $totalPages = ceil($totalThreads / $perPage);
        
        $moderators = $this->forum->getBoardModerators($boardId);
        $currentUser = $this->auth->getCurrentUser();
        
        $templateData = [
            'board' => $board,
            'threads' => $threads,
            'moderators' => $moderators,
            'current_user' => $currentUser,
            'unread_message_count' => $currentUser ? $this->userProfile->getUnreadMessageCount((int) $currentUser['id']) : 0,
            'pagination' => [
                'current_page' => $page,
                'total_pages' => $totalPages,
                'total_threads' => $totalThreads,
                'pages' => range(max(1, $page - 2), min($totalPages, $page + 2))
            ],
            'theme_path' => '/themes/2002_forum',
            'banner_ad' => $this->getBannerAd(),
            'load_time' => $this->getLoadTime()
        ];
        
        return $this->twig->render('forum/board.twig', $templateData);
    }
    
    // Post new topic form
    public function postNewTopic(int $boardId): string
    {
        if (!$this->auth->isLoggedIn()) {
            header('Location: /forum/login?redirect=' . urlencode("/forum/board/{$boardId}/post"));
            exit;
        }
        
        $board = $this->forum->getBoardInfo($boardId);
        if (!$board) {
            throw new \Exception('Board not found', 404);
        }
        
        $currentUser = $this->auth->getCurrentUser();
        if ($this->auth->isUserBanned((int) $currentUser['id'], $boardId)) {
            throw new \Exception('You are banned from posting in this board', 403);
        }
        
        $templateData = [
            'board_id' => $boardId,
            'thread_id' => 0,
            'current_user' => $currentUser,
            'unread_message_count' => $this->userProfile->getUnreadMessageCount((int) $currentUser['id']),
            'theme_path' => '/themes/2002_forum',
            'csrf_token' => $this->generateCSRFToken(),
            'banner_ad' => $this->getBannerAd(),
            'load_time' => $this->getLoadTime()
        ];
        
        return $this->twig->render('forum/post.twig', $templateData);
    }
    
    // Handle post submission
    public function postSubmit(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new \Exception('Method not allowed', 405);
        }
        
        $this->validateCSRFToken($_POST['csrf_token'] ?? '');
        
        $boardId = (int) ($_POST['board_id'] ?? 0);
        $threadId = (int) ($_POST['thread_id'] ?? 0);
        $subject = trim($_POST['subject'] ?? '');
        $message = trim($_POST['message'] ?? '');
        
        if (empty($message)) {
            throw new \Exception('Message cannot be empty', 400);
        }
        
        if ($threadId === 0) {
            // Creating new thread
            if (empty($subject)) {
                throw new \Exception('Subject cannot be empty for new topics', 400);
            }
            
            $newThreadId = $this->forum->createThread($boardId, $subject, $message);
            if (!$newThreadId) {
                throw new \Exception('Failed to create thread', 500);
            }
            
            header("Location: /forum/thread/{$newThreadId}");
        } else {
            // Replying to existing thread
            $postId = $this->forum->createPost($threadId, $message);
            if (!$postId) {
                throw new \Exception('Failed to create post', 500);
            }
            
            header("Location: /forum/thread/{$threadId}#post{$postId}");
        }
        
        exit;
    }
    
    // Ban user form
    public function banUser(int $userId, ?int $boardId = null): string
    {
        if (!$this->auth->canModerateBoard($boardId)) {
            throw new \Exception('Insufficient permissions', 403);
        }
        
        $userModel = new User($this->db);
        $targetUser = $userModel->findById($userId);
        
        if (!$targetUser) {
            throw new \Exception('User not found', 404);
        }
        
        $board = null;
        if ($boardId) {
            $board = $this->forum->getBoardInfo($boardId);
        }
        
        $currentUser = $this->auth->getCurrentUser();
        
        $templateData = [
            'target_user' => $targetUser,
            'board' => $board,
            'current_user' => $currentUser,
            'unread_message_count' => $this->userProfile->getUnreadMessageCount((int) $currentUser['id']),
            'theme_path' => '/themes/2002_forum',
            'csrf_token' => $this->generateCSRFToken(),
            'return_url' => $_GET['return_url'] ?? '',
            'banner_ad' => $this->getBannerAd(),
            'load_time' => $this->getLoadTime()
        ];
        
        return $this->twig->render('forum/ban_user.twig', $templateData);
    }
    
    // Handle ban user submission
    public function banUserSubmit(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new \Exception('Method not allowed', 405);
        }
        
        $this->validateCSRFToken($_POST['csrf_token'] ?? '');
        
        $userId = (int) ($_POST['user_id'] ?? 0);
        $boardId = !empty($_POST['board_id']) ? (int) $_POST['board_id'] : null;
        $reason = trim($_POST['reason'] ?? '');
        $banType = $_POST['ban_type'] ?? 'permanent';
        $expiresAt = !empty($_POST['expires_at']) ? $_POST['expires_at'] : null;
        
        // Verify moderator credentials
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        $currentUser = $this->auth->getCurrentUser();
        if (!$currentUser || $currentUser['email'] !== $email) {
            throw new \Exception('Invalid credentials', 401);
        }
        
        $userModel = new User($this->db);
        if (!$userModel->verifyPassword($password, $currentUser['password_hash'])) {
            throw new \Exception('Invalid password', 401);
        }
        
        $success = $this->admin->banUser($userId, $boardId, $reason, $banType, $expiresAt);
        
        if (!$success) {
            throw new \Exception('Failed to ban user', 500);
        }
        
        $returnUrl = $_POST['return_url'] ?? '/forum';
        header("Location: {$returnUrl}?banned=1");
        exit;
    }
    
    // Login
    public function login(): string
    {
        if ($this->auth->isLoggedIn()) {
            header('Location: /forum');
            exit;
        }
        
        $templateData = [
            'theme_path' => '/themes/2002_forum',
            'csrf_token' => $this->generateCSRFToken(),
            'banner_ad' => $this->getBannerAd(),
            'load_time' => $this->getLoadTime()
        ];
        
        return $this->twig->render('forum/login.twig', $templateData);
    }
    
    // Handle login submission
    public function loginSubmit(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new \Exception('Method not allowed', 405);
        }
        
        $this->validateCSRFToken($_POST['csrf_token'] ?? '');
        
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $rememberMe = isset($_POST['rememberme']);
        
        if ($this->auth->login($email, $password, $rememberMe)) {
            $redirect = $_GET['redirect'] ?? '/forum';
            header("Location: {$redirect}");
        } else {
            header('Location: /forum/login?error=1');
        }
        
        exit;
    }
    
    // Logout
    public function logout(): void
    {
        $this->auth->logout();
        header('Location: /forum');
        exit;
    }
    
    // Registration
    public function register(): string
    {
        if ($this->auth->isLoggedIn()) {
            header('Location: /forum');
            exit;
        }
        
        $templateData = [
            'theme_path' => '/themes/2002_forum',
            'csrf_token' => $this->generateCSRFToken(),
            'banner_ad' => $this->getBannerAd(),
            'load_time' => $this->getLoadTime()
        ];
        
        return $this->twig->render('forum/register.twig', $templateData);
    }
    
    // Handle registration submission
    public function registerSubmit(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new \Exception('Method not allowed', 405);
        }
        
        $this->validateCSRFToken($_POST['csrf_token'] ?? '');
        
        $userData = [
            'username' => trim($_POST['username'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'password' => $_POST['password'] ?? ''
        ];
        
        $userId = $this->auth->register($userData);
        
        if ($userId) {
            // Auto-login after registration
            $this->auth->login($userData['email'], $userData['password']);
            header('Location: /forum');
        } else {
            header('Location: /forum/register?error=1');
        }
        
        exit;
    }
    
    // Helper methods
    private function generateCSRFToken(): string
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
    
    private function validateCSRFToken(string $token): void
    {
        if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
            throw new \Exception('Invalid CSRF token', 403);
        }
    }
    
    private function getBannerAd(): ?array
    {
        // Mock banner ad - in real implementation this would come from database
        return [
            'url' => '#',
            'image' => '/themes/2002_forum/assets/images/shared/genericpgad.gif',
            'alt' => 'Planet Groovy - 24 Hour Updates, Gaming, Entertainment, News and more!'
        ];
    }
    
    private function getLoadTime(): string
    {
        return '0';
    }
}