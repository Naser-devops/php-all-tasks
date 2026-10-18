<?php
$file = __DIR__ . '/counter.txt';
$fp = fopen($file, 'c+');                          // create if it doesn't exist, don't truncate
if (!$fp) die('Cannot open counter file');
if (flock($fp, LOCK_EX)) {                         // exclusive lock: others wait here
    $count = (int)trim(stream_get_contents($fp));  // read
    $count++;                                      // increment
    ftruncate($fp, 0); rewind($fp);
    fwrite($fp, (string)$count);                   // write
    fflush($fp);
    flock($fp, LOCK_UN);                           // release the lock
} else die('Could not lock the file');
fclose($fp);
echo "This page has been visited <b>$count</b> times.";
