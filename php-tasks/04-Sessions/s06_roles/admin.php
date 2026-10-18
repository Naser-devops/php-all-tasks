<?php
require 'auth.php'; require_role(['admin']);
h('Admin dashboard');
echo '<p class="ok">Welcome ' . e($_SESSION['user']) . ', you are allowed here.</p><a href="menu.php">Back</a>';
f();
