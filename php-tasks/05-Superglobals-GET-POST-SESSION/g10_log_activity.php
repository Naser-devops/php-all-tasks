<?php
require 'inc.php';
if (!isset($_SESSION['first_visit'])) $_SESSION['first_visit'] = date('Y-m-d H:i:s');   // set ONLY once
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
h('10. Logging activity ($_SESSION + $_SERVER)');
?><div class="box">First visit time: <b><?= e($_SESSION['first_visit']) ?></b><br>Current time: <b><?= date('Y-m-d H:i:s') ?></b><br>Your IP address: <b><?= e($ip) ?></b></div>
<p>Refresh: the first visit time never changes while the session is alive.</p>
<?php f();
