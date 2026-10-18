<?php
require 'secure.php';
if (isset($_GET['simulate'])) $_SESSION['fp'] = 'stolen-from-another-browser';   // demo: pretend the fingerprint changed
require_secure_login();
h('Dashboard');
?><div class="box">Session ID: <code><?= e(session_id()) ?></code><br>Saved IP: <?= e($_SESSION['ip']) ?><br>Saved browser: <small><?= e($_SESSION['ua']) ?></small></div>
<a href="?simulate=1"><button>Simulate session hijacking</button></a> <a href="login.php">Logout</a>
<?php f();
