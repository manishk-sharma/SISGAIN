<?php
// admin/index.php - Administration Main Dashboard
require_once __DIR__ . '/../config/db.php';
check_admin_auth();

$csrf_token = generate_csrf_token();

// Fetch summary metrics
try {
    $leads_count = $pdo->query("SELECT COUNT(*) FROM leads")->fetchColumn();
    $blogs_count = $pdo->query("SELECT COUNT(*) FROM blogs")->fetchColumn();
    $cases_count = $pdo->query("SELECT COUNT(*) FROM case_studies")->fetchColumn();
    
    // Fetch latest leads
    $stmt = $pdo->query("SELECT * FROM leads ORDER BY created_at DESC LIMIT 10");
    $latest_leads = $stmt->fetchAll();
} catch (Exception $e) {
    $leads_count = $blogs_count = $cases_count = 0;
    $latest_leads = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Console | Sisgain Advisory Systems</title>
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

    <!-- Top Admin Header -->
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
        <!-- Sidebar Navigation -->
        <aside class="w-full lg:w-64 border-r border-white/5 bg-darkCard/25 p-6 space-y-6">
            <h3 class="text-zinc-500 text-[10px] uppercase font-bold tracking-wider">Systems Directories</h3>
            <nav class="flex flex-col space-y-1 text-xs">
                <a href="/admin/index.php" class="flex items-center space-x-3 text-blue-400 bg-blue-500/10 px-4 py-3 rounded-xl font-medium">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
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
                <a href="/admin/settings.php" class="flex items-center space-x-3 text-zinc-300 hover:text-white px-4 py-3 rounded-xl transition-colors">
                    <i data-lucide="settings" class="w-4 h-4 text-zinc-500"></i>
                    <span>Global Settings</span>
                </a>
            </nav>
            <div class="border-t border-white/5 pt-6 text-center">
                <a href="/index.php" target="_blank" class="text-[10px] text-zinc-500 hover:text-white transition-colors flex items-center justify-center">
                    <i data-lucide="external-link" class="w-3.5 h-3.5 mr-1"></i>
                    View Public Site
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 p-6 md:p-12 space-y-12">
            <!-- Metrics Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Leads -->
                <div class="glass-card p-6 rounded-2xl border border-white/5 bg-darkCard/40 flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-zinc-500 text-[10px] uppercase font-bold tracking-wider">Total Leads Logged</span>
                        <p class="text-2xl font-bold font-space text-blue-400"><?= $leads_count ?></p>
                    </div>
                    <div class="p-3 bg-blue-500/10 text-blue-400 rounded-xl">
                        <i data-lucide="users" class="w-6 h-6"></i>
                    </div>
                </div>
                <!-- Blogs -->
                <div class="glass-card p-6 rounded-2xl border border-white/5 bg-darkCard/40 flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-zinc-500 text-[10px] uppercase font-bold tracking-wider">Published Articles</span>
                        <p class="text-2xl font-bold font-space text-cyan-400"><?= $blogs_count ?></p>
                    </div>
                    <div class="p-3 bg-cyan-500/10 text-cyan-400 rounded-xl">
                        <i data-lucide="book-open" class="w-6 h-6"></i>
                    </div>
                </div>
                <!-- Case Studies -->
                <div class="glass-card p-6 rounded-2xl border border-white/5 bg-darkCard/40 flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-zinc-500 text-[10px] uppercase font-bold tracking-wider">Active Case Studies</span>
                        <p class="text-2xl font-bold font-space text-purple-400"><?= $cases_count ?></p>
                    </div>
                    <div class="p-3 bg-purple-500/10 text-purple-400 rounded-xl">
                        <i data-lucide="award" class="w-6 h-6"></i>
                    </div>
                </div>
            </div>

            <!-- Leads Management Section -->
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold font-space text-white flex items-center">
                        <i data-lucide="inbox" class="w-5 h-5 text-blue-400 mr-2"></i>
                        Recorded Client Leads
                    </h2>
                </div>

                <div class="glass-card rounded-2xl overflow-hidden border border-white/10">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="border-b border-white/10 bg-white/2">
                                <th class="p-4 text-zinc-400 font-bold uppercase">Name / Company</th>
                                <th class="p-4 text-zinc-400 font-bold uppercase">Contact info</th>
                                <th class="p-4 text-zinc-400 font-bold uppercase">Inquiry Type</th>
                                <th class="p-4 text-zinc-400 font-bold uppercase">ROI Math Estimates</th>
                                <th class="p-4 text-zinc-400 font-bold uppercase">Logged Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            <?php if (!empty($latest_leads)): ?>
                                <?php foreach ($latest_leads as $lead): ?>
                                    <tr>
                                        <!-- Name -->
                                        <td class="p-4">
                                            <p class="font-bold text-white"><?= htmlspecialchars($lead['name']) ?></p>
                                            <p class="text-[10px] text-zinc-500"><?= htmlspecialchars($lead['company_name']) ?></p>
                                        </td>
                                        <!-- Contact details -->
                                        <td class="p-4">
                                            <p class="text-zinc-300"><?= htmlspecialchars($lead['email']) ?></p>
                                            <p class="text-[10px] text-zinc-500"><?= htmlspecialchars($lead['phone']) ?></p>
                                        </td>
                                        <!-- Inquiry Type -->
                                        <td class="p-4">
                                            <?php if ($lead['type'] === 'roi_calculator'): ?>
                                                <span class="px-2 py-0.5 rounded bg-cyan-500/20 text-cyan-400 border border-cyan-500/30">ROI Calculator</span>
                                            <?php else: ?>
                                                <span class="px-2 py-0.5 rounded bg-blue-500/20 text-blue-400 border border-blue-500/30">Contact form</span>
                                            <?php endif; ?>
                                        </td>
                                        <!-- ROI Calculations output -->
                                        <td class="p-4">
                                            <?php if ($lead['type'] === 'roi_calculator'): ?>
                                                <p class="text-emerald-400 font-semibold font-space">Est. Saving: $<?= number_format($lead['calculated_savings'], 0) ?></p>
                                                <p class="text-[10px] text-zinc-500">3-Yr ROI: <?= number_format($lead['calculated_roi_pct'], 0) ?>%</p>
                                            <?php else: ?>
                                                <p class="text-zinc-400 italic line-clamp-1 max-w-[200px]" title="<?= htmlspecialchars($lead['message']) ?>"><?= htmlspecialchars($lead['message']) ?></p>
                                            <?php endif; ?>
                                        </td>
                                        <!-- Created At -->
                                        <td class="p-4 text-zinc-500">
                                            <?= date('M j, Y H:i', strtotime($lead['created_at'])) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="p-8 text-center text-zinc-500">No leads recorded yet. Try testing forms on public pages.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Toast Alerts layout -->
    <?php $flash = get_flash_message(); if ($flash): ?>
        <div id="admin-toast" class="fixed bottom-6 right-6 z-50 glass-card bg-darkCard border-l-4 <?= $flash['type'] === 'success' ? 'border-l-emerald-500' : 'border-l-rose-500' ?> px-6 py-4 rounded-xl shadow-2xl flex items-center space-x-4 max-w-md">
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
