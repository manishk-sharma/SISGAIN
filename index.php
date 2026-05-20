<?php
// index.php - Enterprise Home Page
require_once __DIR__ . '/config/db.php';

$meta_title = "SISGAIN | Enterprise Digital Transformation Advisory & Engineering";
$meta_description = "Scale operations, automate workflows, migrate infrastructure, and deploy custom AI models. Modernize your corporate IT landscape with Sisgain.";
$meta_keywords = "Digital Transformation Consulting, Enterprise AI, Legacy Modernization, Cloud Migration, Hyperautomation, Sisgain";

try {
    $stmt = $pdo->query("SELECT * FROM case_studies WHERE is_featured = 1 LIMIT 3");
    $featured_cases = $stmt->fetchAll();
} catch (Exception $e) { $featured_cases = []; }

try {
    $stmt = $pdo->query("SELECT * FROM faqs ORDER BY sort_order ASC LIMIT 5");
    $faqs = $stmt->fetchAll();
} catch (Exception $e) { $faqs = []; }

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<!-- ========== HERO ========== -->
<header class="relative min-h-screen flex items-center pt-24 pb-20 px-6 md:px-12 overflow-hidden grid-bg">
    <div class="absolute top-10 left-0 w-[600px] h-[600px] bg-blue-600/8 rounded-full filter blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-cyan-500/8 rounded-full filter blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-16 items-center relative z-10 w-full">
        <div class="lg:col-span-7 space-y-8" data-aos="fade-right">
            <span class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full text-xs font-semibold bg-blue-500/10 border border-blue-500/20 text-blue-400">
                <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                <span>Enterprise Consulting 2026</span>
            </span>

            <h1 class="text-5xl md:text-7xl font-extrabold font-space leading-[1.08] tracking-tight">
                Digital Transformation<br>Services Built for<br>
                <span class="bg-gradient-to-r from-blue-500 via-cyan-400 to-indigo-500 bg-clip-text text-transparent">Enterprise Growth</span>
            </h1>

            <p class="text-zinc-400 text-lg md:text-xl leading-relaxed max-w-2xl">
                Modernize operations, automate workflows, integrate AI, and build scalable digital ecosystems designed for the future of enterprise technology.
            </p>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 pt-2">
                <a href="/contact.php" class="btn-primary text-center">
                    Book Free Strategy Call
                    <i data-lucide="arrow-right" class="w-4 h-4 ml-2 inline-block"></i>
                </a>
                <a href="/roi-calculator.php" class="btn-secondary text-center">
                    <i data-lucide="calculator" class="w-4 h-4 mr-2 inline-block text-cyan-400"></i>
                    Calculate Your ROI
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 pt-10 border-t border-white/5 mt-4">
                <div class="flex items-center space-x-2.5"><i data-lucide="award" class="w-5 h-5 text-blue-500 flex-shrink-0"></i><span class="text-xs text-zinc-400">250+ Projects</span></div>
                <div class="flex items-center space-x-2.5"><i data-lucide="shield-check" class="w-5 h-5 text-cyan-500 flex-shrink-0"></i><span class="text-xs text-zinc-400">HIPAA & GDPR</span></div>
                <div class="flex items-center space-x-2.5"><i data-lucide="globe" class="w-5 h-5 text-indigo-500 flex-shrink-0"></i><span class="text-xs text-zinc-400">UAE | USA | India</span></div>
                <div class="flex items-center space-x-2.5"><i data-lucide="users" class="w-5 h-5 text-emerald-500 flex-shrink-0"></i><span class="text-xs text-zinc-400">98% Retention</span></div>
            </div>
        </div>

        <div class="lg:col-span-5 relative" data-aos="fade-left">
            <div class="h-[480px] glass-card rounded-3xl overflow-hidden border border-white/10 relative">
                <canvas id="hero-canvas" class="absolute inset-0 w-full h-full"></canvas>
                <div class="absolute bottom-6 left-6 glass-card bg-[#0D1324]/90 border border-white/15 px-5 py-3.5 rounded-2xl flex items-center space-x-4 z-20" style="animation: float 4s ease-in-out infinite;">
                    <div class="p-2.5 rounded-xl bg-blue-500/10 text-blue-400"><i data-lucide="trending-up" class="w-5 h-5"></i></div>
                    <div>
                        <p class="text-[10px] text-zinc-500 uppercase tracking-wider font-semibold">Workflow Velocity</p>
                        <p class="text-sm font-bold text-white font-space">3.8x Speed Increment</p>
                    </div>
                </div>
                <div class="absolute top-6 right-6 glass-card bg-[#0D1324]/90 border border-white/15 px-5 py-3.5 rounded-2xl flex items-center space-x-4 z-20">
                    <div class="p-2.5 rounded-xl bg-emerald-500/10 text-emerald-400"><i data-lucide="shield-check" class="w-5 h-5"></i></div>
                    <div>
                        <p class="text-[10px] text-zinc-500 uppercase tracking-wider font-semibold">Security Posture</p>
                        <p class="text-sm font-bold text-white font-space">Zero-Trust Active</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>@keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}</style>
