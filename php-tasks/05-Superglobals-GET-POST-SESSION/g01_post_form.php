<?php
require 'inc.php';
$err = []; $data = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fn = trim($_POST['first_name'] ?? ''); $ln = trim($_POST['last_name'] ?? ''); $em = trim($_POST['email'] ?? '');
    if ($fn === '') $err[] = 'First name is required';
    if ($ln === '') $err[] = 'Last name is required';
    if (!filter_var($em, FILTER_VALIDATE_EMAIL)) $err[] = 'A valid email is required';
    if (!$err) $data = compact('fn', 'ln', 'em');
}
h('1. Handling form data with $_POST');
foreach ($err as $x) echo "<p class='err'>" . e($x) . '</p>';
if ($data) echo '<div class="box ok">First name: <b>' . e($data['fn']) . '</b><br>Last name: <b>' . e($data['ln']) . '</b><br>Email: <b>' . e($data['em']) . '</b></div>';
?><form method="post">First name <input name="first_name" value="<?= e($_POST['first_name'] ?? '') ?>"><br>Last name <input name="last_name" value="<?= e($_POST['last_name'] ?? '') ?>"><br>Email <input name="email" value="<?= e($_POST['email'] ?? '') ?>"><br><button>Send</button></form>
<?php f();
