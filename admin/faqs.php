<?php
// admin/faqs.php - FAQ Accordion Admin Management
require_once __DIR__ . '/../config/db.php';
check_admin_auth();

$csrf_token = generate_csrf_token();
$action = isset($_GET['action']) ? sanitize($_GET['action']) : 'list';
$edit_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$errors = [];

// 1. DELETE ACTION
if ($action === 'delete' && $edit_id > 0) {
    try {
        $stmt = $pdo->prepare("DELETE FROM faqs WHERE id = ?");
        $stmt->execute([$edit_id]);
        set_flash_message('success', 'FAQ accordion item deleted successfully.');
    } catch (Exception $e) {
        set_flash_message('error', 'Could not delete FAQ: ' . $e->getMessage());
    }
    header("Location: /admin/faqs.php");
    exit;
}

// 2. ADD / EDIT HANDLER
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';

    if (!verify_csrf_token($token)) {
        $errors[] = 'CSRF validation failed.';
    } else {
        $question = isset($_POST['question']) ? sanitize($_POST['question']) : '';
        $answer = isset($_POST['answer']) ? sanitize($_POST['answer']) : '';
        $sort_order = isset($_POST['sort_order']) ? intval($_POST['sort_order']) : 0;

        if (empty($question) || empty($answer)) {
            $errors[] = 'Question and Answer fields are required.';
        }

        if (empty($errors)) {
            try {
                if ($edit_id > 0) {
                    $stmt = $pdo->prepare("UPDATE faqs SET question = ?, answer = ?, sort_order = ? WHERE id = ?");
                    $stmt->execute([$question, $answer, $sort_order, $edit_id]);
                    set_flash_message('success', 'FAQ updated successfully.');
                } else {
                    $stmt = $pdo->prepare("INSERT INTO faqs (question, answer, sort_order) VALUES (?, ?, ?)");
                    $stmt->execute([$question, $answer, $sort_order]);
                    set_flash_message('success', 'FAQ added successfully.');
                }
                header("Location: /admin/faqs.php");
                exit;
            } catch (Exception $e) {
                $errors[] = 'Database failure: ' . $e->getMessage();
            }
        }
    }
}

// 3. FETCH SINGLE FAQ
$edit_faq = null;
if (($action === 'edit' || $action === 'add') && $edit_id > 0) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM faqs WHERE id = ? LIMIT 1");
        $stmt->execute([$edit_id]);
        $edit_faq = $stmt->fetch();
    } catch (Exception $e) {
        $errors[] = 'Failed to load FAQ.';
    }
}

