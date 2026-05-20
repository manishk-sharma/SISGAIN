<?php
// roi-calculator.php - Interactive ROI Calculator
require_once __DIR__ . '/config/db.php';

$meta_title = "ROI Calculator | Sisgain Digital Transformation";
$meta_description = "Calculate the return on investment for your digital transformation initiative. Get instant projections for cost savings, efficiency gains, and payback period.";
$meta_keywords = "ROI Calculator, Digital Transformation ROI, Cost Savings Calculator, Enterprise IT Investment";

$csrf_token = generate_csrf_token();
$submitted = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';
    if (verify_csrf_token($token)) {
        $name = sanitize($_POST['name'] ?? '');
        $email = sanitize($_POST['email'] ?? '');
        $company = sanitize($_POST['company'] ?? '');
        $phone = sanitize($_POST['phone'] ?? '');
        $ftes = intval($_POST['ftes'] ?? 100);
        $it_spend = intval($_POST['it_spend'] ?? 500000);
        $manual_hours = intval($_POST['manual_hours'] ?? 80);
        $cloud_pct = intval($_POST['cloud_pct'] ?? 30);

        if (!empty($name) && !empty($email)) {
            try {
                $msg = "ROI Calc - FTEs: $ftes, IT Spend: $it_spend, Manual Hours: $manual_hours, Cloud: $cloud_pct%";
                $stmt = $pdo->prepare("INSERT INTO leads (name, email, company, phone, message, source) VALUES (?, ?, ?, ?, ?, 'roi_calculator')");
                $stmt->execute([$name, $email, $company, $phone, $msg]);
                set_flash_message('success', 'Your custom ROI report has been queued. Our team will follow up within 24 hours.');
                $submitted = true;
            } catch (Exception $e) {}
        }
    }
}

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<!-- HERO -->
<section class="relative py-32 md:py-40 px-6 md:px-12 overflow-hidden">
    <div class="absolute top-10 left-10 w-[500px] h-[500px] bg-blue-600/8 rounded-full filter blur-[120px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto text-center relative z-10" data-aos="fade-up">
        <span class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full text-xs font-semibold bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 mb-6">
            <i data-lucide="calculator" class="w-3.5 h-3.5"></i>
            <span>Investment Analysis</span>
        </span>
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold font-space leading-[1.1] tracking-tight">
            Calculate Your Digital<br><span class="bg-gradient-to-r from-emerald-400 via-cyan-400 to-blue-500 bg-clip-text text-transparent">Transformation ROI</span>
        </h1>
        <p class="text-zinc-400 text-lg md:text-xl max-w-2xl mx-auto mt-6">
            Use our interactive calculator to estimate annual savings, payback period, and 3-year return projections based on your enterprise parameters.
        </p>
    </div>
</section>