</header>

<!-- ========== TRUST MARQUEE ========== -->
<section class="py-12 bg-[#040610] border-y border-white/5 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 md:px-12 flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="text-xs text-zinc-500 uppercase tracking-wider font-semibold flex-shrink-0 whitespace-nowrap">Trusted By Industry Leaders:</div>
        <div class="w-full overflow-hidden marquee-container">
            <div class="marquee-content flex space-x-16">
                <?php $brands = [['layers','blue','Apex Health Group'],['truck','cyan','Gulf Logistics Corp'],['database','indigo','Capital Bank Group'],['flame','orange','Saudi Oil & Energy'],['globe','emerald','Oman Telecoms'],['building','purple','Dubai PropTech']]; ?>
                <?php foreach ([1,2] as $loop): ?>
                    <?php foreach ($brands as $b): ?>
                        <span class="text-sm font-bold tracking-wide text-zinc-600 font-space uppercase flex items-center whitespace-nowrap">
                            <i data-lucide="<?= $b[0] ?>" class="w-4 h-4 mr-2 text-<?= $b[1] ?>-500"></i><?= $b[2] ?>
                        </span>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- ========== PAIN POINTS BENTO GRID ========== -->
<section class="py-24 md:py-32 px-6 md:px-12 relative">
    <div class="max-w-7xl mx-auto space-y-16">
        <div class="text-center max-w-3xl mx-auto space-y-4" data-aos="fade-up">
            <span class="text-xs uppercase font-semibold text-cyan-400 tracking-wider">The Cost of Inaction</span>
            <h2 class="text-3xl md:text-5xl font-bold font-space leading-tight">Is Your Legacy Stack Holding You Back?</h2>
            <p class="text-zinc-400 text-lg">Legacy infrastructure silently drains capital, slows innovation, and exposes your enterprise to compounding risk.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            <div class="md:col-span-8 glass-card bento-glow-container p-8 md:p-10 rounded-3xl flex flex-col justify-between min-h-[260px]" data-aos="fade-up">
                <div><div class="w-12 h-12 rounded-xl bg-blue-500/10 border border-blue-500/20 text-blue-400 flex items-center justify-center mb-6"><i data-lucide="server-crash" class="w-6 h-6"></i></div>
                <h3 class="text-xl font-bold font-space">Legacy Infrastructure</h3>
                <p class="text-zinc-400 text-sm mt-3 max-w-lg">On-premise servers and monolithic architectures create bottlenecks that prevent scalability. Every year of delay compounds technical debt and increases migration costs exponentially.</p></div>
                <div class="text-right mt-6"><span class="text-2xl font-bold font-space text-blue-400">50%+ Maintenance Drag</span></div>
            </div>
            <div class="md:col-span-4 glass-card bento-glow-container p-8 rounded-3xl flex flex-col justify-between min-h-[260px]" data-aos="fade-up" data-aos-delay="100">
                <div><div class="w-12 h-12 rounded-xl bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 flex items-center justify-center mb-6"><i data-lucide="database-zap" class="w-6 h-6"></i></div>
                <h3 class="text-xl font-bold font-space">Data Silos</h3>
                <p class="text-zinc-400 text-sm mt-3">Fragmented databases prevent unified analytics and real-time decision-making across business units.</p></div>
                <div class="text-right mt-6"><span class="text-2xl font-bold font-space text-cyan-400">30% Engineering Lag</span></div>
            </div>
            <div class="md:col-span-4 glass-card bento-glow-container p-8 rounded-3xl flex flex-col justify-between min-h-[260px]" data-aos="fade-up">
                <div><div class="w-12 h-12 rounded-xl bg-purple-500/10 border border-purple-500/20 text-purple-400 flex items-center justify-center mb-6"><i data-lucide="cpu" class="w-6 h-6"></i></div>
                <h3 class="text-xl font-bold font-space">Manual Operations</h3>
                <p class="text-zinc-400 text-sm mt-3">Repetitive manual tasks consume engineering capacity and introduce compliance errors at scale.</p></div>
                <div class="text-right mt-6"><span class="text-2xl font-bold font-space text-purple-400">71% Manual Delay</span></div>
            </div>
            <div class="md:col-span-8 glass-card bento-glow-container p-8 md:p-10 rounded-3xl flex flex-col justify-between min-h-[260px]" data-aos="fade-up" data-aos-delay="100">
                <div><div class="w-12 h-12 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 flex items-center justify-center mb-6"><i data-lucide="shield-alert" class="w-6 h-6"></i></div>
                <h3 class="text-xl font-bold font-space">Security & Audit Gaps</h3>
                <p class="text-zinc-400 text-sm mt-3 max-w-lg">Weak authentication frameworks and outdated compliance postures expose customer data and intellectual property to catastrophic breaches that average $4.4M in direct costs per incident.</p></div>
                <div class="text-right mt-6"><span class="text-2xl font-bold font-space text-red-400">$4.4M Avg. Breach Cost</span></div>
            </div>
        </div>
    </div>
