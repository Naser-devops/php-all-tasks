<?php
require 'auth.php'; require_role(['admin', 'editor', 'viewer']);
h('Menu');
?><p>Logged in as <b><?= e($_SESSION['user']) ?></b> (role: <b><?= e($_SESSION['role']) ?></b>)</p>
<ul><li><a href="admin.php">Admin page</a></li><li><a href="editor.php">Editor page</a></li><li><a href="viewer.php">Viewer page</a></li><li><a href="logout.php">Logout</a></li></ul>
<?php f();
