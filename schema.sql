-- Sisgain Enterprise Database Schema
-- Compatible with MySQL 5.7+ and 8.0+

-- CREATE DATABASE IF NOT EXISTS `sisgain_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- USE `sisgain_db`;

-- 1. Admin Table
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password_hash` VARCHAR(255) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Seed Admin (username: admin, password: admin@sisgain2026)
-- We will use password_hash("admin@sisgain2026", PASSWORD_BCRYPT) which is '$2y$10$U2Kk.pDNuWlh8JtE/sD9v.jCqW461XJlyt3HqQ4B5u2r7tXJvYv/6'
INSERT INTO `admins` (`id`, `username`, `password_hash`, `email`) VALUES
(1, 'admin', '$2y$10$U2Kk.pDNuWlh8JtE/sD9v.jCqW461XJlyt3HqQ4B5u2r7tXJvYv/6', 'admin@sisgain.com')
ON DUPLICATE KEY UPDATE `id`=`id`;

-- 2. Services Table
DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `slug` VARCHAR(100) NOT NULL UNIQUE,
  `title` VARCHAR(150) NOT NULL,
  `short_description` TEXT NOT NULL,
  `long_description` LONGTEXT NOT NULL,
  `icon` VARCHAR(100) DEFAULT 'cpu',
  `kpi_metric` VARCHAR(100) DEFAULT NULL,
  `kpi_value` VARCHAR(50) DEFAULT NULL,
  `meta_title` VARCHAR(150) DEFAULT NULL,
  `meta_description` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Seed Services
INSERT INTO `services` (`slug`, `title`, `short_description`, `long_description`, `icon`, `kpi_metric`, `kpi_value`, `meta_title`, `meta_description`) VALUES
('ai-integration', 'AI & Machine Learning Integration', 'Embed cognitive intelligence, custom LLMs, predictive modeling, and agentic workflows into your core business operations.', 'Our AI Integration services scale from natural language interfaces to advanced predictive analytics. We construct enterprise cognitive architectures that securely leverage your proprietary records to automate reasoning, accelerate decision-making, and predict customer behavior.', 'brain-circuit', 'Decision Speed Improvement', '10x Faster', 'Enterprise AI Integration Services & LLM Deployments | Sisgain', 'Integrate cognitive intelligence, LLMs, and predictive models into your enterprise processes. Modernize workflows with agentic AI applications.'),
('cloud-transformation', 'Cloud Infrastructure Modernization', 'Architect hybrid, multicloud, and cloud-native environments built for extreme reliability, absolute security, and zero friction.', 'We redesign and migrate legacy servers to modern Kubernetes containers, serverless execution flows, and self-healing multi-region configurations. Achieve infinite scale and sub-second failovers without ballooning infrastructure operational budgets.', 'cloud-lightning', 'Infrastructure Overhead Cut', '35% Saved', 'Enterprise Cloud Transformation & DevOps | Sisgain', 'Redesign infrastructure with multicloud and cloud-native systems. Scalable DevOps, Kubernetes migrations, and optimized cloud architectures.'),
('workflow-automation', 'Hyperautomation & RPA Workflows', 'Establish automated process flows and intelligent robots to eliminate manual friction and speed up business speed.', 'Transform complex cross-department activities into automated, error-free execution loops. We combine Robotic Process Automation (RPA) with AI decision trees to manage compliance audits, supply logs, and back-office reports around the clock.', 'cpu-setting', 'Manual Operations Reduced', '71% Less', 'Intelligent Workflow Automation & RPA Consulting | Sisgain', 'Eliminate manual processes with hyperautomation. Intelligent RPA robots, AI decision routes, and cross-system database syncs.'),
('erp-crm-modernization', 'Next-Gen ERP & CRM Modernization', 'Consolidate distributed assets and core customer pathways into unified, fast-loading modern management dashboards.', 'Bridge the gap between distributed tools, field operations, and customer profiles. We design custom integrations for Salesforce, SAP, and custom internal hubs, building single sources of truth with real-time analytics updates.', 'database-lock', 'System Response Rate', '4.2x Faster', 'ERP & CRM System Modernization Services | Sisgain', 'Consolidate legacy databases and CRM/ERP channels into unified, secure analytics dashboards. Streamline sales, support, and inventory.'),
('data-engineering', 'Enterprise Data Engineering & Analytics', 'Construct robust pipelines and processing networks that turn raw telemetry into actionable live intelligence.', 'Consolidate data lakes, transactional stores, and external feeds. Our data architectures cleanse and feed clean data into real-time BI dashboards, preparing your enterprise for instant analytics audits and machine learning ingestion.', 'database-git', 'Data Query Latency Reduced', '88% Lower', 'Data Engineering & Analytics Architecture | Sisgain', 'Build real-time data pipelines, analytical lakes, and live BI dashboards. Scale decision capacity with unified query architecture.'),
('cybersecurity', 'Cybersecurity Modernization & Audits', 'Defend digital boundaries with zero-trust protocols, real-time threat maps, and active penetration evaluations.', 'Modernize security from basic firewalls to comprehensive zero-trust architectures. We implement automated compliance checking, multi-factor token validation, and secure cryptographic storage to satisfy global audits.', 'shield-alert', 'Threat Detection Latency', 'Real-time', 'Enterprise Zero-Trust Cybersecurity Modernization | Sisgain', 'Protect your organization with zero-trust architectures, real-time penetration evaluations, and continuous compliance automation.')
ON DUPLICATE KEY UPDATE `id`=`id`;