</section>

<!-- ========== TRANSFORMATION FRAMEWORK ========== -->
<section class="py-24 md:py-32 bg-[#040610] px-6 md:px-12">
    <div class="max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto space-y-4 mb-20" data-aos="fade-up">
            <span class="text-xs uppercase font-semibold text-blue-400 tracking-wider">Engineering Delivery</span>
            <h2 class="text-3xl md:text-5xl font-bold font-space">The Sisgain Transformation Framework</h2>
            <p class="text-zinc-400 text-lg">A rigorous, end-to-end modernization methodology designed to guarantee production stability and measurable ROI.</p>
        </div>

        <div class="relative framework-timeline">
            <div class="grid grid-cols-1 lg:grid-cols-6 gap-8 relative z-10">
                <?php
                $steps = [
                    ['01','Discovery & Audit','Analyze current infrastructure, identify technical debt, and benchmark performance baselines.'],
                    ['02','Strategy & Architecture','Define target-state blueprints, select technology stacks, and scope investment timelines.'],
                    ['03','Infrastructure Modernization','Deploy containerized environments, migrate databases, and establish CI/CD pipelines.'],
                    ['04','AI Integration','Embed predictive models, NLP engines, and intelligent automation into core workflows.'],
                    ['05','Platform Engineering','Build monitoring dashboards, configure alerting systems, and optimize performance.'],
                    ['06','Continuous Optimization','Scale horizontally, refine models with production data, and drive continuous improvement.']
                ];
                foreach ($steps as $i => $s):
                    $active = $i === 0;
                ?>
                <div class="flex lg:flex-col items-start lg:items-center space-x-6 lg:space-x-0 text-left lg:text-center" data-aos="fade-up" data-aos-delay="<?= $i * 80 ?>">
                    <div class="w-16 h-16 rounded-full <?= $active ? 'bg-blue-600 border-blue-400 shadow-lg shadow-blue-500/20' : 'bg-zinc-800/80 border-white/10' ?> border flex items-center justify-center flex-shrink-0 lg:mb-4 z-10">
                        <span class="<?= $active ? 'text-white' : 'text-zinc-500' ?> font-bold font-space text-sm"><?= $s[0] ?></span>
                    </div>
                    <div>
                        <h4 class="text-white font-bold font-space text-sm"><?= $s[1] ?></h4>
                        <p class="text-zinc-400 text-xs mt-2 max-w-[200px] lg:mx-auto leading-relaxed"><?= $s[2] ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- ========== CORE SERVICES GRID ========== -->
