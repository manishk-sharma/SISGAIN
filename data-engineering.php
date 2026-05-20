<?php
require_once __DIR__ . '/config/db.php';
$meta_title = "Data Engineering & Analytics | Sisgain Enterprise Solutions";
$meta_description = "Enterprise data engineering: data lake architecture, ETL pipelines, real-time streaming, and business intelligence dashboards. 10PB+ data processed.";
$meta_keywords = "Data Engineering, ETL Pipeline, Data Lake, Business Intelligence, Snowflake, Databricks, Apache Kafka, Sisgain";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<section class="relative py-32 md:py-40 px-6 md:px-12 overflow-hidden">
    <div class="absolute top-20 left-0 w-[600px] h-[600px] bg-indigo-600/8 rounded-full filter blur-[120px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-center relative z-10">
        <div class="lg:col-span-7 space-y-8" data-aos="fade-right">
            <span class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full text-xs font-semibold bg-indigo-500/10 border border-indigo-500/20 text-indigo-400">
                <i data-lucide="bar-chart-3" class="w-3.5 h-3.5"></i><span>Data & Analytics</span>
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold font-space leading-[1.1] tracking-tight">
                Enterprise Data Engineering &<br><span class="bg-gradient-to-r from-indigo-400 to-cyan-400 bg-clip-text text-transparent">Business Intelligence</span>
            </h1>
            <p class="text-zinc-400 text-lg leading-relaxed max-w-2xl">Build production-grade data platforms that transform raw information into actionable intelligence. From data lake architecture to real-time dashboards, we engineer the foundation for data-driven decision making.</p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="/contact.php" class="btn-primary text-center">Schedule Data Assessment <i data-lucide="arrow-right" class="w-4 h-4 ml-2 inline-block"></i></a>
                <a href="/roi-calculator.php" class="btn-secondary text-center">Calculate Data ROI</a>
            </div>
        </div>
        <div class="lg:col-span-5 space-y-4" data-aos="fade-left">
            <div class="glass-card p-6 rounded-2xl flex items-center space-x-4"><div class="w-12 h-12 rounded-xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center"><i data-lucide="database" class="w-5 h-5"></i></div><div><p class="text-2xl font-bold font-space text-white">10PB+</p><p class="text-xs text-zinc-500">Data Processed</p></div></div>
            <div class="glass-card p-6 rounded-2xl flex items-center space-x-4"><div class="w-12 h-12 rounded-xl bg-cyan-500/10 text-cyan-400 flex items-center justify-center"><i data-lucide="check-circle" class="w-5 h-5"></i></div><div><p class="text-2xl font-bold font-space text-white">95%</p><p class="text-xs text-zinc-500">Data Quality Score</p></div></div>
            <div class="glass-card p-6 rounded-2xl flex items-center space-x-4"><div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center"><i data-lucide="zap" class="w-5 h-5"></i></div><div><p class="text-2xl font-bold font-space text-white">5x</p><p class="text-xs text-zinc-500">Faster Insights</p></div></div>
        </div>
    </div>
</section>

<section class="py-24 md:py-32 px-6 md:px-12 bg-[#040610]">
    <div class="max-w-7xl mx-auto space-y-16">
        <div class="text-center max-w-3xl mx-auto space-y-4" data-aos="fade-up">
            <span class="text-xs uppercase font-semibold text-indigo-400 tracking-wider">Capabilities</span>
            <h2 class="text-3xl md:text-5xl font-bold font-space">What We Deliver</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $features = [
                ['database','Data Lake Architecture','Design and implement scalable data lake solutions on cloud platforms with proper zoning (bronze/silver/gold), governance policies, and cost-optimized storage tiers.','indigo'],
                ['git-merge','ETL Pipeline Design','Build robust extraction, transformation, and loading pipelines using modern orchestration tools with monitoring, alerting, and automated failure recovery mechanisms.','blue'],
                ['radio','Real-time Streaming','Deploy event-driven streaming architectures using Apache Kafka, Kinesis, and Pub/Sub for sub-second data processing and real-time analytics capabilities.','cyan'],
                ['shield','Data Governance','Implement enterprise data catalogs, lineage tracking, access controls, PII detection, and quality monitoring frameworks that ensure compliance and trust in your data.','emerald'],
                ['bar-chart-3','BI Dashboard Development','Create interactive business intelligence dashboards with Tableau, Power BI, and Looker that provide actionable insights to stakeholders at every level of your organization.','purple'],
                ['check-circle','Data Quality Management','Deploy automated data profiling, validation rules, anomaly detection, and remediation workflows that maintain data accuracy above 95% across all systems.','rose']
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
            <?php foreach (['Snowflake','Databricks','Apache Kafka','Apache Spark','dbt','Tableau','Power BI','Looker','Apache Airflow','Fivetran','Great Expectations','Monte Carlo'] as $tech): ?>
            <span class="px-4 py-2 rounded-full text-xs font-medium bg-white/5 border border-white/10 text-zinc-300 hover:border-indigo-500/30 hover:text-indigo-400 transition-all"><?= $tech ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="py-24 px-6 md:px-12 bg-[#040610]">
    <div class="max-w-7xl mx-auto grid grid-cols-2 lg:grid-cols-4 gap-8">
        <?php $stats = [['10','PB+','Data Processed','indigo'],['95','%','Data Quality','cyan'],['5','x','Faster Insights','emerald'],['150','+','Pipelines Built','purple']];
        foreach ($stats as $si => $s): ?>
        <div class="glass-card p-8 rounded-3xl text-center" data-aos="zoom-in" data-aos-delay="<?= $si*80 ?>">
            <p class="text-4xl md:text-5xl font-bold font-space text-<?= $s[3] ?>-400"><span class="counter-value" data-target="<?= $s[0] ?>"><?= $s[0] ?></span><?= $s[1] ?></p>
            <p class="text-white font-semibold text-sm mt-3"><?= $s[2] ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/cta.php'; require_once __DIR__ . '/includes/footer.php'; ?>
