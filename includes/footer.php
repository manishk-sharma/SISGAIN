<?php
// includes/footer.php
// Premium Enterprise Footer — Appinventiv-Level Quality
// ======================================================
?>

    <!-- ═══════════════════════════════════════════════ -->
    <!-- FOOTER                                          -->
    <!-- ═══════════════════════════════════════════════ -->
    <footer class="relative overflow-hidden bg-[#030410]">

        <!-- Background Glow -->
        <div class="glow-blur-1 bottom-20 left-10"></div>
        <div class="glow-blur-2 bottom-10 right-20"></div>

        <!-- Newsletter Bar -->
        <div class="border-b border-white/5">
            <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 py-14">
                <div class="flex flex-col lg:flex-row items-center justify-between gap-8" data-aos="fade-up">
                    <div class="text-center lg:text-left max-w-lg">
                        <h3 class="text-xl md:text-2xl font-bold font-space text-white">
                            Get Enterprise Insights Delivered
                        </h3>
                        <p class="text-zinc-400 text-sm mt-2">
                            Join 5,000+ CTOs and engineering leaders receiving our weekly digital transformation briefing.
                        </p>
                    </div>
                    <form class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto" onsubmit="return false;">
                        <div class="relative flex-1 lg:w-80">
                            <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-zinc-500"></i>
                            <input type="email" placeholder="Enter your work email" class="w-full bg-white/5 border border-white/10 rounded-xl pl-11 pr-4 py-3.5 text-sm text-white placeholder-zinc-500 focus:outline-none focus:border-blue-500/50 focus:ring-1 focus:ring-blue-500/20 transition-all duration-300">
                        </div>
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white text-sm font-semibold px-8 py-3.5 rounded-xl transition-all duration-300 shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 hover:-translate-y-0.5 flex items-center justify-center whitespace-nowrap">
                            Subscribe
                            <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Footer Grid -->
        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 py-20 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8">

                <!-- Column 1: Brand -->
                <div class="space-y-6 lg:col-span-1">
                    <a href="/index.php" class="inline-block text-2xl font-bold font-space bg-gradient-to-r from-blue-500 to-cyan-400 bg-clip-text text-transparent">
                        SISGAIN
                    </a>
                    <p class="text-zinc-400 text-sm leading-relaxed max-w-xs">
                        Premier enterprise digital transformation advisory. We architect high-performance, secure platforms engineered for exponential growth.
                    </p>

                    <!-- Social Icons -->
                    <div class="flex items-center space-x-3 pt-2">
                        <a href="https://linkedin.com/company/sisgain" target="_blank" rel="noopener" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-zinc-400 hover:text-blue-400 hover:border-blue-500/30 hover:bg-blue-500/10 transition-all duration-300" aria-label="LinkedIn">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        <a href="https://twitter.com/sisgain" target="_blank" rel="noopener" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-zinc-400 hover:text-blue-400 hover:border-blue-500/30 hover:bg-blue-500/10 transition-all duration-300" aria-label="Twitter/X">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-zinc-400 hover:text-blue-400 hover:border-blue-500/30 hover:bg-blue-500/10 transition-all duration-300" aria-label="GitHub">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-zinc-400 hover:text-blue-400 hover:border-blue-500/30 hover:bg-blue-500/10 transition-all duration-300" aria-label="YouTube">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    </div>

                    <!-- Certifications -->
                    <div class="flex flex-wrap gap-2 pt-1">
                        <span class="text-[10px] uppercase font-semibold text-zinc-500 bg-white/5 border border-white/10 px-2.5 py-1 rounded-md">ISO 27001</span>
                        <span class="text-[10px] uppercase font-semibold text-zinc-500 bg-white/5 border border-white/10 px-2.5 py-1 rounded-md">GDPR</span>
                        <span class="text-[10px] uppercase font-semibold text-zinc-500 bg-white/5 border border-white/10 px-2.5 py-1 rounded-md">HIPAA</span>
                    </div>
                </div>

                <!-- Column 2: Services -->
                <div class="space-y-5">
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-white font-space">Services</h4>
                    <ul class="space-y-3">
                        <li><a href="/ai-integration.php" class="text-sm text-zinc-400 hover:text-white transition-colors duration-200">AI & Cognitive Systems</a></li>
                        <li><a href="/cloud-transformation.php" class="text-sm text-zinc-400 hover:text-white transition-colors duration-200">Cloud Transformation</a></li>
                        <li><a href="/workflow-automation.php" class="text-sm text-zinc-400 hover:text-white transition-colors duration-200">RPA & Hyperautomation</a></li>
                        <li><a href="/erp-crm-modernization.php" class="text-sm text-zinc-400 hover:text-white transition-colors duration-200">ERP & CRM Modernization</a></li>
                        <li><a href="/data-engineering.php" class="text-sm text-zinc-400 hover:text-white transition-colors duration-200">Data Pipelines & BI</a></li>
                        <li><a href="/cybersecurity.php" class="text-sm text-zinc-400 hover:text-white transition-colors duration-200">Zero-Trust Cybersecurity</a></li>
                    </ul>
                </div>

                <!-- Column 3: Company -->
                <div class="space-y-5">
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-white font-space">Company</h4>
                    <ul class="space-y-3">
                        <li><a href="/about.php" class="text-sm text-zinc-400 hover:text-white transition-colors duration-200">About Us</a></li>
                        <li><a href="/case-studies.php" class="text-sm text-zinc-400 hover:text-white transition-colors duration-200">Case Studies</a></li>
                        <li><a href="/blog.php" class="text-sm text-zinc-400 hover:text-white transition-colors duration-200">Insights Blog</a></li>
                        <li><a href="/contact.php" class="text-sm text-zinc-400 hover:text-white transition-colors duration-200">Contact</a></li>
                        <li><a href="/roi-calculator.php" class="text-sm text-zinc-400 hover:text-white transition-colors duration-200">ROI Calculator</a></li>
                        <li><a href="/industries.php" class="text-sm text-zinc-400 hover:text-white transition-colors duration-200">Industries</a></li>
                    </ul>
                </div>

                <!-- Column 4: Contact -->
                <div class="space-y-5">
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-white font-space">Contact</h4>
                    <div class="space-y-4">
                        <!-- Dubai -->
                        <div class="flex items-start group">
                            <div class="w-8 h-8 rounded-lg bg-cyan-500/10 flex items-center justify-center mr-3 flex-shrink-0 mt-0.5">
                                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-cyan-400"></i>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-zinc-300">Dubai, UAE</p>
                                <p class="text-xs text-zinc-500 leading-relaxed"><?= htmlspecialchars(get_setting('office_uae', 'Level 24, Marina Plaza, Dubai Marina')) ?></p>
                            </div>
                        </div>
                        <!-- Houston -->
                        <div class="flex items-start group">
                            <div class="w-8 h-8 rounded-lg bg-blue-500/10 flex items-center justify-center mr-3 flex-shrink-0 mt-0.5">
                                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-blue-400"></i>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-zinc-300">Houston, USA</p>
                                <p class="text-xs text-zinc-500 leading-relaxed"><?= htmlspecialchars(get_setting('office_usa', 'Suite 800, Louisiana St, Houston, TX')) ?></p>
                            </div>
                        </div>
                        <!-- India -->
                        <div class="flex items-start group">
                            <div class="w-8 h-8 rounded-lg bg-violet-500/10 flex items-center justify-center mr-3 flex-shrink-0 mt-0.5">
                                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-violet-400"></i>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-zinc-300">Gurugram, India</p>
                                <p class="text-xs text-zinc-500 leading-relaxed"><?= htmlspecialchars(get_setting('office_india', 'Info City, Sector 34, Gurugram')) ?></p>
                            </div>
                        </div>

                        <!-- Email & Phone -->
                        <div class="pt-2 space-y-2">
                            <a href="mailto:<?= htmlspecialchars(get_setting('contact_email', 'hello@sisgain.com')) ?>" class="flex items-center text-xs text-zinc-400 hover:text-blue-400 transition-colors duration-200">
                                <i data-lucide="mail" class="w-3.5 h-3.5 mr-2 text-zinc-500"></i>
                                <?= htmlspecialchars(get_setting('contact_email', 'hello@sisgain.com')) ?>
                            </a>
                            <a href="tel:<?= htmlspecialchars(get_setting('contact_phone', '+971 4 123 4567')) ?>" class="flex items-center text-xs text-zinc-400 hover:text-blue-400 transition-colors duration-200">
                                <i data-lucide="phone" class="w-3.5 h-3.5 mr-2 text-zinc-500"></i>
                                <?= htmlspecialchars(get_setting('contact_phone', '+971 4 123 4567')) ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-white/10">
            <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 py-6 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-xs text-zinc-500">
                    &copy; <?= date('Y') ?> Sisgain Technologies. All rights reserved.
                </p>
                <div class="flex items-center space-x-6">
                    <a href="#" class="text-xs text-zinc-500 hover:text-white transition-colors duration-200">Privacy Policy</a>
                    <span class="text-zinc-700">|</span>
                    <a href="#" class="text-xs text-zinc-500 hover:text-white transition-colors duration-200">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- ═══════════════════════════════════════════════ -->
    <!-- TOAST NOTIFICATIONS                             -->
    <!-- ═══════════════════════════════════════════════ -->
    <?php $flash = get_flash_message(); if ($flash): ?>
        <div id="toast-notification" class="fixed bottom-6 right-6 z-[70] glass-card bg-darkCard/95 border-l-4 <?= $flash['type'] === 'success' ? 'border-l-emerald-500' : ($flash['type'] === 'info' ? 'border-l-blue-500' : 'border-l-rose-500') ?> px-6 py-4 rounded-xl shadow-2xl flex items-center space-x-4 max-w-md transform translate-y-24 opacity-0 transition-all duration-500">
            <div class="flex-shrink-0 w-9 h-9 rounded-full <?= $flash['type'] === 'success' ? 'bg-emerald-500/10' : ($flash['type'] === 'info' ? 'bg-blue-500/10' : 'bg-rose-500/10') ?> flex items-center justify-center">
                <i data-lucide="<?= $flash['type'] === 'success' ? 'check-circle-2' : ($flash['type'] === 'info' ? 'info' : 'alert-triangle') ?>" class="w-5 h-5 <?= $flash['type'] === 'success' ? 'text-emerald-400' : ($flash['type'] === 'info' ? 'text-blue-400' : 'text-rose-400') ?>"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-white"><?= $flash['type'] === 'success' ? 'Success' : ($flash['type'] === 'info' ? 'Info' : 'Error') ?></p>
                <p class="text-xs text-zinc-400 mt-0.5 truncate"><?= htmlspecialchars($flash['text']) ?></p>
            </div>
            <button onclick="document.getElementById('toast-notification').classList.add('translate-y-24','opacity-0');setTimeout(()=>document.getElementById('toast-notification').remove(),500)" class="flex-shrink-0 text-zinc-500 hover:text-white transition-colors">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const toast = document.getElementById("toast-notification");
                if (toast) {
                    setTimeout(function() {
                        toast.classList.remove("translate-y-24", "opacity-0");
                    }, 200);
                    setTimeout(function() {
                        toast.classList.add("translate-y-24", "opacity-0");
                        setTimeout(function() { toast.remove(); }, 500);
                    }, 6000);
                }
            });
        </script>
    <?php endif; ?>

    <!-- ═══════════════════════════════════════════════ -->
    <!-- GLOBAL SCRIPTS                                  -->
    <!-- ═══════════════════════════════════════════════ -->

    <!-- AOS Initialization -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize AOS
            AOS.init({
                duration: 800,
                once: true,
                easing: 'ease-out-cubic',
                offset: 60
            });

            // Initialize Lucide Icons
            lucide.createIcons();
        });
    </script>

    <!-- Custom Application JS -->
    <script src="/assets/js/main.js"></script>
</body>
</html>
