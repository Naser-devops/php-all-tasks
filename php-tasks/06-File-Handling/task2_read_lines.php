<?php
$fp = fopen('fruits.txt', 'r') or die('fruits.txt not found');
echo '<ul>';
while (($line = fgets($fp)) !== false) {                // read one line at a time
    $line = trim($line);
    if ($line !== '') echo '<li>' . htmlspecialchars($line) . '</li>';
}
echo '</ul>';
fclose($fp);
