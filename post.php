<?php
require_once 'inc/functions.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$postId = (int)$_GET['id'];
$post = get_post_by_id($postId);
$themeColor = get_theme_color();

if (!$post) {
    header("Location: index.php");
    exit;
}

// 增加阅读量
increment_post_views($postId);
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($post['title']) ?> | 现代个人博客</title>
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
        <article class="post-detail">
            <div class="post-header">
                <div class="post-meta">
                    <span class="post-date"><?= date('Y年m月d日', strtotime($post['date'])) ?></span>
                    <span class="post-category"><?= $post['category'] ?></span>
                    <span class="post-views"><?= $post['views'] ?> 次阅读</span>
                </div>
                <h1 class="post-title"><?= htmlspecialchars($post['title']) ?></h1>
                <div class="post-tags">
                    <?php foreach ($post['tags'] as $tag): ?>
                        <span class="tag"><?= $tag ?></span>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php if ($post['image']): ?>
                <div class="post-image">
                    <img src="assets/images/<?= $post['image'] ?>" alt="<?= htmlspecialchars($post['title']) ?>">
                </div>
            <?php endif; ?>

            <div class="post-content" id="markdown-content">
                <?= $post['content'] ?>
            </div>

            <div class="post-actions">
                <button class="btn-outline" id="theme-toggle">切换主题</button>
                <div class="social-share">
                    <span>分享:</span>
                    <a href="#" class="share-btn twitter">Twitter</a>
                    <a href="#" class="share-btn facebook">Facebook</a>
                    <a href="#" class="share-btn linkedin">LinkedIn</a>
                </div>
            </div>
        </article>

        <section class="related-posts">
            <h3>相关文章</h3>
            <div class="posts-grid">
                <?php 
                $relatedPosts = get_related_posts($postId, $post['category']);
                foreach ($relatedPosts as $relatedPost): 
                ?>
                    <?php include 'templates/post-card.php'; ?>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <?php include 'inc/footer.php'; ?>
    
    <script src="assets/js/marked.min.js"></script>
    <script>
        // 解析Markdown内容
        document.addEventListener('DOMContentLoaded', function() {
            const markdownContent = document.getElementById('markdown-content');
            if (markdownContent) {
                markdownContent.innerHTML = marked.parse(markdownContent.textContent);
            }
            
            // 主题切换功能
            const themeToggle = document.getElementById('theme-toggle');
            if (themeToggle) {
                themeToggle.addEventListener('click', function() {
                    document.documentElement.classList.toggle('dark-mode');
                    this.textContent = document.documentElement.classList.contains('dark-mode') 
                        ? '切换亮色模式' : '切换暗色模式';
                });
            }
        });
    </script>
</body>
</html>