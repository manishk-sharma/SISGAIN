<?php
// admin/login.php - Administration Secure Sign-in
require_once __DIR__ . '/../config/db.php';

// Redirect if already authenticated
if (is_admin_logged_in()) {
    header("Location: /admin/index.php");
    exit;
}

$csrf_token = generate_csrf_token();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';

    if (!verify_csrf_token($token)) {
        $error = 'Security session validation failed.';
    } else {
        $username = isset($_POST['username']) ? sanitize($_POST['username']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        if (empty($username) || empty($password)) {
            $error = 'Please fill out both username and password fields.';
        } else {
            try {
                // Find matching admin record
                $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ? LIMIT 1");
                $stmt->execute([$username]);
                $admin = $stmt->fetch();

                if ($admin && password_verify($password, $admin['password_hash'])) {
                    // Password correct, establish session
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_username'] = $admin['username'];
                    $_SESSION['admin_id'] = $admin['id'];
                    
                    set_flash_message('success', 'Authenticated successfully. Welcome back to the Advisory Hub.');
                    header("Location: /admin/index.php");
                    exit;
                } else {
                    $error = 'Invalid credentials entered.';
                }
            } catch (Exception $e) {
                $error = 'System failure: ' . $e->getMessage();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Systems Access Login | Sisgain Advisory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        darkBg: '#060816',
                        darkCard: '#0D1324',
                        accentBlue: '#3B82F6',
                        neonCyan: '#06B6D4'
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        space: ['Space Grotesk', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-darkBg text-white flex items-center justify-center min-h-screen p-6">
    <div class="w-full max-w-md space-y-6">
        <!-- Logo -->
        <div class="text-center space-y-2">
            <span class="text-2xl font-bold font-space bg-gradient-to-r from-blue-500 to-cyan-400 bg-clip-text text-transparent">
                SISGAIN SYSTEMS
            </span>
            <p class="text-zinc-500 text-xs uppercase tracking-wider">Secure Administrative Gateway</p>
        </div>

        <!-- Login Form Card -->
        <div class="glass-card p-8 rounded-3xl border border-white/10 bg-darkCard/40">
            <h2 class="text-lg font-bold font-space text-white mb-6">Credential Verification</h2>
            
            <?php if (!empty($error)): ?>
                <div class="p-3 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl text-xs mb-4">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="/admin/login.php" method="POST" class="space-y-4">
                <!-- CSRF Token -->
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">

                <div class="space-y-2">
                    <label for="username" class="text-[9px] uppercase font-bold text-zinc-400">Username</label>
                    <input type="text" id="username" name="username" required class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-blue-500 transition-colors">
                </div>

                <div class="space-y-2">
                    <label for="password" class="text-[9px] uppercase font-bold text-zinc-400">Password</label>
                    <input type="password" id="password" name="password" required class="w-full bg-darkBg border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-blue-500 transition-colors">
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-medium py-3 rounded-xl transition-all shadow-lg flex items-center justify-center text-xs">
                    <i data-lucide="shield-check" class="w-4 h-4 mr-2"></i>
                    Verify Session
                </button>
            </form>
        </div>

        <!-- Back to main -->
        <div class="text-center">
            <a href="/index.php" class="text-zinc-500 hover:text-white transition-colors text-xs inline-flex items-center">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5 mr-1"></i>
                Return to Landing Page
            </a>
        </div>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            lucide.createIcons();
        });
    </script>
</body>
</html>
