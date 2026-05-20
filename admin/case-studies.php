<?php
// admin/case-studies.php - Manage Case Studies
require_once __DIR__ . '/../config/db.php';
check_admin_auth();

$csrf_token = generate_csrf_token();
$action = isset($_GET['action']) ? sanitize($_GET['action']) : 'list';
$edit_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$errors = [];

// 1. DELETE ACTION
if ($action === 'delete' && $edit_id > 0) {
    try {
        $stmt = $pdo->prepare("DELETE FROM case_studies WHERE id = ?");
        $stmt->execute([$edit_id]);
        set_flash_message('success', 'Case study deleted successfully.');
    } catch (Exception $e) {
        set_flash_message('error', 'Could not delete case study: ' . $e->getMessage());
    }
    header("Location: /admin/case-studies.php");
    exit;
}

// 2. ADD / EDIT SUBMIT HANDLER
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';
    
    if (!verify_csrf_token($token)) {
        $errors[] = 'CSRF validation failed.';
    } else {
        $title = isset($_POST['title']) ? sanitize($_POST['title']) : '';
        $client_name = isset($_POST['client_name']) ? sanitize($_POST['client_name']) : '';
        $industry = isset($_POST['industry']) ? sanitize($_POST['industry']) : '';
        $challenge = isset($_POST['challenge']) ? sanitize($_POST['challenge']) : '';
        $strategy = isset($_POST['strategy']) ? sanitize($_POST['strategy']) : '';
        $technologies = isset($_POST['technologies']) ? sanitize($_POST['technologies']) : '';
        $before_stats = isset($_POST['before_stats']) ? sanitize($_POST['before_stats']) : '';
        $after_stats = isset($_POST['after_stats']) ? sanitize($_POST['after_stats']) : '';
        $roi_metric = isset($_POST['roi_metric']) ? sanitize($_POST['roi_metric']) : '';
        $timeline = isset($_POST['timeline']) ? sanitize($_POST['timeline']) : '';

        if (empty($title) || empty($client_name) || empty($challenge) || empty($strategy)) {
            $errors[] = 'Title, Client Name, Challenge, and Strategy are required fields.';
        }

        if (empty($errors)) {
            $slug = generate_slug($title);
            try {
                if ($edit_id > 0) {
                    $stmt = $pdo->prepare("UPDATE case_studies SET title = ?, slug = ?, client_name = ?, industry = ?, challenge = ?, strategy = ?, technologies = ?, before_stats = ?, after_stats = ?, roi_metric = ?, timeline = ? WHERE id = ?");
                    $stmt->execute([$title, $slug, $client_name, $industry, $challenge, $strategy, $technologies, $before_stats, $after_stats, $roi_metric, $timeline, $edit_id]);
                    set_flash_message('success', 'Case study updated successfully.');
                } else {
                    $stmt = $pdo->prepare("INSERT INTO case_studies (title, slug, client_name, industry, challenge, strategy, technologies, before_stats, after_stats, roi_metric, timeline) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$title, $slug, $client_name, $industry, $challenge, $strategy, $technologies, $before_stats, $after_stats, $roi_metric, $timeline]);
                    set_flash_message('success', 'Case study created successfully.');
                }
                header("Location: /admin/case-studies.php");
                exit;
            } catch (Exception $e) {
                $errors[] = 'Database failure: ' . $e->getMessage();
            }
        }
    }
}

// 3. FETCH SINGLE CASE STUDY
$edit_case = null;
if (($action === 'edit' || $action === 'add') && $edit_id > 0) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM case_studies WHERE id = ? LIMIT 1");
        $stmt->execute([$edit_id]);
        $edit_case = $stmt->fetch();
    } catch (Exception $e) {
        $errors[] = 'Failed to load case study data.';
    }
}

