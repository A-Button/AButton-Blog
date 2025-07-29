<?php
// 数据库配置
define('DB_PATH', __DIR__ . '/../data/');
define('POSTS_FILE', DB_PATH . 'posts.json');
define('USERS_FILE', DB_PATH . 'users.json');
define('CONFIG_FILE', DB_PATH . 'config.json');

// 安全密钥
define('SECRET_KEY', 'your-secure-key-here');

// 初始化配置文件（如果不存在）
if (!file_exists(CONFIG_FILE)) {
    $initialConfig = [
        'theme_color' => '#3498db',
        'site_title' => '现代个人博客',
        'admin_email' => 'admin@example.com'
    ];
    file_put_contents(CONFIG_FILE, json_encode($initialConfig, JSON_PRETTY_PRINT));
}
?>