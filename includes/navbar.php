<?php
// includes/navbar.php
// Premium Sticky Navigation — Appinventiv-Level Glass Morphism Design
// ====================================================================

$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav id="main-nav" class="fixed top-0 left-0 w-full z-50 glass-nav transition-all duration-500">
    <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-[72px]">

            <!-- Logo -->
            <a href="/index.php" class="flex items-center space-x-2 group flex-shrink-0">
                <span class="text-2xl font-bold font-space bg-gradient-to-r from-blue-500 to-cyan-400 bg-clip-text text-transparent group-hover:from-blue-400 group-hover:to-cyan-300 transition-all duration-300">
                    SISGAIN
                </span>
            </a>

            <!-- Desktop Navigation — CENTER -->
            <div class="hidden lg:flex items-center space-x-1">
                <!-- Home -->
                <a href="/index.php" class="nav-link-anim text-sm font-medium px-3 py-2 rounded-lg <?= is_active_page('index.php') ?> <?= ($current_page === 'index.php') ? 'active' : '' ?>">
                    Home
                </a>

                <!-- Services Dropdown -->
                <div class="relative group">
                    <a href="/services.php" class="nav-link-anim flex items-center space-x-1 text-sm font-medium px-3 py-2 rounded-lg <?= ($current_page === 'services.php' || in_array($current_page, ['ai-integration.php','cloud-transformation.php','workflow-automation.php','erp-crm-modernization.php','data-engineering.php','cybersecurity.php'])) ? 'text-blue-400 font-semibold active' : 'text-zinc-300 hover:text-white transition-colors duration-200' ?>">
                        <span>Services</span>
                        <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform duration-300 group-hover:rotate-180"></i>
                    </a>

                    <!-- Services Mega Dropdown -->
                    <div class="absolute left-1/2 -translate-x-1/2 mt-2 w-[380px] bg-darkCard/98 border border-white/10 rounded-2xl p-5 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-3 group-hover:translate-y-0 z-50 shadow-2xl shadow-black/40">
                        <!-- Arrow -->
                        <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-darkCard/98 border-l border-t border-white/10 rotate-45"></div>

                        <div class="relative space-y-1">
                            <a href="/services.php" class="flex items-center p-3 rounded-xl hover:bg-white/5 transition-colors group/item">
                                <div class="w-9 h-9 rounded-lg bg-blue-500/10 flex items-center justify-center mr-3 flex-shrink-0">
                                    <i data-lucide="layout-grid" class="w-4 h-4 text-blue-400"></i>
                                </div>
                                <div>
                                    <span class="block text-sm font-semibold text-white group-hover/item:text-blue-400 transition-colors">All Services</span>
                                    <span class="block text-xs text-zinc-500">Full-spectrum enterprise consulting</span>
                                </div>
                            </a>
                            <div class="border-t border-white/5 my-2"></div>
                            <a href="/ai-integration.php" class="flex items-center p-3 rounded-xl hover:bg-white/5 transition-colors group/item">
                                <div class="w-9 h-9 rounded-lg bg-violet-500/10 flex items-center justify-center mr-3 flex-shrink-0">
                                    <i data-lucide="brain-circuit" class="w-4 h-4 text-violet-400"></i>
                                </div>
                                <div>
                                    <span class="block text-sm font-medium text-white group-hover/item:text-violet-400 transition-colors">AI Integration</span>
                                    <span class="block text-xs text-zinc-500">LLMs, MLOps & cognitive pipelines</span>
                                </div>
                            </a>
                            <a href="/cloud-transformation.php" class="flex items-center p-3 rounded-xl hover:bg-white/5 transition-colors group/item">
                                <div class="w-9 h-9 rounded-lg bg-cyan-500/10 flex items-center justify-center mr-3 flex-shrink-0">
                                    <i data-lucide="cloud-lightning" class="w-4 h-4 text-cyan-400"></i>
                                </div>
                                <div>
                                    <span class="block text-sm font-medium text-white group-hover/item:text-cyan-400 transition-colors">Cloud Transformation</span>
                                    <span class="block text-xs text-zinc-500">Multicloud, Kubernetes & DevOps</span>
                                </div>
                            </a>
                            <a href="/workflow-automation.php" class="flex items-center p-3 rounded-xl hover:bg-white/5 transition-colors group/item">
                                <div class="w-9 h-9 rounded-lg bg-purple-500/10 flex items-center justify-center mr-3 flex-shrink-0">
                                    <i data-lucide="cpu" class="w-4 h-4 text-purple-400"></i>
                                </div>
                                <div>
                                    <span class="block text-sm font-medium text-white group-hover/item:text-purple-400 transition-colors">Workflow Automation</span>
                                    <span class="block text-xs text-zinc-500">Hyperautomation & RPA pipelines</span>
                                </div>
                            </a>
                            <a href="/erp-crm-modernization.php" class="flex items-center p-3 rounded-xl hover:bg-white/5 transition-colors group/item">
                                <div class="w-9 h-9 rounded-lg bg-emerald-500/10 flex items-center justify-center mr-3 flex-shrink-0">
                                    <i data-lucide="database" class="w-4 h-4 text-emerald-400"></i>
                                </div>
                                <div>
                                    <span class="block text-sm font-medium text-white group-hover/item:text-emerald-400 transition-colors">ERP & CRM Modernization</span>
                                    <span class="block text-xs text-zinc-500">Legacy system transformation</span>
                                </div>
                            </a>
                            <a href="/data-engineering.php" class="flex items-center p-3 rounded-xl hover:bg-white/5 transition-colors group/item">
                                <div class="w-9 h-9 rounded-lg bg-amber-500/10 flex items-center justify-center mr-3 flex-shrink-0">
                                    <i data-lucide="bar-chart-3" class="w-4 h-4 text-amber-400"></i>
                                </div>
                                <div>
                                    <span class="block text-sm font-medium text-white group-hover/item:text-amber-400 transition-colors">Data Engineering</span>
                                    <span class="block text-xs text-zinc-500">Pipelines, BI & analytics</span>
                                </div>
                            </a>
                            <a href="/cybersecurity.php" class="flex items-center p-3 rounded-xl hover:bg-white/5 transition-colors group/item">
                                <div class="w-9 h-9 rounded-lg bg-rose-500/10 flex items-center justify-center mr-3 flex-shrink-0">
                                    <i data-lucide="shield-check" class="w-4 h-4 text-rose-400"></i>
                                </div>
                                <div>
                                    <span class="block text-sm font-medium text-white group-hover/item:text-rose-400 transition-colors">Cybersecurity</span>
                                    <span class="block text-xs text-zinc-500">Zero-trust architecture & compliance</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Industries -->
                <a href="/industries.php" class="nav-link-anim text-sm font-medium px-3 py-2 rounded-lg <?= is_active_page('industries.php') ?> <?= ($current_page === 'industries.php') ? 'active' : '' ?>">
                    Industries
                </a>

                <!-- Case Studies -->
                <a href="/case-studies.php" class="nav-link-anim text-sm font-medium px-3 py-2 rounded-lg <?= is_active_page('case-studies.php') ?> <?= ($current_page === 'case-studies.php') ? 'active' : '' ?>">
                    Case Studies
                </a>

                <!-- Insights -->
                <a href="/blog.php" class="nav-link-anim text-sm font-medium px-3 py-2 rounded-lg <?= is_active_page('blog.php') ?> <?= ($current_page === 'blog.php') ? 'active' : '' ?>">
                    Insights
                </a>

                <!-- About -->
                <a href="/about.php" class="nav-link-anim text-sm font-medium px-3 py-2 rounded-lg <?= is_active_page('about.php') ?> <?= ($current_page === 'about.php') ? 'active' : '' ?>">
                    About
                </a>

                <!-- ROI Calculator -->
                <a href="/roi-calculator.php" class="nav-link-anim text-sm font-medium px-3 py-2 rounded-lg flex items-center <?= is_active_page('roi-calculator.php') ?> <?= ($current_page === 'roi-calculator.php') ? 'active' : '' ?>">
                    <i data-lucide="calculator" class="w-3.5 h-3.5 mr-1.5 text-neonCyan"></i>
                    ROI Calculator
                </a>
            </div>

            <!-- Desktop CTA + Admin — RIGHT -->
            <div class="hidden lg:flex items-center space-x-3">
                <?php if (is_admin_logged_in()): ?>
                    <a href="/admin/index.php" class="text-xs text-zinc-400 bg-white/5 hover:bg-white/10 px-3 py-1.5 rounded-lg border border-white/10 transition-colors duration-200">
                        Admin Panel
                    </a>
                <?php endif; ?>

                <a href="/contact.php" class="group relative inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white text-sm font-semibold px-6 py-2.5 rounded-full transition-all duration-300 shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 hover:-translate-y-0.5">
                    Contact Us
                    <i data-lucide="arrow-right" class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-1"></i>
                </a>
            </div>

            <!-- Mobile Hamburger -->
            <button id="mobile-menu-btn" class="lg:hidden relative w-10 h-10 flex items-center justify-center rounded-xl border border-white/10 bg-white/5 hover:bg-white/10 transition-colors" aria-label="Toggle menu">
                <div class="flex flex-col items-center justify-center space-y-1.5" id="hamburger-lines">
                    <span class="block w-5 h-[2px] bg-white rounded-full transition-all duration-300" id="line-1"></span>
                    <span class="block w-5 h-[2px] bg-white rounded-full transition-all duration-300" id="line-2"></span>
                    <span class="block w-3.5 h-[2px] bg-white rounded-full transition-all duration-300 ml-auto" id="line-3"></span>
                </div>
            </button>
        </div>
    </div>