<section class="py-24 md:py-32 px-6 md:px-12 relative grid-bg">
    <div class="max-w-7xl mx-auto space-y-16">
        <div class="flex flex-col md:flex-row items-start md:items-end justify-between gap-6">
            <div class="space-y-4" data-aos="fade-right">
                <span class="text-xs uppercase font-semibold text-cyan-400 tracking-wider">Expertise Spheres</span>
                <h2 class="text-3xl md:text-5xl font-bold font-space">Core Enterprise Offerings</h2>
            </div>
            <a href="/services.php" class="text-sm font-semibold text-blue-400 hover:text-blue-300 transition-colors flex items-center link-underline" data-aos="fade-left">
                Explore All Services <i data-lucide="arrow-right" class="w-4 h-4 ml-1.5"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $services = [
                ['Digital Advisory','milestone','blue','High-level strategic consulting to prioritize modernizations, define architectures, and project ROI returns across your technology portfolio.','/services.php','Strategy Framework'],
                ['AI Integration','brain-circuit','cyan','Deploy custom LLMs, RAG pipelines, vector databases, and cognitive automation to transform decision-making at enterprise scale.','/ai-integration.php','AI Specifications'],
                ['Cloud Transformation','cloud-lightning','purple','Architect multi-cloud environments, automate deployments with Kubernetes, and configure auto-scaling for production resilience.','/cloud-transformation.php','Infrastructure Plans'],
                ['Workflow Automation','cpu','purple','Implement RPA bots, intelligent document processing, and end-to-end orchestration to eliminate manual bottlenecks.','/workflow-automation.php','Automation Audits'],
                ['ERP & CRM Systems','database','emerald','Consolidate legacy records, integrate Salesforce and SAP, and unify customer data into a single source of truth.','/erp-crm-modernization.php','Integration Scope'],
                ['Cybersecurity','shield-alert','rose','Establish zero-trust architectures, deploy SOC capabilities, and achieve continuous compliance automation.','/cybersecurity.php','Security Plans']
            ];
            foreach ($services as $i => $s):
            ?>
            <div class="glass-card p-8 rounded-3xl flex flex-col justify-between h-[320px] group" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 80 ?>">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-<?= $s[2] ?>-500/10 text-<?= $s[2] ?>-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i data-lucide="<?= $s[1] ?>" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-xl font-bold font-space text-white group-hover:text-<?= $s[2] ?>-400 transition-colors"><?= $s[0] ?></h3>
                    <p class="text-zinc-400 text-sm mt-3 leading-relaxed"><?= $s[3] ?></p>
                </div>
                <a href="<?= $s[4] ?>" class="text-xs font-semibold text-<?= $s[2] ?>-400 hover:text-white transition-colors flex items-center mt-6">
                    <?= $s[5] ?> <i data-lucide="chevron-right" class="w-3.5 h-3.5 ml-1"></i>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ========== INDUSTRY TABS ========== -->
