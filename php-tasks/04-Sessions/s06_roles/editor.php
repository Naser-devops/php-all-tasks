<?php
require 'auth.php'; require_role(['admin', 'editor']);
h('Editor panel');
echo '<p class="ok">Welcome ' . e($_SESSION['user']) . ', you are allowed here.</p><a href="menu.php">Back</a>';
f();