</nav>

<!-- Mobile Navigation Drawer (Full-screen overlay) -->
<div id="mobile-menu" class="fixed inset-0 z-[60] pointer-events-none opacity-0 transition-opacity duration-300 lg:hidden">
    <!-- Backdrop -->
    <div id="mobile-backdrop" class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeMobileMenu()"></div>

    <!-- Slide-in Panel -->
    <div id="mobile-panel" class="absolute right-0 top-0 bottom-0 w-[85%] max-w-sm bg-darkBg border-l border-white/10 transform translate-x-full transition-transform duration-500 ease-out overflow-y-auto">
        <!-- Panel Header -->
        <div class="flex items-center justify-between px-6 py-5 border-b border-white/5">
            <span class="text-xl font-bold font-space bg-gradient-to-r from-blue-500 to-cyan-400 bg-clip-text text-transparent">SISGAIN</span>
            <button onclick="closeMobileMenu()" class="w-10 h-10 flex items-center justify-center rounded-xl border border-white/10 bg-white/5 hover:bg-white/10 transition-colors" aria-label="Close menu">
                <i data-lucide="x" class="w-5 h-5 text-white"></i>
            </button>
        </div>

        <!-- Panel Links -->
        <div class="px-6 py-6 space-y-1">
            <a href="/index.php" class="mobile-nav-link flex items-center py-3.5 px-4 rounded-xl text-base font-medium <?= ($current_page === 'index.php') ? 'text-blue-400 bg-blue-500/10' : 'text-zinc-300 hover:text-white hover:bg-white/5' ?> transition-all duration-200" style="opacity:0;transform:translateX(30px)">
                <i data-lucide="home" class="w-4.5 h-4.5 mr-3 flex-shrink-0"></i>
                Home
            </a>
            <a href="/services.php" class="mobile-nav-link flex items-center py-3.5 px-4 rounded-xl text-base font-medium <?= ($current_page === 'services.php') ? 'text-blue-400 bg-blue-500/10' : 'text-zinc-300 hover:text-white hover:bg-white/5' ?> transition-all duration-200" style="opacity:0;transform:translateX(30px)">
                <i data-lucide="layers" class="w-4.5 h-4.5 mr-3 flex-shrink-0"></i>
                Services
            </a>

            <!-- Service Sub-links -->
            <div class="pl-6 space-y-0.5">
                <a href="/ai-integration.php" class="mobile-nav-link flex items-center py-2.5 px-4 rounded-lg text-sm text-zinc-400 hover:text-white hover:bg-white/5 transition-all duration-200" style="opacity:0;transform:translateX(30px)">
                    <i data-lucide="brain-circuit" class="w-3.5 h-3.5 mr-2.5 text-violet-400"></i>
                    AI Integration
                </a>
                <a href="/cloud-transformation.php" class="mobile-nav-link flex items-center py-2.5 px-4 rounded-lg text-sm text-zinc-400 hover:text-white hover:bg-white/5 transition-all duration-200" style="opacity:0;transform:translateX(30px)">
                    <i data-lucide="cloud-lightning" class="w-3.5 h-3.5 mr-2.5 text-cyan-400"></i>
                    Cloud Transformation
                </a>
                <a href="/workflow-automation.php" class="mobile-nav-link flex items-center py-2.5 px-4 rounded-lg text-sm text-zinc-400 hover:text-white hover:bg-white/5 transition-all duration-200" style="opacity:0;transform:translateX(30px)">
                    <i data-lucide="cpu" class="w-3.5 h-3.5 mr-2.5 text-purple-400"></i>
                    Hyperautomation
                </a>
                <a href="/data-engineering.php" class="mobile-nav-link flex items-center py-2.5 px-4 rounded-lg text-sm text-zinc-400 hover:text-white hover:bg-white/5 transition-all duration-200" style="opacity:0;transform:translateX(30px)">
                    <i data-lucide="bar-chart-3" class="w-3.5 h-3.5 mr-2.5 text-amber-400"></i>
                    Data Engineering
                </a>
                <a href="/cybersecurity.php" class="mobile-nav-link flex items-center py-2.5 px-4 rounded-lg text-sm text-zinc-400 hover:text-white hover:bg-white/5 transition-all duration-200" style="opacity:0;transform:translateX(30px)">
                    <i data-lucide="shield-check" class="w-3.5 h-3.5 mr-2.5 text-rose-400"></i>
                    Cybersecurity
                </a>
            </div>

            <a href="/industries.php" class="mobile-nav-link flex items-center py-3.5 px-4 rounded-xl text-base font-medium <?= ($current_page === 'industries.php') ? 'text-blue-400 bg-blue-500/10' : 'text-zinc-300 hover:text-white hover:bg-white/5' ?> transition-all duration-200" style="opacity:0;transform:translateX(30px)">
                <i data-lucide="factory" class="w-4.5 h-4.5 mr-3 flex-shrink-0"></i>
                Industries
            </a>
            <a href="/case-studies.php" class="mobile-nav-link flex items-center py-3.5 px-4 rounded-xl text-base font-medium <?= ($current_page === 'case-studies.php') ? 'text-blue-400 bg-blue-500/10' : 'text-zinc-300 hover:text-white hover:bg-white/5' ?> transition-all duration-200" style="opacity:0;transform:translateX(30px)">
                <i data-lucide="briefcase" class="w-4.5 h-4.5 mr-3 flex-shrink-0"></i>
                Case Studies
            </a>
            <a href="/blog.php" class="mobile-nav-link flex items-center py-3.5 px-4 rounded-xl text-base font-medium <?= ($current_page === 'blog.php') ? 'text-blue-400 bg-blue-500/10' : 'text-zinc-300 hover:text-white hover:bg-white/5' ?> transition-all duration-200" style="opacity:0;transform:translateX(30px)">
                <i data-lucide="newspaper" class="w-4.5 h-4.5 mr-3 flex-shrink-0"></i>
                Insights
            </a>
            <a href="/about.php" class="mobile-nav-link flex items-center py-3.5 px-4 rounded-xl text-base font-medium <?= ($current_page === 'about.php') ? 'text-blue-400 bg-blue-500/10' : 'text-zinc-300 hover:text-white hover:bg-white/5' ?> transition-all duration-200" style="opacity:0;transform:translateX(30px)">
                <i data-lucide="building-2" class="w-4.5 h-4.5 mr-3 flex-shrink-0"></i>
                About
            </a>
            <a href="/roi-calculator.php" class="mobile-nav-link flex items-center py-3.5 px-4 rounded-xl text-base font-medium <?= ($current_page === 'roi-calculator.php') ? 'text-cyan-400 bg-cyan-500/10' : 'text-neonCyan hover:text-cyan-300 hover:bg-cyan-500/5' ?> transition-all duration-200" style="opacity:0;transform:translateX(30px)">
                <i data-lucide="calculator" class="w-4.5 h-4.5 mr-3 flex-shrink-0"></i>
                ROI Calculator
            </a>
        </div>

        <!-- Panel CTA -->
        <div class="px-6 pb-8 space-y-3 border-t border-white/5 pt-6">
            <?php if (is_admin_logged_in()): ?>
                <a href="/admin/index.php" class="block text-center text-sm text-zinc-400 bg-white/5 py-3 rounded-xl border border-white/10 hover:bg-white/10 transition-colors">
                    Admin Dashboard
                </a>
            <?php endif; ?>
            <a href="/contact.php" class="mobile-nav-link flex items-center justify-center text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-cyan-500 py-3.5 rounded-xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 transition-all duration-300" style="opacity:0;transform:translateX(30px)">
                Contact Us
                <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
            </a>
        </div>
    </div>
