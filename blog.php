<?php
// blog.php - Enterprise Insights & Thought Leadership
require_once __DIR__ . '/config/db.php';

$meta_title = "Insights & Thought Leadership | Sisgain Enterprise Blog";
$meta_description = "Expert analysis on AI integration, cloud transformation, cybersecurity, and enterprise digital strategy from Sisgain's senior architects.";
$meta_keywords = "Enterprise Blog, Digital Transformation Insights, AI Articles, Cloud Strategy, Cybersecurity Analysis";

$search = isset($_GET['search']) ? sanitize($_GET['search']) : '';
$category = isset($_GET['category']) ? sanitize($_GET['category']) : '';

try {
    $sql = "SELECT * FROM blogs WHERE status = 'published'";
    $params = [];
    if (!empty($search)) {
        $sql .= " AND (title LIKE ? OR excerpt LIKE ?)";
        $params[] = "%$search%";
        $params[] = "%$search%";
    }
    if (!empty($category) && $category !== 'all') {
        $sql .= " AND category = ?";
        $params[] = $category;
    }
    $sql .= " ORDER BY created_at DESC LIMIT 12";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $blogs = $stmt->fetchAll();
} catch (Exception $e) { $blogs = []; }

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<!-- HERO -->
<section class="relative py-32 md:py-40 px-6 md:px-12 overflow-hidden">
    <div class="absolute top-20 right-10 w-[500px] h-[500px] bg-purple-600/8 rounded-full filter blur-[120px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto text-center relative z-10" data-aos="fade-up">
        <span class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full text-xs font-semibold bg-purple-500/10 border border-purple-500/20 text-purple-400 mb-6">
            <i data-lucide="pen-tool" class="w-3.5 h-3.5"></i>
            <span>Expert Analysis</span>
        </span>
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold font-space leading-[1.1] tracking-tight">
            Enterprise Insights &<br><span class="bg-gradient-to-r from-purple-400 via-blue-400 to-cyan-400 bg-clip-text text-transparent">Thought Leadership</span>
        </h1>
        <p class="text-zinc-400 text-lg md:text-xl max-w-2xl mx-auto mt-6">
            Deep-dive analysis from our senior architects on AI, cloud infrastructure, cybersecurity, and enterprise transformation strategy.
        </p>
    </div>
</section>

<!-- SEARCH & FILTERS -->
<section class="px-6 md:px-12 pb-8">
    <div class="max-w-7xl mx-auto space-y-6">
        <form action="/blog.php" method="GET" class="max-w-xl mx-auto" data-aos="fade-up">
            <div class="relative">
                <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search articles..." class="w-full bg-white/5 border border-white/10 rounded-2xl pl-12 pr-4 py-4 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-blue-500/50 transition-all">
                <i data-lucide="search" class="w-5 h-5 text-zinc-500 absolute left-4 top-1/2 -translate-y-1/2"></i>
            </div>
        </form>

        <div class="flex flex-wrap items-center justify-center gap-3" data-aos="fade-up">
            <?php
            $categories = ['all'=>'All','ai'=>'AI & ML','cloud'=>'Cloud','automation'=>'Automation','security'=>'Security','data'=>'Data','strategy'=>'Strategy'];
            foreach ($categories as $key => $label):
                $active = ($category === $key) || (empty($category) && $key === 'all');
            ?>
            <a href="/blog.php<?= $key !== 'all' ? '?category='.$key : '' ?>" class="px-4 py-2 rounded-full text-xs font-medium border transition-all <?= $active ? 'border-blue-500 bg-blue-500/10 text-blue-400' : 'border-white/10 text-zinc-400 hover:border-white/20' ?>"><?= $label ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- BLOG GRID -->
