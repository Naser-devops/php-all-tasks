<?php
require 'inc.php';
h('4. Server information with $_SERVER');
$rows = [
  "Server IP address"      => $_SERVER['SERVER_ADDR'] ?? 'n/a',
  'Server name'            => $_SERVER['SERVER_NAME'] ?? 'n/a',
  'Current script name'    => $_SERVER['SCRIPT_NAME'] ?? 'n/a',
  'Browser (user agent)'   => $_SERVER['HTTP_USER_AGENT'] ?? 'n/a',
  'Request method'         => $_SERVER['REQUEST_METHOD'] ?? 'n/a',
  "Client's IP address"    => $_SERVER['REMOTE_ADDR'] ?? 'n/a',
];
echo '<table border="1" cellpadding="8" style="border-collapse:collapse;background:#fff">';
foreach ($rows as $k => $v) echo '<tr><th align="left">' . e($k) . '</th><td>' . e($v) . '</td></tr>';
echo '</table>'; f();
