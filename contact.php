<?php
// contact.php - Enterprise Contact & Inquiry Portal
require_once __DIR__ . '/config/db.php';

$meta_title = "Contact Us | Sisgain Enterprise Digital Transformation";
$meta_description = "Schedule a strategy call with our enterprise consulting team. Offices in Dubai, Houston, and India. Get a response within 24 hours.";
$meta_keywords = "Contact Sisgain, Enterprise Consulting, Strategy Call, Digital Transformation Inquiry";

$csrf_token = generate_csrf_token();
$errors = [];
$success = false;

// POST handler
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';
    if (!verify_csrf_token($token)) {
        $errors[] = 'Security validation failed. Please try again.';
    } else {
        $name = isset($_POST['name']) ? sanitize($_POST['name']) : '';
        $email = isset($_POST['email']) ? sanitize($_POST['email']) : '';
        $company = isset($_POST['company']) ? sanitize($_POST['company']) : '';
        $phone = isset($_POST['phone']) ? sanitize($_POST['phone']) : '';
        $service = isset($_POST['service']) ? sanitize($_POST['service']) : '';
        $budget = isset($_POST['budget']) ? sanitize($_POST['budget']) : '';
        $message = isset($_POST['message']) ? sanitize($_POST['message']) : '';

        if (empty($name) || empty($email) || empty($message)) {
            $errors[] = 'Name, email, and message are required fields.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address.';
        }

        if (empty($errors)) {
            try {
                $stmt = $pdo->prepare("INSERT INTO leads (name, email, company, phone, service_interest, budget_range, message, source) VALUES (?, ?, ?, ?, ?, ?, ?, 'contact_form')");
                $stmt->execute([$name, $email, $company, $phone, $service, $budget, $message]);
                set_flash_message('success', 'Your inquiry has been submitted. Our team will respond within 24 hours.');
                header("Location: /contact.php");
                exit;
            } catch (Exception $e) {
                $errors[] = 'An error occurred. Please try again later.';
            }
        }
    }
}

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<!-- HERO -->
<section class="relative py-32 md:py-40 px-6 md:px-12 overflow-hidden">
    <div class="absolute top-20 right-0 w-[600px] h-[600px] bg-blue-600/8 rounded-full filter blur-[120px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto text-center relative z-10" data-aos="fade-up">
        <span class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full text-xs font-semibold bg-blue-500/10 border border-blue-500/20 text-blue-400 mb-6">
            <i data-lucide="mail" class="w-3.5 h-3.5"></i>
            <span>Get In Touch</span>
        </span>
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold font-space leading-[1.1] tracking-tight">
            Let's Build Something<br><span class="bg-gradient-to-r from-blue-500 via-cyan-400 to-blue-600 bg-clip-text text-transparent">Extraordinary</span>
        </h1>
        <p class="text-zinc-400 text-lg md:text-xl max-w-2xl mx-auto mt-6 leading-relaxed">
            Whether you're modernizing legacy systems or launching an AI-first strategy, our enterprise architects are ready to engineer your next competitive advantage.
        </p>
    </div>
</section>

