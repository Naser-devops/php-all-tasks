<?php
session_start();
$_SESSION['refresh_count'] = ($_SESSION['refresh_count'] ?? 0) + 1;     // +1 on every page load / refresh
if (isset($_GET['reset'])) { unset($_SESSION['refresh_count']); header('Location: t7_refresh_counter.php'); exit; }
?><!DOCTYPE html><html><head><meta charset="UTF-8"><link rel="stylesheet" href="style.css"><title>Task 7</title></head><body>
<h2>Task 7: Refresh counter</h2><div class="box">This page was loaded <b class="ok"><?= $_SESSION['refresh_count'] ?></b> time(s) in this session.<br>
Press F5 to refresh. <a href="?reset=1">Reset</a></div></body></html>
