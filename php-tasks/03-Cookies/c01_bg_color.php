<?php
require 'inc.php';
$colors = ['Red' => '#ffcdd2', 'Blue' => '#bbdefb', 'Green' => '#c8e6c9'];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($colors[$_POST['color'] ?? ''])) {   // whitelist = safe
    setcookie('bg_color', $_POST['color'], time() + 30 * 24 * 3600, '/');               // save for 30 days
    header('Location: c01_bg_color.php'); exit;
}
$saved = $_COOKIE['bg_color'] ?? '';
h('1. Background color preference', isset($colors[$saved]) ? 'background:' . $colors[$saved] : '');
?>
<form method="post"><select name="color"><?php foreach ($colors as $n => $c) echo "<option" . ($saved === $n ? ' selected' : '') . ">$n</option>"; ?></select> <button>Save</button></form>
<p>Saved color: <b><?= e($saved ?: 'none yet') ?></b></p>
<?php f();