<section class="py-24 md:py-32 bg-[#040610] px-6 md:px-12">
    <div class="max-w-7xl mx-auto space-y-16">
        <div class="text-center max-w-3xl mx-auto space-y-4" data-aos="fade-up">
            <span class="text-xs uppercase font-semibold text-cyan-400 tracking-wider">Sector Expertise</span>
            <h2 class="text-3xl md:text-5xl font-bold font-space">Tailored Industrial Blueprints</h2>
            <p class="text-zinc-400 text-lg">Purpose-built solutions that address the unique compliance, regulatory, and operational challenges of your industry.</p>
        </div>

        <div class="flex flex-wrap items-center justify-center gap-3" data-aos="fade-up">
            <?php $tabs = ['healthcare'=>'Healthcare','banking'=>'Banking','logistics'=>'Logistics','manufacturing'=>'Manufacturing','retail'=>'Retail']; $first = true; ?>
            <?php foreach ($tabs as $key => $label): ?>
                <button data-industry-tab="<?= $key ?>" class="px-5 py-2.5 rounded-full text-sm font-medium border transition-all <?= $first ? 'border-blue-500 bg-blue-500/10 text-blue-400' : 'border-white/10 text-zinc-400 hover:border-white/20' ?>"><?= $label ?></button>
            <?php $first = false; endforeach; ?>
        </div>

        <div class="relative min-h-[380px]">
            <?php
            $panels = [
                ['healthcare','activity','rose','Healthcare Digital Modernization','We build HIPAA-compliant patient portals, automated diagnostic pipelines, and secure interoperability layers that connect disparate clinical systems into unified care platforms.','1.2ms','Validation Latency','99.9%','HIPAA Compliance','Apex Health Group','Automated EMR classification reduced diagnostic delays from weeks to minutes.'],
                ['banking','landmark','emerald','Secure Finance Platforms','Real-time transaction monitoring, event-driven audit engines, and PCI DSS-compliant ledger architectures designed to handle millions of daily financial events.','Real-time','Ledger Auditing','71% Less','Manual Audit Hours','Capital Bank Group','Event-driven validation auditing deployed across legacy distributed branches.'],
                ['logistics','truck','cyan','Optimized Logistics Networks','GPS-integrated fleet management, predictive maintenance scheduling, and container-orchestrated APIs that deliver sub-second response times across global supply chains.','99.99%','Infrastructure Uptime','42% Saved','Cloud Costs','Gulf Logistics Corp','Migrated physical ledger systems to containerized clusters with sub-second failover.'],
                ['manufacturing','settings','orange','Industrial IoT & Telemetry','Connect factory sensors to real-time analytics streams, enable predictive maintenance, and automate quality control with computer vision at the production line.','85%','Predictive Accuracy','3.2x','Production Throughput','','Edge computing architecture delivering predictive maintenance at millisecond latency.'],
                ['retail','shopping-bag','purple','E-Commerce Cloud Scale','Headless commerce architectures, personalized recommendation engines, and auto-scaling infrastructure that handles traffic surges during peak seasons.','99.97%','Platform Uptime','2.4x','Conversion Improvement','','Dynamic catalog APIs on serverless infrastructure with CDN-accelerated delivery.']
            ];
            foreach ($panels as $j => $p):
            ?>
            <div data-industry-panel="<?= $p[0] ?>" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center <?= $j > 0 ? 'hidden' : '' ?>">
                <div class="lg:col-span-6 space-y-6">
                    <h3 class="text-2xl font-bold font-space text-white flex items-center"><i data-lucide="<?= $p[1] ?>" class="w-6 h-6 text-<?= $p[2] ?>-400 mr-3"></i><?= $p[3] ?></h3>
                    <p class="text-zinc-400 text-sm leading-relaxed"><?= $p[4] ?></p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 rounded-2xl bg-white/5 border border-white/5"><p class="text-white font-bold font-space text-xl"><?= $p[5] ?></p><p class="text-xs text-zinc-500 mt-1"><?= $p[6] ?></p></div>
                        <div class="p-4 rounded-2xl bg-white/5 border border-white/5"><p class="text-white font-bold font-space text-xl"><?= $p[7] ?></p><p class="text-xs text-zinc-500 mt-1"><?= $p[8] ?></p></div>
                    </div>
                </div>
                <div class="lg:col-span-6 glass-card p-6 rounded-3xl border border-white/10 bg-[#0D1324]/30 space-y-4">
                    <h4 class="text-white font-bold font-space text-sm"><?= $p[9] ? 'Case Study: ' . $p[9] : 'Architecture Snapshot' ?></h4>
                    <p class="text-zinc-400 text-xs leading-relaxed"><?= $p[10] ?></p>
                    <a href="/case-studies.php" class="text-xs font-semibold text-blue-400 hover:underline flex items-center mt-4">Read Full Analysis <i data-lucide="chevron-right" class="w-3.5 h-3.5 ml-0.5"></i></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ========== STATS COUNTERS ========== -->
