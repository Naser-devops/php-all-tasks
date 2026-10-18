<?php
require 'inc.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $theme = in_array($_POST['theme'] ?? '', ['light', 'dark'], true) ? $_POST['theme'] : 'light';
    $lang  = in_array($_POST['lang'] ?? '', ['en', 'ar'], true) ? $_POST['lang'] : 'en';
    setcookie('pref_theme', $theme, time() + 30 * 86400, '/'); setcookie('pref_lang', $lang, time() + 30 * 86400, '/');
    header('Location: g06_cookie_preferences.php'); exit;
}
$theme = $_COOKIE['pref_theme'] ?? 'light'; $lang = $_COOKIE['pref_lang'] ?? 'en';
$text = $lang === 'ar' ? 'مرحباً بك في موقعي' : 'Welcome to my website';
h('6. Preferences with $_COOKIE', $theme === 'dark' ? 'background:#222;color:#fff' : '');
?><div dir="<?= $lang === 'ar' ? 'rtl' : 'ltr' ?>"><h3><?= $text ?></h3></div>
<form method="post">Theme <select name="theme"><option value="light" <?= $theme === 'light' ? 'selected' : '' ?>>Light</option><option value="dark" <?= $theme === 'dark' ? 'selected' : '' ?>>Dark</option></select>
Language <select name="lang"><option value="en" <?= $lang === 'en' ? 'selected' : '' ?>>English</option><option value="ar" <?= $lang === 'ar' ? 'selected' : '' ?>>العربية</option></select> <button>Save</button></form>
<?php f();
