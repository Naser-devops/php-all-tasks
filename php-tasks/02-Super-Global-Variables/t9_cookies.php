<?php
// Task 9: set a cookie with every option, read all cookies, delete them
$action = $_GET['action'] ?? '';
if ($action === 'set') {
    setcookie('cookie_name', 'cookie_value', [
        'expires'  => time() + 3600,    // [expiry_time] 1 hour
        'path'     => '/',              // [cookie_path]
        'domain'   => '',               // [domain] empty = current host
        'secure'   => false,            // [secure] true = HTTPS only (false so it works on http://localhost)
        'httponly' => true,             // [httponly] hidden from JavaScript
        'samesite' => 'Lax',
    ]);
    setcookie('theme', 'dark', time() + 3600, '/');
    header('Location: t9_cookies.php?msg=Cookies+created'); exit;
}
if ($action === 'delete') {
    foreach (array_keys($_COOKIE) as $name) {
        if ($name === session_name()) continue;
        setcookie($name, '', time() - 3600, '/');       // expiry in the past = delete
    }
    header('Location: t9_cookies.php?msg=Cookies+deleted'); exit;
}
?><!DOCTYPE html><html><head><meta charset="UTF-8"><link rel="stylesheet" href="style.css"><title>Task 9</title></head><body>
<h2>Task 9: Cookies</h2>
<?php if (isset($_GET['msg'])) echo '<p class="ok">' . htmlspecialchars($_GET['msg']) . '</p>'; ?>
<p><a href="?action=set"><button>1) Create cookies</button></a> <a href="t9_cookies.php"><button>2) Show cookies</button></a> <a href="?action=delete"><button>3) Delete cookies</button></a></p>
<div class="box"><b>All cookies:</b>
<?php if (!$_COOKIE) echo '<p>No cookies</p>'; else { echo '<ul>'; foreach ($_COOKIE as $k => $v) echo '<li>' . htmlspecialchars("$k = $v") . '</li>'; echo '</ul>'; } ?></div>
</body></html>
