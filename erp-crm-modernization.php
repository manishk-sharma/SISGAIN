<?php
require_once __DIR__ . '/config/db.php';
$meta_title = "ERP & CRM Modernization | Sisgain Enterprise Solutions";
$meta_description = "Legacy system modernization, SAP migration, Salesforce integration, and unified customer platforms. 200+ enterprise system integrations delivered.";
$meta_keywords = "ERP Modernization, CRM Integration, SAP Migration, Salesforce, Legacy Systems, Enterprise Integration, Sisgain";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<section class="relative py-32 md:py-40 px-6 md:px-12 overflow-hidden">
    <div class="absolute top-10 right-10 w-[600px] h-[600px] bg-emerald-600/8 rounded-full filter blur-[120px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-center relative z-10">
        <div class="lg:col-span-7 space-y-8" data-aos="fade-right">
            <span class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full text-xs font-semibold bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">
                <i data-lucide="database" class="w-3.5 h-3.5"></i><span>Enterprise Systems</span>
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold font-space leading-[1.1] tracking-tight">
                Legacy System Modernization &<br><span class="bg-gradient-to-r from-emerald-400 to-blue-500 bg-clip-text text-transparent">Enterprise Integration</span>
            </h1>
            <p class="text-zinc-400 text-lg leading-relaxed max-w-2xl">Consolidate fragmented enterprise systems, migrate to modern platforms, and build unified data architectures that give your organization a 360-degree view of customers, operations, and performance.</p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="/contact.php" class="btn-primary text-center">Schedule Assessment <i data-lucide="arrow-right" class="w-4 h-4 ml-2 inline-block"></i></a>
                <a href="/roi-calculator.php" class="btn-secondary text-center">Calculate Integration ROI</a>
            </div>
        </div>
        <div class="lg:col-span-5 space-y-4" data-aos="fade-left">
            <div class="glass-card p-6 rounded-2xl flex items-center space-x-4"><div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center"><i data-lucide="zap" class="w-5 h-5"></i></div><div><p class="text-2xl font-bold font-space text-white">50%</p><p class="text-xs text-zinc-500">Faster Processing</p></div></div>
            <div class="glass-card p-6 rounded-2xl flex items-center space-x-4"><div class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center"><i data-lucide="users" class="w-5 h-5"></i></div><div><p class="text-2xl font-bold font-space text-white">360°</p><p class="text-xs text-zinc-500">Customer View</p></div></div>
            <div class="glass-card p-6 rounded-2xl flex items-center space-x-4"><div class="w-12 h-12 rounded-xl bg-cyan-500/10 text-cyan-400 flex items-center justify-center"><i data-lucide="trending-up" class="w-5 h-5"></i></div><div><p class="text-2xl font-bold font-space text-white">35%</p><p class="text-xs text-zinc-500">Revenue Increase</p></div></div>
        </div>
    </div>
</section>

<section class="py-24 md:py-32 px-6 md:px-12 bg-[#040610]">
    <div class="max-w-7xl mx-auto space-y-16">
        <div class="text-center max-w-3xl mx-auto space-y-4" data-aos="fade-up">
            <span class="text-xs uppercase font-semibold text-emerald-400 tracking-wider">Capabilities</span>
            <h2 class="text-3xl md:text-5xl font-bold font-space">What We Deliver</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $features = [
                ['server','SAP S/4HANA Migration','Execute end-to-end SAP migrations including system conversion, data harmonization, custom code adaptation, and post-migration optimization for S/4HANA environments.','emerald'],
                ['users','Salesforce Integration','Design and implement Salesforce solutions including Sales Cloud, Service Cloud, and Marketing Cloud with custom objects, flows, and third-party integrations.','blue'],
                ['code','Custom ERP Development','Build tailored ERP modules for organizations with unique processes that off-the-shelf solutions cannot address, using modern microservices architecture.','purple'],
                ['database','Data Migration','Execute zero-downtime data migrations with automated ETL pipelines, data quality validation, reconciliation scripts, and rollback strategies.','cyan'],
                ['network','API Gateway Design','Architect enterprise API management layers with rate limiting, authentication, versioning, and developer portals that connect legacy and modern systems.','indigo'],
                ['bar-chart-3','Real-time Analytics','Deploy operational dashboards with real-time data streaming from ERP and CRM systems for instant visibility into sales, inventory, and customer metrics.','rose']
            ];
            foreach ($features as $fi => $f): ?>
            <div class="glass-card p-8 rounded-3xl group" data-aos="fade-up" data-aos-delay="<?= ($fi%3)*80 ?>">
                <div class="w-12 h-12 rounded-2xl bg-<?= $f[3] ?>-500/10 text-<?= $f[3] ?>-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform"><i data-lucide="<?= $f[0] ?>" class="w-6 h-6"></i></div>
                <h3 class="text-lg font-bold font-space text-white mb-3"><?= $f[1] ?></h3>
                <p class="text-zinc-400 text-sm leading-relaxed"><?= $f[2] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="py-24 px-6 md:px-12">
    <div class="max-w-5xl mx-auto text-center space-y-8" data-aos="fade-up">
        <h2 class="text-3xl md:text-4xl font-bold font-space">Technology Stack</h2>
        <div class="flex flex-wrap justify-center gap-3">
            <?php foreach (['SAP S/4HANA','Salesforce','Microsoft Dynamics 365','Oracle ERP','HubSpot','MuleSoft','Boomi','Workato','Zapier','Kong API','GraphQL','REST APIs'] as $tech): ?>
            <span class="px-4 py-2 rounded-full text-xs font-medium bg-white/5 border border-white/10 text-zinc-300 hover:border-emerald-500/30 hover:text-emerald-400 transition-all"><?= $tech ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="py-24 px-6 md:px-12 bg-[#040610]">
    <div class="max-w-7xl mx-auto grid grid-cols-2 lg:grid-cols-4 gap-8">
        <?php $stats = [['50','%','Faster Processing','emerald'],['360','°','Customer View','blue'],['35','%','Revenue Increase','cyan'],['200','+','Integrations','purple']];
        foreach ($stats as $si => $s): ?>
        <div class="glass-card p-8 rounded-3xl text-center" data-aos="zoom-in" data-aos-delay="<?= $si*80 ?>">
            <p class="text-4xl md:text-5xl font-bold font-space text-<?= $s[3] ?>-400"><span class="counter-value" data-target="<?= $s[0] ?>"><?= $s[0] ?></span><?= $s[1] ?></p>
            <p class="text-white font-semibold text-sm mt-3"><?= $s[2] ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/cta.php'; require_once __DIR__ . '/includes/footer.php'; ?>
