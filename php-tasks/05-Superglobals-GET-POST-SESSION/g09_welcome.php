<?php
require 'inc.php';
h('Welcome page');
$first = trim($_GET['first'] ?? ''); $last = trim($_GET['last'] ?? '');
echo $first !== '' ? '<div class="box ok">Welcome, <b>' . e("$first $last") . '</b>!</div>' : '<p class="err">No name was sent.</p>';
echo '<a href="g09_redirect_get.php">&larr; back</a>'; f();
