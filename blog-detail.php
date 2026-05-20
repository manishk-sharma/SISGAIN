<?php
// blog-detail.php - Single Blog Article
require_once __DIR__ . '/config/db.php';

$slug = isset($_GET['slug']) ? sanitize($_GET['slug']) : '';
$blog = null;
$related = [];

if (!empty($slug)) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM blogs WHERE slug = ? AND status = 'published' LIMIT 1");
        $stmt->execute([$slug]);
        $blog = $stmt->fetch();

        if ($blog) {
            $stmt2 = $pdo->prepare("SELECT id, title, slug, category, created_at FROM blogs WHERE category = ? AND id != ? AND status = 'published' ORDER BY created_at DESC LIMIT 3");
            $stmt2->execute([$blog['category'], $blog['id']]);
            $related = $stmt2->fetchAll();
        }
    } catch (Exception $e) {}
}

$meta_title = $blog ? htmlspecialchars($blog['title']) . ' | Sisgain Insights' : 'Article Not Found | Sisgain';
$meta_description = $blog ? htmlspecialchars(substr($blog['excerpt'] ?? '', 0, 160)) : 'The requested article could not be found.';
$meta_keywords = $blog ? htmlspecialchars($blog['category'] ?? '') . ', Enterprise Insights, Sisgain' : '';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<?php if ($blog): ?>

<!-- ARTICLE HERO -->
<section class="relative py-32 md:py-40 px-6 md:px-12 overflow-hidden">
    <div class="absolute top-20 left-10 w-[400px] h-[400px] bg-blue-600/8 rounded-full filter blur-[120px] pointer-events-none"></div>
    <div class="max-w-4xl mx-auto relative z-10" data-aos="fade-up">
        <div class="flex items-center space-x-4 mb-6">
            <span class="text-[10px] uppercase font-bold tracking-wider text-blue-400 bg-blue-500/10 px-3 py-1 rounded"><?= htmlspecialchars($blog['category']) ?></span>
            <span class="text-xs text-zinc-500"><?= date('F d, Y', strtotime($blog['created_at'])) ?></span>
            <?php $wordCount = str_word_count(strip_tags($blog['content'] ?? '')); $readTime = max(1, round($wordCount / 250)); ?>
            <span class="text-xs text-zinc-500"><?= $readTime ?> min read</span>
        </div>
        <h1 class="text-3xl md:text-5xl lg:text-6xl font-extrabold font-space leading-[1.1] tracking-tight"><?= htmlspecialchars($blog['title']) ?></h1>
        <div class="flex items-center space-x-4 mt-8">
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center text-white font-bold text-sm">
                <?= strtoupper(substr($blog['author'] ?? 'S', 0, 1)) ?>
            </div>
            <div>
                <p class="text-white text-sm font-semibold"><?= htmlspecialchars($blog['author'] ?? 'Sisgain Editorial') ?></p>
                <p class="text-zinc-500 text-xs">Senior Enterprise Architect</p>
            </div>
        </div>
    </div>
</section>

<!-- CONTENT + SIDEBAR -->
<section class="py-16 px-6 md:px-12">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12">
        <!-- ARTICLE BODY -->
        <article class="lg:col-span-8 prose prose-invert prose-sm max-w-none">
            <div class="glass-card p-8 md:p-12 rounded-3xl border border-white/10">
                <div class="text-zinc-300 text-sm leading-[1.8] space-y-6 blog-content">
                    <?= $blog['content'] ?>
                </div>
            </div>

            <!-- Share Bar -->
            <div class="flex items-center justify-between py-8 border-t border-white/10 mt-8">
                <p class="text-zinc-500 text-xs">Share this article:</p>
                <div class="flex items-center space-x-3">
                    <a href="https://twitter.com/intent/tweet?text=<?= urlencode($blog['title']) ?>&url=<?= urlencode('https://sisgain.com/blog-detail.php?slug=' . $blog['slug']) ?>" target="_blank" class="w-9 h-9 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-blue-500/10 hover:border-blue-500/20 transition-all"><i data-lucide="twitter" class="w-4 h-4 text-zinc-400"></i></a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode('https://sisgain.com/blog-detail.php?slug=' . $blog['slug']) ?>" target="_blank" class="w-9 h-9 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-blue-500/10 hover:border-blue-500/20 transition-all"><i data-lucide="linkedin" class="w-4 h-4 text-zinc-400"></i></a>
                    <button onclick="navigator.clipboard.writeText(window.location.href)" class="w-9 h-9 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-blue-500/10 hover:border-blue-500/20 transition-all"><i data-lucide="link" class="w-4 h-4 text-zinc-400"></i></button>
                </div>
            </div>
        </article>

        <!-- SIDEBAR -->
        <aside class="lg:col-span-4 space-y-8">
            <!-- Related Articles -->
            <?php if (!empty($related)): ?>
            <div class="glass-card p-6 rounded-2xl border border-white/10">
                <h4 class="text-white font-bold font-space text-sm mb-4">Related Articles</h4>
                <div class="space-y-4">
                    <?php foreach ($related as $rel): ?>
                    <a href="/blog-detail.php?slug=<?= urlencode($rel['slug']) ?>" class="block group">
                        <p class="text-zinc-300 text-sm font-medium group-hover:text-blue-400 transition-colors"><?= htmlspecialchars($rel['title']) ?></p>
                        <p class="text-zinc-500 text-xs mt-1"><?= date('M d, Y', strtotime($rel['created_at'])) ?></p>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Newsletter -->
            <div class="glass-card p-6 rounded-2xl border border-blue-500/15 bg-blue-500/5">
                <h4 class="text-white font-bold font-space text-sm mb-2">Enterprise Newsletter</h4>
                <p class="text-zinc-400 text-xs mb-4">Get weekly insights on AI, cloud, and digital transformation delivered to your inbox.</p>
                <form action="/contact.php" method="GET" class="space-y-3">
                    <input type="email" placeholder="Your email address" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-blue-500/50 transition-all">
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-semibold py-3 rounded-xl transition-all text-sm">Subscribe</button>
                </form>
            </div>

            <!-- Back to Blog -->
            <a href="/blog.php" class="flex items-center text-sm text-blue-400 hover:text-blue-300 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>Back to All Insights
            </a>
        </aside>
    </div>
</section>

<?php else: ?>

<!-- 404 STATE -->
<section class="min-h-[60vh] flex items-center justify-center px-6 md:px-12">
    <div class="text-center space-y-6" data-aos="fade-up">
        <div class="w-20 h-20 rounded-full bg-zinc-800 flex items-center justify-center mx-auto">
            <i data-lucide="file-x" class="w-10 h-10 text-zinc-500"></i>
        </div>
        <h1 class="text-3xl md:text-4xl font-bold font-space">Article Not Found</h1>
        <p class="text-zinc-400 max-w-md mx-auto">The article you're looking for may have been moved or doesn't exist. Explore our latest enterprise insights below.</p>
        <a href="/blog.php" class="btn-primary inline-flex items-center">
            Browse All Articles <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
        </a>
    </div>
</section>

<?php endif; ?>

<?php
require_once __DIR__ . '/includes/cta.php';
require_once __DIR__ . '/includes/footer.php';
?>