<section class="py-24 md:py-32 px-6 md:px-12 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-[#060816] to-[#040610]"></div>
    <div class="max-w-7xl mx-auto grid grid-cols-2 lg:grid-cols-4 gap-8 relative z-10">
        <?php
        $stats = [
            ['42','%','Lower Operational Costs','Average savings across first 12 months','blue'],
            ['3.8','x','Faster Workflow Delivery','Processing speed acceleration rates','cyan'],
            ['71','%','Reduced Manual Tasks','Intelligent process automation deployed','purple'],
            ['99.9','%','Infrastructure Reliability','Average SLA across all deployments','emerald']
        ];
        foreach ($stats as $i => $st):
        ?>
        <div class="glass-card p-8 rounded-3xl border border-white/5 text-center" data-aos="zoom-in" data-aos-delay="<?= $i * 80 ?>">
            <p class="text-4xl md:text-5xl font-bold font-space text-<?= $st[4] ?>-400">
                <span class="counter-value" data-target="<?= $st[0] ?>"><?= strpos($st[0],'.') !== false ? '0.0' : '0' ?></span><?= $st[1] ?>
            </p>
            <p class="text-white font-semibold text-sm mt-3"><?= $st[2] ?></p>
            <p class="text-zinc-500 text-xs mt-1.5"><?= $st[3] ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- ========== CASE STUDIES ========== -->
<section class="py-24 md:py-32 px-6 md:px-12 bg-[#040610]">
    <div class="max-w-7xl mx-auto space-y-16">
        <div class="flex flex-col md:flex-row items-start md:items-end justify-between gap-6">
            <div class="space-y-4" data-aos="fade-right">
                <span class="text-xs uppercase font-semibold text-cyan-400 tracking-wider">Proven Execution</span>
                <h2 class="text-3xl md:text-5xl font-bold font-space">Enterprise Case Studies</h2>
            </div>
            <a href="/case-studies.php" class="text-sm font-semibold text-blue-400 hover:text-blue-300 transition-colors flex items-center" data-aos="fade-left">View All <i data-lucide="arrow-right" class="w-4 h-4 ml-1.5"></i></a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <?php if (!empty($featured_cases)): ?>
                <?php foreach ($featured_cases as $case): ?>
                <div class="glass-card rounded-3xl overflow-hidden flex flex-col justify-between h-full group" data-aos="fade-up">
                    <div class="p-8 space-y-4">
                        <span class="inline-block text-[10px] uppercase font-bold tracking-wider text-blue-400 bg-blue-500/10 px-2.5 py-1 rounded"><?= htmlspecialchars($case['industry']) ?></span>
                        <h3 class="text-xl font-bold font-space text-white group-hover:text-blue-400 transition-colors"><?= htmlspecialchars($case['title']) ?></h3>
                        <p class="text-xs text-zinc-400 leading-relaxed"><strong class="text-zinc-300">Challenge:</strong> <?= htmlspecialchars($case['challenge']) ?></p>
                        <p class="text-xs text-zinc-400 leading-relaxed"><strong class="text-zinc-300">Strategy:</strong> <?= htmlspecialchars($case['strategy']) ?></p>
                    </div>
                    <div class="p-8 bg-[#0c0f20]/50 border-t border-white/5 space-y-3">
                        <div class="flex items-center justify-between text-xs"><span class="text-zinc-500">ROI Metric:</span><span class="text-emerald-400 font-semibold font-space"><?= htmlspecialchars($case['roi_metric']) ?></span></div>
                        <div class="flex items-center justify-between text-xs"><span class="text-zinc-500">Timeline:</span><span class="text-white font-medium"><?= htmlspecialchars($case['timeline']) ?></span></div>
                        <a href="/case-studies.php#<?= htmlspecialchars($case['slug']) ?>" class="block text-center text-xs font-semibold text-blue-400 hover:text-white transition-colors bg-white/5 py-2.5 rounded-xl border border-white/5 hover:bg-white/10 mt-2">Read Full Analysis</a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <?php
                $fallback = [
                    ['Healthcare','Apex Health Group Digital Overhaul','Legacy EMR systems caused 3-week diagnostic delays.','HIPAA-compliant cloud portal with automated triage AI.','99.9% Compliance','4 Months'],
                    ['Finance','Capital Bank Ledger Migration','Manual audit processes consuming 400+ engineer-hours monthly.','Event-driven microservices with real-time reconciliation.','71% Efficiency Gain','6 Months'],
                    ['Logistics','Gulf Logistics Cloud Infrastructure','Physical servers with 12-hour failover causing delivery SLA breaches.','Kubernetes clusters with sub-second failover and auto-scaling.','42% Cost Savings','5 Months']
                ];
                foreach ($fallback as $fb):
                ?>
                <div class="glass-card rounded-3xl overflow-hidden flex flex-col justify-between h-full group" data-aos="fade-up">
                    <div class="p-8 space-y-4">
                        <span class="inline-block text-[10px] uppercase font-bold tracking-wider text-blue-400 bg-blue-500/10 px-2.5 py-1 rounded"><?= $fb[0] ?></span>
                        <h3 class="text-xl font-bold font-space text-white group-hover:text-blue-400 transition-colors"><?= $fb[1] ?></h3>
                        <p class="text-xs text-zinc-400"><strong class="text-zinc-300">Challenge:</strong> <?= $fb[2] ?></p>
                        <p class="text-xs text-zinc-400"><strong class="text-zinc-300">Strategy:</strong> <?= $fb[3] ?></p>
                    </div>
                    <div class="p-8 bg-[#0c0f20]/50 border-t border-white/5 space-y-3">
                        <div class="flex items-center justify-between text-xs"><span class="text-zinc-500">ROI:</span><span class="text-emerald-400 font-semibold font-space"><?= $fb[4] ?></span></div>
                        <div class="flex items-center justify-between text-xs"><span class="text-zinc-500">Timeline:</span><span class="text-white font-medium"><?= $fb[5] ?></span></div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ========== TECHNOLOGY ORBITS ========== -->
