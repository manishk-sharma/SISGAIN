/**
 * ============================================================================
 * SISGAIN Enterprise — Hero Canvas Network Constellation
 * Premium interactive particle visualization with depth & physics
 * Targets: canvas#hero-canvas OR canvas#hero-network-canvas
 * Version 2.0 | Production Build
 * ============================================================================
 */

class ConstellationNetwork {

    // -------------------------------------------------------------------------
    // CONFIGURATION
    // -------------------------------------------------------------------------

    static DEFAULTS = {
        nodeCount: { min: 80, max: 120 },
        nodeMinSize: 1,
        nodeMaxSize: 4,
        connectionDistance: 150,
        mouseInfluenceRadius: 200,
        mouseAttractionStrength: 0.02,
        driftSpeedRange: 0.4,
        colors: {
            blue: "#3b82f6",
            cyan: "#06b6d4",
            blueRGB: "59, 130, 246",
            cyanRGB: "6, 182, 212",
            connectionBase: "59, 130, 246",
        },
        glowPulseSpeed: 0.008,
        shootingStarInterval: { min: 5000, max: 8000 },
        gridOpacity: 0.018,
        gridSize: 50,
    };


    // -------------------------------------------------------------------------
    // CONSTRUCTOR
    // -------------------------------------------------------------------------

    constructor(canvasId) {
        // Support both canvas IDs used in the codebase
        this.canvas = document.getElementById(canvasId)
            || document.getElementById("hero-network-canvas")
            || document.getElementById("hero-canvas");

        if (!this.canvas) return;

        this.ctx = this.canvas.getContext("2d", { alpha: true });
        this.nodes = [];
        this.shootingStars = [];
        this.mouse = { x: null, y: null };
        this.time = 0;
        this.lastShootingStar = 0;
        this.nextShootingStarDelay = this._randomBetween(
            ConstellationNetwork.DEFAULTS.shootingStarInterval.min,
            ConstellationNetwork.DEFAULTS.shootingStarInterval.max
        );
        this.isVisible = true;
        this.animationId = null;
        this.dpr = Math.min(window.devicePixelRatio || 1, 2);

        this._resize();
        this._createNodes();
        this._bindEvents();
        this._startAnimation();

        console.log(`%c✦ Constellation Network initialized (${this.nodes.length} nodes)`, "color: #06b6d4; font-size: 10px;");
    }


    // -------------------------------------------------------------------------
    // CANVAS SIZING
    // -------------------------------------------------------------------------

    _resize() {
        const parent = this.canvas.parentElement;
        const rect = parent.getBoundingClientRect();
        const width = rect.width || parent.clientWidth;
        const height = rect.height || parent.clientHeight || 500;

        // High-DPI canvas scaling
        this.canvas.width = width * this.dpr;
        this.canvas.height = height * this.dpr;
        this.canvas.style.width = `${width}px`;
        this.canvas.style.height = `${height}px`;
        this.ctx.scale(this.dpr, this.dpr);

        this.width = width;
        this.height = height;

        // Performance hint
        this.canvas.style.willChange = "transform";
    }


    // -------------------------------------------------------------------------
    // NODE GENERATION
    // -------------------------------------------------------------------------

    _createNodes() {
        const { nodeCount, nodeMinSize, nodeMaxSize, driftSpeedRange, colors } = ConstellationNetwork.DEFAULTS;
        const count = Math.floor(this._randomBetween(nodeCount.min, nodeCount.max));

        this.nodes = [];

        for (let i = 0; i < count; i++) {
            const isBlue = Math.random() > 0.35;
            const size = this._randomBetween(nodeMinSize, nodeMaxSize);

            this.nodes.push({
                x: Math.random() * this.width,
                y: Math.random() * this.height,
                vx: (Math.random() - 0.5) * driftSpeedRange,
                vy: (Math.random() - 0.5) * driftSpeedRange,
                baseVx: (Math.random() - 0.5) * driftSpeedRange,
                baseVy: (Math.random() - 0.5) * driftSpeedRange,
                radius: size,
                color: isBlue ? colors.blue : colors.cyan,
                colorRGB: isBlue ? colors.blueRGB : colors.cyanRGB,
                alpha: 0.4 + Math.random() * 0.6,
                pulsePhase: Math.random() * Math.PI * 2,
                pulseSpeed: 0.015 + Math.random() * 0.025,
                // Slight per-node drift randomness over time
                driftPhase: Math.random() * Math.PI * 2,
                driftAmplitude: 0.1 + Math.random() * 0.15,
            });
        }
    }


    // -------------------------------------------------------------------------
    // EVENT BINDING
    // -------------------------------------------------------------------------

