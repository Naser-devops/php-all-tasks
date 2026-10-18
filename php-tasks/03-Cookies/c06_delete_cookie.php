<?php
require 'inc.php';
$msg = '';
if (isset($_GET['set']))    { setcookie('fruit', 'Mango', time() + 3600, '/'); header('Location: c06_delete_cookie.php'); exit; }
if (isset($_GET['delete'])) { setcookie('fruit', '', time() - 3600, '/'); header('Location: c06_delete_cookie.php?deleted=1'); exit; }
h('6. Deleting a cookie');
if (isset($_GET['deleted'])) echo '<p class="ok">The cookie has been removed.</p>';
if (isset($_COOKIE['fruit'])) echo '<div class="box">Favorite fruit: <b>' . e($_COOKIE['fruit']) . '</b></div><a href="?delete=1"><button>Delete Cookie</button></a>';
else echo '<div class="box">No cookie found.</div><a href="?set=1"><button>Set cookie</button></a>';
f();
