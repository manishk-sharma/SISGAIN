<?php
require_once __DIR__ . '/config/db.php';
$meta_title = "Case Studies | Sisgain Enterprise Transformation Results";
$meta_description = "Real enterprise transformation results. Healthcare, banking, and logistics case studies with measurable ROI, timeline, and technology details.";
$meta_keywords = "Case Studies, Enterprise Results, Digital Transformation ROI, Healthcare IT, Banking Technology, Cloud Migration, Sisgain";

try {
    $stmt = $pdo->query("SELECT * FROM case_studies ORDER BY id DESC");
    $case_studies = $stmt->fetchAll();
} catch (Exception $e) { $case_studies = []; }

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<!-- HERO -->
<section class="relative py-32 md:py-40 px-6 md:px-12 overflow-hidden">
    <div class="absolute top-10 right-10 w-[600px] h-[600px] bg-emerald-600/8 rounded-full filter blur-[120px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto text-center relative z-10" data-aos="fade-up">
        <span class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full text-xs font-semibold bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 mb-6">
            <i data-lucide="trophy" class="w-3.5 h-3.5"></i><span>Proven Results</span>
        </span>
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold font-space leading-[1.1] tracking-tight">
            Real Results.<br><span class="bg-gradient-to-r from-emerald-400 via-cyan-400 to-blue-500 bg-clip-text text-transparent">Proven Impact.</span>
        </h1>
        <p class="text-zinc-400 text-lg md:text-xl max-w-2xl mx-auto mt-6">
            Explore detailed transformation stories with measurable business outcomes, technology architectures, and implementation timelines.
        </p>
    </div>
</section>

