<?php
// admin/logout.php - Session Termination
require_once __DIR__ . '/../config/db.php';

$_SESSION = [];

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();

// Redirect back to login
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
set_flash_message('success', 'Logged out successfully.');
header("Location: /admin/login.php");
exit;
