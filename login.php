<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

$logged_in = false;
$username = "";

if (isset($_SESSION['username'])) {
  $logged_in = true;
  $username = $_SESSION['username'];
}
?>
<!--comment-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | SubWoofer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .logo-img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .nav-link {
            font-size: 0.875rem;
            font-weight: 500;
            color: #4b5563;
            transition: color 0.3s ease;
        }
        
        .nav-link.active {
            color: #047857;
            border-bottom: 2px solid #047857;
            padding-bottom: 0.25rem;
        }
        
        .nav-link:hover {
            color: #047857;
        }
        
        .action-btn {
            color: #4b5563;
            transition: color 0.3s ease;
        }
        
        .action-btn:hover {
            color: #047857;
        }
        
        .cart-badge {
            position: absolute;
            top: -0.5rem;
            right: -0.5rem;
            background: #059669;
            color: white;
            font-size: 0.75rem;
            border-radius: 50%;
            width: 1.25rem;
            height: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <a href="index.php" class="flex items-center space-x-3">
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">SubWoofer</h1>
                        <p class="text-xs text-gray-500">Your very own playlist hub</p>
                    </div>
                </a>

                <!-- Navigation -->
                <nav class="hidden md:flex space-x-8">
                    <a href="index.php" class="nav-link">Home</a>
                    <a href="products.php" class="nav-link">Discover</a>
                    <a href="about_us.php" class="nav-link">About us</a>
                    <a href="contact.php" class="nav-link">My Playlist</a>
                </nav>

                <!-- Actions -->
                <div class="flex items-center space-x-4">
                    <button class="action-btn">
                        <i class="fas fa-search"></i>
                    </button>
                    
                    <?php if ($logged_in): ?>
                        <a href="cart.php" class="action-btn relative">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-badge">3</span>
                        </a>
                        <span class="text-gray-900 font-semibold"><?php echo htmlspecialchars($username) ?>!</span>
                    <?php else: ?>
                        <a href="cart.php" class="action-btn relative">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-badge">0</span>
                        </a>
                        <a href="login.php" class="action-btn">
                            <i class="fas fa-user"></i>
                        </a>
                    <?php endif; ?>
                </div>
                
                <?php if ($logged_in): ?>
                <div class="flex items-center space-x-2">
                    <form method="POST" action="php_functions/logout.php">
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 text-sm">Log out</button>
                    </form>
                    
                    <form method="POST" action="admin_dash.php">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm">Admin Dash</button>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <section id="main-content" class="login-section">
        <h2 class="title">Welcome to LuxeHome</h2>
        <p class="subtitle">Choose How To Login</p>
    
        <div class="login-container">

            <!--Customer Login Box-->
            <div class="login-box">
                <h3>Customer Login</h3>
                <form action="php_functions/user_login.php" method="POST">
                    <label>Email</label>
                    <input type="email" name="email" required>

                    <label>Password</label>
                    <input type="password" name="password" required>

                    <button type="submit" class="login-btn">Login As Customer</button>
                </form>
                <!--Forgot Password-->
                <div class="text-center"> 
                    <a href="#" class="forgot">Forgot Your Password?</a>
                    <p class="forgot-text">Don't Have An account?
                        <a href="register.php">Register</a>
                    </p>
                </div>
            </div>

            <!--Admin Login-->
            <div class="login-box"> 
                <h3>Admin Login</h3>
                <form action="admin_dash.php"> 
                    <label>Email</label>
                    <input type="email" required>

                    <label>Password</label>
                    <input type="password" required>
                    <button type="submit" class="login-btn admin">Login As Admin</button>
                </form>
                <!--Forgot Password-->
                <div class="text-center"> 
                    <a href="#" class="forgot">Forgot Your Password?</a>
                    <p class="forgot-text">Don't Have An account?
                        <a href="register.php">Register</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Footer -->
                <div>
                <div class="flex items-center space-x-3 mb-4">
                    <div>
                    <h3 class="text-lg font-bold text-white">SubWoofer</h3>
                    <p class="text-sm text-gray-400">Playlist Hub</p>
                    </div>
                </div>
                <p class="text-gray-400 text-sm mb-4">
                    Build your own playlists and share them with your friends. You can like, comment and collaborate on each others playlists, 
                    Have fun PlayListing!
                </p>
                </div>

                <!-- Quick Links -->
                <div>
                <h4 class="text-white font-semibold mb-3">Quick Links</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="index.php" class="hover:text-white">Home</a></li>
                    <li><a href="products.php" class="hover:text-white">Discover</a></li>
                    <li><a href="about_us.php" class="hover:text-white">About us</a></li>
                    <li><a href="contact.php" class="hover:text-white">My Playlist</a></li>
                </ul>
                </div>

                <!-- Contact -->
                <div>
                <h4 class="text-white font-semibold mb-3">Contact</h4>
                <ul class="space-y-2 text-sm">
                    <li>hello@luxehome.com</li>
                    <li>1-800-LUXE-HOME</li>
                    <li>Mon–Fri: 9am–6pm EST</li>
                </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-4 text-center text-sm text-gray-400">
                © 2025 LuxeHome. All rights reserved.
                <a href="#" class="hover:text-white ml-2">Privacy Policy</a> |
                <a href="#" class="hover:text-white ml-2">Terms of Service</a>
            </div>
        </div>
    </footer>

    <script src="js/script.js"></script>
    <script src="js/accessibility.js"></script>
</body>
</html>