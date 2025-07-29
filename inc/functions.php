<?php
require_once '.config.php';

// 获取所有文章
function get_all_posts() {
    $posts = read_json(POSTS_FILE);
    // 按日期降序排序
    usort($posts, function($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });
    return $posts;
}

// 根据ID获取文章
function get_post_by_id($id) {
    $posts = read_json(POSTS_FILE);
    foreach ($posts as $post) {
        if ($post['id'] == $id) {
            return $post;
        }
    }
    return null;
}

// 增加文章阅读量
function increment_post_views($id) {
    $posts = read_json(POSTS_FILE);
    foreach ($posts as &$post) {
        if ($post['id'] == $id) {
            $post['views']++;
            break;
        }
    }
    write_json(POSTS_FILE, $posts);
}

// 获取相关文章
function get_related_posts($currentId, $category, $limit = 3) {
    $posts = read_json(POSTS_FILE);
    $related = [];
    
    foreach ($posts as $post) {
        if ($post['id'] != $currentId && $post['category'] == $category) {
            $related[] = $post;
            if (count($related) >= $limit) break;
        }
    }
    
    // 如果相关文章不足，用最新文章补充
    if (count($related) < $limit) {
        foreach ($posts as $post) {
            if ($post['id'] != $currentId && !in_array($post, $related)) {
                $related[] = $post;
                if (count($related) >= $limit) break;
            }
        }
    }
    
    return $related;
}

// 获取主题色
function get_theme_color() {
    $config = read_json(CONFIG_FILE);
    return $config['theme_color'] ?? '#3498db'; // 默认亮蓝色
}

// 更新主题色
function update_theme_color($color) {
    $config = read_json(CONFIG_FILE);
    $config['theme_color'] = $color;
    write_json(CONFIG_FILE, $config);
}

// 辅助函数：读取JSON数据
function read_json($file) {
    if (!file_exists($file)) return [];
    $content = file_get_contents($file);
    return json_decode($content, true) ?: [];
}

// 辅助函数：写入JSON数据
function write_json($file, $data) {
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents($file, $json);
}

// 数据库配置
define('DB_PATH', __DIR__ . '/../data/');
define('POSTS_FILE', DB_PATH . 'posts.json');
define('USERS_FILE', DB_PATH . 'users.json');
define('CONFIG_FILE', DB_PATH . 'config.json');

// 安全密钥
define('SECRET_KEY', '12345678');

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