<section class="py-24 md:py-32 px-6 md:px-12 relative overflow-hidden">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <div class="lg:col-span-5 space-y-6" data-aos="fade-right">
            <span class="text-xs uppercase font-semibold text-blue-400 tracking-wider">Technology Ecosystem</span>
            <h2 class="text-3xl md:text-5xl font-bold font-space">The Connected Enterprise Stack</h2>
            <p class="text-zinc-400 leading-relaxed">Our architectures integrate seamlessly with modern cloud-native platforms, legacy enterprise systems, and emerging AI frameworks to deliver comprehensive transformation.</p>
            <div id="orbit-detail-card" class="glass-card p-6 rounded-2xl border border-white/10 space-y-2 mt-8">
                <h4 id="orbit-detail-title" class="text-white font-bold font-space text-base">Artificial Intelligence</h4>
                <p id="orbit-detail-desc" class="text-zinc-400 text-xs leading-relaxed">Deep integrations of cognitive systems, custom LLMs, and predictive models configured for zero data leakage.</p>
                <div class="text-xs text-emerald-400 pt-2 flex items-center"><i data-lucide="trending-up" class="w-4 h-4 mr-1.5"></i><span id="orbit-detail-metric">10x faster decision logic</span></div>
            </div>
        </div>

        <div class="lg:col-span-7 flex justify-center relative h-[450px]" data-aos="fade-left">
            <div class="orbit-center">
                <div class="absolute w-20 h-20 rounded-full bg-blue-500/10 border border-blue-500/30 flex items-center justify-center shadow-2xl"><span class="text-glow-blue font-bold font-space text-xs text-blue-400">SISGAIN</span></div>
                <div class="orbit-ring orbit-ring-1">
                    <div class="orbit-node" style="top:0;left:50%;transform:translate(-50%,-50%)" data-title="Artificial Intelligence" data-desc="Custom LLMs, RAG pipelines, and vector databases." data-metric="10x faster execution"><i data-lucide="brain-circuit" class="w-4 h-4 text-cyan-400"></i></div>
                    <div class="orbit-node" style="bottom:0;left:50%;transform:translate(-50%,50%)" data-title="Cloud Native" data-desc="Multi-cloud Kubernetes orchestration and serverless compute." data-metric="99.99% uptime"><i data-lucide="cloud" class="w-4 h-4 text-blue-400"></i></div>
                    <div class="orbit-node" style="top:50%;left:0;transform:translate(-50%,-50%)" data-title="DevOps & CI/CD" data-desc="Automated pipelines, infrastructure as code, and GitOps." data-metric="3x deployment velocity"><i data-lucide="git-branch" class="w-4 h-4 text-purple-400"></i></div>
                    <div class="orbit-node" style="top:50%;right:0;transform:translate(50%,-50%)" data-title="Zero-Trust Security" data-desc="Identity-first architecture with continuous compliance." data-metric="99.7% threat detection"><i data-lucide="shield" class="w-4 h-4 text-emerald-400"></i></div>
                </div>
                <div class="orbit-ring orbit-ring-2">
                    <div class="orbit-node" style="top:0;left:50%;transform:translate(-50%,-50%)" data-title="Kubernetes" data-desc="Container orchestration at production scale." data-metric="500+ clusters managed"><i data-lucide="container" class="w-4 h-4 text-blue-400"></i></div>
                    <div class="orbit-node" style="bottom:0;left:50%;transform:translate(-50%,50%)" data-title="API Gateway" data-desc="Enterprise API management and rate limiting." data-metric="1M+ req/sec"><i data-lucide="network" class="w-4 h-4 text-cyan-400"></i></div>
                    <div class="orbit-node" style="top:50%;left:0;transform:translate(-50%,-50%)" data-title="Data Engineering" data-desc="Real-time ETL pipelines and data lake architecture." data-metric="10PB+ processed"><i data-lucide="database" class="w-4 h-4 text-indigo-400"></i></div>
                    <div class="orbit-node" style="top:50%;right:0;transform:translate(50%,-50%)" data-title="Blockchain" data-desc="Distributed ledger technology for secure transactions." data-metric="Immutable audit trails"><i data-lucide="link" class="w-4 h-4 text-orange-400"></i></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== FAQ ACCORDION ========== -->