<!-- CALCULATOR -->
<section class="py-16 px-6 md:px-12">
    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12">

        <!-- SLIDERS -->
        <div class="lg:col-span-7" data-aos="fade-right">
            <div class="glass-card p-8 md:p-10 rounded-3xl border border-white/10 space-y-10">
                <h2 class="text-2xl font-bold font-space text-white">Enterprise Parameters</h2>

                <!-- FTEs -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <label class="text-sm font-medium text-zinc-300">Number of Full-Time Employees</label>
                        <span id="ftes-display" class="text-sm font-bold font-space text-blue-400">100</span>
                    </div>
                    <input type="range" id="roi-ftes" min="10" max="5000" value="100" step="10" class="w-full h-2 bg-white/10 rounded-full appearance-none cursor-pointer accent-blue-500">
                    <div class="flex justify-between text-[10px] text-zinc-600"><span>10</span><span>5,000</span></div>
                </div>

                <!-- IT Spend -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <label class="text-sm font-medium text-zinc-300">Annual IT Spend</label>
                        <span id="spend-display" class="text-sm font-bold font-space text-cyan-400">$500,000</span>
                    </div>
                    <input type="range" id="roi-spend" min="100000" max="10000000" value="500000" step="50000" class="w-full h-2 bg-white/10 rounded-full appearance-none cursor-pointer accent-cyan-500">
                    <div class="flex justify-between text-[10px] text-zinc-600"><span>$100K</span><span>$10M</span></div>
                </div>

                <!-- Manual Hours -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <label class="text-sm font-medium text-zinc-300">Manual Process Hours / Week</label>
                        <span id="hours-display" class="text-sm font-bold font-space text-purple-400">80 hrs</span>
                    </div>
                    <input type="range" id="roi-hours" min="10" max="500" value="80" step="5" class="w-full h-2 bg-white/10 rounded-full appearance-none cursor-pointer accent-purple-500">
                    <div class="flex justify-between text-[10px] text-zinc-600"><span>10 hrs</span><span>500 hrs</span></div>
                </div>

                <!-- Cloud Adoption -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <label class="text-sm font-medium text-zinc-300">Current Cloud Adoption</label>
                        <span id="cloud-display" class="text-sm font-bold font-space text-emerald-400">30%</span>
                    </div>
                    <input type="range" id="roi-cloud" min="0" max="100" value="30" step="5" class="w-full h-2 bg-white/10 rounded-full appearance-none cursor-pointer accent-emerald-500">
                    <div class="flex justify-between text-[10px] text-zinc-600"><span>0%</span><span>100%</span></div>
                </div>
            </div>
        </div>

        <!-- RESULTS PANEL -->
        <div class="lg:col-span-5 space-y-6" data-aos="fade-left">
            <div class="glass-card p-8 rounded-3xl border border-emerald-500/20 bg-emerald-500/5 space-y-6">
                <h3 class="text-lg font-bold font-space text-white flex items-center">
                    <i data-lucide="trending-up" class="w-5 h-5 text-emerald-400 mr-2"></i>
                    Projected Results
                </h3>

                <div class="space-y-5">
                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5">
                        <p class="text-xs text-zinc-500 uppercase tracking-wider font-semibold">Estimated Annual Savings</p>
                        <p id="roi-savings" class="text-3xl font-bold font-space text-emerald-400 mt-1">$210,000</p>
                    </div>
                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5">
                        <p class="text-xs text-zinc-500 uppercase tracking-wider font-semibold">3-Year ROI Projection</p>
                        <p id="roi-3year" class="text-3xl font-bold font-space text-blue-400 mt-1">$630,000</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-zinc-500 uppercase tracking-wider font-semibold">Payback Period</p>
                            <p id="roi-payback" class="text-xl font-bold font-space text-cyan-400 mt-1">8 months</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-zinc-500 uppercase tracking-wider font-semibold">Efficiency Gain</p>
                            <p id="roi-efficiency" class="text-xl font-bold font-space text-purple-400 mt-1">3.2x</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lead Capture -->
            <div class="glass-card p-6 rounded-2xl border border-white/10">
                <h4 class="text-sm font-bold font-space text-white mb-4">Get Your Custom ROI Report</h4>
                <form action="/roi-calculator.php" method="POST" class="space-y-3">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
                    <input type="hidden" name="ftes" id="form-ftes" value="100">
                    <input type="hidden" name="it_spend" id="form-spend" value="500000">
                    <input type="hidden" name="manual_hours" id="form-hours" value="80">
                    <input type="hidden" name="cloud_pct" id="form-cloud" value="30">
                    <input type="text" name="name" required placeholder="Full Name" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-blue-500/50 transition-all">
                    <input type="email" name="email" required placeholder="Company Email" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-blue-500/50 transition-all">
                    <input type="text" name="company" placeholder="Company Name" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-blue-500/50 transition-all">
                    <input type="tel" name="phone" placeholder="Phone (optional)" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-blue-500/50 transition-all">
                    <button type="submit" class="w-full bg-gradient-to-r from-emerald-600 to-cyan-500 hover:from-emerald-500 hover:to-cyan-400 text-white font-semibold py-3.5 rounded-xl transition-all text-sm">
                        Download Custom Report <i data-lucide="download" class="w-4 h-4 ml-1 inline-block"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- METHODOLOGY -->