-- 3. Case Studies Table
DROP TABLE IF EXISTS `case_studies`;
CREATE TABLE `case_studies` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(150) NOT NULL,
  `slug` VARCHAR(150) NOT NULL UNIQUE,
  `client_name` VARCHAR(100) NOT NULL,
  `industry` VARCHAR(100) NOT NULL,
  `challenge` TEXT NOT NULL,
  `strategy` TEXT NOT NULL,
  `technologies` VARCHAR(255) NOT NULL, -- comma-separated
  `before_stats` VARCHAR(100) DEFAULT NULL,
  `after_stats` VARCHAR(100) DEFAULT NULL,
  `roi_metric` VARCHAR(100) DEFAULT NULL,
  `timeline` VARCHAR(50) DEFAULT NULL,
  `image_url` VARCHAR(255) DEFAULT NULL,
  `is_featured` TINYINT(1) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Seed Case Studies
INSERT INTO `case_studies` (`title`, `slug`, `client_name`, `industry`, `challenge`, `strategy`, `technologies`, `before_stats`, `after_stats`, `roi_metric`, `timeline`, `image_url`, `is_featured`) VALUES
('AI-Powered Claims Processing for Apex Health', 'ai-claims-processing-health', 'Apex Health Group', 'Healthcare', 'Manual claims validation took 14 days per record, leading to high processing backlogs and client dissatisfaction.', 'Deployed custom NLP models and automated verification paths, matching submitted records against policy constraints dynamically.', 'Python, PyTorch, PHP, MySQL, AWS Textract', '14 Days processing latency', '1.2 Minutes validation', '92% processing efficiency boost', '4 Months', '/uploads/case_health.jpg', 1),
('Cloud Infrastructure Redesign for UAE Logistics Hub', 'cloud-infrastructure-logistics', 'Gulf Logistics Corp', 'Logistics', 'Legacy systems failed under peak loads, resulting in shipping delays and database timeouts during seasonal delivery spikes.', 'Migrated legacy physical servers to a containerized multicloud Kubernetes cluster across multiple regions with auto-scaling.', 'Docker, Kubernetes, AWS EKS, Terraform, PHP', '98.4% Uptime (weekly crashes)', '99.99% Uptime (zero outages)', '42% Lower infrastructure overhead costs', '6 Months', '/uploads/case_logistics.jpg', 1),
('Financial Ledger Modernization for Capital Bank', 'financial-ledger-modernization', 'Capital Bank Group', 'Banking', 'Siloed database branches required daily reconcile steps, consuming thousands of developer hours and causing auditing gaps.', 'Engineered a unified event-driven core banking database architecture with automated microservice validation audits.', 'PHP 8.2, MySQL, Redis, Apache Kafka, Go', '24 Hours reconciliation loop', 'Real-time ledger audit sync', '71% Reduced manual audits', '8 Months', '/uploads/case_banking.jpg', 0)
ON DUPLICATE KEY UPDATE `id`=`id`;

