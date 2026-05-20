<?php
// admin/blogs.php - Manage Insights & Articles
require_once __DIR__ . '/../config/db.php';
check_admin_auth();

$csrf_token = generate_csrf_token();
$action = isset($_GET['action']) ? sanitize($_GET['action']) : 'list';
$edit_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$errors = [];

// Ensure upload directory exists
$upload_dir = __DIR__ . '/../uploads/';
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// 1. DELETE ACTION
if ($action === 'delete' && $edit_id > 0) {
    try {
        $stmt = $pdo->prepare("DELETE FROM blogs WHERE id = ?");
        $stmt->execute([$edit_id]);
        set_flash_message('success', 'Article deleted successfully.');
    } catch (Exception $e) {
        set_flash_message('error', 'Could not delete article: ' . $e->getMessage());
    }
    header("Location: /admin/blogs.php");
    exit;
}

// 2. ADD / EDIT POST HANDLER
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';

    if (!verify_csrf_token($token)) {
        $errors[] = 'CSRF validation failed.';
    } else {
        $title = isset($_POST['title']) ? sanitize($_POST['title']) : '';
        $category = isset($_POST['category']) ? sanitize($_POST['category']) : '';
        $summary = isset($_POST['summary']) ? sanitize($_POST['summary']) : '';
        $content = isset($_POST['content']) ? $_POST['content'] : ''; // Allow raw HTML tags from text editor
        $keywords = isset($_POST['meta_keywords']) ? sanitize($_POST['meta_keywords']) : '';
        $author = isset($_POST['author_name']) ? sanitize($_POST['author_name']) : 'Sisgain Team';
        $status = isset($_POST['status']) ? sanitize($_POST['status']) : 'published';
        
        if (empty($title) || empty($summary) || empty($content)) {
            $errors[] = 'Title, Summary, and Content fields are required.';
        }

        // Image upload handling
        $image_url = isset($_POST['existing_image']) ? $_POST['existing_image'] : '/uploads/blog_default.jpg';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_name = time() . '_' . basename($_FILES['image']['name']);
            $target_file = $upload_dir . $file_name;
            
            // Validate extension
            $ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
            
            if (in-array($ext, $allowed)) {
                if (move_uploaded_file($file_tmp, $target_file)) {
                    $image_url = '/uploads/' . $file_name;
                } else {
                    $errors[] = 'Failed to save uploaded image.';
                }
            } else {
                $errors[] = 'Invalid image type. Allowed: JPG, PNG, WEBP, GIF.';
            }
        }

        if (empty($errors)) {
            $slug = generate_slug($title);
            try {
                if ($edit_id > 0) {
                    // Update
                    $stmt = $pdo->prepare("UPDATE blogs SET title = ?, slug = ?, category = ?, summary = ?, content = ?, image_url = ?, meta_keywords = ?, author_name = ?, status = ? WHERE id = ?");
                    $stmt->execute([$title, $slug, $category, $summary, $content, $image_url, $keywords, $author, $status, $edit_id]);
                    set_flash_message('success', 'Article updated successfully.');
                } else {
                    // Insert
                    $stmt = $pdo->prepare("INSERT INTO blogs (title, slug, category, summary, content, image_url, meta_keywords, author_name, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$title, $slug, $category, $summary, $content, $image_url, $keywords, $author, $status]);
                    set_flash_message('success', 'Article published successfully.');
                }
                header("Location: /admin/blogs.php");
                exit;
            } catch (Exception $e) {
                $errors[] = 'Database failure: ' . $e->getMessage();
            }
        }
    }
}

// 3. FETCH DATA FOR EDIT MODE
$edit_post = null;
if (($action === 'edit' || $action === 'add') && $edit_id > 0) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM blogs WHERE id = ? LIMIT 1");
        $stmt->execute([$edit_id]);
        $edit_post = $stmt->fetch();
    } catch (Exception $e) {
        $errors[] = 'Failed to load post data.';
    }
}