// 4. LIST ALL FAQS
try {
    $stmt = $pdo->query("SELECT * FROM faqs ORDER BY sort_order ASC, id ASC");
    $all_faqs = $stmt->fetchAll();
} catch (Exception $e) {
    $all_faqs = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ Accordions | Sisgain Advisory Systems</title>
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
                <a href="/admin/blogs.php" class="flex items-center space-x-3 text-zinc-300 hover:text-white px-4 py-3 rounded-xl transition-colors">
                    <i data-lucide="book-open" class="w-4 h-4 text-zinc-500"></i>
                    <span>Manage Insights</span>
                </a>
                <a href="/admin/case-studies.php" class="flex items-center space-x-3 text-zinc-300 hover:text-white px-4 py-3 rounded-xl transition-colors">
                    <i data-lucide="award" class="w-4 h-4 text-zinc-500"></i>
                    <span>Manage Case Studies</span>
                </a>
                <a href="/admin/faqs.php" class="flex items-center space-x-3 text-blue-400 bg-blue-500/10 px-4 py-3 rounded-xl font-medium">
                    <i data-lucide="help-circle" class="w-4 h-4"></i>
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
                    <h2 class="text-xl font-bold font-space text-white">FAQ Accordions</h2>
                    <a href="/admin/faqs.php?action=add" class="bg-blue-600 hover:bg-blue-500 text-white font-medium px-4 py-2 rounded-xl text-xs flex items-center transition-colors">
                        <i data-lucide="plus" class="w-4 h-4 mr-1"></i> Add Accordion
                    </a>
                </div>

                <div class="glass-card rounded-2xl overflow-hidden border border-white/10">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="border-b border-white/10 bg-white/2">
                                <th class="p-4 text-zinc-400 font-bold uppercase">Question</th>
                                <th class="p-4 text-zinc-400 font-bold uppercase">Answer description</th>
                                <th class="p-4 text-zinc-400 font-bold uppercase">Sort Order</th>
                                <th class="p-4 text-zinc-400 font-bold uppercase text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            <?php if (!empty($all_faqs)): ?>
                                <?php foreach ($all_faqs as $faq): ?>
                                    <tr>
                                        <td class="p-4 text-white font-bold max-w-[200px] truncate">
                                            <?= htmlspecialchars($faq['question']) ?>
                                        </td>
                                        <td class="p-4 text-zinc-400 max-w-[300px] truncate">
                                            <?= htmlspecialchars($faq['answer']) ?>
                                        </td>
                                        <td class="p-4 text-zinc-300 font-space font-semibold">
                                            <?= htmlspecialchars($faq['sort_order']) ?>
                                        </td>
                                        <td class="p-4 text-right space-x-2">
                                            <a href="/admin/faqs.php?action=edit&id=<?= $faq['id'] ?>" class="text-blue-400 hover:text-blue-300 font-medium">Edit</a>
                                            <a href="/admin/faqs.php?action=delete&id=<?= $faq['id'] ?>" onclick="return confirm('Confirm deleting FAQ accordion?')" class="text-red-400 hover:text-red-300 font-medium">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="p-8 text-center text-zinc-500">No FAQ accordions created. Click 'Add Accordion' to start.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <!-- ADD / EDIT MODE -->
            <?php if ($action === 'add' || $action === 'edit'): ?>
                <?php 
                    $form_title = ($edit_id > 0 && $edit_faq) ? 'Modify FAQ Item' : 'Create FAQ Item'; 
                    $q_val = $edit_faq ? $edit_faq['question'] : '';
                    $a_val = $edit_faq ? $edit_faq['answer'] : '';
                    $sort_val = $edit_faq ? $edit_faq['sort_order'] : 0;
                ?>
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold font-space text-white"><?= $form_title ?></h2>
                    <a href="/admin/faqs.php" class="text-zinc-500 hover:text-white text-xs flex items-center">
                        <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i> Cancel & Return
                    </a>
                </div>

                <div class="glass-card p-8 md:p-12 rounded-3xl border border-white/10 bg-darkCard/40">
                    <form action="/admin/faqs.php?id=<?= $edit_id ?>" method="POST" class="space-y-6">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">

                        <div class="space-y-2">
                            <label for="question" class="text-[9px] uppercase font-bold text-zinc-400">Question Text *</label>
                            <input type="text" id="question" name="question" required value="<?= htmlspecialchars($q_val) ?>" class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-blue-500">
                        </div>

                        <div class="space-y-2">
                            <label for="answer" class="text-[9px] uppercase font-bold text-zinc-400">Answer Text *</label>
                            <textarea id="answer" name="answer" rows="5" required class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-blue-500"><?= htmlspecialchars($a_val) ?></textarea>
                        </div>

                        <div class="space-y-2">
                            <label for="sort_order" class="text-[9px] uppercase font-bold text-zinc-400">Sorting Priority (Low values show first)</label>
                            <input type="number" id="sort_order" name="sort_order" value="<?= htmlspecialchars($sort_val) ?>" class="w-24 bg-darkBg border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-blue-500">
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-medium py-3 rounded-xl transition-all shadow-lg flex items-center justify-center text-xs">
                            <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                            Save FAQ Item
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
