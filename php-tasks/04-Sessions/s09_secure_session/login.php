<?php
require 'secure.php';
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (($_POST['username'] ?? '') === 'admin' && ($_POST['password'] ?? '') === '1234') {
        session_regenerate_id(true);                    // new session ID after login
        $_SESSION['user'] = 'admin'; $_SESSION['ip'] = $_SERVER['REMOTE_ADDR']; $_SESSION['ua'] = $_SERVER['HTTP_USER_AGENT'] ?? '';
        $_SESSION['fp'] = fingerprint();
        header('Location: dashboard.php'); exit;
    }
    $err = 'Wrong credentials';
}
h('9. Secure login (admin / 1234)');
if (isset($_GET['hijack'])) echo '<p class="err">⚠️ Suspicious change in IP / browser detected. You were logged out.</p>';
if ($err) echo "<p class='err'>$err</p>";
?><form method="post">Username <input name="username"><br>Password <input type="password" name="password"><br><button>Login</button></form>
<?php f();
