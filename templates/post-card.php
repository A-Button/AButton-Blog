<div class="post-card" data-category="<?= $post['category'] ?>">
    <?php if ($post['image']): ?>
        <div class="post-image">
            <img src="assets/images/<?= $post['image'] ?>" alt="<?= htmlspecialchars($post['title']) ?>">
        </div>
    <?php endif; ?>
    
    <div class="post-content">
        <div class="post-meta">
            <span class="post-date"><?= date('Y.m.d', strtotime($post['date'])) ?></span>
            <span class="post-category"><?= $post['category'] ?></span>
        </div>
        
        <h3 class="post-title">
            <a href="post.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a>
        </h3>
        
        <p class="post-excerpt"><?= mb_substr(strip_tags($post['excerpt']), 0, 100) ?>...</p>
        
        <div class="post-tags">
            <?php foreach ($post['tags'] as $tag): ?>
                <span class="tag"><?= $tag ?></span>
            <?php endforeach; ?>
        </div>
        
        <a href="post.php?id=<?= $post['id'] ?>" class="btn-outline read-more">阅读全文</a>
    </div>
</div>