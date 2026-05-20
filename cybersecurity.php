<?php
require_once __DIR__ . '/config/db.php';
$meta_title = "Cybersecurity & Compliance | Sisgain Enterprise Solutions";
$meta_description = "Enterprise cybersecurity: zero-trust architecture, threat detection, identity management, and automated compliance across HIPAA, GDPR, SOC 2, PCI DSS.";
$meta_keywords = "Cybersecurity, Zero Trust, Threat Detection, HIPAA, GDPR, SOC 2, PCI DSS, Identity Management, Sisgain";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<section class="relative py-32 md:py-40 px-6 md:px-12 overflow-hidden">
    <div class="absolute bottom-10 right-0 w-[600px] h-[600px] bg-rose-600/8 rounded-full filter blur-[120px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-center relative z-10">
        <div class="lg:col-span-7 space-y-8" data-aos="fade-right">
            <span class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full text-xs font-semibold bg-rose-500/10 border border-rose-500/20 text-rose-400">
                <i data-lucide="shield-alert" class="w-3.5 h-3.5"></i><span>Enterprise Security</span>
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold font-space leading-[1.1] tracking-tight">
                Enterprise Cybersecurity &<br><span class="bg-gradient-to-r from-rose-400 to-purple-500 bg-clip-text text-transparent">Zero-Trust Architecture</span>
            </h1>
            <p class="text-zinc-400 text-lg leading-relaxed max-w-2xl">Protect your enterprise with identity-first security architectures, AI-powered threat detection, and automated compliance frameworks that maintain continuous audit readiness across every regulation.</p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="/contact.php" class="btn-primary text-center">Schedule Security Assessment <i data-lucide="arrow-right" class="w-4 h-4 ml-2 inline-block"></i></a>
                <a href="/roi-calculator.php" class="btn-secondary text-center">Calculate Security ROI</a>
            </div>
        </div>
        <div class="lg:col-span-5 space-y-4" data-aos="fade-left">
            <div class="glass-card p-6 rounded-2xl flex items-center space-x-4"><div class="w-12 h-12 rounded-xl bg-rose-500/10 text-rose-400 flex items-center justify-center"><i data-lucide="shield" class="w-5 h-5"></i></div><div><p class="text-2xl font-bold font-space text-white">99.7%</p><p class="text-xs text-zinc-500">Threat Detection Rate</p></div></div>
            <div class="glass-card p-6 rounded-2xl flex items-center space-x-4"><div class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center"><i data-lucide="clock" class="w-5 h-5"></i></div><div><p class="text-2xl font-bold font-space text-white">60%</p><p class="text-xs text-zinc-500">Faster Incident Response</p></div></div>
            <div class="glass-card p-6 rounded-2xl flex items-center space-x-4"><div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center"><i data-lucide="check-circle" class="w-5 h-5"></i></div><div><p class="text-2xl font-bold font-space text-white">100%</p><p class="text-xs text-zinc-500">Audit Compliance</p></div></div>
        </div>
    </div>
</section>

<section class="py-24 md:py-32 px-6 md:px-12 bg-[#040610]">
    <div class="max-w-7xl mx-auto space-y-16">
        <div class="text-center max-w-3xl mx-auto space-y-4" data-aos="fade-up">
            <span class="text-xs uppercase font-semibold text-rose-400 tracking-wider">Capabilities</span>
            <h2 class="text-3xl md:text-5xl font-bold font-space">What We Deliver</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $features = [
                ['shield','Zero-Trust Implementation','Deploy identity-centric security architectures with micro-segmentation, least-privilege access, continuous verification, and encrypted communications across all network layers.','rose'],
                ['radar','Threat Detection & Response','Implement AI-powered SIEM systems, behavioral analytics, and automated incident response playbooks that detect and neutralize threats in real-time with 99.7% accuracy.','blue'],
                ['fingerprint','Identity & Access Management','Design and deploy enterprise IAM solutions with SSO, MFA, privileged access management, and automated provisioning/deprovisioning across all corporate applications.','purple'],
                ['cloud','Cloud Security Posture','Implement CSPM, CWPP, and CASB solutions that continuously monitor cloud configurations, detect misconfigurations, and enforce security policies across multi-cloud environments.','cyan'],
                ['clipboard-check','Compliance Automation','Automate evidence collection, control testing, and audit reporting across HIPAA, GDPR, SOC 2, PCI DSS, and ISO 27001 frameworks with continuous monitoring dashboards.','emerald'],
                ['monitor','Security Operations Center','Establish 24/7 SOC capabilities with dedicated threat analysts, real-time monitoring dashboards, and automated escalation workflows for rapid incident management.','indigo']
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
            <?php foreach (['CrowdStrike','Palo Alto Networks','Splunk','Okta','HashiCorp Vault','AWS GuardDuty','Azure Sentinel','Snyk','Tenable','Wiz','SentinelOne','Datadog Security'] as $tech): ?>
            <span class="px-4 py-2 rounded-full text-xs font-medium bg-white/5 border border-white/10 text-zinc-300 hover:border-rose-500/30 hover:text-rose-400 transition-all"><?= $tech ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="py-24 px-6 md:px-12 bg-[#040610]">
    <div class="max-w-7xl mx-auto grid grid-cols-2 lg:grid-cols-4 gap-8">
        <?php $stats = [['99.7','%','Threat Detection','rose'],['60','%','Faster Response','blue'],['100','%','Audit Compliance','emerald'],['4.4','M','Breach Prevention','purple']];
        foreach ($stats as $si => $s): ?>
        <div class="glass-card p-8 rounded-3xl text-center" data-aos="zoom-in" data-aos-delay="<?= $si*80 ?>">
            <p class="text-4xl md:text-5xl font-bold font-space text-<?= $s[3] ?>-400"><span class="counter-value" data-target="<?= $s[0] ?>"><?= $s[0] ?></span><?= $s[1] ?></p>
            <p class="text-white font-semibold text-sm mt-3"><?= $s[2] ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/cta.php'; require_once __DIR__ . '/includes/footer.php'; ?>
