<?php
$themeColor = get_theme_color();
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>现代个人博客 | 思想与技术的交汇</title>
    <meta name="description" content="一个专注于Web开发、设计思维与技术前沿的个人博客">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22 fill=%22<?= urlencode($themeColor) ?>%22>✍️</text></svg>">
    <style>
        :root {
            --primary-color: <?= $themeColor ?>;
        }
        
        <?php if ($currentPage === 'post.php'): ?>
        .post-banner {
            background: linear-gradient(135deg, rgba(<?= hexdec(substr($themeColor, 1, 2)) ?>, <?= hexdec(substr($themeColor, 3, 2)) ?>, <?= hexdec(substr($themeColor, 5, 2)) ?>, 0.1), rgba(44, 62, 80, 0.2));
            padding: 60px 0;
            margin-bottom: 40px;
            text-align: center;
        }
        <?php endif; ?>
    </style>
</head>
<body class="<?= $currentPage === 'index.php' ? 'home' : '' ?>">
    <header class="header">
        <div class="container">
            <div class="header-inner">
                <a href="index.php" class="logo">
                    <svg viewBox="0 0 24 24" width="36" height="36">
                        <path fill="white" d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/>
                    </svg>
                    <span>现代博客</span>
                </a>
                
                <div class="header-actions">
                    <button id="theme-toggle" class="btn-icon">
                        <svg viewBox="0 0 24 24" width="24" height="24">
                            <path fill="currentColor" d="M12,18c-3.3,0-6-2.7-6-6s2.7-6,6-6s6,2.7,6,6S15.3,18,12,18zM12,8c-2.2,0-4,1.8-4,4c0,2.2,1.8,4,4,4c2.2,0,4-1.8,4-4C16,9.8,14.2,8,12,8z"/>
                        </svg>
                    </button>
                    
                    <div class="search-box">
                        <input type="text" placeholder="搜索文章...">
                        <button class="btn-icon">
                            <svg viewBox="0 0 24 24" width="20" height="20">
                                <path fill="currentColor" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>