<section class="py-24 md:py-32 bg-[#040610] px-6 md:px-12">
    <div class="max-w-4xl mx-auto">
        <div class="text-center space-y-4 mb-16" data-aos="fade-up">
            <span class="text-xs uppercase font-semibold text-blue-400 tracking-wider">Knowledge Base</span>
            <h2 class="text-3xl md:text-5xl font-bold font-space">Common Advisory Questions</h2>
        </div>

        <div class="space-y-4" data-aos="fade-up">
            <?php if (!empty($faqs)): ?>
                <?php foreach ($faqs as $faq): ?>
                <div class="glass-card rounded-2xl border border-white/10 overflow-hidden">
                    <button class="faq-toggle w-full text-left px-6 py-5 flex items-center justify-between" aria-expanded="false">
                        <span class="text-white font-semibold text-sm pr-4"><?= htmlspecialchars($faq['question']) ?></span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-zinc-400 flex-shrink-0 faq-arrow transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content hidden px-6 pb-5">
                        <p class="text-zinc-400 text-sm leading-relaxed"><?= htmlspecialchars($faq['answer']) ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <?php
                $default_faqs = [
                    ['What industries do you specialize in?','We serve healthcare, banking, logistics, manufacturing, retail, and energy sectors. Each engagement is customized to address industry-specific compliance requirements, operational challenges, and competitive dynamics.'],
                    ['How long does a typical transformation take?','Most engagements span 3-9 months depending on scope. We deliver in phased sprints so you see measurable value within the first 4-6 weeks, not months.'],
                    ['What is the average ROI of your engagements?','Our clients typically see 42% operational cost reduction within 12 months, with full payback achieved in 8-14 months. We provide detailed ROI projections before every engagement.'],
                    ['Do you support legacy system integration?','Absolutely. We specialize in connecting modern cloud-native architectures with existing legacy systems through API gateways, middleware layers, and incremental migration strategies.'],
                    ['What security certifications do you maintain?','We maintain SOC 2 Type II, ISO 27001, HIPAA, GDPR, and PCI DSS compliance across all engagements. Every solution is built with zero-trust architecture principles.']
                ];
                foreach ($default_faqs as $dfaq):
                ?>
                <div class="glass-card rounded-2xl border border-white/10 overflow-hidden">
                    <button class="faq-toggle w-full text-left px-6 py-5 flex items-center justify-between" aria-expanded="false">
                        <span class="text-white font-semibold text-sm pr-4"><?= $dfaq[0] ?></span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-zinc-400 flex-shrink-0 faq-arrow transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content hidden px-6 pb-5">
                        <p class="text-zinc-400 text-sm leading-relaxed"><?= $dfaq[1] ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<script src="/assets/js/dashboard.js"></script>
<?php
require_once __DIR__ . '/includes/cta.php';
require_once __DIR__ . '/includes/footer.php';
?>
