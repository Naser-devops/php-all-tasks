<?php
require 'inc.php';
if (isset($_GET['set'])) {
    setcookie('secure_demo', 'top-secret', [
        'expires' => time() + 3600, 'path' => '/',
        'secure' => true,        // only sent over HTTPS (browsers also allow it on http://localhost)
        'httponly' => true,      // JavaScript cannot read it
        'samesite' => 'Strict',
    ]);
    header('Location: c07_secure_cookie.php'); exit;
}
h('7. Secure + HttpOnly cookie');
?><p><a href="?set=1"><button>Set secure cookie</button></a></p>
<div class="box">PHP sees: <b><?= e($_COOKIE['secure_demo'] ?? 'nothing (not set, or your site is not HTTPS/localhost)') ?></b></div>
<div class="box">JavaScript sees (document.cookie): <b id="js"></b></div>
<script>
  document.getElementById('js').textContent = document.cookie.includes('secure_demo')
    ? 'secure_demo is VISIBLE (not HttpOnly!)' : 'secure_demo is HIDDEN  -> HttpOnly works';
</script>
<?php f();
