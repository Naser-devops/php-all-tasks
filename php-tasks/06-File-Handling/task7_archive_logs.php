<?php
$dir = __DIR__ . '/archives';
if (!is_dir($dir)) mkdir($dir, 0755, true);                    // create it if missing
$copied = 0;
foreach (scandir(__DIR__) as $file) {
    if (is_file($file) && strtolower(pathinfo($file, PATHINFO_EXTENSION)) === 'log') {   // glob('*.log') also works
        copy($file, "$dir/$file"); $copied++; echo "Copied: " . htmlspecialchars($file) . '<br>';
    }
}
echo "<b>$copied</b> log file(s) archived.";
