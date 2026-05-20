<?php
require_once __DIR__ . '/config/db.php';
$meta_title = "Cloud Transformation | Sisgain Enterprise Solutions";
$meta_description = "Enterprise cloud migration and infrastructure modernization. Multi-cloud architecture, Kubernetes orchestration, and serverless computing with 99.99% uptime SLA.";
$meta_keywords = "Cloud Migration, Kubernetes, AWS, Azure, GCP, Cloud Architecture, Infrastructure Modernization, Sisgain";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<section class="relative py-32 md:py-40 px-6 md:px-12 overflow-hidden">
    <div class="absolute top-20 left-0 w-[600px] h-[600px] bg-blue-600/8 rounded-full filter blur-[120px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-center relative z-10">
        <div class="lg:col-span-7 space-y-8" data-aos="fade-right">
            <span class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full text-xs font-semibold bg-blue-500/10 border border-blue-500/20 text-blue-400">
                <i data-lucide="cloud-lightning" class="w-3.5 h-3.5"></i><span>Cloud Infrastructure</span>
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold font-space leading-[1.1] tracking-tight">
                Enterprise Cloud Transformation &<br><span class="bg-gradient-to-r from-blue-400 to-purple-500 bg-clip-text text-transparent">Infrastructure Modernization</span>
            </h1>
            <p class="text-zinc-400 text-lg leading-relaxed max-w-2xl">Architect resilient multi-cloud environments, automate infrastructure provisioning, and achieve 99.99% uptime through container orchestration and serverless computing.</p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="/contact.php" class="btn-primary text-center">Schedule Cloud Assessment <i data-lucide="arrow-right" class="w-4 h-4 ml-2 inline-block"></i></a>
                <a href="/roi-calculator.php" class="btn-secondary text-center">Calculate Cloud ROI</a>
            </div>
        </div>
        <div class="lg:col-span-5 space-y-4" data-aos="fade-left">
            <div class="glass-card p-6 rounded-2xl flex items-center space-x-4"><div class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center"><i data-lucide="server" class="w-5 h-5"></i></div><div><p class="text-2xl font-bold font-space text-white">99.99%</p><p class="text-xs text-zinc-500">Uptime SLA Achieved</p></div></div>
            <div class="glass-card p-6 rounded-2xl flex items-center space-x-4"><div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center"><i data-lucide="trending-down" class="w-5 h-5"></i></div><div><p class="text-2xl font-bold font-space text-white">45%</p><p class="text-xs text-zinc-500">Cost Savings Average</p></div></div>
            <div class="glass-card p-6 rounded-2xl flex items-center space-x-4"><div class="w-12 h-12 rounded-xl bg-purple-500/10 text-purple-400 flex items-center justify-center"><i data-lucide="rocket" class="w-5 h-5"></i></div><div><p class="text-2xl font-bold font-space text-white">3x</p><p class="text-xs text-zinc-500">Deployment Speed</p></div></div>
        </div>
    </div>
</section>

<section class="py-24 md:py-32 px-6 md:px-12 bg-[#040610]">
    <div class="max-w-7xl mx-auto space-y-16">
        <div class="text-center max-w-3xl mx-auto space-y-4" data-aos="fade-up">
            <span class="text-xs uppercase font-semibold text-blue-400 tracking-wider">Capabilities</span>
            <h2 class="text-3xl md:text-5xl font-bold font-space">What We Deliver</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $features = [
                ['cloud','Multi-Cloud Architecture','Design and implement cloud-agnostic architectures across AWS, Azure, and GCP with unified management, cost optimization, and disaster recovery built in from day one.','blue'],
                ['container','Kubernetes Orchestration','Deploy and manage production-grade Kubernetes clusters with auto-scaling, service mesh, rolling deployments, and comprehensive observability across all workloads.','cyan'],
                ['zap','Serverless Computing','Build event-driven architectures using Lambda, Cloud Functions, and Azure Functions to eliminate server management and pay only for actual compute consumption.','purple'],
                ['shield','Cloud Security Posture','Implement CSPM tools, identity federation, encryption at rest and in transit, and automated compliance scanning across your entire cloud estate.','emerald'],
                ['trending-down','Cost Optimization','Right-size instances, implement spot/reserved capacity strategies, and deploy FinOps dashboards to continuously reduce cloud spend by 30-45%.','indigo'],
                ['refresh-cw','Disaster Recovery','Architect multi-region failover, automated backup pipelines, and sub-minute RTO/RPO targets to ensure business continuity under any scenario.','rose']
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
            <?php foreach (['AWS','Microsoft Azure','Google Cloud','Kubernetes','Docker','Terraform','Ansible','CloudFormation','Pulumi','Istio','Prometheus','Grafana','ArgoCD','Helm'] as $tech): ?>
            <span class="px-4 py-2 rounded-full text-xs font-medium bg-white/5 border border-white/10 text-zinc-300 hover:border-blue-500/30 hover:text-blue-400 transition-all"><?= $tech ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="py-24 px-6 md:px-12 bg-[#040610]">
    <div class="max-w-7xl mx-auto grid grid-cols-2 lg:grid-cols-4 gap-8">
        <?php $stats = [['99.99','%','Uptime SLA','blue'],['45','%','Cost Savings','emerald'],['3','x','Deploy Speed','purple'],['500','+','Cloud Migrations','cyan']];
        foreach ($stats as $si => $s): ?>
        <div class="glass-card p-8 rounded-3xl text-center" data-aos="zoom-in" data-aos-delay="<?= $si*80 ?>">
            <p class="text-4xl md:text-5xl font-bold font-space text-<?= $s[3] ?>-400"><span class="counter-value" data-target="<?= $s[0] ?>"><?= $s[0] ?></span><?= $s[1] ?></p>
            <p class="text-white font-semibold text-sm mt-3"><?= $s[2] ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/cta.php'; require_once __DIR__ . '/includes/footer.php'; ?>