-- 4. Blog Table
DROP TABLE IF EXISTS `blogs`;
CREATE TABLE `blogs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(200) NOT NULL,
  `slug` VARCHAR(200) NOT NULL UNIQUE,
  `category` VARCHAR(100) NOT NULL,
  `summary` VARCHAR(255) NOT NULL,
  `content` LONGTEXT NOT NULL,
  `image_url` VARCHAR(255) DEFAULT NULL,
  `meta_keywords` VARCHAR(255) DEFAULT NULL,
  `author_name` VARCHAR(100) DEFAULT 'Sisgain Advisory Team',
  `status` ENUM('draft', 'published') DEFAULT 'published',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Seed Blogs
INSERT INTO `blogs` (`title`, `slug`, `category`, `summary`, `content`, `image_url`, `meta_keywords`, `author_name`, `status`) VALUES
('The Future of Enterprise AI: Scaling Beyond Sandbox Demos', 'future-enterprise-ai-scaling', 'AI & Automation', 'Why 80% of corporate AI proof-of-concepts fail to transition to production environments and how to establish robust infrastructure.', '<h2>The Enterprise AI Chasm</h2><p>Many enterprise technology leaders discover that building a functional chatbot in a local environment is simple, but moving it to serve millions of customers securely with strict data governance is highly complex.</p><h3>Why Sandbox Prototypes Fail</h3><p>Sandbox environments do not address real-world challenges like token rate limits, data privacy guidelines (GDPR/HIPAA), API failures, and memory context decay. To scale AI, you need to transition from simple prompt templates to robust agentic architectures that contain validation middleware and fallback databases.</p><h3>The Solution: Hybrid Integration</h3><p>We recommend establishing standard APIs that route between different LLM engines dynamically based on cost and compliance needs. By placing a local routing server in front of third-party APIs, you can cache repeated prompts, scrub personally identifiable information (PII) before transmission, and fall back to local open-source models if public services go offline.</p>', '/uploads/blog_ai.jpg', 'AI Integration, LLM deployment, Enterprise AI, Hyperautomation', 'Dr. Sarah Vance (AI Lead)', 'published'),
('Transitioning to Zero-Trust Architecture: A Step-by-Step Modernization Strategy', 'transition-zero-trust-architecture', 'Cybersecurity', 'A practical roadmap for security leaders to transition from traditional perimeter firewalls to identity-driven zero-trust validation systems.', '<h2>The Death of the Corporate Perimeter</h2><p>Traditionally, security models assumed that everything inside a corporate network could be trusted. However, modern remote working models, SaaS dependencies, and advanced phishing methods have made perimeter firewalls obsolete.</p><h3>What is Zero-Trust?</h3><p>Zero-Trust operates on three primary principles: Never Trust, Always Verify, and Assume Breach. Every single request, whether originating inside the corporate network or from an external IP address, must be authenticated, authorized, and cryptographically verified.</p><h3>Phased Implementation Roadmap</h3><p>First, identify your sensitive data zones and document their current access paths. Second, transition from static credentials to dynamic multi-factor validation tools. Finally, introduce continuous risk-based telemetry analysis to flag requests originating from unusual locations or hours.</p>', '/uploads/blog_security.jpg', 'Zero Trust, Cybersecurity, IAM, Cloud Security, Compliance', 'Marcus Chen (CISO)', 'published'),
('Optimizing Cloud Spending in 2026: DevOps Strategies that Deliver ROI', 'optimizing-cloud-spending-devops', 'Cloud Computing', 'How organizations can eliminate infrastructure waste, configure autoscaling, and optimize Kubernetes allocations.', '<h2>The Hidden Cost of Cloud Scale</h2><p>As organizations grow their digital services, cloud infrastructure bills often rise faster than revenue. Over-provisioned databases, orphaned volumes, and idle container nodes are common sources of financial waste.</p><h3>Modern DevOps Optimization</h3><p>By integrating automated infrastructure-as-code tests, companies can enforce standard limits on resources. Dynamic autoscaling ensures that servers scale down during off-peak hours and spin up only when demand rises, maximizing cost efficiency.</p><h3>Recommendations</h3><p>Set up real-time cost tracking dashboards, implement automatic sizing recommendations for Kubernetes nodes, and use spot instances for fault-tolerant tasks.</p>', '/uploads/blog_cloud.jpg', 'Cloud cost, DevOps, Kubernetes, AWS optimization, Azure cost control', 'Aravind Nair (Cloud Architect)', 'published')
ON DUPLICATE KEY UPDATE `id`=`id`;

-- 5. FAQ Table
DROP TABLE IF EXISTS `faqs`;
CREATE TABLE `faqs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `question` TEXT NOT NULL,
  `answer` TEXT NOT NULL,
  `category` VARCHAR(100) DEFAULT 'General',
  `sort_order` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Seed FAQs
