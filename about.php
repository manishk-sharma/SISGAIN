<?php
require_once __DIR__ . '/config/db.php';
$meta_title = "About Us | Sisgain Enterprise Digital Transformation";
$meta_description = "10+ years engineering enterprise technology transformations across 15 industries. Offices in Dubai, Houston, and India. 500+ engineers, 250+ projects delivered.";
$meta_keywords = "About Sisgain, Enterprise Consulting, Digital Transformation Company, Technology Advisory, Global Offices";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<!-- HERO -->
<section class="relative py-32 md:py-40 px-6 md:px-12 overflow-hidden">
    <div class="absolute top-20 left-0 w-[600px] h-[600px] bg-blue-600/8 rounded-full filter blur-[120px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto text-center relative z-10" data-aos="fade-up">
        <span class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full text-xs font-semibold bg-blue-500/10 border border-blue-500/20 text-blue-400 mb-6">
            <i data-lucide="building-2" class="w-3.5 h-3.5"></i><span>Our Story</span>
        </span>
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold font-space leading-[1.1] tracking-tight">
            Engineering the Future of<br><span class="bg-gradient-to-r from-blue-500 via-cyan-400 to-emerald-400 bg-clip-text text-transparent">Enterprise Technology</span>
        </h1>
        <p class="text-zinc-400 text-lg md:text-xl max-w-3xl mx-auto mt-6">
            Since 2016, Sisgain has been at the forefront of enterprise digital transformation, partnering with Fortune 500 companies to modernize infrastructure, automate operations, and deploy intelligent systems.
        </p>
    </div>
</section>

<!-- MISSION & VISION -->
<section class="py-24 md:py-32 px-6 md:px-12">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div class="space-y-6" data-aos="fade-right">
            <span class="text-xs uppercase font-semibold text-blue-400 tracking-wider">Our Mission</span>
            <h2 class="text-3xl md:text-4xl font-bold font-space">Empowering Enterprises Through Intelligent Technology</h2>
            <p class="text-zinc-400 leading-relaxed">We believe every enterprise deserves access to world-class technology advisory. Our mission is to bridge the gap between legacy operations and modern digital capabilities through rigorous engineering, strategic consulting, and measurable outcomes.</p>
            <p class="text-zinc-400 leading-relaxed">We don't just recommend technology—we build it, deploy it, and optimize it alongside our clients until the transformation delivers its promised ROI.</p>
        </div>
        <div class="glass-card p-8 md:p-10 rounded-3xl border border-blue-500/15 bg-blue-500/5 flex flex-col justify-center" data-aos="fade-left">
            <span class="text-xs uppercase font-semibold text-cyan-400 tracking-wider mb-4">Our Vision</span>
            <blockquote class="text-2xl md:text-3xl font-bold font-space text-white leading-snug">
                "To be the most trusted enterprise transformation partner for organizations navigating the complexity of digital modernization."
            </blockquote>
            <div class="mt-8 flex items-center space-x-4">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center text-white font-bold">SK</div>
                <div>
                    <p class="text-white text-sm font-semibold">Sanjay Kumar</p>
                    <p class="text-zinc-500 text-xs">Founder & CEO, Sisgain Technologies</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- STATS -->
<section class="py-20 px-6 md:px-12 bg-[#040610]">
    <div class="max-w-7xl mx-auto grid grid-cols-2 lg:grid-cols-4 gap-8">
        <?php $stats = [['10','+','Years of Experience','blue'],['250','+','Projects Delivered','cyan'],['500','+','Engineers Worldwide','purple'],['3','','Global Offices','emerald']];
        foreach ($stats as $si => $s): ?>
        <div class="text-center space-y-2" data-aos="zoom-in" data-aos-delay="<?= $si * 80 ?>">
            <p class="text-4xl md:text-5xl font-bold font-space text-<?= $s[3] ?>-400"><span class="counter-value" data-target="<?= $s[0] ?>"><?= $s[0] ?></span><?= $s[1] ?></p>
            <p class="text-zinc-400 text-sm"><?= $s[2] ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- LEADERSHIP -->
