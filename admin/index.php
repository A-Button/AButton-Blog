<?php
require_once '../inc/.auth.php';
require_once '../inc/functions.php';

$posts = get_all_posts();
$themeColor = get_theme_color();
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>博客管理后台</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <style>
        :root {
            --primary-color: <?= $themeColor ?>;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <?php include 'inc/admin-nav.php'; ?>
        
        <main class="admin-content">
            <div class="admin-header">
                <h1>文章管理</h1>
                <a href="edit-post.php" class="btn-primary">创建新文章</a>
            </div>
            
            <div class="stats-cards">
                <div class="stat-card">
                    <h3>总文章数</h3>
                    <p class="stat-value"><?= count($posts) ?></p>
                </div>
                <div class="stat-card">
                    <h3>本月新增</h3>
                    <p class="stat-value">4</p>
                </div>
                <div class="stat-card">
                    <h3>总阅读量</h3>
                    <p class="stat-value"><?= array_sum(array_column($posts, 'views')) ?></p>
                </div>
            </div>
            
            <div class="admin-table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>标题</th>
                            <th>分类</th>
                            <th>日期</th>
                            <th>阅读量</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($posts as $post): ?>
                        <tr>
                            <td><?= htmlspecialchars($post['title']) ?></td>
                            <td><?= $post['category'] ?></td>
                            <td><?= date('Y-m-d', strtotime($post['date'])) ?></td>
                            <td><?= $post['views'] ?></td>
                            <td class="actions">
                                <a href="edit-post.php?id=<?= $post['id'] ?>" class="btn-edit">编辑</a>
                                <button class="btn-delete" data-id="<?= $post['id'] ?>">删除</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    
    <script src="../assets/js/admin.js"></script>
</body>
</html>