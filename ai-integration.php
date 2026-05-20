<?php
require_once __DIR__ . '/config/db.php';
$meta_title = "AI & Machine Learning Integration | Sisgain Enterprise Solutions";
$meta_description = "Deploy enterprise AI solutions: custom LLMs, RAG pipelines, predictive analytics, computer vision, and cognitive automation. 200+ AI models deployed across 15 industries.";
$meta_keywords = "Enterprise AI, Machine Learning, LLM Deployment, RAG Pipeline, Predictive Analytics, Computer Vision, Sisgain";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<!-- HERO -->
<section class="relative py-32 md:py-40 px-6 md:px-12 overflow-hidden">
    <div class="absolute top-20 right-0 w-[600px] h-[600px] bg-cyan-600/8 rounded-full filter blur-[120px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-center relative z-10">
        <div class="lg:col-span-7 space-y-8" data-aos="fade-right">
            <span class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full text-xs font-semibold bg-cyan-500/10 border border-cyan-500/20 text-cyan-400">
                <i data-lucide="brain-circuit" class="w-3.5 h-3.5"></i><span>Artificial Intelligence</span>
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold font-space leading-[1.1] tracking-tight">
                Enterprise AI Integration &<br><span class="bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">Cognitive Automation</span>
            </h1>
            <p class="text-zinc-400 text-lg leading-relaxed max-w-2xl">
                Transform enterprise decision-making with custom LLM deployments, RAG pipeline architectures, and predictive analytics engines that deliver measurable intelligence at scale.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="/contact.php" class="btn-primary text-center">Schedule AI Strategy Call <i data-lucide="arrow-right" class="w-4 h-4 ml-2 inline-block"></i></a>
                <a href="/roi-calculator.php" class="btn-secondary text-center">Calculate AI ROI</a>
            </div>
        </div>
        <div class="lg:col-span-5 space-y-4" data-aos="fade-left">
            <div class="glass-card p-6 rounded-2xl flex items-center space-x-4"><div class="w-12 h-12 rounded-xl bg-cyan-500/10 text-cyan-400 flex items-center justify-center"><i data-lucide="zap" class="w-5 h-5"></i></div><div><p class="text-2xl font-bold font-space text-white">10x</p><p class="text-xs text-zinc-500">Faster Decision Logic</p></div></div>
            <div class="glass-card p-6 rounded-2xl flex items-center space-x-4"><div class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center"><i data-lucide="target" class="w-5 h-5"></i></div><div><p class="text-2xl font-bold font-space text-white">85%</p><p class="text-xs text-zinc-500">Accuracy Improvement</p></div></div>
            <div class="glass-card p-6 rounded-2xl flex items-center space-x-4"><div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center"><i data-lucide="trending-down" class="w-5 h-5"></i></div><div><p class="text-2xl font-bold font-space text-white">60%</p><p class="text-xs text-zinc-500">Cost Reduction</p></div></div>
        </div>
    </div>
</section>

<!-- WHAT WE DELIVER -->
<section class="py-24 md:py-32 px-6 md:px-12 bg-[#040610]">
    <div class="max-w-7xl mx-auto space-y-16">
        <div class="text-center max-w-3xl mx-auto space-y-4" data-aos="fade-up">
            <span class="text-xs uppercase font-semibold text-cyan-400 tracking-wider">Capabilities</span>
            <h2 class="text-3xl md:text-5xl font-bold font-space">What We Deliver</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $features = [
                ['brain','Custom LLM Deployment','Fine-tune and deploy domain-specific large language models with enterprise-grade security, data isolation, and inference optimization for sub-100ms response times.','cyan'],
                ['search','RAG Pipeline Architecture','Build production-grade Retrieval-Augmented Generation systems using vector databases, semantic search, and your proprietary data for contextually accurate responses.','blue'],
                ['bar-chart-3','Predictive Analytics Engines','Deploy forecasting models for demand planning, risk assessment, and operational optimization using time-series analysis and ensemble learning techniques.','purple'],
                ['eye','Computer Vision Systems','Implement visual inspection, document extraction, and real-time object detection systems using convolutional neural networks and edge computing.','emerald'],
                ['message-square','NLP & Conversational AI','Build intelligent chatbots, sentiment analysis engines, and automated document classification systems that understand context and intent.','indigo'],
                ['shield','AI Governance & Ethics','Establish model monitoring frameworks, bias detection pipelines, and explainability dashboards to ensure responsible AI deployment at scale.','rose']
            ];
            foreach ($features as $fi => $f):
            ?>
            <div class="glass-card p-8 rounded-3xl group" data-aos="fade-up" data-aos-delay="<?= ($fi % 3) * 80 ?>">
                <div class="w-12 h-12 rounded-2xl bg-<?= $f[3] ?>-500/10 text-<?= $f[3] ?>-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i data-lucide="<?= $f[0] ?>" class="w-6 h-6"></i>
                </div>
                <h3 class="text-lg font-bold font-space text-white mb-3"><?= $f[1] ?></h3>
                <p class="text-zinc-400 text-sm leading-relaxed"><?= $f[2] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- TECHNOLOGY STACK -->
<section class="py-24 px-6 md:px-12">
    <div class="max-w-5xl mx-auto text-center space-y-8" data-aos="fade-up">
        <h2 class="text-3xl md:text-4xl font-bold font-space">Technology Stack</h2>
        <div class="flex flex-wrap justify-center gap-3">
            <?php foreach (['TensorFlow','PyTorch','OpenAI','LangChain','Pinecone','Hugging Face','NVIDIA CUDA','scikit-learn','Apache Spark MLlib','Weights & Biases','MLflow','ONNX Runtime'] as $tech): ?>
            <span class="px-4 py-2 rounded-full text-xs font-medium bg-white/5 border border-white/10 text-zinc-300 hover:border-cyan-500/30 hover:text-cyan-400 transition-all"><?= $tech ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- STATS -->
<section class="py-24 px-6 md:px-12 bg-[#040610]">
    <div class="max-w-7xl mx-auto grid grid-cols-2 lg:grid-cols-4 gap-8">
        <?php $stats = [['10','x','Faster Decisions','cyan'],['85','%','Accuracy Gain','blue'],['60','%','Cost Reduction','emerald'],['200','+','Models Deployed','purple']];
        foreach ($stats as $si => $s): ?>
        <div class="glass-card p-8 rounded-3xl text-center" data-aos="zoom-in" data-aos-delay="<?= $si*80 ?>">
            <p class="text-4xl md:text-5xl font-bold font-space text-<?= $s[3] ?>-400"><span class="counter-value" data-target="<?= $s[0] ?>"><?= $s[0] ?></span><?= $s[1] ?></p>
            <p class="text-white font-semibold text-sm mt-3"><?= $s[2] ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/cta.php'; require_once __DIR__ . '/includes/footer.php'; ?>
