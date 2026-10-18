<?php
require '../inc.php';
if (!empty($_SESSION['username'])) { header('Location: protected.php'); exit; }
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // hard-coded credentials (as the task allows)
    if (($_POST['username'] ?? '') === 'admin' && ($_POST['password'] ?? '') === '1234') {
        session_regenerate_id(true);
        $_SESSION['username'] = 'admin';
        header('Location: protected.php'); exit;
    }
    $err = 'Wrong username or password';
}
h('1. Login (admin / 1234)');
if ($err) echo "<p class='err'>" . e($err) . '</p>';
?><form method="post">Username <input name="username" required><br>Password <input type="password" name="password" required><br><button>Login</button></form>
<?php f();
