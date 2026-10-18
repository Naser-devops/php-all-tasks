<?php
require '../inc.php';
if (empty($_SESSION['username'])) { header('Location: login.php'); exit; }
h('Dashboard');
echo '<div class="box ok">Hello <b>' . e($_SESSION['username']) . '</b>, you are logged in.</div><a href="logout.php"><button>Logout</button></a>';
f();
