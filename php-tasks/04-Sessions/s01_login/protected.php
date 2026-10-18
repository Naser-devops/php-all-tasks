<?php
require '../inc.php';
if (empty($_SESSION['username'])) { header('Location: login.php'); exit; }     // guard
h('Protected page');
?><div class="box ok">Welcome, <b><?= e($_SESSION['username']) ?></b>! Only logged-in users can see this.</div>
<a href="logout.php"><button>Logout</button></a>
<?php f();