<!-- CASE STUDIES GRID -->
<section class="py-24 md:py-32 px-6 md:px-12">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <?php if (!empty($case_studies)): ?>
                <?php foreach ($case_studies as $case): ?>
                <div id="<?= htmlspecialchars($case['slug']) ?>" class="glass-card rounded-3xl overflow-hidden flex flex-col justify-between h-full group" data-aos="fade-up">
                    <div class="p-8 space-y-4 flex-1">
                        <span class="inline-block text-[10px] uppercase font-bold tracking-wider text-blue-400 bg-blue-500/10 px-3 py-1 rounded"><?= htmlspecialchars($case['industry']) ?></span>
                        <h3 class="text-xl font-bold font-space text-white group-hover:text-blue-400 transition-colors"><?= htmlspecialchars($case['title']) ?></h3>
                        <div class="space-y-3">
                            <div><p class="text-[10px] uppercase text-zinc-500 font-semibold tracking-wider mb-1">Challenge</p><p class="text-xs text-zinc-400 leading-relaxed"><?= htmlspecialchars($case['challenge']) ?></p></div>
                            <div><p class="text-[10px] uppercase text-zinc-500 font-semibold tracking-wider mb-1">Strategy</p><p class="text-xs text-zinc-400 leading-relaxed"><?= htmlspecialchars($case['strategy']) ?></p></div>
                        </div>
                        <?php if (!empty($case['tech_stack'])): ?>
                        <div class="flex flex-wrap gap-1.5 pt-2">
                            <?php foreach (explode(',', $case['tech_stack']) as $tech): ?>
                            <span class="text-[9px] px-2 py-0.5 rounded bg-white/5 text-zinc-500 border border-white/5"><?= trim(htmlspecialchars($tech)) ?></span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="p-8 bg-[#0c0f20]/50 border-t border-white/5 space-y-3">
                        <div class="flex items-center justify-between text-xs"><span class="text-zinc-500">ROI Metric:</span><span class="text-emerald-400 font-bold font-space"><?= htmlspecialchars($case['roi_metric']) ?></span></div>
                        <div class="flex items-center justify-between text-xs"><span class="text-zinc-500">Timeline:</span><span class="text-white font-medium"><?= htmlspecialchars($case['timeline']) ?></span></div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <?php
                $fallback = [
                    ['Healthcare','Apex Health Group Digital Overhaul','apex-health',
                     'Legacy EMR systems created 3-week diagnostic processing delays across 12 clinical departments. Manual patient intake consumed 400+ staff hours weekly. HIPAA audit failures threatened accreditation.',
                     'Deployed a cloud-native HIPAA-compliant platform with automated triage AI, real-time interoperability via HL7 FHIR standards, and predictive diagnostic models trained on 2M+ patient records.',
                     'AWS,Kubernetes,TensorFlow,HL7 FHIR,React','99.9% HIPAA Compliance','4 Months'],
                    ['Finance','Capital Bank Real-Time Ledger Migration','capital-bank',
                     'Manual reconciliation processes across 340 branches consumed 12,000+ engineer-hours monthly. Audit cycles lasted 6 weeks. Real-time fraud detection was nonexistent.',
                     'Built event-driven microservices architecture with Apache Kafka for real-time transaction streaming, deployed ML-based fraud detection achieving 99.8% accuracy, and automated 90% of audit reporting.',
                     'Apache Kafka,Kubernetes,Python,Snowflake,React','71% Efficiency Gain','6 Months'],
                    ['Logistics','Gulf Logistics Cloud Infrastructure','gulf-logistics',
                     'Physical servers with 12-hour failover times caused SLA breaches on 15% of deliveries. No real-time fleet visibility. Infrastructure costs growing 25% year-over-year.',
                     'Migrated entire infrastructure to multi-AZ Kubernetes clusters on AWS with auto-scaling, deployed GPS-integrated fleet management APIs, and implemented real-time supply chain dashboards.',
                     'AWS EKS,Terraform,Go,PostgreSQL,Grafana','42% Cost Savings','5 Months'],
                    ['Manufacturing','OmniManufacture IoT Platform','omni-manufacture',
                     'Disconnected production lines with zero predictive maintenance capability. Average unplanned downtime of 180 hours per quarter. No quality inspection automation.',
                     'Deployed 500+ IoT sensors with edge computing gateways, built ML-powered predictive maintenance models achieving 72-hour advance warnings, and implemented computer vision quality inspection at line speed.',
                     'Azure IoT Hub,TensorFlow,Python,InfluxDB,Grafana','85% Downtime Reduction','7 Months'],
                    ['Retail','NexaRetail E-Commerce Scale','nexa-retail',
                     'Monolithic commerce platform crashed during peak sales events. Page load times averaged 4.2 seconds. Zero personalization capability. Conversion rate stagnant at 1.8%.',
                     'Rebuilt on headless commerce architecture with CDN-accelerated delivery, deployed AI recommendation engine processing 5M daily sessions, and implemented auto-scaling serverless backend.',
                     'Next.js,Node.js,AWS Lambda,Redis,Algolia','2.4x Conversion Increase','4 Months'],
                    ['Energy','GulfEnergy Smart Grid Analytics','gulf-energy',
                     'Manual monitoring of 500+ substations with no predictive capability. Outage response times averaged 45 minutes. No renewable energy optimization. Environmental compliance reporting required 3 FTEs.',
                     'Deployed smart grid analytics platform with real-time demand response, automated environmental compliance reporting, and renewable energy forecasting using weather-integrated ML models.',
                     'Azure,Apache Kafka,Python,Tableau,SCADA','30% Operational Savings','8 Months']
                ];
                foreach ($fallback as $fi => $fb):
                ?>
                <div id="<?= $fb[2] ?>" class="glass-card rounded-3xl overflow-hidden flex flex-col justify-between h-full group" data-aos="fade-up" data-aos-delay="<?= ($fi % 3) * 80 ?>">
                    <div class="p-8 space-y-4 flex-1">
                        <span class="inline-block text-[10px] uppercase font-bold tracking-wider text-blue-400 bg-blue-500/10 px-3 py-1 rounded"><?= $fb[0] ?></span>
                        <h3 class="text-xl font-bold font-space text-white group-hover:text-blue-400 transition-colors"><?= $fb[1] ?></h3>
                        <div class="space-y-3">
                            <div><p class="text-[10px] uppercase text-zinc-500 font-semibold tracking-wider mb-1">Challenge</p><p class="text-xs text-zinc-400 leading-relaxed"><?= $fb[3] ?></p></div>
                            <div><p class="text-[10px] uppercase text-zinc-500 font-semibold tracking-wider mb-1">Strategy</p><p class="text-xs text-zinc-400 leading-relaxed"><?= $fb[4] ?></p></div>
                        </div>
                        <div class="flex flex-wrap gap-1.5 pt-2">
                            <?php foreach (explode(',', $fb[5]) as $tech): ?>
                            <span class="text-[9px] px-2 py-0.5 rounded bg-white/5 text-zinc-500 border border-white/5"><?= trim($tech) ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="p-8 bg-[#0c0f20]/50 border-t border-white/5 space-y-3">
                        <div class="flex items-center justify-between text-xs"><span class="text-zinc-500">ROI Metric:</span><span class="text-emerald-400 font-bold font-space"><?= $fb[6] ?></span></div>
                        <div class="flex items-center justify-between text-xs"><span class="text-zinc-500">Timeline:</span><span class="text-white font-medium"><?= $fb[7] ?></span></div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- STATS -->
<section class="py-20 px-6 md:px-12 bg-[#040610]">
    <div class="max-w-7xl mx-auto grid grid-cols-2 lg:grid-cols-4 gap-8">
        <?php $stats = [['250','+','Projects Completed','blue'],['42','%','Avg. Cost Savings','emerald'],['98','%','Client Satisfaction','cyan'],['15','+','Industries Served','purple']];
        foreach ($stats as $si => $s): ?>
        <div class="text-center" data-aos="zoom-in" data-aos-delay="<?= $si * 80 ?>">
            <p class="text-4xl md:text-5xl font-bold font-space text-<?= $s[3] ?>-400"><span class="counter-value" data-target="<?= $s[0] ?>"><?= $s[0] ?></span><?= $s[1] ?></p>
            <p class="text-zinc-400 text-sm mt-2"><?= $s[2] ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/cta.php'; require_once __DIR__ . '/includes/footer.php'; ?>
