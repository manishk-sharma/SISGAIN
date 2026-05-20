# SISGAIN — Enterprise Digital Transformation Platform

A premium, enterprise-grade Digital Transformation Services website built using **Core PHP 8+**, **MySQL**, **Tailwind CSS**, and **Vanilla JavaScript**. This platform is designed with futuristic, high-end SaaS aesthetics inspired by premium consulting agencies (like Appinventiv).

---

## 🎨 Design & Interactivity Features

*   **Interactive Hero Canvas**: A custom network constellation particle animation (`assets/js/dashboard.js`) rendering modern, glowing, mouse-attracting node vectors.
*   **Modern Glassmorphism UI**: Implemented via a robust, custom design system (`assets/css/style.css`) with blur effects, premium gradient cards, and smooth hover translations.
*   **GSAP & AOS Animations**: Scroll-driven reveal triggers, parallax movements, and staggered entry layouts.
*   **Interactive ROI Calculator**: Real-time sliders allowing prospective enterprise clients to project annual cloud and automation savings, payback period, and efficiency gains.
*   **Dynamic Sector blueprints**: Tabbed sectors showing specialized solutions for Healthcare (HIPAA), Banking (Fintech), Logistics, and Manufacturing (IoT).
*   **Full Admin CMS Dashboard**: A secured management backend with full CRUD operations for services, blogs, case-studies, FAQs, and global settings.

---

## 🛠️ Tech Stack

*   **Backend**: PHP 8+ (MVC-inspired includes architecture, prepared SQL statements, CSRF protection, secure auth modules).
*   **Database**: MySQL (PDO engine).
*   **Frontend Styling**: Tailwind CSS, Google Fonts (Space Grotesk & Inter), Lucide Icons.
*   **Motion**: GSAP 3.12 (ScrollTrigger), AOS (Animate On Scroll).

---

## 📂 Project Structure

```bash
├── admin/                  # CMS Administrative Module
│   ├── index.php           # Admin Dashboard Overview
│   ├── blogs.php           # Blog Post CRUD
│   ├── case-studies.php    # Case Studies CRUD
│   ├── services.php        # Services Management
│   ├── faqs.php            # FAQ Management
│   ├── settings.php        # Global CMS Configuration
│   ├── login.php           # Security Authorization
│   └── logout.php          # Session Destruction
├── assets/
│   ├── css/
│   │   └── style.css       # Global Design Tokens & Glassmorphism System
│   └── js/
│       ├── main.js         # Navbar control, Counters, Accordions, Scroll Engine
│       └── dashboard.js    # Canvas Particle Constellation Engine
├── config/
│   └── db.php              # Secure PDO Database Connection & Helpers
├── includes/
│   ├── header.php          # Dynamic Metadata Head
│   ├── navbar.php          # Sticky Glass-morphism Navigation
│   ├── footer.php          # Responsive Multi-column Footer
│   └── cta.php             # Conversion-optimised Banner
├── schema.sql              # Initial Database Structure
├── index.php               # Complete Homepage (10 Sections)
├── services.php            # Capabilities Grid
├── industries.php          # Compliance-focused Industry tabs
├── about.php               # Company Profile, Offices, Team
├── case-studies.php        # Performance Track Record
├── contact.php             # Secure Lead Capture Form
├── blog.php                # Editorial Articles Grid
├── blog-detail.php         # Single Article Reader
└── roi-calculator.php      # Live ROI Assessment Engine
```

---

## 🚀 Setup & Local Installation

### 1. Database Configuration
1. Import the `schema.sql` into your local MySQL server.
2. Edit the database credentials in `config/db.php`:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'sisgain_db');
   define('DB_USER', 'your_username');
   define('DB_PASS', 'your_password');
   ```

### 2. Launch Local Server
Start the built-in PHP development server in the root project directory:
```bash
php -S localhost:8000
```
Open **`http://localhost:8000`** in your browser.

---

## 🔒 Security Posture
*   **CSRF Protection**: Token validation on all form endpoints (Contact, ROI, Admin Actions).
*   **SQL Injection Prevention**: Forced PDO prepared statements on all database queries.
*   **Data Sanitization**: Secure helper functions verifying dynamic content inputs before compilation.
