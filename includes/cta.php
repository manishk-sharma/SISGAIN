<?php
// includes/cta.php
// Premium Enterprise Call-to-Action Section — Appinventiv-Level Quality
// =====================================================================
?>
<section class="relative py-24 md:py-32 overflow-hidden">

    <!-- Gradient Background Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-blue-950/80 via-darkBg to-purple-950/60 z-0"></div>

    <!-- Decorative Glow Orbs -->
    <div class="absolute top-1/4 left-1/4 w-[500px] h-[500px] rounded-full bg-blue-500/10 filter blur-[100px] pointer-events-none animate-glow-pulse"></div>
    <div class="absolute bottom-1/4 right-1/4 w-[400px] h-[400px] rounded-full bg-purple-500/8 filter blur-[100px] pointer-events-none animate-glow-pulse" style="animation-delay: 1.5s;"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[300px] h-[300px] rounded-full bg-cyan-500/5 filter blur-[80px] pointer-events-none"></div>

    <!-- Subtle Grid Pattern -->
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: linear-gradient(rgba(255,255,255,.1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.1) 1px, transparent 1px); background-size: 60px 60px;"></div>

    <div class="relative z-10 max-w-4xl mx-auto px-5 sm:px-6 lg:px-8 text-center" data-aos="fade-up">

        <!-- Status Badge -->
        <div class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full bg-blue-500/10 border border-blue-500/20 mb-8" data-aos="fade-up" data-aos-delay="100">
            <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
            <span class="text-xs font-semibold text-blue-400 tracking-wide">Immediate Engagement Available</span>
        </div>

        <!-- Heading -->
        <h2 class="text-3xl md:text-5xl lg:text-6xl font-extrabold font-space leading-[1.15] text-white mb-6" data-aos="fade-up" data-aos-delay="200">
            Ready to Transform<br class="hidden sm:block"> Your Enterprise?
        </h2>

        <!-- Subtitle -->
        <p class="text-base md:text-lg text-zinc-400 leading-relaxed max-w-2xl mx-auto mb-10" data-aos="fade-up" data-aos-delay="300">
            Connect with our senior consultants to map out legacy modernization strategies, estimate infrastructure ROI, and architect AI-powered solutions tailored for your enterprise growth trajectory.
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4" data-aos="fade-up" data-aos-delay="400">
            <!-- Primary CTA -->
            <a href="/contact.php" class="group relative inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-semibold px-8 py-4 rounded-full text-sm transition-all duration-300 shadow-xl shadow-blue-500/25 hover:shadow-blue-500/50 hover:-translate-y-1 w-full sm:w-auto">
                <svg class="w-5 h-5 mr-2.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                Schedule Strategy Call
                <i data-lucide="arrow-right" class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-1"></i>
            </a>

            <!-- Secondary CTA -->
            <a href="/case-studies.php" class="group inline-flex items-center justify-center bg-transparent border border-white/20 hover:border-white/40 hover:bg-white/5 text-white font-semibold px-8 py-4 rounded-full text-sm transition-all duration-300 hover:-translate-y-1 w-full sm:w-auto">
                Explore Case Studies
                <i data-lucide="arrow-up-right" class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-0.5 group-hover:-translate-y-0.5"></i>
            </a>
        </div>

        <!-- Trust Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mt-16 pt-10 border-t border-white/10" data-aos="fade-up" data-aos-delay="500">
            <div class="text-center">
                <p class="text-2xl md:text-3xl font-bold font-space text-white cta-counter" data-target="98">98%</p>
                <p class="text-xs text-zinc-500 mt-1.5">Client Retention</p>
            </div>
            <div class="text-center">
                <p class="text-2xl md:text-3xl font-bold font-space text-white cta-counter" data-target="250">250+</p>
                <p class="text-xs text-zinc-500 mt-1.5">Projects Delivered</p>
            </div>
            <div class="text-center">
                <p class="text-2xl md:text-3xl font-bold font-space text-white">Sub-2h</p>
                <p class="text-xs text-zinc-500 mt-1.5">Response Time</p>
            </div>
            <div class="text-center">
                <p class="text-2xl md:text-3xl font-bold font-space text-white">3x</p>
                <p class="text-xs text-zinc-500 mt-1.5">Average ROI</p>
            </div>
        </div>
    </div>
</section>