<section class="py-24 md:py-32 px-6 md:px-12">
    <div class="max-w-7xl mx-auto space-y-16">
        <div class="text-center max-w-3xl mx-auto space-y-4" data-aos="fade-up">
            <span class="text-xs uppercase font-semibold text-cyan-400 tracking-wider">Leadership</span>
            <h2 class="text-3xl md:text-5xl font-bold font-space">Meet Our Leadership</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php
            $leaders = [
                ['Sanjay Kumar','Founder & CEO','20+ years in enterprise technology. Former VP of Engineering at Oracle. Led digital transformations for 50+ Fortune 500 companies.','SK','blue'],
                ['Priya Sharma','Chief Technology Officer','Ex-Google Cloud architect. Specializes in multi-cloud infrastructure, Kubernetes, and AI/ML platform engineering across enterprise environments.','PS','cyan'],
                ['James Rodriguez','VP, Delivery','Former McKinsey consultant. Manages cross-functional delivery teams across 3 global offices with 98% on-time delivery record.','JR','purple'],
                ['Sarah Chen','Head of AI Practice','PhD in Computer Science from Stanford. Published researcher in NLP and computer vision. Led development of 200+ enterprise AI models.','SC','emerald']
            ];
            foreach ($leaders as $li => $l): ?>
            <div class="glass-card p-6 rounded-3xl text-center group" data-aos="fade-up" data-aos-delay="<?= $li * 80 ?>">
                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-<?= $l[4] ?>-500 to-<?= $l[4] ?>-700 flex items-center justify-center mx-auto mb-4 text-white text-xl font-bold font-space group-hover:scale-110 transition-transform"><?= $l[3] ?></div>
                <h3 class="text-white font-bold font-space"><?= $l[0] ?></h3>
                <p class="text-<?= $l[4] ?>-400 text-xs font-semibold mt-1"><?= $l[1] ?></p>
                <p class="text-zinc-400 text-xs mt-3 leading-relaxed"><?= $l[2] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- GLOBAL OFFICES -->
<section class="py-24 md:py-32 px-6 md:px-12 bg-[#040610]">
    <div class="max-w-7xl mx-auto space-y-16">
        <div class="text-center max-w-3xl mx-auto space-y-4" data-aos="fade-up">
            <span class="text-xs uppercase font-semibold text-blue-400 tracking-wider">Global Presence</span>
            <h2 class="text-3xl md:text-5xl font-bold font-space">Our Offices</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php
            $offices = [
                ['Dubai, UAE','Level 24, Marina Plaza, Dubai Marina, Dubai, UAE','The gateway to Middle East enterprise markets. Serving healthcare, banking, and oil & gas sectors across the GCC region.','blue','🇦🇪'],
                ['Houston, USA','Suite 800, Louisiana St, Houston, TX 77002, USA','North American headquarters. Focused on energy, manufacturing, and financial services across the United States.','cyan','🇺🇸'],
                ['Gurugram, India','Phase III, Info City, Sector 34, Gurugram, Haryana 122001','Global engineering center with 400+ developers. Delivers platform engineering, AI research, and 24/7 support operations.','purple','🇮🇳']
            ];
            foreach ($offices as $oi => $o): ?>
            <div class="glass-card p-8 rounded-3xl" data-aos="fade-up" data-aos-delay="<?= $oi * 100 ?>">
                <div class="text-4xl mb-4"><?= $o[4] ?></div>
                <h3 class="text-xl font-bold font-space text-white mb-2"><?= $o[0] ?></h3>
                <p class="text-zinc-400 text-xs mb-4"><?= $o[1] ?></p>
                <p class="text-zinc-500 text-xs leading-relaxed"><?= $o[2] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- VALUES -->
