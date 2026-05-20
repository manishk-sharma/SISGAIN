<?php
require_once __DIR__ . '/config/db.php';
$meta_title = "Industry Solutions | Sisgain Enterprise Digital Transformation";
$meta_description = "Industry-specific digital transformation for Healthcare, Banking, Logistics, Manufacturing, Retail, and Energy sectors. Compliance-first, results-driven.";
$meta_keywords = "Industry Solutions, Healthcare IT, Banking Technology, Logistics Automation, Manufacturing IoT, Retail Commerce, Energy Digital, Sisgain";

$active_sector = isset($_GET['sector']) ? sanitize($_GET['sector']) : 'healthcare';
$valid_sectors = ['healthcare','banking','logistics','manufacturing','retail','energy'];
if (!in_array($active_sector, $valid_sectors)) $active_sector = 'healthcare';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<section class="relative py-32 md:py-40 px-6 md:px-12 overflow-hidden">
    <div class="absolute top-20 right-0 w-[600px] h-[600px] bg-blue-600/8 rounded-full filter blur-[120px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto text-center relative z-10" data-aos="fade-up">
        <span class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full text-xs font-semibold bg-blue-500/10 border border-blue-500/20 text-blue-400 mb-6">
            <i data-lucide="building-2" class="w-3.5 h-3.5"></i><span>Sector Expertise</span>
        </span>
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold font-space leading-[1.1] tracking-tight">
            Industry-Specific<br><span class="bg-gradient-to-r from-blue-500 via-cyan-400 to-emerald-400 bg-clip-text text-transparent">Digital Solutions</span>
        </h1>
        <p class="text-zinc-400 text-lg md:text-xl max-w-3xl mx-auto mt-6">
            Purpose-built transformation blueprints that address unique compliance requirements, operational challenges, and competitive dynamics across six core industries.
        </p>
    </div>
</section>