<section class="py-24 px-6 md:px-12 bg-[#040610]">
    <div class="max-w-5xl mx-auto">
        <h2 class="text-3xl md:text-4xl font-bold font-space text-center mb-16" data-aos="fade-up">Calculation Methodology</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="glass-card p-6 rounded-2xl" data-aos="fade-up">
                <h4 class="text-white font-bold font-space text-sm mb-3">Cost Savings Formula</h4>
                <p class="text-zinc-400 text-xs leading-relaxed">Annual savings are calculated as: (IT Spend × Cloud Savings Factor) + (Manual Hours × Average Hourly Cost × Automation Rate × 52 weeks). Cloud savings increase proportionally to the gap between current and optimal cloud adoption.</p>
            </div>
            <div class="glass-card p-6 rounded-2xl" data-aos="fade-up" data-aos-delay="100">
                <h4 class="text-white font-bold font-space text-sm mb-3">ROI Projection Model</h4>
                <p class="text-zinc-400 text-xs leading-relaxed">3-year projections include compound efficiency gains of 15% year-over-year as automation matures. Payback period factors in typical implementation costs of 30-40% of first-year savings. All estimates are conservative baselines.</p>
            </div>
        </div>
    </div>
</section>

<!-- ROI Calculator JS -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ftes = document.getElementById('roi-ftes');
    const spend = document.getElementById('roi-spend');
    const hours = document.getElementById('roi-hours');
    const cloud = document.getElementById('roi-cloud');

    function formatCurrency(num) {
        if (num >= 1000000) return '$' + (num / 1000000).toFixed(1) + 'M';
        if (num >= 1000) return '$' + Math.round(num).toLocaleString();
        return '$' + num;
    }

    function calculate() {
        const f = parseInt(ftes.value);
        const s = parseInt(spend.value);
        const h = parseInt(hours.value);
        const c = parseInt(cloud.value);

        document.getElementById('ftes-display').textContent = f.toLocaleString();
        document.getElementById('spend-display').textContent = formatCurrency(s);
        document.getElementById('hours-display').textContent = h + ' hrs';
        document.getElementById('cloud-display').textContent = c + '%';

        // Update hidden form fields
        document.getElementById('form-ftes').value = f;
        document.getElementById('form-spend').value = s;
        document.getElementById('form-hours').value = h;
        document.getElementById('form-cloud').value = c;

        // Cloud savings: higher savings when current adoption is low
        const cloudGap = (100 - c) / 100;
        const cloudSavings = s * 0.35 * cloudGap;

        // Automation savings: manual hours × $75/hr avg × 71% reduction × 52 weeks
        const autoSavings = h * 75 * 0.71 * 52;

        // Scale factor based on FTEs
        const scaleFactor = Math.min(f / 100, 5);

        const annualSavings = Math.round((cloudSavings + autoSavings) * Math.min(scaleFactor, 2.5));
        const threeYear = Math.round(annualSavings * 3 * 1.15);
        const payback = Math.max(4, Math.round(12 * (annualSavings * 0.35) / annualSavings));
        const efficiency = (1 + (h * 0.71 / Math.max(h * 0.29, 1))).toFixed(1);

        document.getElementById('roi-savings').textContent = formatCurrency(annualSavings);
        document.getElementById('roi-3year').textContent = formatCurrency(threeYear);
        document.getElementById('roi-payback').textContent = payback + ' months';
        document.getElementById('roi-efficiency').textContent = efficiency + 'x';
    }

    [ftes, spend, hours, cloud].forEach(el => {
        el.addEventListener('input', calculate);
    });

    calculate(); // Initial calculation
});
</script>

<?php
require_once __DIR__ . '/includes/cta.php';
require_once __DIR__ . '/includes/footer.php';
?>
