/**
 * ============================================================================
 * SISGAIN Enterprise — Main JavaScript Controller
 * Premium Appinventiv-grade interactions & micro-animations
 * Version 2.0 | Production Build
 * ============================================================================
 */

document.addEventListener("DOMContentLoaded", () => {

    // =========================================================================
    // 1. GLOBAL CONFIG & UTILITIES
    // =========================================================================

    const SISGAIN = {
        scrollThreshold: 100,
        navHideDelay: 0,
        counterDuration: 2200,
        typingSpeed: 80,
        typingDeleteSpeed: 40,
        typingPause: 2000,
        toastDuration: 4000,
        revealThreshold: 0.15,
        parallaxDamping: 0.08,
    };

    /** Easing: cubic ease-out for buttery smooth transitions */
    const easeOutCubic = (t) => 1 - Math.pow(1 - t, 3);

    /** Easing: exponential ease-out for dramatic reveals */
    const easeOutExpo = (t) => (t === 1 ? 1 : 1 - Math.pow(2, -10 * t));

    /** Throttle helper for scroll-heavy handlers */
    const throttle = (fn, wait) => {
        let lastTime = 0;
        return (...args) => {
            const now = Date.now();
            if (now - lastTime >= wait) {
                lastTime = now;
                fn(...args);
            }
        };
    };

    /** Debounce helper for resize handlers */
    const debounce = (fn, delay) => {
        let timer;
        return (...args) => {
            clearTimeout(timer);
            timer = setTimeout(() => fn(...args), delay);
        };
    };


    // =========================================================================
    // 2. STICKY NAVBAR — Hide on Scroll Down, Show on Scroll Up
    // =========================================================================

    const navbar = document.querySelector("nav.sticky");
    if (navbar) {
        let lastScrollY = window.scrollY;
        let ticking = false;
        let navHidden = false;

        // Inject transition styles once
        navbar.style.transition = "transform 0.35s cubic-bezier(0.4, 0, 0.2, 1), background-color 0.3s ease, backdrop-filter 0.3s ease, box-shadow 0.3s ease";

        const updateNavbar = () => {
            const currentScrollY = window.scrollY;
            const scrollDelta = currentScrollY - lastScrollY;

            // Scrolled state — apply frosted glass effect
            if (currentScrollY > SISGAIN.scrollThreshold) {
                navbar.classList.add("scrolled");
                navbar.style.backgroundColor = "rgba(6, 8, 22, 0.85)";
                navbar.style.backdropFilter = "blur(20px) saturate(180%)";
                navbar.style.webkitBackdropFilter = "blur(20px) saturate(180%)";
                navbar.style.boxShadow = "0 1px 0 rgba(255,255,255,0.05), 0 8px 32px rgba(0,0,0,0.4)";
            } else {
                navbar.classList.remove("scrolled");
                navbar.style.backgroundColor = "";
                navbar.style.backdropFilter = "";
                navbar.style.webkitBackdropFilter = "";
                navbar.style.boxShadow = "";
            }

            // Hide/show logic — only trigger after passing threshold
            if (currentScrollY > SISGAIN.scrollThreshold) {
                if (scrollDelta > 8 && !navHidden) {
                    // Scrolling DOWN — hide navbar
                    navbar.style.transform = "translateY(-100%)";
                    navHidden = true;
                } else if (scrollDelta < -5 && navHidden) {
                    // Scrolling UP — show navbar
                    navbar.style.transform = "translateY(0)";
                    navHidden = false;
                }
            } else {
                // At top — always visible
                navbar.style.transform = "translateY(0)";
                navHidden = false;
            }

            lastScrollY = currentScrollY;
            ticking = false;
        };

        window.addEventListener("scroll", () => {
            if (!ticking) {
                requestAnimationFrame(updateNavbar);
                ticking = true;
            }
        }, { passive: true });
    }


    // =========================================================================
    // 3. MOBILE MENU — Slide Animation, Outside Click, Link Close
    // =========================================================================

    const mobileMenuBtn = document.getElementById("mobile-menu-btn");
    const mobileMenu = document.getElementById("mobile-menu");

    if (mobileMenuBtn && mobileMenu) {
        // Set up smooth slide animation
        mobileMenu.style.transition = "max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease, transform 0.3s ease";
        mobileMenu.style.overflow = "hidden";

        let menuOpen = false;

        const openMenu = () => {
            mobileMenu.classList.remove("hidden");
            // Force reflow for transition
            mobileMenu.offsetHeight;
            mobileMenu.style.maxHeight = mobileMenu.scrollHeight + "px";
            mobileMenu.style.opacity = "1";
            mobileMenu.style.transform = "translateY(0)";
            menuOpen = true;
            updateHamburgerIcon(true);
        };

        const closeMenu = () => {
            mobileMenu.style.maxHeight = "0px";
            mobileMenu.style.opacity = "0";
            mobileMenu.style.transform = "translateY(-8px)";
            menuOpen = false;
            updateHamburgerIcon(false);
            setTimeout(() => {
                if (!menuOpen) mobileMenu.classList.add("hidden");
            }, 400);
        };

        const updateHamburgerIcon = (isOpen) => {
            const path = mobileMenuBtn.querySelector("path");
            if (path) {
                path.setAttribute("d", isOpen
                    ? "M6 18L18 6M6 6l12 12"
                    : "M4 6h16M4 12h16M4 18h16"
                );
            }
        };

        // Initial state
        mobileMenu.style.maxHeight = "0px";
        mobileMenu.style.opacity = "0";
        mobileMenu.style.transform = "translateY(-8px)";

        mobileMenuBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            menuOpen ? closeMenu() : openMenu();
        });

        // Close when clicking outside
        document.addEventListener("click", (e) => {
            if (menuOpen && !mobileMenu.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                closeMenu();
            }
        });

        // Close when clicking a nav link
        mobileMenu.querySelectorAll("a").forEach(link => {
            link.addEventListener("click", () => {
                if (menuOpen) closeMenu();
            });
        });
    }


    // =========================================================================
    // 4. SCROLL-TRIGGERED COUNTERS (IntersectionObserver + Easing)
    // =========================================================================

    const counterElements = document.querySelectorAll("[data-counter-target], .counter-value");

    if (counterElements.length > 0) {
        const runCounter = (el) => {
            const target = parseFloat(el.getAttribute("data-counter-target") || el.getAttribute("data-target"));
            const suffix = el.getAttribute("data-counter-suffix") || el.getAttribute("data-suffix") || "";
            const isFloat = el.getAttribute("data-counter-float") === "true" || String(target).includes(".");
            const duration = SISGAIN.counterDuration;
            const startTime = performance.now();

            const animate = (now) => {
                const elapsed = now - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const eased = easeOutExpo(progress);
                const currentVal = eased * target;

                if (isFloat) {
                    el.textContent = currentVal.toFixed(1) + suffix;
                } else {
                    el.textContent = Math.floor(currentVal).toLocaleString() + suffix;
                }

                if (progress < 1) {
                    requestAnimationFrame(animate);
                } else {
                    // Ensure final value is exact
                    el.textContent = (isFloat ? target.toFixed(1) : Math.floor(target).toLocaleString()) + suffix;
                }
            };

            requestAnimationFrame(animate);
        };

        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    runCounter(entry.target);
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.4 });

        counterElements.forEach(el => counterObserver.observe(el));
    }


    // =========================================================================
    // 5. SMOOTH SCROLL for Anchor Links
    // =========================================================================

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener("click", (e) => {
            const targetId = anchor.getAttribute("href");
            if (targetId === "#" || targetId === "#!") return;

            const targetEl = document.querySelector(targetId);
            if (targetEl) {
                e.preventDefault();
                const navHeight = navbar ? navbar.offsetHeight : 0;
                const targetPos = targetEl.getBoundingClientRect().top + window.scrollY - navHeight - 20;

                window.scrollTo({
                    top: targetPos,
                    behavior: "smooth"
                });
            }
        });
    });


    // =========================================================================
    // 6. PARALLAX EFFECT (requestAnimationFrame powered)
    // =========================================================================

    const parallaxElements = document.querySelectorAll(".parallax-element");

    if (parallaxElements.length > 0) {
        let parallaxTicking = false;

        const updateParallax = () => {
            const scrollY = window.scrollY;
            const windowHeight = window.innerHeight;

            parallaxElements.forEach(el => {
                const speed = parseFloat(el.getAttribute("data-speed")) || 0.15;
                const rect = el.getBoundingClientRect();
                const elementCenter = rect.top + rect.height / 2;
                const viewportCenter = windowHeight / 2;
                const offset = (elementCenter - viewportCenter) * speed;

                el.style.transform = `translate3d(0, ${offset}px, 0)`;
                el.style.willChange = "transform";
            });

            parallaxTicking = false;
        };

        window.addEventListener("scroll", () => {
            if (!parallaxTicking) {
                requestAnimationFrame(updateParallax);
                parallaxTicking = true;
            }
        }, { passive: true });
    }


    // =========================================================================
    // 7. REVEAL ON SCROLL (Custom IntersectionObserver system)
    // =========================================================================

    const revealElements = document.querySelectorAll(".reveal, .reveal-up, .reveal-left, .reveal-right");

    if (revealElements.length > 0) {
        // Inject base reveal CSS dynamically
        const revealCSS = document.createElement("style");
        revealCSS.textContent = `
            .reveal, .reveal-up, .reveal-left, .reveal-right {
                opacity: 0;
                transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
                will-change: opacity, transform;
            }
            .reveal, .reveal-up { transform: translateY(40px); }
            .reveal-left { transform: translateX(-50px); }
            .reveal-right { transform: translateX(50px); }
            .revealed {
                opacity: 1 !important;
                transform: translateY(0) translateX(0) !important;
            }
            .reveal-stagger > * {
                opacity: 0;
                transform: translateY(30px);
                transition: opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1), transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            }
            .reveal-stagger.revealed > * { opacity: 1; transform: translateY(0); }
        `;
        document.head.appendChild(revealCSS);

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    el.classList.add("revealed");

                    // Stagger children if container has .reveal-stagger
                    if (el.classList.contains("reveal-stagger")) {
                        const children = el.children;
                        Array.from(children).forEach((child, i) => {
                            child.style.transitionDelay = `${i * 100}ms`;
                        });
                    }

                    revealObserver.unobserve(el);
                }
            });
        }, { threshold: SISGAIN.revealThreshold, rootMargin: "0px 0px -50px 0px" });

        revealElements.forEach(el => revealObserver.observe(el));
    }


    // =========================================================================
    // 8. TYPED TEXT EFFECT (Multi-string rotation with cursor)
    // =========================================================================

    const typedElements = document.querySelectorAll(".typed-text");

    typedElements.forEach(el => {
        const strings = JSON.parse(el.getAttribute("data-strings") || '["Enterprise Solutions", "Digital Transformation", "AI Engineering"]');
        const speed = parseInt(el.getAttribute("data-speed")) || SISGAIN.typingSpeed;
        const deleteSpeed = parseInt(el.getAttribute("data-delete-speed")) || SISGAIN.typingDeleteSpeed;
        const pauseDuration = parseInt(el.getAttribute("data-pause")) || SISGAIN.typingPause;

        // Create cursor element
        const cursor = document.createElement("span");
        cursor.className = "typed-cursor";
        cursor.textContent = "|";
        cursor.style.cssText = "animation: blink-cursor 0.75s step-end infinite; font-weight: 100; margin-left: 2px; color: #3b82f6;";
        el.parentNode.insertBefore(cursor, el.nextSibling);

        // Add blink keyframes if not already added
        if (!document.getElementById("typed-cursor-css")) {
            const cursorCSS = document.createElement("style");
            cursorCSS.id = "typed-cursor-css";
            cursorCSS.textContent = `@keyframes blink-cursor { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }`;
            document.head.appendChild(cursorCSS);
        }

        let stringIndex = 0;
        let charIndex = 0;
        let isDeleting = false;

        const type = () => {
            const currentString = strings[stringIndex];

            if (isDeleting) {
                el.textContent = currentString.substring(0, charIndex - 1);
                charIndex--;
            } else {
                el.textContent = currentString.substring(0, charIndex + 1);
                charIndex++;
            }

            let delay = isDeleting ? deleteSpeed : speed;

            if (!isDeleting && charIndex === currentString.length) {
                delay = pauseDuration;
                isDeleting = true;
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                stringIndex = (stringIndex + 1) % strings.length;
                delay = 400;
            }

            setTimeout(type, delay);
        };

        // Only start when element is visible
        const typedObserver = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                type();
                typedObserver.unobserve(el);
            }
        }, { threshold: 0.3 });

        typedObserver.observe(el);
    });


    // =========================================================================
    // 9. INDUSTRY TABS — Smooth Fade Transitions
    // =========================================================================

    const tabBtns = document.querySelectorAll("[data-industry-tab]");
    const tabPanels = document.querySelectorAll("[data-industry-panel]");

    if (tabBtns.length > 0 && tabPanels.length > 0) {
        // Set transition on all panels
        tabPanels.forEach(panel => {
            panel.style.transition = "opacity 0.45s cubic-bezier(0.4, 0, 0.2, 1), transform 0.45s cubic-bezier(0.4, 0, 0.2, 1)";
        });

        let isTransitioning = false;

        tabBtns.forEach(btn => {
            btn.addEventListener("click", () => {
                if (isTransitioning) return;
                const targetIndustry = btn.getAttribute("data-industry-tab");

                // Skip if already active
                const activePanel = document.querySelector('[data-industry-panel]:not(.hidden)');
                if (activePanel && activePanel.getAttribute("data-industry-panel") === targetIndustry) return;

                isTransitioning = true;

                // Update active tab styling
                tabBtns.forEach(b => {
                    b.classList.remove("border-blue-500", "bg-blue-500/10", "text-blue-400");
                    b.classList.add("border-white/10", "text-zinc-400");
                });
                btn.classList.remove("border-white/10", "text-zinc-400");
                btn.classList.add("border-blue-500", "bg-blue-500/10", "text-blue-400");

                // Fade out current panel
                if (activePanel) {
                    activePanel.style.opacity = "0";
                    activePanel.style.transform = "translateY(12px)";
                }

                setTimeout(() => {
                    // Hide all panels
                    tabPanels.forEach(p => {
                        p.classList.add("hidden");
                        p.style.opacity = "0";
                        p.style.transform = "translateY(12px)";
                    });

                    // Show target panel
                    const targetPanel = document.querySelector(`[data-industry-panel="${targetIndustry}"]`);
                    if (targetPanel) {
                        targetPanel.classList.remove("hidden");
                        // Force reflow
                        targetPanel.offsetHeight;
                        requestAnimationFrame(() => {
                            targetPanel.style.opacity = "1";
                            targetPanel.style.transform = "translateY(0)";
                            isTransitioning = false;
                        });

                        // Re-initialize Lucide icons in new panel
                        if (typeof lucide !== "undefined") {
                            lucide.createIcons({ nodes: [targetPanel] });
                        }
                    } else {
                        isTransitioning = false;
                    }
                }, 300);
            });
        });
    }


    // =========================================================================
    // 10. FAQ ACCORDIONS — Smooth Height Animation
    // =========================================================================

    const faqContainers = document.querySelectorAll(".glass-card.rounded-2xl");

    faqContainers.forEach(container => {
        const toggleBtn = container.querySelector("button[onclick]");
        if (!toggleBtn) return;

        const answerPanel = toggleBtn.nextElementSibling;
        if (!answerPanel) return;

        // Remove inline onclick — we handle it properly
        toggleBtn.removeAttribute("onclick");

        const arrowIcon = toggleBtn.querySelector(".arrow-ico");

        // Set up smooth height transition
        answerPanel.style.transition = "max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease, padding 0.3s ease";
        answerPanel.style.overflow = "hidden";

        // Initial collapsed state
        if (answerPanel.classList.contains("hidden")) {
            answerPanel.classList.remove("hidden");
            answerPanel.style.maxHeight = "0px";
            answerPanel.style.opacity = "0";
            answerPanel.style.paddingTop = "0";
            answerPanel.style.paddingBottom = "0";
        }

        let isOpen = false;

        toggleBtn.addEventListener("click", () => {
            if (isOpen) {
                // CLOSE this accordion
                answerPanel.style.maxHeight = "0px";
                answerPanel.style.opacity = "0";
                answerPanel.style.paddingTop = "0";
                answerPanel.style.paddingBottom = "0";
                if (arrowIcon) arrowIcon.classList.remove("rotate-180");
                isOpen = false;
            } else {
                // CLOSE all other accordions first (one-open-at-a-time)
                faqContainers.forEach(otherContainer => {
                    if (otherContainer === container) return;
                    const otherBtn = otherContainer.querySelector("button");
                    const otherPanel = otherBtn?.nextElementSibling;
                    const otherArrow = otherBtn?.querySelector(".arrow-ico");
                    if (otherPanel && otherPanel.style.maxHeight !== "0px") {
                        otherPanel.style.maxHeight = "0px";
                        otherPanel.style.opacity = "0";
                        otherPanel.style.paddingTop = "0";
                        otherPanel.style.paddingBottom = "0";
                        if (otherArrow) otherArrow.classList.remove("rotate-180");
                        // Reset state on the other container
                        otherContainer._faqOpen = false;
                    }
                });

                // OPEN this accordion
                answerPanel.style.maxHeight = answerPanel.scrollHeight + 40 + "px";
                answerPanel.style.opacity = "1";
                answerPanel.style.paddingTop = "1rem";
                answerPanel.style.paddingBottom = "1.5rem";
                if (arrowIcon) arrowIcon.classList.add("rotate-180");
                isOpen = true;
            }

            container._faqOpen = isOpen;
        });
    });


    // =========================================================================
    // 11. MAGNETIC CURSOR EFFECT
    // =========================================================================

    const magneticElements = document.querySelectorAll(".magnetic");

    magneticElements.forEach(el => {
        const strength = parseFloat(el.getAttribute("data-strength")) || 0.3;

        el.style.transition = "transform 0.3s cubic-bezier(0.2, 0, 0.2, 1)";

        el.addEventListener("mousemove", (e) => {
            const rect = el.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;

            const deltaX = (e.clientX - centerX) * strength;
            const deltaY = (e.clientY - centerY) * strength;

            el.style.transform = `translate3d(${deltaX}px, ${deltaY}px, 0)`;
        });

        el.addEventListener("mouseleave", () => {
            el.style.transform = "translate3d(0, 0, 0)";
        });
    });


    // =========================================================================
    // 12. SCROLL PROGRESS BAR
    // =========================================================================

    const progressBar = document.createElement("div");
    progressBar.id = "scroll-progress-bar";
    progressBar.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        height: 3px;
        width: 0%;
        background: linear-gradient(90deg, #3b82f6, #06b6d4);
        z-index: 9999;
        transition: width 0.1s linear;
        pointer-events: none;
        border-radius: 0 2px 2px 0;
        box-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
    `;
    document.body.prepend(progressBar);

    const updateProgress = () => {
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const scrollPercent = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
        progressBar.style.width = `${scrollPercent}%`;
    };

    window.addEventListener("scroll", throttle(updateProgress, 16), { passive: true });


    // =========================================================================
    // 13. IMAGE LAZY LOADING with Fade-In
    // =========================================================================

    const lazyImages = document.querySelectorAll("img[data-src]");

    if (lazyImages.length > 0) {
        const lazyCSS = document.createElement("style");
        lazyCSS.textContent = `
            img[data-src] {
                opacity: 0;
                transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            }
            img.lazy-loaded {
                opacity: 1;
            }
        `;
        document.head.appendChild(lazyCSS);

        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    const src = img.getAttribute("data-src");

                    if (src) {
                        img.src = src;
                        img.addEventListener("load", () => {
                            img.classList.add("lazy-loaded");
                            img.removeAttribute("data-src");
                        });
                        img.addEventListener("error", () => {
                            img.classList.add("lazy-loaded");
                        });
                    }

                    imageObserver.unobserve(img);
                }
            });
        }, { rootMargin: "100px" });

        lazyImages.forEach(img => imageObserver.observe(img));
    }


    // =========================================================================
    // 14. TOAST NOTIFICATION SYSTEM (Auto-dismiss)
    // =========================================================================

    const toast = document.getElementById("toast-notification");

    if (toast) {
        // Animate in
        requestAnimationFrame(() => {
            setTimeout(() => {
                toast.classList.remove("translate-y-20", "opacity-0");
                toast.style.transform = "translateY(0)";
                toast.style.opacity = "1";
            }, 150);
        });

        // Auto-dismiss after configured duration
        setTimeout(() => {
            toast.style.transform = "translateY(20px)";
            toast.style.opacity = "0";
            setTimeout(() => toast.remove(), 500);
        }, SISGAIN.toastDuration);
    }


    // =========================================================================
    // 15. BENTO GRID INTERACTIVE GLOW TRACKER
    // =========================================================================

    const bentoCards = document.querySelectorAll(".bento-glow-container");

    bentoCards.forEach(card => {
        card.addEventListener("mousemove", (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            card.style.setProperty("--x", `${x}px`);
            card.style.setProperty("--y", `${y}px`);
        });
    });


    // =========================================================================
    // 16. ORBIT NODE CLICK HANDLERS
    // =========================================================================

    const orbitNodes = document.querySelectorAll(".orbit-node");
    const orbitDetailTitle = document.getElementById("orbit-detail-title");
    const orbitDetailDesc = document.getElementById("orbit-detail-desc");
    const orbitDetailMetric = document.getElementById("orbit-detail-metric");

    if (orbitNodes.length > 0 && orbitDetailTitle && orbitDetailDesc) {
        const detailCard = document.getElementById("orbit-detail-card");

        orbitNodes.forEach(node => {
            node.addEventListener("click", () => {
                const title = node.getAttribute("data-title");
                const desc = node.getAttribute("data-desc");
                const metric = node.getAttribute("data-metric");

                // Fade transition on detail card
                if (detailCard) {
                    detailCard.style.transition = "opacity 0.2s ease, transform 0.2s ease";
                    detailCard.style.opacity = "0";
                    detailCard.style.transform = "translateY(8px)";
                }

                setTimeout(() => {
                    orbitDetailTitle.textContent = title;
                    orbitDetailDesc.textContent = desc;
                    if (orbitDetailMetric && metric) {
                        orbitDetailMetric.textContent = metric;
                        orbitDetailMetric.parentElement.classList.remove("hidden");
                    } else if (orbitDetailMetric) {
                        orbitDetailMetric.parentElement.classList.add("hidden");
                    }

                    if (detailCard) {
                        requestAnimationFrame(() => {
                            detailCard.style.opacity = "1";
                            detailCard.style.transform = "translateY(0)";
                        });
                    }
                }, 200);

                // Active state on clicked node
                orbitNodes.forEach(n => n.classList.remove("orbit-active"));
                node.classList.add("orbit-active");
            });
        });
    }


    // =========================================================================
    // 17. TIMELINE ROADMAP — Scroll-activated Highlights
    // =========================================================================

    const timelineItems = document.querySelectorAll("[data-roadmap-step]");
    const roadmapProgress = document.getElementById("roadmap-progress-bar");

    if (timelineItems.length > 0 && roadmapProgress) {
        const updateTimeline = () => {
            const windowHeight = window.innerHeight;
            let activeIndex = -1;

            timelineItems.forEach((item, index) => {
                const rect = item.getBoundingClientRect();
                if (rect.top < windowHeight * 0.6) {
                    activeIndex = index;
                }
            });

            if (activeIndex !== -1) {
                const pct = ((activeIndex + 1) / timelineItems.length) * 100;
                roadmapProgress.style.width = `${pct}%`;
                roadmapProgress.style.transition = "width 0.5s cubic-bezier(0.4, 0, 0.2, 1)";

                timelineItems.forEach((item, index) => {
                    const stepCircle = item.querySelector(".step-circle");
                    const stepNum = item.querySelector(".step-num");
                    if (index <= activeIndex) {
                        stepCircle.classList.remove("bg-zinc-800", "border-white/10");
                        stepCircle.classList.add("bg-blue-500", "border-blue-400", "scale-110");
                        stepNum.classList.remove("text-zinc-500");
                        stepNum.classList.add("text-white", "text-glow-blue");
                    } else {
                        stepCircle.classList.add("bg-zinc-800", "border-white/10");
                        stepCircle.classList.remove("bg-blue-500", "border-blue-400", "scale-110");
                        stepNum.classList.add("text-zinc-500");
                        stepNum.classList.remove("text-white", "text-glow-blue");
                    }
                });
            }
        };

        window.addEventListener("scroll", throttle(updateTimeline, 50), { passive: true });
    }


    // =========================================================================
    // 18. LUCIDE ICONS INITIALIZATION
    // =========================================================================

    if (typeof lucide !== "undefined") {
        lucide.createIcons();
    }


    // =========================================================================
    // 19. AOS (Animate On Scroll) INITIALIZATION
    // =========================================================================

    if (typeof AOS !== "undefined") {
        AOS.init({
            duration: 800,
            once: true,
            offset: 80,
            easing: "ease-out-cubic",
            anchorPlacement: "top-bottom",
        });
    }


    // =========================================================================
    // 20. GSAP SCROLL-TRIGGERED ENHANCEMENTS
    // =========================================================================

    if (typeof gsap !== "undefined") {
        // Subtle float animation for hero overlay cards
        gsap.utils.toArray(".glass-card.animate-bounce").forEach(card => {
            // Override CSS bounce with smoother GSAP float
            card.style.animation = "none";
            gsap.to(card, {
                y: -8,
                duration: 2.5,
                ease: "sine.inOut",
                yoyo: true,
                repeat: -1,
            });
        });

        // Stagger-in for service grid cards
        gsap.utils.toArray(".glass-card").forEach(card => {
            card.addEventListener("mouseenter", () => {
                gsap.to(card, {
                    scale: 1.02,
                    duration: 0.3,
                    ease: "power2.out",
                });
            });
            card.addEventListener("mouseleave", () => {
                gsap.to(card, {
                    scale: 1,
                    duration: 0.4,
                    ease: "power2.out",
                });
            });
        });

        // Hero text entrance
        const heroH1 = document.querySelector("header h1");
        if (heroH1) {
            gsap.from(heroH1, {
                y: 40,
                opacity: 0,
                duration: 1,
                delay: 0.2,
                ease: "power3.out",
            });
        }

        const heroP = document.querySelector("header p");
        if (heroP) {
            gsap.from(heroP, {
                y: 30,
                opacity: 0,
                duration: 1,
                delay: 0.4,
                ease: "power3.out",
            });
        }
    }


    // =========================================================================
    // 21. PERFORMANCE: Reduce animations when prefers-reduced-motion
    // =========================================================================

    const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    if (prefersReducedMotion) {
        // Disable parallax
        parallaxElements?.forEach(el => el.style.transform = "");

        // Simplify progress bar
        if (progressBar) progressBar.style.transition = "none";

        // Tell AOS to not animate
        if (typeof AOS !== "undefined") {
            document.querySelectorAll("[data-aos]").forEach(el => {
                el.removeAttribute("data-aos");
                el.style.opacity = "1";
                el.style.transform = "none";
            });
        }
    }


    // =========================================================================
    // INIT COMPLETE LOG
    // =========================================================================

    console.log("%c⚡ SISGAIN Enterprise UI v2.0 Initialized", "color: #3b82f6; font-weight: bold; font-size: 12px;");

});
