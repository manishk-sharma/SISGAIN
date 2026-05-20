<?php
require_once __DIR__ . '/config/db.php';
$meta_title = "Workflow Automation | Sisgain Enterprise Solutions";
$meta_description = "Intelligent process automation using RPA, document AI, and workflow orchestration. Eliminate 71% of manual operations within 90 days.";
$meta_keywords = "Workflow Automation, RPA, Process Mining, Hyperautomation, UiPath, Document AI, Sisgain";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<section class="relative py-32 md:py-40 px-6 md:px-12 overflow-hidden">
    <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-purple-600/8 rounded-full filter blur-[120px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-center relative z-10">
        <div class="lg:col-span-7 space-y-8" data-aos="fade-right">
            <span class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full text-xs font-semibold bg-purple-500/10 border border-purple-500/20 text-purple-400">
                <i data-lucide="cpu" class="w-3.5 h-3.5"></i><span>Process Automation</span>
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold font-space leading-[1.1] tracking-tight">
                Hyperautomation &<br><span class="bg-gradient-to-r from-purple-400 to-cyan-400 bg-clip-text text-transparent">Intelligent Workflow Engineering</span>
            </h1>
            <p class="text-zinc-400 text-lg leading-relaxed max-w-2xl">Identify automation candidates through process mining, deploy RPA bots, and orchestrate end-to-end workflows that eliminate manual bottlenecks and drive operational excellence.</p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="/contact.php" class="btn-primary text-center">Schedule Automation Audit <i data-lucide="arrow-right" class="w-4 h-4 ml-2 inline-block"></i></a>
                <a href="/roi-calculator.php" class="btn-secondary text-center">Calculate Automation ROI</a>
            </div>
        </div>
        <div class="lg:col-span-5 space-y-4" data-aos="fade-left">
            <div class="glass-card p-6 rounded-2xl flex items-center space-x-4"><div class="w-12 h-12 rounded-xl bg-purple-500/10 text-purple-400 flex items-center justify-center"><i data-lucide="zap" class="w-5 h-5"></i></div><div><p class="text-2xl font-bold font-space text-white">71%</p><p class="text-xs text-zinc-500">Manual Reduction</p></div></div>
            <div class="glass-card p-6 rounded-2xl flex items-center space-x-4"><div class="w-12 h-12 rounded-xl bg-cyan-500/10 text-cyan-400 flex items-center justify-center"><i data-lucide="trending-up" class="w-5 h-5"></i></div><div><p class="text-2xl font-bold font-space text-white">4.2x</p><p class="text-xs text-zinc-500">Throughput Increase</p></div></div>
            <div class="glass-card p-6 rounded-2xl flex items-center space-x-4"><div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center"><i data-lucide="dollar-sign" class="w-5 h-5"></i></div><div><p class="text-2xl font-bold font-space text-white">$2.4M</p><p class="text-xs text-zinc-500">Avg. Annual Savings</p></div></div>
        </div>
    </div>
</section>

<section class="py-24 md:py-32 px-6 md:px-12 bg-[#040610]">
    <div class="max-w-7xl mx-auto space-y-16">
        <div class="text-center max-w-3xl mx-auto space-y-4" data-aos="fade-up">
            <span class="text-xs uppercase font-semibold text-purple-400 tracking-wider">Capabilities</span>
            <h2 class="text-3xl md:text-5xl font-bold font-space">What We Deliver</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $features = [
                ['bot','RPA Implementation','Deploy attended and unattended software robots that automate high-volume, rule-based tasks across finance, HR, operations, and customer service departments.','purple'],
                ['file-scan','Document Processing AI','Extract structured data from invoices, contracts, medical records, and forms using OCR, NLP, and intelligent document classification models.','cyan'],
                ['git-merge','Workflow Orchestration','Design and deploy end-to-end process flows using BPMN-compliant engines that coordinate human tasks, system integrations, and automated decisions.','blue'],
                ['scale','Business Rules Engine','Centralize complex decision logic into maintainable rule sets that can be updated by business analysts without developer involvement.','emerald'],
                ['plug','Integration Hub','Connect disparate enterprise systems through a unified integration platform with pre-built connectors for 200+ enterprise applications.','indigo'],
                ['search','Process Mining','Analyze event logs to discover actual process flows, identify bottlenecks, detect compliance deviations, and quantify automation potential.','rose']
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
            <?php foreach (['UiPath','Automation Anywhere','Power Automate','Camunda','Apache Airflow','Celonis','ABBYY','Zapier','n8n','Temporal','Prefect'] as $tech): ?>
            <span class="px-4 py-2 rounded-full text-xs font-medium bg-white/5 border border-white/10 text-zinc-300 hover:border-purple-500/30 hover:text-purple-400 transition-all"><?= $tech ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="py-24 px-6 md:px-12 bg-[#040610]">
    <div class="max-w-7xl mx-auto grid grid-cols-2 lg:grid-cols-4 gap-8">
        <?php $stats = [['71','%','Manual Reduction','purple'],['4.2','x','Throughput Gain','cyan'],['90','%','Error Elimination','emerald'],['2.4','M+','Avg. Savings','blue']];
        foreach ($stats as $si => $s): ?>
        <div class="glass-card p-8 rounded-3xl text-center" data-aos="zoom-in" data-aos-delay="<?= $si*80 ?>">
            <p class="text-4xl md:text-5xl font-bold font-space text-<?= $s[3] ?>-400"><span class="counter-value" data-target="<?= $s[0] ?>"><?= $s[0] ?></span><?= $s[1] ?></p>
            <p class="text-white font-semibold text-sm mt-3"><?= $s[2] ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/cta.php'; require_once __DIR__ . '/includes/footer.php'; ?>
