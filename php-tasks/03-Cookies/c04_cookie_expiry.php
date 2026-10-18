<?php
require 'inc.php';
if (isset($_GET['set'])) {
    $until = time() + 60;                                   // expires after 1 minute
    setcookie('temp', 'I will disappear in 1 minute', $until, '/');
    setcookie('temp_until', (string)$until, $until, '/');
    header('Location: c04_cookie_expiry.php'); exit;
}
h('4. Cookie expiry experiment');
echo '<p><a href="?set=1"><button>Set cookie (60 seconds)</button></a></p>';
if (isset($_COOKIE['temp'])) {
    $left = max(0, (int)$_COOKIE['temp_until'] - time());
    echo '<div class="box ok">Cookie value: <b>' . e($_COOKIE['temp']) . '</b><br>Time left: ' . $left . ' s</div>';
    echo '<meta http-equiv="refresh" content="5">';         // auto refresh to watch it expire
} else echo '<div class="box err">Cookie not found: it expired (or was never set).</div>';
f();
