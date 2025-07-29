<?php
require_once 'inc/functions.php';
$posts = get_all_posts();
$themeColor = get_theme_color();
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>现代个人博客 | 思想与技术的交汇</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        :root {
            --primary-color: <?= $themeColor ?>;
        }
    </style>
</head>
<body>
    <?php include 'inc/header.php'; ?>
    <?php include 'inc/nav.php'; ?>

    <main class="container">
        <section class="hero">
            <div class="hero-content">
                <h1>探索技术与创意的世界</h1>
                <p>一个专注于Web开发、设计思维与技术前沿的个人博客</p>
                <a href="#latest-posts" class="btn-primary">阅读最新文章</a>
            </div>
            <div class="hero-image">
                <div class="graphic-element"></div>
            </div>
        </section>

        <section id="latest-posts" class="posts-section">
            <div class="section-header">
                <h2>最新文章</h2>
                <div class="filter-controls">
                    <button class="filter-btn active" data-category="all">全部</button>
                    <button class="filter-btn" data-category="technology">技术</button>
                    <button class="filter-btn" data-category="design">设计</button>
                    <button class="filter-btn" data-category="life">生活</button>
                </div>
            </div>

            <div class="posts-grid">
                <?php foreach ($posts as $post): ?>
                    <?php include 'templates/post-card.php'; ?>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <?php include 'inc/footer.php'; ?>
    
    <script src="assets/js/marked.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>