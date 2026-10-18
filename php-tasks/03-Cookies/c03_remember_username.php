<?php
require 'inc.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = trim($_POST['username'] ?? '');
    if ($u !== '') setcookie('username', $u, time() + 7 * 24 * 3600, '/');
    header('Location: c03_remember_username.php?ok=1'); exit;
}
h('3. Remember username');
if (isset($_GET['ok'])) echo '<p class="ok">Logged in (username remembered)</p>';
?><form method="post">Username <input name="username" value="<?= e($_COOKIE['username'] ?? '') ?>" required><br>
Password <input type="password" name="password"><br><button>Login</button></form>
<?php f();
