<?php
require 'includes/functions.php';
if (empty($_SESSION['is_admin'])) { header('Location: admin.php'); exit; }
$id = (int)($_GET['id'] ?? 0); $users = load_users();
if (!isset($users[$id])) { header('Location: admin.php'); exit; }
$old = $users[$id]; $err = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old = array_merge($old, $_POST);
    $err = validate_user($_POST, false, $id);
    if (!$err) {
        foreach (['email', 'mobile', 'fname', 'mname', 'lname', 'family'] as $k) $users[$id][$k] = trim($_POST[$k]);
        if ($_POST['password'] !== '') $users[$id]['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        save_users($users); header('Location: admin.php?updated=1'); exit;
    }
}
page_header('Edit user', 'admin.php'); ?>
<h1>Edit user #<?= $id ?></h1><p class="lead2">Leave password empty to keep the current one</p>
<form method="post" data-validate novalidate>
<?php field('email', 'Email', 'email', $old, $err, 'email');
field('mobile', 'Mobile', 'text', $old, $err, 'mobile', 'maxlength="14"');
field('fname', 'First name', 'text', $old, $err, 'name'); field('mname', 'Middle name', 'text', $old, $err, 'name');
field('lname', 'Last name', 'text', $old, $err, 'name'); field('family', 'Family name', 'text', $old, $err, 'name');
field('password', 'New password (optional)', 'password', [], $err, 'optpass'); ?>
<button class="btn-pill btn-login">Save</button></form>
<script>/* optional password: skip the JS rule when empty */</script>
<?php page_footer();
