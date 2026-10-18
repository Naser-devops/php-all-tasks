<?php
require 'inc.php';
if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));       // 1) generate token, keep in session
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf_token'] ?? '')) {              // 3) compare token
        http_response_code(403); $msg = '<p class="err">❌ Invalid CSRF token. Request rejected.</p>';
    } else {
        $msg = '<p class="ok">✅ Form accepted: ' . e($_POST['comment'] ?? '') . '</p>';
        $_SESSION['csrf'] = bin2hex(random_bytes(32));                              // new token after each success
    }
}
h('8. CSRF protection');
echo $msg;
?><form method="post"><input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf']) ?>">   <!-- 2) hidden field -->
<input name="comment" placeholder="Comment" required> <button>Send</button></form>
<p><small>Try it: open DevTools, change the hidden token value, then submit.</small></p>
<?php f();