    _bindEvents() {
        // Resize handler (debounced)
        this._resizeHandler = this._debounce(() => {
            this._resize();
            // Re-clamp nodes to new dimensions
            this.nodes.forEach(node => {
                node.x = Math.min(node.x, this.width);
                node.y = Math.min(node.y, this.height);
            });
        }, 200);

        window.addEventListener("resize", this._resizeHandler);

        // Mouse tracking
        this.canvas.addEventListener("mousemove", (e) => {
            const rect = this.canvas.getBoundingClientRect();
            this.mouse.x = e.clientX - rect.left;
            this.mouse.y = e.clientY - rect.top;
        });

        this.canvas.addEventListener("mouseleave", () => {
            this.mouse.x = null;
            this.mouse.y = null;
        });

        // Touch support for mobile
        this.canvas.addEventListener("touchmove", (e) => {
            const rect = this.canvas.getBoundingClientRect();
            const touch = e.touches[0];
            this.mouse.x = touch.clientX - rect.left;
            this.mouse.y = touch.clientY - rect.top;
        }, { passive: true });

        this.canvas.addEventListener("touchend", () => {
            this.mouse.x = null;
            this.mouse.y = null;
        });

        // Visibility API — pause when tab is not visible
        document.addEventListener("visibilitychange", () => {
            if (document.hidden) {
                this.isVisible = false;
            } else {
                this.isVisible = true;
                this.lastShootingStar = performance.now();
            }
        });
    }


    // -------------------------------------------------------------------------
    // MAIN ANIMATION LOOP
    // -------------------------------------------------------------------------

    _startAnimation() {
        const animate = (timestamp) => {
            this.animationId = requestAnimationFrame(animate);

            if (!this.isVisible) return;

            this.time = timestamp || 0;

            // Clear canvas
            this.ctx.clearRect(0, 0, this.width, this.height);

            // Render layers in order (back to front)
            this._drawSubtleGrid();
            this._drawCenterGlow();
            this._updateAndDrawConnections();
            this._updateAndDrawNodes();
            this._updateAndDrawShootingStars(timestamp);
        };

        this.animationId = requestAnimationFrame(animate);
    }


    // -------------------------------------------------------------------------
    // LAYER: Subtle Grid Background
    // -------------------------------------------------------------------------

    _drawSubtleGrid() {
        const { gridOpacity, gridSize } = ConstellationNetwork.DEFAULTS;
        this.ctx.strokeStyle = `rgba(255, 255, 255, ${gridOpacity})`;
        this.ctx.lineWidth = 0.5;

        for (let x = 0; x < this.width; x += gridSize) {
            this.ctx.beginPath();
            this.ctx.moveTo(x, 0);
            this.ctx.lineTo(x, this.height);
            this.ctx.stroke();
        }

        for (let y = 0; y < this.height; y += gridSize) {
            this.ctx.beginPath();
            this.ctx.moveTo(0, y);
            this.ctx.lineTo(this.width, y);
            this.ctx.stroke();
        }
    }


    // -------------------------------------------------------------------------
    // LAYER: Pulsing Center Glow
    // -------------------------------------------------------------------------

    _drawCenterGlow() {
        const { glowPulseSpeed, colors } = ConstellationNetwork.DEFAULTS;
        const cx = this.width / 2;
        const cy = this.height / 2;

        // Pulsing alpha
        const pulseAlpha = 0.04 + Math.sin(this.time * glowPulseSpeed) * 0.025;
        const pulseRadius = 120 + Math.sin(this.time * glowPulseSpeed * 0.7) * 30;

        // Outer glow (large, subtle)
        const outerGrad = this.ctx.createRadialGradient(cx, cy, 0, cx, cy, pulseRadius * 1.8);
        outerGrad.addColorStop(0, `rgba(${colors.blueRGB}, ${pulseAlpha * 0.6})`);
        outerGrad.addColorStop(0.4, `rgba(${colors.cyanRGB}, ${pulseAlpha * 0.3})`);
        outerGrad.addColorStop(1, "rgba(0, 0, 0, 0)");

        this.ctx.beginPath();
        this.ctx.arc(cx, cy, pulseRadius * 1.8, 0, Math.PI * 2);
        this.ctx.fillStyle = outerGrad;
        this.ctx.fill();

        // Inner glow (tight, brighter)
        const innerGrad = this.ctx.createRadialGradient(cx, cy, 0, cx, cy, pulseRadius * 0.6);
        innerGrad.addColorStop(0, `rgba(${colors.blueRGB}, ${pulseAlpha * 1.2})`);
        innerGrad.addColorStop(1, "rgba(0, 0, 0, 0)");

        this.ctx.beginPath();
        this.ctx.arc(cx, cy, pulseRadius * 0.6, 0, Math.PI * 2);
        this.ctx.fillStyle = innerGrad;
        this.ctx.fill();
    }


