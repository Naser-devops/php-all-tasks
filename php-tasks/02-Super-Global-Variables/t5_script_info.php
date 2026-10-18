<?php
$scriptName = $_SERVER['SCRIPT_NAME'];                       // e.g. /02-Super-Global-Variables/t5_script_info.php
$projectName = basename(dirname($scriptName));                // folder that contains the script = project name
?><!DOCTYPE html><html><head><meta charset="UTF-8"><link rel="stylesheet" href="style.css"><title>Task 5</title></head><body>
<h2>Task 5: Project & script name</h2><div class="box">
Project name: <b><?= htmlspecialchars($projectName) ?></b><br>
Script name (SCRIPT_NAME): <b><?= htmlspecialchars($scriptName) ?></b><br>
File only (basename): <b><?= htmlspecialchars(basename($_SERVER['PHP_SELF'])) ?></b><br>
Full path (SCRIPT_FILENAME): <b><?= htmlspecialchars($_SERVER['SCRIPT_FILENAME']) ?></b></div></body></html>
