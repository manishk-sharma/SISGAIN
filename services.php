<?php
require_once __DIR__ . '/config/db.php';
$meta_title = "Services | Sisgain Enterprise Digital Transformation";
$meta_description = "Comprehensive enterprise digital transformation services: AI integration, cloud migration, workflow automation, ERP modernization, data engineering, and cybersecurity.";
$meta_keywords = "Enterprise Services, Digital Transformation, AI, Cloud, Automation, ERP, Data, Cybersecurity";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<!-- HERO -->
<section class="relative py-32 md:py-40 px-6 md:px-12 overflow-hidden">
    <div class="absolute top-20 left-10 w-[500px] h-[500px] bg-blue-600/8 rounded-full filter blur-[120px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto text-center relative z-10" data-aos="fade-up">
        <span class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full text-xs font-semibold bg-blue-500/10 border border-blue-500/20 text-blue-400 mb-6">
            <i data-lucide="layers" class="w-3.5 h-3.5"></i><span>Enterprise Capabilities</span>
        </span>
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold font-space leading-[1.1] tracking-tight">
            Our Enterprise<br><span class="bg-gradient-to-r from-blue-500 via-cyan-400 to-purple-500 bg-clip-text text-transparent">Capabilities</span>
        </h1>
        <p class="text-zinc-400 text-lg md:text-xl max-w-3xl mx-auto mt-6">
            Six interconnected practice areas that deliver end-to-end digital transformation for enterprises ready to lead their industries.
        </p>
    </div>
</section>

<!-- SERVICES GRID -->
<section class="py-24 md:py-32 px-6 md:px-12">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <?php
            $all_services = [
                ['AI & Machine Learning Integration','brain-circuit','cyan','Deploy enterprise-grade AI solutions including custom LLM deployments, RAG pipeline architectures, predictive analytics engines, and computer vision systems. We transform raw data into intelligent decision-making capabilities that drive measurable business outcomes across your entire organization.','10x Faster Decisions','/ai-integration.php'],
                ['Cloud Transformation','cloud-lightning','blue','Architect and execute multi-cloud migration strategies across AWS, Azure, and GCP. From Kubernetes orchestration to serverless computing, we build resilient infrastructure that scales automatically while reducing operational costs by up to 45%.','99.99% Uptime SLA','/cloud-transformation.php'],
                ['Workflow Automation','cpu','purple','Implement intelligent process automation using RPA, document processing AI, and workflow orchestration engines. We identify automation candidates through process mining and deploy solutions that eliminate 71% of manual operations within 90 days.','71% Manual Reduction','/workflow-automation.php'],
                ['ERP & CRM Modernization','database','emerald','Consolidate legacy enterprise systems, integrate SAP S/4HANA and Salesforce, and build unified customer platforms. Our API-first approach ensures seamless data flow while preserving business-critical logic across your organization.','360° Customer View','/erp-crm-modernization.php'],
                ['Data Engineering & Analytics','bar-chart-3','indigo','Build production-grade data lakes, ETL pipelines, and real-time streaming architectures. From Snowflake to Databricks, we engineer data platforms that transform raw information into actionable business intelligence at petabyte scale.','5x Faster Insights','/data-engineering.php'],
                ['Cybersecurity & Compliance','shield-alert','rose','Establish zero-trust architectures, deploy SOC capabilities, and automate compliance across HIPAA, GDPR, SOC 2, and PCI DSS frameworks. We protect your enterprise from threats while maintaining continuous audit readiness.','99.7% Threat Detection','/cybersecurity.php']
            ];
            foreach ($all_services as $i => $svc):
            ?>
            <div class="glass-card p-8 md:p-10 rounded-3xl group" data-aos="fade-up" data-aos-delay="<?= ($i % 2) * 100 ?>">
                <div class="flex items-start justify-between mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-<?= $svc[2] ?>-500/10 text-<?= $svc[2] ?>-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="<?= $svc[1] ?>" class="w-7 h-7"></i>
                    </div>
                    <span class="text-[10px] uppercase font-bold tracking-wider text-<?= $svc[2] ?>-400 bg-<?= $svc[2] ?>-500/10 px-3 py-1 rounded-full"><?= $svc[4] ?></span>
                </div>
                <h3 class="text-2xl font-bold font-space text-white group-hover:text-<?= $svc[2] ?>-400 transition-colors mb-4"><?= $svc[0] ?></h3>
                <p class="text-zinc-400 text-sm leading-relaxed mb-6"><?= $svc[3] ?></p>
                <a href="<?= $svc[5] ?>" class="text-sm font-semibold text-<?= $svc[2] ?>-400 hover:text-white transition-colors flex items-center">
                    Explore Service <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- HOW WE WORK -->
<section class="py-24 md:py-32 px-6 md:px-12 bg-[#040610]">
    <div class="max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto space-y-4 mb-20" data-aos="fade-up">
            <span class="text-xs uppercase font-semibold text-cyan-400 tracking-wider">Methodology</span>
            <h2 class="text-3xl md:text-5xl font-bold font-space">How We Work</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <?php
            $process = [
                ['01','Discover','Deep-dive assessment of your technology landscape, pain points, and business objectives.','blue'],
                ['02','Architect','Design target-state blueprints, select technology stacks, and define success metrics.','cyan'],
                ['03','Execute','Phased implementation with sprint-based delivery, continuous testing, and stakeholder alignment.','purple'],
                ['04','Optimize','Post-deployment monitoring, performance tuning, and continuous improvement cycles.','emerald']
            ];
            foreach ($process as $pi => $p):
            ?>
            <div class="text-center space-y-4" data-aos="fade-up" data-aos-delay="<?= $pi * 100 ?>">
                <div class="w-16 h-16 rounded-2xl bg-<?= $p[3] ?>-500/10 border border-<?= $p[3] ?>-500/20 text-<?= $p[3] ?>-400 flex items-center justify-center mx-auto">
                    <span class="text-xl font-bold font-space"><?= $p[0] ?></span>
                </div>
                <h3 class="text-white font-bold font-space"><?= $p[1] ?></h3>
                <p class="text-zinc-400 text-sm leading-relaxed"><?= $p[2] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- STATS -->
<section class="py-24 px-6 md:px-12">
    <div class="max-w-7xl mx-auto grid grid-cols-2 lg:grid-cols-4 gap-8">
        <?php
        $stats = [['250','+','Projects Delivered','blue'],['98','%','Client Retention','cyan'],['15','+','Industries Served','purple'],['3','','Global Offices','emerald']];
        foreach ($stats as $si => $s):
        ?>
        <div class="glass-card p-8 rounded-3xl text-center" data-aos="zoom-in" data-aos-delay="<?= $si * 80 ?>">
            <p class="text-4xl md:text-5xl font-bold font-space text-<?= $s[3] ?>-400"><span class="counter-value" data-target="<?= $s[0] ?>"><?= $s[0] ?></span><?= $s[1] ?></p>
            <p class="text-white font-semibold text-sm mt-3"><?= $s[2] ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
require_once __DIR__ . '/includes/cta.php';
require_once __DIR__ . '/includes/footer.php';
?>