</div>

<!-- Navbar Behavior Scripts -->
<script>
(function() {
    const nav = document.getElementById('main-nav');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobilePanel = document.getElementById('mobile-panel');
    const mobileBtn = document.getElementById('mobile-menu-btn');
    let lastScrollY = 0;
    let isMenuOpen = false;

    // Hide on scroll down, show on scroll up
    window.addEventListener('scroll', function() {
        const currentScrollY = window.scrollY;

        // Add scrolled class after 100px
        if (currentScrollY > 100) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }

        // Hide/show on scroll direction (only when mobile menu is closed)
        if (!isMenuOpen) {
            if (currentScrollY > lastScrollY && currentScrollY > 150) {
                nav.classList.add('nav-hidden');
            } else {
                nav.classList.remove('nav-hidden');
            }
        }

        lastScrollY = currentScrollY;
    }, { passive: true });

    // Mobile Menu Toggle
    mobileBtn.addEventListener('click', function() {
        if (isMenuOpen) {
            closeMobileMenu();
        } else {
            openMobileMenu();
        }
    });

    window.openMobileMenu = function() {
        isMenuOpen = true;
        mobileMenu.classList.remove('pointer-events-none', 'opacity-0');
        mobileMenu.classList.add('pointer-events-auto', 'opacity-100');
        mobilePanel.classList.remove('translate-x-full');
        document.body.style.overflow = 'hidden';

        // Animate hamburger to X
        document.getElementById('line-1').style.transform = 'rotate(45deg) translateY(5px)';
        document.getElementById('line-2').style.opacity = '0';
        document.getElementById('line-3').style.transform = 'rotate(-45deg) translateY(-5px)';
        document.getElementById('line-3').style.width = '20px';

        // Stagger-animate links
        const links = document.querySelectorAll('.mobile-nav-link');
        links.forEach(function(link, i) {
            setTimeout(function() {
                link.style.opacity = '1';
                link.style.transform = 'translateX(0)';
                link.style.transition = 'all 0.4s cubic-bezier(0.16, 1, 0.3, 1)';
            }, 80 + (i * 50));
        });
    };

    window.closeMobileMenu = function() {
        isMenuOpen = false;
        mobilePanel.classList.add('translate-x-full');
        mobileMenu.classList.add('opacity-0');
        document.body.style.overflow = '';

        // Reset hamburger
        document.getElementById('line-1').style.transform = '';
        document.getElementById('line-2').style.opacity = '1';
        document.getElementById('line-3').style.transform = '';
        document.getElementById('line-3').style.width = '';

        setTimeout(function() {
            mobileMenu.classList.add('pointer-events-none');
            mobileMenu.classList.remove('pointer-events-auto');

            // Reset link animations
            const links = document.querySelectorAll('.mobile-nav-link');
            links.forEach(function(link) {
                link.style.opacity = '0';
                link.style.transform = 'translateX(30px)';
                link.style.transition = 'none';
            });
        }, 500);
    };
})();
</script>
