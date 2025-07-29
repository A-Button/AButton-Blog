<?php
require_once '../inc/functions.php';

session_start();

// 如果用户未登录，重定向到登录页面
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// 验证用户是否存在
$users = read_json(USERS_FILE);
$userExists = false;

foreach ($users as $user) {
    if ($user['id'] == $_SESSION['user_id']) {
        $userExists = true;
        break;
    }
}

// 如果用户不存在，清除会话并重定向
if (!$userExists) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}
?>