<?php
// Usage: task9_delete_report.php?file=report1.pdf
$baseDir = realpath(__DIR__ . '/downloads');
$name = $_GET['file'] ?? '';
if ($name === '' || $name !== basename($name) || str_contains($name, "\0") || !preg_match('/^[A-Za-z0-9._-]+$/', $name))
    die('❌ Invalid file name');                                     // blocks ../ , slashes, null bytes ...
$path = realpath($baseDir . DIRECTORY_SEPARATOR . $name);            // resolve the real final path
if ($path === false || strpos($path, $baseDir . DIRECTORY_SEPARATOR) !== 0 || !is_file($path))
    die('❌ File not found or outside the downloads folder');         // must stay INSIDE downloads/
echo unlink($path) ? '✅ Deleted: ' . htmlspecialchars($name) : '❌ Could not delete the file';
