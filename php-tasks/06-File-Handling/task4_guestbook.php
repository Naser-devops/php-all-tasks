<?php
$file = __DIR__ . '/guestbook.txt';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text = trim($_POST['entry'] ?? '');
    if ($text !== '') {
        $text = str_replace(["\r", "\n"], ' ', $text);                                    // keep each entry on ONE line
        file_put_contents($file, '[' . date('Y-m-d H:i:s') . '] ' . $text . PHP_EOL, FILE_APPEND | LOCK_EX);
    }
    header('Location: task4_guestbook.php'); exit;
}
?><!DOCTYPE html><html><head><meta charset="UTF-8"><title>Guestbook</title></head><body>
<h2>Guestbook</h2><form method="post"><textarea name="entry" rows="3" cols="40" required></textarea><br><button>Sign</button></form><h3>Entries</h3>
<?php if (file_exists($file)) foreach (file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $l) echo '<p>' . htmlspecialchars($l) . '</p>'; ?></body></html>
