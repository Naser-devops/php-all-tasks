<?php
require 'inc.php';
$levels = ['Beginner', 'Intermediate', 'Advanced'];
if (!isset($_COOKIE['user_level'])) setcookie('user_level', 'Beginner', time() + 3600 * 24, '/');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && in_array($_POST['level'] ?? '', $levels, true)) {
    setcookie('user_level', $_POST['level'], time() + 3600 * 24, '/');      // same name = update
    header('Location: c09_cookie_update.php?updated=1'); exit;
}
h('9. Cookie update');
if (isset($_GET['updated'])) echo '<p class="ok">Updated!</p>';
?><div class="box">User Level: <b><?= e($_COOKIE['user_level'] ?? 'Beginner (first visit, refresh to see the cookie)') ?></b></div>
<form method="post">New level <select name="level"><?php foreach ($levels as $l) echo "<option>$l</option>"; ?></select> <button>Update</button></form>
<?php f();
