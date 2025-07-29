<nav class="navbar">
    <div class="container">
        <ul class="nav-links">
            <li><a href="index.php" <?= basename($_SERVER['PHP_SELF']) === 'index.php' ? 'class="active"' : '' ?>>首页</a></li>
            <li><a href="#">技术</a></li>
            <li><a href="#">设计</a></li>
            <li><a href="#">生活</a></li>
            <li><a href="about.php">关于</a></li>
            <li><a href="contact.php">联系</a></li>
        </ul>
    </div>
</nav>