// 4. LIST ALL CASE STUDIES
try {
    $stmt = $pdo->query("SELECT * FROM case_studies ORDER BY id DESC");
    $all_cases = $stmt->fetchAll();
} catch (Exception $e) {
    $all_cases = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Case Studies | Sisgain Advisory Systems</title>
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
                <a href="/admin/case-studies.php" class="flex items-center space-x-3 text-blue-400 bg-blue-500/10 px-4 py-3 rounded-xl font-medium">
                    <i data-lucide="award" class="w-4 h-4"></i>
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
                    <h2 class="text-xl font-bold font-space text-white">Advisory Case Studies</h2>
                    <a href="/admin/case-studies.php?action=add" class="bg-blue-600 hover:bg-blue-500 text-white font-medium px-4 py-2 rounded-xl text-xs flex items-center transition-colors">
                        <i data-lucide="plus" class="w-4 h-4 mr-1"></i> Add Case Profile
                    </a>
                </div>

                <div class="glass-card rounded-2xl overflow-hidden border border-white/10">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="border-b border-white/10 bg-white/2">
                                <th class="p-4 text-zinc-400 font-bold uppercase">Client / Industry</th>
                                <th class="p-4 text-zinc-400 font-bold uppercase">Project Title</th>
                                <th class="p-4 text-zinc-400 font-bold uppercase">ROI Projection</th>
                                <th class="p-4 text-zinc-400 font-bold uppercase text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            <?php if (!empty($all_cases)): ?>
                                <?php foreach ($all_cases as $case): ?>
                                    <tr>
                                        <td class="p-4">
                                            <p class="font-bold text-white"><?= htmlspecialchars($case['client_name']) ?></p>
                                            <p class="text-[10px] text-zinc-500"><?= htmlspecialchars($case['industry']) ?></p>
                                        </td>
                                        <td class="p-4 text-zinc-300">
                                            <?= htmlspecialchars($case['title']) ?>
                                        </td>
                                        <td class="p-4 text-emerald-400 font-medium font-space">
                                            <?= htmlspecialchars($case['roi_metric']) ?>
                                        </td>
                                        <td class="p-4 text-right space-x-2">
                                            <a href="/admin/case-studies.php?action=edit&id=<?= $case['id'] ?>" class="text-blue-400 hover:text-blue-300 font-medium">Edit</a>
                                            <a href="/admin/case-studies.php?action=delete&id=<?= $case['id'] ?>" onclick="return confirm('Confirm deleting this profile?')" class="text-red-400 hover:text-red-300 font-medium">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="p-8 text-center text-zinc-500">No case profiles configured yet. Click 'Add Case Profile' to initialize.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <!-- ADD / EDIT MODE -->
            <?php if ($action === 'add' || $action === 'edit'): ?>
                <?php 
                    $form_title = ($edit_id > 0 && $edit_case) ? 'Modify Case Profile' : 'Draft New Case Profile'; 
                    $title_val = $edit_case ? $edit_case['title'] : '';
                    $client_val = $edit_case ? $edit_case['client_name'] : '';
                    $ind_val = $edit_case ? $edit_case['industry'] : '';
                    $ch_val = $edit_case ? $edit_case['challenge'] : '';
                    $st_val = $edit_case ? $edit_case['strategy'] : '';
                    $tech_val = $edit_case ? $edit_case['technologies'] : '';
                    $before_val = $edit_case ? $edit_case['before_stats'] : '';
                    $after_val = $edit_case ? $edit_case['after_stats'] : '';
                    $roi_val = $edit_case ? $edit_case['roi_metric'] : '';
                    $time_val = $edit_case ? $edit_case['timeline'] : '';
                ?>
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold font-space text-white"><?= $form_title ?></h2>
                    <a href="/admin/case-studies.php" class="text-zinc-500 hover:text-white text-xs flex items-center">
                        <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i> Cancel & Return
                    </a>
                </div>

                <div class="glass-card p-8 md:p-12 rounded-3xl border border-white/10 bg-darkCard/40">
                    <form action="/admin/case-studies.php?id=<?= $edit_id ?>" method="POST" class="space-y-6">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-2">
                                <label for="title" class="text-[9px] uppercase font-bold text-zinc-400">Project Title *</label>
                                <input type="text" id="title" name="title" required value="<?= htmlspecialchars($title_val) ?>" class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-blue-500">
                            </div>
                            <div class="space-y-2">
                                <label for="client_name" class="text-[9px] uppercase font-bold text-zinc-400">Client Name *</label>
                                <input type="text" id="client_name" name="client_name" required value="<?= htmlspecialchars($client_val) ?>" class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-blue-500">
                            </div>
                            <div class="space-y-2">
                                <label for="industry" class="text-[9px] uppercase font-bold text-zinc-400">Industry Sector *</label>
                                <input type="text" id="industry" name="industry" required value="<?= htmlspecialchars($ind_val) ?>" placeholder="e.g. Healthcare, Banking" class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-blue-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="challenge" class="text-[9px] uppercase font-bold text-zinc-400">The Challenge *</label>
                                <textarea id="challenge" name="challenge" rows="4" required class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-blue-500"><?= htmlspecialchars($ch_val) ?></textarea>
                            </div>
                            <div class="space-y-2">
                                <label for="strategy" class="text-[9px] uppercase font-bold text-zinc-400">Sisgain Strategy *</label>
                                <textarea id="strategy" name="strategy" rows="4" required class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-blue-500"><?= htmlspecialchars($st_val) ?></textarea>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="technologies" class="text-[9px] uppercase font-bold text-zinc-400">Technologies (Comma separated list)</label>
                                <input type="text" id="technologies" name="technologies" value="<?= htmlspecialchars($tech_val) ?>" placeholder="e.g. AWS, Terraform, Kubernetes" class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-blue-500">
                            </div>
                            <div class="space-y-2">
                                <label for="timeline" class="text-[9px] uppercase font-bold text-zinc-400">Project Timeline</label>
                                <input type="text" id="timeline" name="timeline" value="<?= htmlspecialchars($time_val) ?>" placeholder="e.g. 4 Months, 6 Weeks" class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-blue-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-2">
                                <label for="before_stats" class="text-[9px] uppercase font-bold text-zinc-400">Metrics: Before Modernization</label>
                                <input type="text" id="before_stats" name="before_stats" value="<?= htmlspecialchars($before_val) ?>" placeholder="e.g. 14 Days manual audit" class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-blue-500">
                            </div>
                            <div class="space-y-2">
                                <label for="after_stats" class="text-[9px] uppercase font-bold text-zinc-400">Metrics: After Modernization</label>
                                <input type="text" id="after_stats" name="after_stats" value="<?= htmlspecialchars($after_val) ?>" placeholder="e.g. 1.2 Minutes real-time sync" class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-blue-500">
                            </div>
                            <div class="space-y-2">
                                <label for="roi_metric" class="text-[9px] uppercase font-bold text-zinc-400">Overall ROI return stat</label>
                                <input type="text" id="roi_metric" name="roi_metric" value="<?= htmlspecialchars($roi_val) ?>" placeholder="e.g. $420k saved annually" class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-blue-500">
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-medium py-3 rounded-xl transition-all shadow-lg flex items-center justify-center text-xs">
                            <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                            Save Case Study Profile
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
