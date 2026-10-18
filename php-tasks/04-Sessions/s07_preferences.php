<?php
require 'inc.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['theme'] = in_array($_POST['theme'] ?? '', ['light', 'dark'], true) ? $_POST['theme'] : 'light';
    $_SESSION['lang']  = in_array($_POST['lang'] ?? '', ['en', 'ar'], true) ? $_POST['lang'] : 'en';
    header('Location: s07_preferences.php'); exit;
}
$theme = $_SESSION['theme'] ?? 'light'; $lang = $_SESSION['lang'] ?? 'en';
$t = ['en' => ['Hello! Choose your preferences', 'Theme', 'Language', 'Save'], 'ar' => ['مرحباً! اختر تفضيلاتك', 'الوضع', 'اللغة', 'حفظ']][$lang];
h('7. Preferences in session', $theme === 'dark' ? 'background:#222;color:#fff' : '');
echo '<div dir="' . ($lang === 'ar' ? 'rtl' : 'ltr') . '"><h3>' . $t[0] . '</h3><form method="post">' . $t[1] . ' <select name="theme">';
foreach (['light', 'dark'] as $o) echo "<option" . ($theme === $o ? ' selected' : '') . ">$o</option>";
echo '</select><br>' . $t[2] . ' <select name="lang"><option value="en"' . ($lang === 'en' ? ' selected' : '') . '>English</option><option value="ar"' . ($lang === 'ar' ? ' selected' : '') . '>العربية</option></select><br><button>' . $t[3] . '</button></form></div>';
f();
