<?php
require 'config.php';
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (($_POST['username'] ?? '') === 'admin' && ($_POST['password'] ?? '') === '1234') {
        session_regenerate_id(true); $_SESSION['user'] = 'admin'; $_SESSION['last_activity'] = time();
        header('Location: page.php'); exit;
    }
    $err = 'Wrong credentials';
}
h('5. Login (admin / 1234)');
if (isset($_GET['expired'])) echo '<p class="err">Session expired due to inactivity. Please log in again.</p>';
if ($err) echo "<p class='err'>$err</p>";
?><form method="post">Username <input name="username"><br>Password <input type="password" name="password"><br><button>Login</button></form>
<?php f();
