<?php
require 'inc.php';
h('3. Contact form with $_REQUEST');
$name = trim($_REQUEST['name'] ?? ''); $msg = trim($_REQUEST['message'] ?? '');     // works for GET and POST
if ($name !== '' && $msg !== '') echo '<div class="box ok">Method used: <b>' . e($_SERVER['REQUEST_METHOD']) . '</b><br>Name: ' . e($name) . '<br>Message: ' . e($msg) . '</div>';
elseif ($_REQUEST) echo '<p class="err">Name and message are required</p>';
?>
<form method="get" class="box"><b>Send with GET</b><br><input name="name" placeholder="Name"><br><textarea name="message" placeholder="Message"></textarea><br><button>Send GET</button></form>
<form method="post" class="box"><b>Send with POST</b><br><input name="name" placeholder="Name"><br><textarea name="message" placeholder="Message"></textarea><br><button>Send POST</button></form>
<?php f();
