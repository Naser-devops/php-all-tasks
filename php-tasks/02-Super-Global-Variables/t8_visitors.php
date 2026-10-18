<?php
session_start();
$file = __DIR__ . '/visitors.txt';
$fp = fopen($file, 'c+');                // create if missing, read/write
flock($fp, LOCK_EX);                     // protect from simultaneous visitors
$count = (int)stream_get_contents($fp);
if (empty($_SESSION['counted'])) {       // count each visitor (session) only once
    $count++; $_SESSION['counted'] = true;
    ftruncate($fp, 0); rewind($fp); fwrite($fp, (string)$count);
}
flock($fp, LOCK_UN); fclose($fp);
?><!DOCTYPE html><html><head><meta charset="UTF-8"><link rel="stylesheet" href="style.css"><title>Task 8</title></head><body>
<h2>Task 8: Number of visitors</h2><div class="box">Total visitors: <b class="ok"><?= $count ?></b><br>
<small>Refreshing doesn't add a visitor. Open in another browser / private window to add one.</small></div></body></html>