<!-- CONTACT FORM + INFO -->
<section class="py-24 px-6 md:px-12 relative">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12">

        <!-- FORM -->
        <div class="lg:col-span-7" data-aos="fade-right">
            <?php if (!empty($errors)): ?>
                <div class="p-4 bg-red-500/10 border border-red-500/20 text-red-400 rounded-2xl text-sm mb-8">
                    <?php foreach ($errors as $err): ?>
                        <p><?= htmlspecialchars($err) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="glass-card p-8 md:p-12 rounded-3xl border border-white/10">
                <h2 class="text-2xl font-bold font-space text-white mb-2">Send Us Your Inquiry</h2>
                <p class="text-zinc-400 text-sm mb-8">Fill out the form below and our enterprise team will respond within 24 hours.</p>

                <form action="/contact.php" method="POST" class="space-y-6">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="name" class="text-xs uppercase font-semibold text-zinc-400 tracking-wider">Full Name *</label>
                            <input type="text" id="name" name="name" required placeholder="John Mitchell" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3.5 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-blue-500/50 focus:ring-1 focus:ring-blue-500/25 transition-all">
                        </div>
                        <div class="space-y-2">
                            <label for="email" class="text-xs uppercase font-semibold text-zinc-400 tracking-wider">Company Email *</label>
                            <input type="email" id="email" name="email" required placeholder="john@company.com" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3.5 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-blue-500/50 focus:ring-1 focus:ring-blue-500/25 transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="company" class="text-xs uppercase font-semibold text-zinc-400 tracking-wider">Company Name</label>
                            <input type="text" id="company" name="company" placeholder="Acme Corporation" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3.5 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-blue-500/50 focus:ring-1 focus:ring-blue-500/25 transition-all">
                        </div>
                        <div class="space-y-2">
                            <label for="phone" class="text-xs uppercase font-semibold text-zinc-400 tracking-wider">Phone Number</label>
                            <input type="tel" id="phone" name="phone" placeholder="+1 (555) 000-0000" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3.5 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-blue-500/50 focus:ring-1 focus:ring-blue-500/25 transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="service" class="text-xs uppercase font-semibold text-zinc-400 tracking-wider">Service Interest</label>
                            <select id="service" name="service" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3.5 text-sm text-white focus:outline-none focus:border-blue-500/50 transition-all appearance-none">
                                <option value="">Select a service</option>
                                <option value="AI Integration">AI & Machine Learning</option>
                                <option value="Cloud Transformation">Cloud Infrastructure</option>
                                <option value="Workflow Automation">Process Automation</option>
                                <option value="ERP & CRM">ERP & CRM Modernization</option>
                                <option value="Data Engineering">Data Engineering & BI</option>
                                <option value="Cybersecurity">Cybersecurity & Compliance</option>
                                <option value="Full Transformation">Full Digital Transformation</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label for="budget" class="text-xs uppercase font-semibold text-zinc-400 tracking-wider">Project Budget Range</label>
                            <select id="budget" name="budget" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3.5 text-sm text-white focus:outline-none focus:border-blue-500/50 transition-all appearance-none">
                                <option value="">Select budget range</option>
                                <option value="$25K - $50K">$25,000 – $50,000</option>
                                <option value="$50K - $100K">$50,000 – $100,000</option>
                                <option value="$100K - $250K">$100,000 – $250,000</option>
                                <option value="$250K - $500K">$250,000 – $500,000</option>
                                <option value="$500K+">$500,000+</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="message" class="text-xs uppercase font-semibold text-zinc-400 tracking-wider">Project Details *</label>
                        <textarea id="message" name="message" rows="5" required placeholder="Tell us about your current challenges and transformation goals..." class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3.5 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-blue-500/50 focus:ring-1 focus:ring-blue-500/25 transition-all resize-none"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-semibold py-4 rounded-xl transition-all duration-300 shadow-lg hover:shadow-blue-500/25 flex items-center justify-center text-sm transform hover:-translate-y-0.5">
                        Send Inquiry
                        <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                    </button>

                    <p class="text-zinc-500 text-xs text-center">By submitting, you agree to our privacy policy. We never share your data with third parties.</p>
                </form>
            </div>
        </div>

        <!-- CONTACT INFO SIDEBAR -->
        <div class="lg:col-span-5 space-y-6" data-aos="fade-left">
            <!-- Email -->
            <div class="glass-card p-6 rounded-2xl border border-white/10 flex items-start space-x-4">
                <div class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center flex-shrink-0">
                    <i data-lucide="mail" class="w-5 h-5"></i>
                </div>
                <div>
                    <h4 class="text-white font-semibold text-sm">Email Us</h4>
                    <a href="mailto:advisory@sisgain.com" class="text-zinc-400 text-sm hover:text-blue-400 transition-colors">advisory@sisgain.com</a>
                </div>
            </div>

            <!-- Schedule -->
            <div class="glass-card p-6 rounded-2xl border border-white/10 flex items-start space-x-4">
                <div class="w-12 h-12 rounded-xl bg-cyan-500/10 text-cyan-400 flex items-center justify-center flex-shrink-0">
                    <i data-lucide="calendar" class="w-5 h-5"></i>
                </div>
                <div>
                    <h4 class="text-white font-semibold text-sm">Schedule a Call</h4>
                    <a href="https://calendly.com/sisgain-consulting/strategy-call" target="_blank" class="text-zinc-400 text-sm hover:text-cyan-400 transition-colors">Book on Calendly →</a>
                </div>
            </div>

            <!-- WhatsApp -->
            <div class="glass-card p-6 rounded-2xl border border-white/10 flex items-start space-x-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center flex-shrink-0">
                    <i data-lucide="message-circle" class="w-5 h-5"></i>
                </div>
                <div>
                    <h4 class="text-white font-semibold text-sm">WhatsApp</h4>
                    <a href="https://wa.me/971501234567" target="_blank" class="text-zinc-400 text-sm hover:text-emerald-400 transition-colors">Chat with us directly →</a>
                </div>
            </div>

            <!-- Office Addresses -->
            <div class="glass-card p-6 rounded-2xl border border-white/10 space-y-6">
                <h4 class="text-white font-semibold text-sm flex items-center">
                    <i data-lucide="map-pin" class="w-4 h-4 text-blue-400 mr-2"></i>
                    Global Offices
                </h4>
                <div class="space-y-5">
                    <div class="pl-6 border-l-2 border-blue-500/30">
                        <p class="text-white text-xs font-semibold">Dubai, UAE</p>
                        <p class="text-zinc-400 text-xs mt-1">Level 24, Marina Plaza, Dubai Marina, Dubai, UAE</p>
                    </div>
                    <div class="pl-6 border-l-2 border-cyan-500/30">
                        <p class="text-white text-xs font-semibold">Houston, USA</p>
                        <p class="text-zinc-400 text-xs mt-1">Suite 800, Louisiana St, Houston, TX 77002, USA</p>
                    </div>
                    <div class="pl-6 border-l-2 border-purple-500/30">
                        <p class="text-white text-xs font-semibold">Gurugram, India</p>
                        <p class="text-zinc-400 text-xs mt-1">Phase III, Info City, Sector 34, Gurugram, HR 122001</p>
                    </div>
                </div>
            </div>

            <!-- Response Promise -->
            <div class="bg-gradient-to-br from-blue-600/10 to-cyan-500/10 p-6 rounded-2xl border border-blue-500/15">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-blue-500/20 text-blue-400 flex items-center justify-center">
                        <i data-lucide="clock" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <p class="text-white text-sm font-semibold">24-Hour Response Guarantee</p>
                        <p class="text-zinc-400 text-xs">Our enterprise team responds to every inquiry within one business day.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- WHAT HAPPENS NEXT -->
