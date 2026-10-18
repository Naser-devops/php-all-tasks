<?php
// Task 2: URL box + GO button -> redirect to that URL
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = trim($_POST['url'] ?? '');
    if ($url !== '' && !preg_match('#^https?://#i', $url)) $url = 'https://' . $url;   // add scheme if missing
    if (filter_var($url, FILTER_VALIDATE_URL) && preg_match('#^https?://#i', $url)) {  // only http/https (security)
        header('Location: ' . $url); exit;
    }
    $error = 'Please enter a valid URL';
}
?><!DOCTYPE html><html><head><meta charset="UTF-8"><link rel="stylesheet" href="style.css"><title>Task 2</title></head><body>
<h2>Task 2: Mini search engine</h2>
<form method="post"><input type="text" name="url" placeholder="example.com" size="40" required> <button>GO</button></form>
<?php if (!empty($error)) echo "<p class='err'>$error</p>"; ?></body></html>
