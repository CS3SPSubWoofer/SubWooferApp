<?php 
// login.php — Step 1: authenticate, create a session, show what we store. 
session_start(); 
// require_once __DIR__ . '/partials.php'; // pulls in db-conn.php ($pdo) 
$error = ''; // Logout. 
if (isset($_GET['logout'])) { 
logActivity('logout', 'Logged out: ' . ($_SESSION['username'] ?? 'guest'), 'login.php'); 
session_destroy(); header('Location: login.php'); 
exit; 
} // Login submission.
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
$username = $_POST['username'] ?? ''; 
$password = $_POST['password'] ?? ''; 
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ?"); 
$stmt->execute([$username, $password]); 
$user = $stmt->fetch(); 

if ($user) {
 // The session — the data the server will remember about this user. 
$_SESSION['user_id'] = $user['id']; 
$_SESSION['username'] = $user['username']; 
$_SESSION['full_name'] = $user['full_name']; 
$_SESSION['role'] = $user['role']; 
$_SESSION['email'] = $user['email']; 
$_SESSION['login_time'] = date('H:i:s'); 
logActivity('login', 'Logged in as ' . $user['username'], 'login.php'); 
header('Location: search.php'); 
exit; 
} else { 
$error = 'Invalid username or password.'; 
logActivity('login_failed', 'Tried username: ' . $username, 'login.php'); 
} 
}

pageHead('Car Parts — Login'); 
?> 
<div class="bar"> 
<strong>Car Parts Store</strong> 
<span> 
<?php if (!empty($_SESSION['username'])): ?> Logged in as <?= htmlspecialchars($_SESSION['username']) ?> 
<a href="login.php?logout=1">Log out</a> 
<?php else: ?> Not logged in <?php endif; ?> 
</span> 
</div> 
<h1>Login</h1> 
<?php if (!empty($_SESSION['username'])): ?> 
<div class="card">You are logged in. <a href="search.php">Go to search →</a></div> 
<?php else: ?> 
<div class="card"> 
<?php if ($error): ?>
<p class="err"><?= htmlspecialchars($error) ?></p>
<?php endif; ?> 
<form method="post"> 
<label>Username</label> 
<input class="medium" name="username" autofocus> 
<label>Password</label> 
<input class="medium" type="password" name="password"> 
<br>
<button type="submit">Log in</button> 
</form> 
<p class="hint">Try: <code>alice / password</code>, <code>bob / bob2024</code>, <code>admin / admin123</code>
</p> 
</div> 
<?php endif; ?> 
<?php renderPanel('login.php'); echo '</body></html>';