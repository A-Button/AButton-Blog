<?php
require_once '../inc/.auth.php';
require_once '../inc/functions.php';

$postId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$posts = read_json(POSTS_FILE);
$post = null;
$isNew = true;

// 查找现有文章
if ($postId > 0) {
    foreach ($posts as $p) {
        if ($p['id'] === $postId) {
            $post = $p;
            $isNew = false;
            break;
        }
    }
}

// 处理表单提交
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $excerpt = trim($_POST['excerpt'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $tags = trim($_POST['tags'] ?? '');
    $image = trim($_POST['image'] ?? '');
    
    // 验证输入
    if (empty($title)) $errors[] = '标题不能为空';
    if (empty($slug)) $errors[] = 'URL标识不能为空';
    if (empty($content)) $errors[] = '内容不能为空';
    if (empty($category)) $errors[] = '请选择分类';
    
    if (empty($errors)) {
        // 处理标签
        $tagArray = array_map('trim', explode(',', $tags));
        $tagArray = array_filter($tagArray);
        
        $postData = [
            'id' => $isNew ? time() : $postId,
            'title' => $title,
            'slug' => $slug,
            'content' => $content,
            'excerpt' => $excerpt ?: mb_substr(strip_tags($content), 0, 200) . '...',
            'date' => $isNew ? date('Y-m-d') : ($post['date'] ?? date('Y-m-d')),
            'category' => $category,
            'tags' => $tagArray,
            'image' => $image,
            'views' => $isNew ? 0 : ($post['views'] ?? 0)
        ];
        
        // 更新文章数组
        if ($isNew) {
            $posts[] = $postData;
        } else {
            foreach ($posts as &$p) {
                if ($p['id'] === $postId) {
                    $p = $postData;
                    break;
                }
            }
        }
        
        // 保存到JSON
        write_json(POSTS_FILE, $posts);
        
        // 重定向到管理面板
        $_SESSION['success'] = $isNew ? '文章创建成功！' : '文章更新成功！';
        header('Location: index.php');
        exit;
    }
}

// 如果未找到文章，初始化新文章
if (!$post && !$isNew) {
    header('Location: index.php');
    exit;
}

$themeColor = get_theme_color();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $isNew ? '创建新文章' : '编辑文章' ?> | 博客后台</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <style>
        :root {
            --primary-color: <?= $themeColor ?>;
        }
        
        .editor-container {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }
        
        .editor-column {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .editor-preview {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            padding: 20px;
            height: 500px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <?php include 'inc/admin-nav.php'; ?>
        
        <main class="admin-content">
            <div class="admin-header">
                <h1><?= $isNew ? '创建新文章' : '编辑文章' ?></h1>
                <a href="index.php" class="btn-outline">返回列表</a>
            </div>
            
            <?php if (!empty($errors)): ?>
                <div class="alert error">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <form method="POST" class="admin-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="title">文章标题 *</label>
                        <input type="text" id="title" name="title" required 
                               value="<?= htmlspecialchars($post['title'] ?? '') ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="slug">URL标识 *</label>
                        <input type="text" id="slug" name="slug" required 
                               value="<?= htmlspecialchars($post['slug'] ?? '') ?>">
                        <p class="form-hint">用于生成文章URL，只能包含字母、数字和连字符</p>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="category">分类 *</label>
                        <select id="category" name="category" required>
                            <option value="">选择分类</option>
                            <option value="technology" <?= ($post['category'] ?? '') === 'technology' ? 'selected' : '' ?>>技术</option>
                            <option value="design" <?= ($post['category'] ?? '') === 'design' ? 'selected' : '' ?>>设计</option>
                            <option value="life" <?= ($post['category'] ?? '') === 'life' ? 'selected' : '' ?>>生活</option>
                            <option value="travel" <?= ($post['category'] ?? '') === 'travel' ? 'selected' : '' ?>>旅行</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="tags">标签</label>
                        <input type="text" id="tags" name="tags" 
                               value="<?= htmlspecialchars(implode(', ', $post['tags'] ?? [])) ?>">
                        <p class="form-hint">多个标签用英文逗号分隔</p>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="image">特色图片</label>
                    <input type="text" id="image" name="image" 
                           value="<?= htmlspecialchars($post['image'] ?? '') ?>">
                    <p class="form-hint">图片路径，例如: post-image.jpg</p>
                </div>
                
                <div class="form-group">
                    <label for="excerpt">文章摘要</label>
                    <textarea id="excerpt" name="excerpt" rows="3"><?= htmlspecialchars($post['excerpt'] ?? '') ?></textarea>
                    <p class="form-hint">如果不填，将自动从内容中生成</p>
                </div>
                
                <div class="editor-container">
                    <div class="editor-column">
                        <label for="content">文章内容 (Markdown格式) *</label>
                        <textarea id="content" name="content" rows="20" required><?= htmlspecialchars($post['content'] ?? '') ?></textarea>
                    </div>
                    
                    <div class="editor-column">
                        <label>实时预览</label>
                        <div class="editor-preview" id="markdown-preview">
                            <?= $post['content'] ?? '输入内容后预览将显示在这里' ?>
                        </div>
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary"><?= $isNew ? '创建文章' : '更新文章' ?></button>
                    <button type="button" class="btn btn-outline" id="save-draft">保存草稿</button>
                </div>
            </form>
        </main>
    </div>
    
    <script src="../assets/js/marked.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const contentInput = document.getElementById('content');
            const preview = document.getElementById('markdown-preview');
            
            // 实时Markdown预览
            contentInput.addEventListener('input', function() {
                preview.innerHTML = marked.parse(this.value);
            });
            
            // 生成slug
            document.getElementById('title').addEventListener('input', function() {
                const slugInput = document.getElementById('slug');
                if (!slugInput.value) {
                    const slug = this.value
                        .toLowerCase()
                        .replace(/[^a-z0-9\s]/g, '')
                        .replace(/\s+/g, '-');
                    slugInput.value = slug;
                }
            });
            
            // 保存草稿
            document.getElementById('save-draft').addEventListener('click', function() {
                alert('草稿保存功能需要进一步实现');
                // 这里可以添加本地存储草稿的功能
            });
        });
    </script>
</body>
</html>