<section class="py-24 md:py-32 px-6 md:px-12">
    <div class="max-w-7xl mx-auto space-y-16">
        <div class="text-center max-w-3xl mx-auto space-y-4" data-aos="fade-up">
            <span class="text-xs uppercase font-semibold text-emerald-400 tracking-wider">Core Values</span>
            <h2 class="text-3xl md:text-5xl font-bold font-space">What Drives Us</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php
            $values = [
                ['lightbulb','Innovation','We push the boundaries of enterprise technology, constantly evaluating emerging platforms and methodologies to deliver cutting-edge solutions.','blue'],
                ['heart','Integrity','We maintain complete transparency in every engagement—from honest assessments to realistic timelines and open communication.','rose'],
                ['target','Excellence','We hold ourselves to the highest engineering standards. Every deployment undergoes rigorous testing, security auditing, and performance optimization.','purple'],
                ['handshake','Partnership','We integrate deeply with our clients\' teams, sharing knowledge and building internal capabilities that last beyond our engagement.','emerald']
            ];
            foreach ($values as $vi => $v): ?>
            <div class="glass-card p-8 rounded-3xl text-center group" data-aos="fade-up" data-aos-delay="<?= $vi * 80 ?>">
                <div class="w-14 h-14 rounded-2xl bg-<?= $v[3] ?>-500/10 text-<?= $v[3] ?>-400 flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform"><i data-lucide="<?= $v[0] ?>" class="w-7 h-7"></i></div>
                <h3 class="text-white font-bold font-space mb-3"><?= $v[1] ?></h3>
                <p class="text-zinc-400 text-sm leading-relaxed"><?= $v[2] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- TIMELINE -->
<section class="py-24 md:py-32 px-6 md:px-12 bg-[#040610]">
    <div class="max-w-4xl mx-auto space-y-16">
        <div class="text-center space-y-4" data-aos="fade-up">
            <span class="text-xs uppercase font-semibold text-cyan-400 tracking-wider">Our Journey</span>
            <h2 class="text-3xl md:text-5xl font-bold font-space">Company Milestones</h2>
        </div>
        <div class="space-y-8">
            <?php
            $milestones = [
                ['2016','Founded','Sisgain Technologies founded in Gurugram, India with a vision to democratize enterprise digital transformation.','blue'],
                ['2018','First Fortune 500 Client','Secured our first Fortune 500 engagement, delivering a cloud migration for a major healthcare conglomerate.','cyan'],
                ['2020','Cloud Practice Launch','Established dedicated cloud engineering practice, becoming certified partners with AWS, Azure, and GCP.','purple'],
                ['2022','AI Research Lab','Launched our AI/ML research lab focused on enterprise applications of LLMs, computer vision, and predictive analytics.','emerald'],
                ['2024','Global Expansion','Opened offices in Dubai and Houston, expanding our reach to Middle East and North American enterprise markets.','indigo'],
                ['2026','Digital Advisory','Launched comprehensive digital advisory practice, serving 250+ enterprise clients across 15 industries worldwide.','rose']
            ];
            foreach ($milestones as $mi => $m): ?>
            <div class="flex items-start space-x-6" data-aos="fade-up" data-aos-delay="<?= $mi * 80 ?>">
                <div class="flex-shrink-0 w-24 text-right">
                    <span class="text-<?= $m[3] ?>-400 font-bold font-space text-lg"><?= $m[0] ?></span>
                </div>
                <div class="flex-shrink-0 w-4 h-4 rounded-full bg-<?= $m[3] ?>-500 border-4 border-<?= $m[3] ?>-500/20 mt-1.5"></div>
                <div class="flex-1 pb-8 border-l border-white/10 pl-6 -ml-2">
                    <h4 class="text-white font-bold font-space"><?= $m[1] ?></h4>
                    <p class="text-zinc-400 text-sm mt-1 leading-relaxed"><?= $m[2] ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/cta.php'; require_once __DIR__ . '/includes/footer.php'; ?>
