<?php date_default_timezone_set('Asia/Amman'); ?>
<!DOCTYPE html><html><head><meta charset="UTF-8"><link rel="stylesheet" href="style.css"><title>Task 6</title></head><body>
<h2>Task 6: Page requested time</h2><div class="box">
Timestamp: <b><?= $_SERVER['REQUEST_TIME'] ?></b><br>
Readable: <b><?= date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']) ?></b><br>
With microseconds: <b><?= $_SERVER['REQUEST_TIME_FLOAT'] ?></b></div></body></html>