<section class="py-16 px-6 md:px-12">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (!empty($blogs)): ?>
                <?php foreach ($blogs as $blog): ?>
                <a href="/blog-detail.php?slug=<?= urlencode($blog['slug']) ?>" class="glass-card rounded-3xl overflow-hidden group flex flex-col" data-aos="fade-up">
                    <div class="h-48 bg-gradient-to-br from-blue-600/20 to-purple-600/20 flex items-center justify-center">
                        <i data-lucide="file-text" class="w-12 h-12 text-zinc-600 group-hover:text-blue-400 transition-colors"></i>
                    </div>
                    <div class="p-6 space-y-3 flex-1 flex flex-col">
                        <span class="text-[10px] uppercase font-bold tracking-wider text-blue-400 bg-blue-500/10 px-2.5 py-1 rounded self-start"><?= htmlspecialchars($blog['category']) ?></span>
                        <h3 class="text-lg font-bold font-space text-white group-hover:text-blue-400 transition-colors"><?= htmlspecialchars($blog['title']) ?></h3>
                        <p class="text-zinc-400 text-sm leading-relaxed flex-1"><?= htmlspecialchars(substr($blog['excerpt'], 0, 150)) ?>...</p>
                        <div class="flex items-center justify-between text-xs text-zinc-500 pt-3 border-t border-white/5 mt-auto">
                            <span><?= htmlspecialchars($blog['author'] ?? 'Sisgain Editorial') ?></span>
                            <span><?= date('M d, Y', strtotime($blog['created_at'])) ?></span>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            <?php else: ?>
                <?php
                $fallback_blogs = [
                    ['AI & ML','The Enterprise Guide to RAG Pipeline Architecture','Retrieval-Augmented Generation is transforming how enterprises build knowledge systems. Learn how to architect production-grade RAG pipelines that deliver accurate, contextual responses from your proprietary data.','Dr. Sarah Chen','Mar 15, 2026'],
                    ['Cloud','Multi-Cloud Strategy: Avoiding Vendor Lock-In at Scale','As enterprises distribute workloads across AWS, Azure, and GCP, the risk of fragmented operations grows. This guide presents a unified orchestration framework for multi-cloud governance.','James Rodriguez','Mar 08, 2026'],
                    ['Security','Zero-Trust Architecture: A CISO\'s Implementation Playbook','Traditional perimeter security is obsolete. This comprehensive guide walks through identity-first security architecture, micro-segmentation strategies, and continuous verification protocols.','Michael Okafor','Feb 28, 2026'],
                    ['Automation','Process Mining: Discovering Hidden Automation Opportunities','Before you automate, you need to understand. Process mining uses event log analysis to reveal bottlenecks, compliance deviations, and automation candidates across your enterprise workflows.','Emily Watson','Feb 20, 2026'],
                    ['Data','Building a Modern Data Mesh for Enterprise Analytics','Centralized data lakes are giving way to distributed data mesh architectures. Learn how domain-oriented data ownership and self-serve infrastructure accelerate analytical maturity.','Priya Sharma','Feb 12, 2026'],
                    ['Strategy','Digital Maturity Assessment: Where Does Your Enterprise Stand?','Our proprietary 5-level maturity model helps CIOs benchmark their organizations digital capabilities against industry leaders and identify the highest-impact transformation initiatives.','Robert Kim','Feb 05, 2026']
                ];
                foreach ($fallback_blogs as $fi => $fb):
                ?>
                <div class="glass-card rounded-3xl overflow-hidden group flex flex-col" data-aos="fade-up" data-aos-delay="<?= $fi * 80 ?>">
                    <div class="h-48 bg-gradient-to-br from-blue-600/20 to-purple-600/20 flex items-center justify-center">
                        <i data-lucide="file-text" class="w-12 h-12 text-zinc-600 group-hover:text-blue-400 transition-colors"></i>
                    </div>
                    <div class="p-6 space-y-3 flex-1 flex flex-col">
                        <span class="text-[10px] uppercase font-bold tracking-wider text-blue-400 bg-blue-500/10 px-2.5 py-1 rounded self-start"><?= $fb[0] ?></span>
                        <h3 class="text-lg font-bold font-space text-white group-hover:text-blue-400 transition-colors"><?= $fb[1] ?></h3>
                        <p class="text-zinc-400 text-sm leading-relaxed flex-1"><?= $fb[2] ?></p>
                        <div class="flex items-center justify-between text-xs text-zinc-500 pt-3 border-t border-white/5 mt-auto">
                            <span><?= $fb[3] ?></span><span><?= $fb[4] ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
require_once __DIR__ . '/includes/cta.php';
require_once __DIR__ . '/includes/footer.php';
?>