INSERT INTO `faqs` (`question`, `answer`, `category`, `sort_order`) VALUES
('What is Sisgain\'s typical engagement model for enterprise digital transformation?', 'We work via a discovery-driven approach. First, we perform an in-depth audit of your legacy workflows and data architectures. Then, we outline a fixed-timeline modernization strategy, deploy our dedicated platform engineering teams, and deliver robust systems integrated with custom dashboards.', 'Process', 1),
('How do you ensure data security and compliance with HIPAA and GDPR during modernization?', 'We integrate zero-trust structures directly into the code and database layouts. We implement automated data anonymization, end-to-end encryption in transit and at rest, and role-based access controls to satisfy strict compliance standard audits.', 'Compliance', 2),
('Can you integrate custom AI models with our proprietary legacy databases without compromising privacy?', 'Yes. We build custom API layers and local validation gateways that scrub sensitive records or run AI processing locally. This ensures no proprietary corporate data is exposed to public search models or outer endpoints.', 'AI Integration', 3),
('What cloud providers do you support for enterprise infrastructure migration?', 'We support AWS, Azure, Google Cloud Platform (GCP), and hybrid on-premise cloud configurations. We manage migrations using infrastructure-as-code tools (Terraform/Ansible) to guarantee seamless, repeatable deployments.', 'Cloud Infrastructure', 4)
ON DUPLICATE KEY UPDATE `id`=`id`;

-- 6. Leads Table
DROP TABLE IF EXISTS `leads`;
CREATE TABLE `leads` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `type` ENUM('contact', 'roi_calculator') NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `company_name` VARCHAR(100) DEFAULT NULL,
  `phone` VARCHAR(50) DEFAULT NULL,
  `message` TEXT DEFAULT NULL,
  `company_size` VARCHAR(50) DEFAULT NULL,
  `manual_workflows` INT DEFAULT NULL,
  `operational_cost` DECIMAL(12,2) DEFAULT NULL,
  `infra_spend` DECIMAL(12,2) DEFAULT NULL,
  `calculated_savings` DECIMAL(12,2) DEFAULT NULL,
  `calculated_roi_pct` DECIMAL(8,2) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. Settings Table
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `setting_key` VARCHAR(100) NOT NULL UNIQUE,
  `setting_value` TEXT DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Seed Settings
INSERT INTO `settings` (`setting_key`, `setting_value`) VALUES
('site_title', 'SISGAIN | Enterprise Digital Transformation Advisory & Engineering'),
('site_description', 'Accelerate growth with our custom AI integration, cloud-native modernization, hyperautomation pipelines, and premium platform engineering.'),
('contact_email', 'consulting@sisgain.com'),
('contact_phone', '+971 4 123 4567'),
('calendly_link', 'https://calendly.com/sisgain-consulting/strategy-call'),
('office_uae', 'Level 24, Marina Plaza, Dubai Marina, Dubai, UAE'),
('office_usa', 'Suite 800, Louisiana St, Houston, TX 77002, USA'),
('office_india', 'Phase III, Info City, Sector 34, Gurugram, HR 122001, India')
ON DUPLICATE KEY UPDATE `id`=`id`;