<section class="py-24 px-6 md:px-12 bg-[#040610]">
    <div class="max-w-5xl mx-auto">
        <h2 class="text-3xl md:text-4xl font-bold font-space text-center mb-16" data-aos="fade-up">What Happens Next?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center space-y-4" data-aos="fade-up">
                <div class="w-16 h-16 rounded-2xl bg-blue-500/10 border border-blue-500/20 text-blue-400 flex items-center justify-center mx-auto">
                    <span class="text-xl font-bold font-space">01</span>
                </div>
                <h3 class="text-white font-semibold font-space">Response Within 24h</h3>
                <p class="text-zinc-400 text-sm">A senior enterprise architect reviews your inquiry and responds with initial observations and next steps.</p>
            </div>
            <div class="text-center space-y-4" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 rounded-2xl bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 flex items-center justify-center mx-auto">
                    <span class="text-xl font-bold font-space">02</span>
                </div>
                <h3 class="text-white font-semibold font-space">Discovery Call</h3>
                <p class="text-zinc-400 text-sm">We schedule a 45-minute discovery session to understand your technical landscape, pain points, and business objectives.</p>
            </div>
            <div class="text-center space-y-4" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center mx-auto">
                    <span class="text-xl font-bold font-space">03</span>
                </div>
                <h3 class="text-white font-semibold font-space">Custom Proposal</h3>
                <p class="text-zinc-400 text-sm">You receive a detailed transformation roadmap with timeline, investment breakdown, and projected ROI within 5 business days.</p>
            </div>
        </div>
    </div>
</section>

<?php
require_once __DIR__ . '/includes/cta.php';
require_once __DIR__ . '/includes/footer.php';
?>
