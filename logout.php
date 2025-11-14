<?php
require_once __DIR__ . '/dbconnect.php';

$log_helper = __DIR__ . '/app/util/log_helper.php';
if (file_exists($log_helper)) {
    require_once $log_helper;
    // log logout while we still have the username
    log_action(current_user_name(), current_user_role(), 'LOGOUT', 'user', current_user_name(), null);
}

// clear and destroy session fully
$_SESSION = [];
if (ini_get('session.use_cookies')) {
    $p = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
}
session_destroy();

// redirect to login
header('Location: /LibraryManagementSystem/index.php');
exit;