// 4. FETCH ALL BLOGS FOR LIST MODE
try {
    $stmt = $pdo->query("SELECT * FROM blogs ORDER BY created_at DESC");
    $all_posts = $stmt->fetchAll();
} catch (Exception $e) {
    $all_posts = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Insights | Sisgain Advisory Systems</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        darkBg: '#060816',
                        darkCard: '#0D1324',
                        accentBlue: '#3B82F6',
                        neonCyan: '#06B6D4'
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        space: ['Space Grotesk', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-darkBg text-white min-h-screen flex flex-col">

    <!-- Header -->
    <header class="border-b border-white/5 bg-darkCard/50 backdrop-blur px-6 py-4 flex items-center justify-between">
        <a href="/admin/index.php" class="flex items-center space-x-2">
            <span class="text-lg font-bold font-space bg-gradient-to-r from-blue-500 to-cyan-400 bg-clip-text text-transparent">SISGAIN ADVISORY</span>
            <span class="text-[9px] uppercase bg-blue-500/20 text-blue-400 px-2 py-0.5 rounded border border-blue-500/30">Control Console</span>
        </a>
        <div class="flex items-center space-x-4">
            <span class="text-xs text-zinc-400">Authenticated as: <strong class="text-white"><?= htmlspecialchars($_SESSION['admin_username']) ?></strong></span>
            <a href="/admin/logout.php" class="text-xs text-red-400 hover:text-red-300 transition-colors flex items-center border border-red-500/20 bg-red-500/5 px-3 py-1.5 rounded-lg">
                <i data-lucide="log-out" class="w-3.5 h-3.5 mr-1"></i> Sign Out
            </a>
        </div>
    </header>

    <div class="flex-1 flex flex-col lg:flex-row">
        <!-- Sidebar -->
        <aside class="w-full lg:w-64 border-r border-white/5 bg-darkCard/25 p-6 space-y-6">
            <h3 class="text-zinc-500 text-[10px] uppercase font-bold tracking-wider">Systems Directories</h3>
            <nav class="flex flex-col space-y-1 text-xs">
                <a href="/admin/index.php" class="flex items-center space-x-3 text-zinc-300 hover:text-white px-4 py-3 rounded-xl transition-colors">
                    <i data-lucide="layout-dashboard" class="w-4 h-4 text-zinc-500"></i>
                    <span>Dashboard Metrics</span>
                </a>
                <a href="/admin/blogs.php" class="flex items-center space-x-3 text-blue-400 bg-blue-500/10 px-4 py-3 rounded-xl font-medium">
                    <i data-lucide="book-open" class="w-4 h-4"></i>
                    <span>Manage Insights</span>
                </a>
                <a href="/admin/case-studies.php" class="flex items-center space-x-3 text-zinc-300 hover:text-white px-4 py-3 rounded-xl transition-colors">
                    <i data-lucide="award" class="w-4 h-4 text-zinc-500"></i>
                    <span>Manage Case Studies</span>
                </a>
                <a href="/admin/faqs.php" class="flex items-center space-x-3 text-zinc-300 hover:text-white px-4 py-3 rounded-xl transition-colors">
                    <i data-lucide="help-circle" class="w-4 h-4 text-zinc-500"></i>
                    <span>FAQ Accordions</span>
                </a>
                <a href="/admin/settings.php" class="flex items-center space-x-3 text-zinc-300 hover:text-white px-4 py-3 rounded-xl transition-colors">
                    <i data-lucide="settings" class="w-4 h-4 text-zinc-500"></i>
                    <span>Global Settings</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 md:p-12 space-y-12">
            
            <?php if (!empty($errors)): ?>
                <div class="p-4 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl text-xs space-y-1">
                    <?php foreach ($errors as $err): ?>
                        <p>✔ <?= htmlspecialchars($err) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- LIST MODE -->
            <?php if ($action === 'list'): ?>
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold font-space text-white">Insights Articles</h2>
                    <a href="/admin/blogs.php?action=add" class="bg-blue-600 hover:bg-blue-500 text-white font-medium px-4 py-2 rounded-xl text-xs flex items-center transition-colors">
                        <i data-lucide="plus" class="w-4 h-4 mr-1"></i> Add New Article
                    </a>
                </div>

                <div class="glass-card rounded-2xl overflow-hidden border border-white/10">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="border-b border-white/10 bg-white/2">
                                <th class="p-4 text-zinc-400 font-bold uppercase">Title / Category</th>
                                <th class="p-4 text-zinc-400 font-bold uppercase">Author</th>
                                <th class="p-4 text-zinc-400 font-bold uppercase">Status</th>
                                <th class="p-4 text-zinc-400 font-bold uppercase text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            <?php if (!empty($all_posts)): ?>
                                <?php foreach ($all_posts as $post): ?>
                                    <tr>
                                        <td class="p-4">
                                            <p class="font-bold text-white"><?= htmlspecialchars($post['title']) ?></p>
                                            <p class="text-[10px] text-zinc-500">Category: <?= htmlspecialchars($post['category']) ?></p>
                                        </td>
                                        <td class="p-4 text-zinc-300">
                                            <?= htmlspecialchars($post['author_name']) ?>
                                        </td>
                                        <td class="p-4">
                                            <span class="px-2 py-0.5 rounded text-[10px] <?= $post['status'] === 'published' ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' : 'bg-zinc-800 text-zinc-400 border border-zinc-700' ?>">
                                                <?= ucfirst(htmlspecialchars($post['status'])) ?>
                                            </span>
                                        </td>
                                        <td class="p-4 text-right space-x-2">
                                            <a href="/admin/blogs.php?action=edit&id=<?= $post['id'] ?>" class="text-blue-400 hover:text-blue-300">Edit</a>
                                            <a href="/admin/blogs.php?action=delete&id=<?= $post['id'] ?>" onclick="return confirm('Confirm article deletion?')" class="text-red-400 hover:text-red-300">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="p-8 text-center text-zinc-500">No blog posts found. Click 'Add New Article' to write one.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <!-- ADD / EDIT MODE -->
            <?php if ($action === 'add' || $action === 'edit'): ?>
                <?php 
                    $form_title = ($edit_id > 0 && $edit_post) ? 'Modify Insight Report' : 'Draft New Insight Report'; 
                    $title_val = $edit_post ? $edit_post['title'] : '';
                    $cat_val = $edit_post ? $edit_post['category'] : '';
                    $sum_val = $edit_post ? $edit_post['summary'] : '';
                    $content_val = $edit_post ? $edit_post['content'] : '';
                    $key_val = $edit_post ? $edit_post['meta_keywords'] : '';
                    $auth_val = $edit_post ? $edit_post['author_name'] : 'Sisgain Advisory Team';
                    $status_val = $edit_post ? $edit_post['status'] : 'published';
                    $img_val = $edit_post ? $edit_post['image_url'] : '/uploads/blog_default.jpg';
                ?>
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold font-space text-white"><?= $form_title ?></h2>
                    <a href="/admin/blogs.php" class="text-zinc-500 hover:text-white text-xs flex items-center">
                        <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i> Cancel & Return
                    </a>
                </div>

                <div class="glass-card p-8 md:p-12 rounded-3xl border border-white/10 bg-darkCard/40">
                    <form action="/admin/blogs.php?id=<?= $edit_id ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
                        <input type="hidden" name="existing_image" value="<?= htmlspecialchars($img_val) ?>">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="title" class="text-[9px] uppercase font-bold text-zinc-400">Article Title *</label>
                                <input type="text" id="title" name="title" required value="<?= htmlspecialchars($title_val) ?>" class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-blue-500">
                            </div>
                            <div class="space-y-2">
                                <label for="category" class="text-[9px] uppercase font-bold text-zinc-400">Category / Tag *</label>
                                <input type="text" id="category" name="category" required value="<?= htmlspecialchars($cat_val) ?>" placeholder="e.g. AI & Automation, Cybersecurity" class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-blue-500">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="summary" class="text-[9px] uppercase font-bold text-zinc-400">Summary description (SEO Meta tag description) *</label>
                            <input type="text" id="summary" name="summary" required value="<?= htmlspecialchars($sum_val) ?>" class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-blue-500">
                        </div>

                        <div class="space-y-2">
                            <label for="content" class="text-[9px] uppercase font-bold text-zinc-400">Article markup body *</label>
                            <textarea id="content" name="content" rows="12" required class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-3 text-xs text-white font-mono focus:outline-none focus:border-blue-500"><?= htmlspecialchars($content_val) ?></textarea>
                            <span class="text-[10px] text-zinc-500">Supports standard HTML tags (e.g. &lt;h3&gt;, &lt;p&gt;, &lt;ul&gt;).</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-2">
                                <label for="author_name" class="text-[9px] uppercase font-bold text-zinc-400">Author Name</label>
                                <input type="text" id="author_name" name="author_name" value="<?= htmlspecialchars($auth_val) ?>" class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-blue-500">
                            </div>
                            <div class="space-y-2">
                                <label for="status" class="text-[9px] uppercase font-bold text-zinc-400">Publication Status</label>
                                <select id="status" name="status" class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-blue-500">
                                    <option value="published" <?= $status_val === 'published' ? 'selected' : '' ?>>Published</option>
                                    <option value="draft" <?= $status_val === 'draft' ? 'selected' : '' ?>>Draft</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label for="image" class="text-[9px] uppercase font-bold text-zinc-400">Banner Image Upload</label>
                                <input type="file" id="image" name="image" class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-blue-500">
                                <?php if ($edit_post && $edit_post['image_url']): ?>
                                    <p class="text-[10px] text-zinc-500">Current file: <?= htmlspecialchars($edit_post['image_url']) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="meta_keywords" class="text-[9px] uppercase font-bold text-zinc-400">SEO Keywords (Comma separated)</label>
                            <input type="text" id="meta_keywords" name="meta_keywords" value="<?= htmlspecialchars($key_val) ?>" class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-blue-500">
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-medium py-3 rounded-xl transition-all shadow-lg flex items-center justify-center text-xs">
                            <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                            Save Insight Report
                        </button>
                    </form>
                </div>
            <?php endif; ?>

        </main>
    </div>

    <!-- Toast Alerts -->
    <?php $flash = get_flash_message(); if ($flash): ?>
        <div id="admin-toast" class="fixed bottom-6 right-6 z-50 glass-card bg-darkCard border-l-4 <?= $flash['type'] === 'success' ? 'border-l-emerald-500' : 'border-l-rose-500' ?> px-6 py-4 rounded-xl shadow-2xl">
            <div class="text-xs text-white"><?= htmlspecialchars($flash['text']) ?></div>
        </div>
        <script>
            setTimeout(() => document.getElementById("admin-toast").remove(), 4000);
        </script>
    <?php endif; ?>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            lucide.createIcons();
        });
    </script>
</body>
</html>
