<?php
$file = fopen('welcome.txt', 'w');                       // 'w' = create / overwrite
if ($file === false) die('Cannot create the file');
fwrite($file, 'Welcome to PHP File Handling!');
fclose($file);                                          // always close
echo 'welcome.txt created. Content: ' . htmlspecialchars(file_get_contents('welcome.txt'));
