<?php
require 'config.php';
check_session();
h('Private page');
$left = TIMEOUT - (time() - $_SESSION['last_activity']);
?><div class="box">Hello <?= e($_SESSION['user']) ?>. Timeout after <b><?= TIMEOUT ?></b> seconds of inactivity.<br>Do nothing, then refresh after that time.</div>
<a href="login.php?logout=1" onclick="return true">Login page</a>
<?php f();
