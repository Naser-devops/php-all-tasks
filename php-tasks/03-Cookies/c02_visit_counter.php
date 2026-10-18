<?php
require 'inc.php';
$visits = (int)($_COOKIE['visits'] ?? 0) + 1;                 // first visit => 0 + 1 = 1
setcookie('visits', (string)$visits, time() + 365 * 24 * 3600, '/');
h('2. Visit counter with cookies');
?><div class="box">You have visited this page <b class="ok"><?= $visits ?></b> time(s).</div><p>Refresh the page to increase it.</p>
<?php f();