<!-- INDUSTRY TABS -->
<section class="py-16 md:py-24 px-6 md:px-12">
    <div class="max-w-7xl mx-auto space-y-16">
        <div class="flex flex-wrap items-center justify-center gap-3" data-aos="fade-up">
            <?php
            $tabs = [
                'healthcare'=>['Healthcare','activity','rose'],
                'banking'=>['Banking & Finance','landmark','emerald'],
                'logistics'=>['Logistics & Supply Chain','truck','cyan'],
                'manufacturing'=>['Manufacturing','settings','orange'],
                'retail'=>['Retail & E-Commerce','shopping-bag','purple'],
                'energy'=>['Energy & Utilities','flame','amber']
            ];
            foreach ($tabs as $key => $tab):
                $isActive = ($key === $active_sector);
            ?>
            <button data-industry-tab="<?= $key ?>" class="px-5 py-2.5 rounded-full text-sm font-medium border transition-all flex items-center space-x-2 <?= $isActive ? 'border-blue-500 bg-blue-500/10 text-blue-400' : 'border-white/10 text-zinc-400 hover:border-white/20' ?>">
                <i data-lucide="<?= $tab[1] ?>" class="w-4 h-4"></i><span><?= $tab[0] ?></span>
            </button>
            <?php endforeach; ?>
        </div>

        <div class="relative min-h-[600px]">
            <?php
            $panels = [
                ['healthcare','activity','rose','Healthcare Digital Modernization',
                'The healthcare industry faces mounting pressure to digitize patient workflows, comply with stringent HIPAA regulations, and integrate disparate clinical systems. Legacy EMR platforms create data silos that delay diagnostics and compromise patient outcomes. Our healthcare transformation practice builds HIPAA-compliant cloud platforms, AI-powered diagnostic pipelines, and interoperability layers that unify clinical, operational, and financial data.',
                [['Automated Clinical Workflows','Digitize patient admissions, lab orders, and discharge processes with intelligent routing and real-time status dashboards.','clipboard-check'],['Interoperability & HL7 FHIR','Connect disparate EMR/EHR systems using HL7 FHIR standards for seamless data exchange across care networks.','plug'],['Predictive Diagnostics','Deploy machine learning models that analyze patient data to identify disease risk factors and recommend preventive interventions.','brain']],
                '99.9%','HIPAA Compliance','1.2ms','Validation Latency','Apex Health Group','Automated EMR classification reduced diagnostic file delays from 3 weeks to minutes across 12 clinical departments.'],

                ['banking','landmark','emerald','Banking & Financial Technology',
                'Financial institutions require real-time transaction processing, automated regulatory compliance, and fraud detection systems that operate at massive scale. Legacy core banking systems cannot support the speed and agility demanded by modern fintech competition. We build event-driven architectures, real-time risk engines, and automated audit systems that transform banking operations.',
                [['Real-time Transaction Processing','Deploy event-streaming architectures that process millions of transactions per second with sub-millisecond latency and complete audit trails.','zap'],['Automated Regulatory Compliance','Build compliance engines that continuously monitor transactions against KYC, AML, and Basel III requirements with automated reporting.','shield'],['AI-Powered Fraud Detection','Implement behavioral analytics and anomaly detection models that identify fraudulent activity in real-time with 99.8% accuracy.','radar']],
                'Real-time','Ledger Auditing','71% Less','Manual Audit Hours','Capital Bank Group','Event-driven ledger validation deployed across 340 branch offices with real-time reconciliation.'],

                ['logistics','truck','cyan','Logistics & Supply Chain',
                'Global supply chains demand real-time visibility, predictive routing, and automated warehouse management. Physical infrastructure limitations and manual tracking processes create costly delays and SLA violations. Our logistics practice builds GPS-integrated fleet management platforms, predictive maintenance systems, and cloud-native supply chain APIs.',
                [['Fleet Management Platform','Real-time vehicle tracking, route optimization, and automated dispatch systems with predictive ETA calculations.','map'],['Warehouse Automation','IoT-enabled inventory management, automated pick-and-pack workflows, and RFID tracking integration.','package'],['Supply Chain Analytics','End-to-end supply chain visibility dashboards with demand forecasting and supplier performance monitoring.','bar-chart-3']],
                '99.99%','Infrastructure Uptime','42% Saved','Cloud Infrastructure Cost','Gulf Logistics Corp','Migrated to containerized clusters with sub-second failover and 42% cost reduction across 8 distribution centers.'],

                ['manufacturing','settings','orange','Manufacturing & Industrial IoT',
                'Modern manufacturing requires connected factory floors, predictive maintenance, and automated quality control. Disconnected production systems and manual inspection processes lead to unplanned downtime and quality defects. We deploy edge computing solutions, computer vision inspection systems, and digital twin platforms.',
                [['Predictive Maintenance','Deploy vibration, thermal, and acoustic sensors with ML models that predict equipment failures 72 hours in advance.','activity'],['Computer Vision QC','Automated visual inspection systems that detect defects at production-line speeds with 99.5% accuracy.','eye'],['Digital Twin Platform','Create virtual replicas of production facilities for simulation, optimization, and scenario planning.','monitor']],
                '85%','Predictive Accuracy','3.2x','Production Throughput','','Edge computing architecture delivering predictive maintenance with 72-hour advance warning across 200+ machines.'],

                ['retail','shopping-bag','purple','Retail & E-Commerce',
                'Retailers need omnichannel experiences, personalized recommendations, and infrastructure that handles peak traffic surges. Legacy commerce platforms cannot deliver the speed and personalization modern consumers expect. We build headless commerce architectures, recommendation engines, and auto-scaling infrastructure.',
                [['Headless Commerce','API-first commerce platforms that deliver content across web, mobile, kiosk, and IoT touchpoints from a single backend.','code'],['Personalization Engine','AI-powered product recommendations, dynamic pricing, and behavioral targeting that increase conversion rates by 2.4x.','sparkles'],['Peak Traffic Management','Auto-scaling infrastructure with CDN integration that handles 10x traffic surges during flash sales without degradation.','trending-up']],
                '99.97%','Platform Uptime','2.4x','Conversion Improvement','','Dynamic catalog APIs on serverless infrastructure with CDN-accelerated delivery serving 5M+ daily sessions.'],

                ['energy','flame','amber','Energy & Utilities',
                'Energy companies must modernize grid management, optimize resource allocation, and comply with environmental regulations while transitioning to renewable sources. Legacy SCADA systems and manual monitoring create operational blind spots. We deploy smart grid analytics, renewable energy management platforms, and regulatory compliance automation.',
                [['Smart Grid Analytics','Real-time monitoring and optimization of power distribution networks using IoT sensors and predictive analytics.','radio'],['Renewable Energy Management','Forecasting and optimization platforms for wind, solar, and hybrid energy generation with battery storage management.','sun'],['Regulatory Compliance','Automated environmental reporting, emissions tracking, and regulatory filing systems across federal and state requirements.','clipboard-check']],
                '30%','Operational Efficiency','$12M','Annual Savings','','Deployed smart grid analytics across 500+ substations with real-time demand response and predictive maintenance.']
            ];

            foreach ($panels as $pi => $p):
                $isFirst = ($p[0] === $active_sector);
            ?>
            <div data-industry-panel="<?= $p[0] ?>" class="<?= $isFirst ? '' : 'hidden' ?> space-y-12">
                <!-- Main Content -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    <div class="lg:col-span-6 space-y-6">
                        <h2 class="text-3xl font-bold font-space text-white flex items-center">
                            <i data-lucide="<?= $p[1] ?>" class="w-7 h-7 text-<?= $p[2] ?>-400 mr-3"></i><?= $p[3] ?>
                        </h2>
                        <p class="text-zinc-400 text-sm leading-relaxed"><?= $p[4] ?></p>
                        <div class="grid grid-cols-2 gap-4 pt-4">
                            <div class="p-5 rounded-2xl bg-white/5 border border-white/5"><p class="text-white font-bold font-space text-2xl"><?= $p[7] ?></p><p class="text-xs text-zinc-500 mt-1"><?= $p[8] ?></p></div>
                            <div class="p-5 rounded-2xl bg-white/5 border border-white/5"><p class="text-white font-bold font-space text-2xl"><?= $p[9] ?></p><p class="text-xs text-zinc-500 mt-1"><?= $p[10] ?></p></div>
                        </div>
                    </div>
                    <div class="lg:col-span-6 space-y-4">
                        <?php foreach ($p[5] as $feat): ?>
                        <div class="glass-card p-5 rounded-2xl flex items-start space-x-4">
                            <div class="w-10 h-10 rounded-xl bg-<?= $p[2] ?>-500/10 text-<?= $p[2] ?>-400 flex items-center justify-center flex-shrink-0"><i data-lucide="<?= $feat[2] ?>" class="w-5 h-5"></i></div>
                            <div><h4 class="text-white font-semibold text-sm"><?= $feat[0] ?></h4><p class="text-zinc-400 text-xs mt-1 leading-relaxed"><?= $feat[1] ?></p></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Case Study -->
                <div class="glass-card p-6 rounded-2xl border border-white/10 bg-[#0D1324]/30">
                    <h4 class="text-white font-bold font-space text-sm mb-2"><?= $p[11] ? 'Case Study: ' . $p[11] : 'Architecture Blueprint' ?></h4>
                    <p class="text-zinc-400 text-xs leading-relaxed"><?= $p[12] ?></p>
                    <div class="flex items-center justify-between mt-4">
                        <a href="/case-studies.php" class="text-xs font-semibold text-blue-400 hover:underline flex items-center">Read Full Analysis <i data-lucide="arrow-right" class="w-3.5 h-3.5 ml-1"></i></a>
                        <a href="/contact.php?service=<?= $p[0] ?>" class="text-xs font-semibold text-<?= $p[2] ?>-400 bg-<?= $p[2] ?>-500/10 px-4 py-2 rounded-full hover:bg-<?= $p[2] ?>-500/20 transition-all">
                            Schedule Industry Consultation <i data-lucide="calendar" class="w-3 h-3 ml-1 inline-block"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/cta.php'; require_once __DIR__ . '/includes/footer.php'; ?>