    // -------------------------------------------------------------------------
    // LAYER: Nodes — Physics, Mouse Interaction, Rendering
    // -------------------------------------------------------------------------

    _updateAndDrawNodes() {
        const { mouseInfluenceRadius, mouseAttractionStrength } = ConstellationNetwork.DEFAULTS;

        this.nodes.forEach(node => {
            // ── Drift randomness over time ──
            node.driftPhase += 0.003;
            const driftX = Math.sin(node.driftPhase) * node.driftAmplitude;
            const driftY = Math.cos(node.driftPhase * 0.8) * node.driftAmplitude;

            node.vx = node.baseVx + driftX;
            node.vy = node.baseVy + driftY;

            // ── Mouse attraction (NOT repulsion — subtle pull) ──
            if (this.mouse.x !== null && this.mouse.y !== null) {
                const dx = this.mouse.x - node.x;
                const dy = this.mouse.y - node.y;
                const dist = Math.sqrt(dx * dx + dy * dy);

                if (dist < mouseInfluenceRadius && dist > 1) {
                    const force = (1 - dist / mouseInfluenceRadius) * mouseAttractionStrength;
                    node.vx += (dx / dist) * force * 8;
                    node.vy += (dy / dist) * force * 8;
                }
            }

            // ── Update position ──
            node.x += node.vx;
            node.y += node.vy;

            // ── Soft boundary wrapping (more organic than bouncing) ──
            const margin = 10;
            if (node.x < -margin) node.x = this.width + margin;
            if (node.x > this.width + margin) node.x = -margin;
            if (node.y < -margin) node.y = this.height + margin;
            if (node.y > this.height + margin) node.y = -margin;

            // ── Pulsing alpha ──
            node.pulsePhase += node.pulseSpeed;
            const alpha = node.alpha * (0.6 + Math.sin(node.pulsePhase) * 0.4);

            // ── Draw node with glow ──
            this.ctx.save();

            // Glow layer
            this.ctx.shadowBlur = 12;
            this.ctx.shadowColor = `rgba(${node.colorRGB}, 0.6)`;

            this.ctx.beginPath();
            this.ctx.arc(node.x, node.y, node.radius, 0, Math.PI * 2);
            this.ctx.fillStyle = `rgba(${node.colorRGB}, ${alpha})`;
            this.ctx.fill();

            // Bright core
            if (node.radius > 2.5) {
                this.ctx.beginPath();
                this.ctx.arc(node.x, node.y, node.radius * 0.4, 0, Math.PI * 2);
                this.ctx.fillStyle = `rgba(255, 255, 255, ${alpha * 0.6})`;
                this.ctx.fill();
            }

            this.ctx.restore();
        });
    }


    // -------------------------------------------------------------------------
    // LAYER: Connections Between Nearby Nodes
    // -------------------------------------------------------------------------

    _updateAndDrawConnections() {
        const { connectionDistance, colors } = ConstellationNetwork.DEFAULTS;
        const nodes = this.nodes;
        const len = nodes.length;

        this.ctx.lineWidth = 0.6;

        for (let i = 0; i < len; i++) {
            for (let j = i + 1; j < len; j++) {
                const n1 = nodes[i];
                const n2 = nodes[j];

                const dx = n1.x - n2.x;
                const dy = n1.y - n2.y;

                // Quick distance pre-check (skip sqrt when obviously too far)
                if (Math.abs(dx) > connectionDistance || Math.abs(dy) > connectionDistance) continue;

                const distSq = dx * dx + dy * dy;
                const maxDistSq = connectionDistance * connectionDistance;

                if (distSq < maxDistSq) {
                    const dist = Math.sqrt(distSq);
                    // Opacity falls off with distance — closer = more visible
                    const alpha = (1 - dist / connectionDistance) * 0.15;

                    // Gradient line between two node colors
                    const grad = this.ctx.createLinearGradient(n1.x, n1.y, n2.x, n2.y);
                    grad.addColorStop(0, `rgba(${n1.colorRGB}, ${alpha})`);
                    grad.addColorStop(1, `rgba(${n2.colorRGB}, ${alpha})`);

                    this.ctx.strokeStyle = grad;
                    this.ctx.beginPath();
                    this.ctx.moveTo(n1.x, n1.y);
                    this.ctx.lineTo(n2.x, n2.y);
                    this.ctx.stroke();
                }
            }
        }

        // Mouse connection lines — draw lines from cursor to nearby nodes
        if (this.mouse.x !== null && this.mouse.y !== null) {
            const mouseRadius = ConstellationNetwork.DEFAULTS.mouseInfluenceRadius;

            for (let i = 0; i < len; i++) {
                const node = nodes[i];
                const dx = node.x - this.mouse.x;
                const dy = node.y - this.mouse.y;
                const distSq = dx * dx + dy * dy;

                if (distSq < mouseRadius * mouseRadius) {
                    const dist = Math.sqrt(distSq);
                    const alpha = (1 - dist / mouseRadius) * 0.12;

                    this.ctx.strokeStyle = `rgba(${colors.cyanRGB}, ${alpha})`;
                    this.ctx.lineWidth = 0.4;
                    this.ctx.beginPath();
                    this.ctx.moveTo(this.mouse.x, this.mouse.y);
                    this.ctx.lineTo(node.x, node.y);
                    this.ctx.stroke();
                }
            }

            this.ctx.lineWidth = 0.6;
        }
    }


