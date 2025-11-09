<?php
require_once 'includes/db.php';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: troubleshooter.php');
    exit;
}

// Get form data
$language = $_POST['language'] ?? 'en';
$email = $_POST['f_2'] ?? '';
$account_name = $_POST['f_1'] ?? '';
$problem_description = $_POST['f_4'] ?? '';
$page = $_POST['f_page'] ?? '';

// Basic validation
$errors = [];

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Valid email address is required';
}

if (empty($problem_description)) {
    $errors[] = 'Problem description is required';
}

// If no errors, save to database
if (empty($errors)) {
    try {
        $stmt = $pdo->prepare('
            INSERT INTO support_requests
            (language, page, f1, f2, f4, created)
            VALUES (?, ?, ?, ?, ?, NOW())
        ');

        $stmt->execute([
            $language,
            $page,
            $account_name, // f1
            $email,        // f2
            $problem_description // f4
        ]);

        // Redirect to success page
        $success_message = urlencode('Your support request has been submitted successfully. We will respond to your email address as soon as possible.');
        header("Location: troubleshooter.php?lang={$language}&page=s_main&message=" . $success_message);
        exit;

    } catch (PDOException $e) {
        $errors[] = 'Database error occurred. Please try again.';
        error_log('Troubleshooter form error: ' . $e->getMessage());
    }
}

// If there are errors, redirect back with error message
if (!empty($errors)) {
    $error_message = urlencode(implode('. ', $errors));
    header("Location: troubleshooter.php?lang={$language}&page={$page}&error=" . $error_message);
    exit;
}
?>