<?php
require 'includes/functions.php';
$loginError = '';
if (isset($_GET['logout'])) { unset($_SESSION['is_admin']); header('Location: admin.php'); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_login'])) {
    if (($_POST['email'] ?? '') === ADMIN_EMAIL && ($_POST['password'] ?? '') === ADMIN_PASS) {
        session_regenerate_id(true); $_SESSION['is_admin'] = true; header('Location: admin.php'); exit;
    }
    $loginError = 'Wrong admin credentials';
}
if (!empty($_SESSION['is_admin']) && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $users = load_users(); unset($users[(int)$_POST['delete_id']]); save_users($users);
    header('Location: admin.php?deleted=1'); exit;
}
if (empty($_SESSION['is_admin'])) {
    page_header('Admin Login', 'index.php'); ?>
    <h1>Admin Login</h1><p class="lead2">Super user only</p>
    <?php if ($loginError): ?><div class="alert alert-danger"><?= e($loginError) ?></div><?php endif; ?>
    <form method="post"><input type="hidden" name="admin_login" value="1">
      <div class="mb-3"><label class="form-label">Email</label><input class="form-control" name="email" type="email" required></div>
      <div class="mb-3"><label class="form-label">Password</label><input class="form-control" name="password" type="password" required></div>
      <button class="btn-pill btn-login">Login</button></form>
    <p class="small-link text-muted">Demo: <?= ADMIN_EMAIL ?> / <?= ADMIN_PASS ?></p>
    <?php page_footer(); exit;
}
$users = load_users();
?><!DOCTYPE html><html><head><meta charset="UTF-8"><title>Admin Panel</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></head><body class="p-4">
<div class="container"><div class="d-flex justify-content-between mb-3"><h2>Registered users</h2><a class="btn btn-outline-secondary" href="?logout=1">Logout</a></div>
<?php if (isset($_GET['deleted'])) echo '<div class="alert alert-warning">User deleted</div>'; if (isset($_GET['updated'])) echo '<div class="alert alert-success">User updated</div>'; ?>
<div class="table-responsive"><table class="table table-bordered table-striped align-middle">
<thead class="table-dark"><tr><th>ID</th><th>Name</th><th>Email</th><th>Password (hash)</th><th>Date created</th><th>Date last login</th><th>Edit</th><th>Delete</th></tr></thead><tbody>
<?php if (!$users): ?><tr><td colspan="8" class="text-center text-muted">No users yet</td></tr><?php endif;
foreach ($users as $u): ?>
<tr><td><?= $u['id'] ?></td><td><?= e("{$u['fname']} {$u['mname']} {$u['lname']} {$u['family']}") ?></td><td><?= e($u['email']) ?></td>
<td><code><?= e(substr($u['password'], 0, 14)) ?>…</code></td><td><?= e($u['created_at']) ?></td><td><?= e($u['last_login'] ?? '-') ?></td>
<td><a class="btn btn-sm btn-primary" href="edit.php?id=<?= $u['id'] ?>">Edit</a></td>
<td><form method="post" onsubmit="return confirm('Delete this user?')"><input type="hidden" name="delete_id" value="<?= $u['id'] ?>"><button class="btn btn-sm btn-danger">Delete</button></form></td></tr>
<?php endforeach; ?></tbody></table></div></div></body></html>