    // -------------------------------------------------------------------------
    // LAYER: Shooting Stars
    // -------------------------------------------------------------------------

    _updateAndDrawShootingStars(timestamp) {
        const elapsed = timestamp - this.lastShootingStar;

        // Spawn a new shooting star on schedule
        if (elapsed > this.nextShootingStarDelay) {
            this._spawnShootingStar();
            this.lastShootingStar = timestamp;
            this.nextShootingStarDelay = this._randomBetween(
                ConstellationNetwork.DEFAULTS.shootingStarInterval.min,
                ConstellationNetwork.DEFAULTS.shootingStarInterval.max
            );
        }

        // Render and update active shooting stars
        this.shootingStars = this.shootingStars.filter(star => {
            star.x += star.vx;
            star.y += star.vy;
            star.life -= star.decay;

            if (star.life <= 0) return false;

            const alpha = star.life;
            const tailLength = 60;

            // Draw tail (gradient line)
            const grad = this.ctx.createLinearGradient(
                star.x, star.y,
                star.x - star.vx * tailLength / star.speed,
                star.y - star.vy * tailLength / star.speed
            );
            grad.addColorStop(0, `rgba(255, 255, 255, ${alpha * 0.9})`);
            grad.addColorStop(0.3, `rgba(${ConstellationNetwork.DEFAULTS.colors.cyanRGB}, ${alpha * 0.5})`);
            grad.addColorStop(1, `rgba(${ConstellationNetwork.DEFAULTS.colors.blueRGB}, 0)`);

            this.ctx.save();
            this.ctx.strokeStyle = grad;
            this.ctx.lineWidth = 1.5;
            this.ctx.lineCap = "round";
            this.ctx.beginPath();
            this.ctx.moveTo(star.x, star.y);
            this.ctx.lineTo(
                star.x - star.vx * tailLength / star.speed,
                star.y - star.vy * tailLength / star.speed
            );
            this.ctx.stroke();

            // Draw head glow
            this.ctx.shadowBlur = 6;
            this.ctx.shadowColor = `rgba(255, 255, 255, ${alpha})`;
            this.ctx.beginPath();
            this.ctx.arc(star.x, star.y, 1.5, 0, Math.PI * 2);
            this.ctx.fillStyle = `rgba(255, 255, 255, ${alpha})`;
            this.ctx.fill();
            this.ctx.restore();

            // Remove if off-screen
            return star.x >= -20 && star.x <= this.width + 20
                && star.y >= -20 && star.y <= this.height + 20;
        });
    }

    _spawnShootingStar() {
        // Random angle (mostly diagonal, upper area)
        const angle = this._randomBetween(Math.PI * 0.1, Math.PI * 0.4);
        const speed = this._randomBetween(4, 8);

        // Start from random position along top/left edges
        const startFromTop = Math.random() > 0.5;
        const x = startFromTop
            ? this._randomBetween(this.width * 0.1, this.width * 0.9)
            : -10;
        const y = startFromTop
            ? -10
            : this._randomBetween(0, this.height * 0.4);

        this.shootingStars.push({
            x,
            y,
            vx: Math.cos(angle) * speed,
            vy: Math.sin(angle) * speed,
            speed,
            life: 1.0,
            decay: this._randomBetween(0.008, 0.015),
        });
    }


    // -------------------------------------------------------------------------
    // UTILITIES
    // -------------------------------------------------------------------------

    _randomBetween(min, max) {
        return min + Math.random() * (max - min);
    }

    _debounce(fn, delay) {
        let timer;
        return (...args) => {
            clearTimeout(timer);
            timer = setTimeout(() => fn.apply(this, args), delay);
        };
    }


    // -------------------------------------------------------------------------
    // CLEANUP (for SPA use if needed)
    // -------------------------------------------------------------------------

    destroy() {
        if (this.animationId) {
            cancelAnimationFrame(this.animationId);
        }
        window.removeEventListener("resize", this._resizeHandler);
        this.nodes = [];
        this.shootingStars = [];
    }
}


// =============================================================================
// INITIALIZATION
// =============================================================================

document.addEventListener("DOMContentLoaded", () => {
    // Initialize with priority canvas ID, falls back to alternate
    new ConstellationNetwork("hero-canvas");
});
