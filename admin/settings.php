<?php
// admin/settings.php - Global Advisory Platform Settings
require_once __DIR__ . '/../config/db.php';
check_admin_auth();

$csrf_token = generate_csrf_token();
$errors = [];
$success = false;

// 1. HANDLE POST SUBMISSION
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';

    if (!verify_csrf_token($token)) {
        $errors[] = 'CSRF verification failed.';
    } else {
        $settings = isset($_POST['settings']) ? $_POST['settings'] : [];
        
        try {
            $pdo->beginTransaction();
            
            // Loop and save settings parameters dynamically
            $stmt = $pdo->prepare("INSERT INTO settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?");
            foreach ($settings as $key => $val) {
                $sanitized_key = sanitize($key);
                $sanitized_val = sanitize($val);
                $stmt->execute([$sanitized_key, $sanitized_val, $sanitized_val]);
            }
            
            $pdo->commit();
            set_flash_message('success', 'Global parameters updated successfully.');
            header("Location: /admin/settings.php");
            exit;
        } catch (Exception $e) {
            $pdo->rollBack();
            $errors[] = 'Failed to save settings: ' . $e->getMessage();
        }
    }
}

// 2. FETCH ALL SETTINGS
$current_settings = [];
try {
    $stmt = $pdo->query("SELECT setting_key, setting_value FROM settings");
    while ($row = $stmt->fetch()) {
        $current_settings[$row['setting_key']] = $row['setting_value'];
    }
} catch (Exception $e) {
    // Fail silently, defaults fallback
}

// Helper function to read settings safely in template
function settings_value($key, $default = '') {
    global $current_settings;
    return isset($current_settings[$key]) ? $current_settings[$key] : $default;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Configurations | Sisgain Advisory Systems</title>
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
                <a href="/admin/faqs.php" class="flex items-center space-x-3 text-zinc-300 hover:text-white px-4 py-3 rounded-xl transition-colors">
                    <i data-lucide="help-circle" class="w-4 h-4 text-zinc-500"></i>
                    <span>FAQ Accordions</span>
                </a>
                <a href="/admin/settings.php" class="flex items-center space-x-3 text-blue-400 bg-blue-500/10 px-4 py-3 rounded-xl font-medium">
                    <i data-lucide="settings" class="w-4 h-4"></i>
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

            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold font-space text-white">Global Configuration Parameters</h2>
            </div>

            <div class="glass-card p-8 md:p-12 rounded-3xl border border-white/10 bg-darkCard/40">
                <form action="/admin/settings.php" method="POST" class="space-y-6">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">

                    <h3 class="text-xs uppercase tracking-wider text-blue-400 font-bold font-space pb-2 border-b border-white/5">Locations & Address Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label class="text-[9px] uppercase font-bold text-zinc-400">Office address UAE</label>
                            <input type="text" name="settings[office_uae]" value="<?= htmlspecialchars(settings_value('office_uae', 'Level 24, Marina Plaza, Dubai Marina, Dubai, UAE')) ?>" class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-blue-500">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] uppercase font-bold text-zinc-400">Office address USA</label>
                            <input type="text" name="settings[office_usa]" value="<?= htmlspecialchars(settings_value('office_usa', 'Suite 800, Louisiana St, Houston, TX 77002, USA')) ?>" class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-blue-500">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] uppercase font-bold text-zinc-400">Office address India</label>
                            <input type="text" name="settings[office_india]" value="<?= htmlspecialchars(settings_value('office_india', 'Phase III, Info City, Sector 34, Gurugram, HR 122001, India')) ?>" class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-blue-500">
                        </div>
                    </div>

                    <h3 class="text-xs uppercase tracking-wider text-cyan-400 font-bold font-space pt-6 pb-2 border-b border-white/5">Consultation & Contact Channels</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[9px] uppercase font-bold text-zinc-400">Calendly link</label>
                            <input type="text" name="settings[calendly_link]" value="<?= htmlspecialchars(settings_value('calendly_link', 'https://calendly.com/sisgain-consulting/strategy-call')) ?>" class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-blue-500">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] uppercase font-bold text-zinc-400">Consultation Email</label>
                            <input type="text" name="settings[contact_email]" value="<?= htmlspecialchars(settings_value('contact_email', 'advisory@sisgain.com')) ?>" class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-blue-500">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-medium py-3 rounded-xl transition-all shadow-lg flex items-center justify-center text-xs">
                        <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                        Save Configuration settings
                    </button>
                </form>
            </div>

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
