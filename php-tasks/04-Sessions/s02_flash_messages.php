<?php
require 'inc.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $_SESSION['flash'] = $name === '' ? ['error', 'Name is required!'] : ['success', "Thanks $name, form submitted!"];
    header('Location: s02_flash_messages.php'); exit;
}
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);                         // shown once, then removed => disappears on reload
h('2. Flash messages');
if ($flash) echo '<div class="box ' . ($flash[0] === 'success' ? 'ok' : 'err') . '">' . e($flash[1]) . '</div>';
?><form method="post"><input name="name" placeholder="Your name"> <button>Send</button></form><p>Reload the page: the message is gone.</p>
<?php f();
