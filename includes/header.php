<?php
// includes/header.php
// Premium Enterprise HTML Head & Opening Body — Appinventiv-Level Quality
// =========================================================================

require_once __DIR__ . '/../config/db.php';

// Dynamic page meta — controllers can set $meta_title, $meta_description, $meta_keywords before including this file
$site_title       = get_setting('site_title', 'SISGAIN | Enterprise Digital Transformation');
$site_description = get_setting('site_description', 'Accelerate enterprise growth with AI integrations, hybrid cloud modernization, and zero-trust security strategies.');

$page_title    = isset($meta_title)       ? $meta_title       : $site_title;
$page_desc     = isset($meta_description) ? $meta_description : $site_description;
$page_keywords = isset($meta_keywords)    ? $meta_keywords    : 'digital transformation, enterprise AI, cloud migration, RPA, DevOps, data engineering, cybersecurity';
$canonical_url = 'https://' . $_SERVER['HTTP_HOST'] . strtok($_SERVER['REQUEST_URI'], '?');
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= htmlspecialchars($page_title) ?></title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="<?= htmlspecialchars($page_desc) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($page_keywords) ?>">
    <meta name="author" content="Sisgain Technologies">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?= htmlspecialchars($canonical_url) ?>">

    <!-- Open Graph / Social -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= htmlspecialchars($page_title) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($page_desc) ?>">
    <meta property="og:url" content="<?= htmlspecialchars($canonical_url) ?>">
    <meta property="og:image" content="https://<?= $_SERVER['HTTP_HOST'] ?>/assets/images/og-preview.jpg">
    <meta property="og:site_name" content="SISGAIN">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($page_title) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($page_desc) ?>">

    <!-- JSON-LD Organization Schema -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "SISGAIN",
      "url": "https://<?= $_SERVER['HTTP_HOST'] ?>",
      "logo": "https://<?= $_SERVER['HTTP_HOST'] ?>/assets/images/logo.png",
      "sameAs": [
        "https://www.linkedin.com/company/sisgain",
        "https://twitter.com/sisgain"
      ],
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "<?= htmlspecialchars(get_setting('contact_phone', '+971 4 123 4567')) ?>",
        "contactType": "consulting support",
        "areaServed": ["AE", "US", "IN"],
        "availableLanguage": ["en", "ar"]
      }
    }
    </script>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/assets/images/favicon.png">
    <link rel="apple-touch-icon" href="/assets/images/favicon.png">

    <!-- Google Fonts — Preconnect + Load -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN with Custom Config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        darkBg:     '#060816',
                        darkCard:   '#0D1324',
                        accentBlue: '#3B82F6',
                        neonCyan:   '#06B6D4',
                        darkText:   '#0f0f0f',
                        borderGlass: 'rgba(255, 255, 255, 0.08)'
                    },
                    fontFamily: {
                        sans:  ['Inter', 'system-ui', 'sans-serif'],
                        space: ['"Space Grotesk"', 'sans-serif']
                    },
                    borderRadius: {
                        '3xl': '24px',
                        '4xl': '32px'
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'glow-pulse': 'glow-pulse 3s ease-in-out infinite',
                        'slide-up': 'slide-up 0.6s ease-out',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' }
                        },
                        'glow-pulse': {
                            '0%, 100%': { opacity: 0.4 },
                            '50%': { opacity: 0.8 }
                        },
                        'slide-up': {
                            '0%': { transform: 'translateY(30px)', opacity: 0 },
                            '100%': { transform: 'translateY(0)', opacity: 1 }
                        }
                    }
                }
            }
        }
    </script>

    <!-- AOS — Animate On Scroll -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- GSAP Animation Engine + ScrollTrigger -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="/assets/css/style.css">

    <!-- Inline Critical Styles -->
    <style>
        /* Scroll Progress Bar */
        #scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: linear-gradient(90deg, #3B82F6, #06B6D4);
            z-index: 9999;
            transition: width 0.1s linear;
            pointer-events: none;
        }

        /* Glass Morphism Nav */
        .glass-nav {
            background: rgba(6, 8, 22, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }
        .glass-nav.scrolled {
            background: rgba(6, 8, 22, 0.92);
        }
        .glass-nav.nav-hidden {
            transform: translateY(-100%);
        }

        /* Glass Card */
        .glass-card {
            background: rgba(13, 19, 36, 0.6);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        /* Background Glow Orbs */
        .glow-blur-1 {
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.12) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(60px);
            pointer-events: none;
        }
        .glow-blur-2 {
            position: absolute;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(6, 182, 212, 0.10) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(60px);
            pointer-events: none;
        }

        /* Nav Link Underline Animation */
        .nav-link-anim {
            position: relative;
        }
        .nav-link-anim::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #3B82F6, #06B6D4);
            transition: width 0.3s ease;
            border-radius: 2px;
        }
        .nav-link-anim:hover::after {
            width: 100%;
        }
        .nav-link-anim.active::after {
            width: 100%;
        }

        /* Smooth page transitions */
        body {
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        /* Selection color */
        ::selection {
            background: #3B82F6;
            color: #fff;
        }
    </style>
</head>
<body class="bg-darkBg text-white antialiased font-sans">
    <!-- Scroll Progress Indicator -->
    <div id="scroll-progress"></div>

    <!-- Background Glow Orbs -->
    <div class="glow-blur-1 top-10 left-5"></div>
    <div class="glow-blur-2 top-80 right-10"></div>

    <!-- Scroll Progress Script -->
    <script>
        window.addEventListener('scroll', function() {
            const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
            const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrollPercent = (scrollTop / scrollHeight) * 100;
            document.getElementById('scroll-progress').style.width = scrollPercent + '%';
        });
    </script>
