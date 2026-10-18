<?php
require 'includes/functions.php';
$err = []; $old = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old = $_POST;
    $err = validate_user($_POST, true);            // backend validation
    if (!$err) {
        $users = load_users(); $id = next_id($users);
        $users[$id] = [
            'id' => $id, 'email' => trim($_POST['email']), 'mobile' => trim($_POST['mobile']),
            'fname' => trim($_POST['fname']), 'mname' => trim($_POST['mname']),
            'lname' => trim($_POST['lname']), 'family' => trim($_POST['family']),
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'dob' => sprintf('%04d-%02d-%02d', $_POST['year'], $_POST['month'], $_POST['day']),
            'created_at' => date('Y-m-d H:i:s'), 'last_login' => null,
        ];
        save_users($users);
        header('Location: login.php?registered=1'); exit;
    }
}
page_header('Sign up', 'index.php'); ?>
<h1>Sign up</h1><p class="lead2">Create an Account, it's free</p>
<form method="post" data-validate novalidate>
  <?php field('email', 'Email', 'email', $old, $err, 'email');
  field('mobile', 'Mobile (14 digits)', 'text', $old, $err, 'mobile', 'maxlength="14" inputmode="numeric"');
  field('fname', 'First name', 'text', $old, $err, 'name');
  field('mname', 'Middle name', 'text', $old, $err, 'name');
  field('lname', 'Last name', 'text', $old, $err, 'name');
  field('family', 'Family name', 'text', $old, $err, 'name');
  field('password', 'Password', 'password', $old, $err, 'password');
  field('confirm', 'Confirm Password', 'password', $old, $err, 'confirm'); ?>
  <div class="mb-3"><label class="form-label">Date of Birth</label>
    <div class="row g-2">
      <div class="col"><input class="form-control" name="day" data-rule="dob" type="number" placeholder="DD" min="1" max="31" value="<?= e($old['day'] ?? '') ?>"></div>
      <div class="col"><input class="form-control" name="month" data-rule="dob" type="number" placeholder="MM" min="1" max="12" value="<?= e($old['month'] ?? '') ?>"></div>
      <div class="col"><input class="form-control" name="year" data-rule="dob" type="number" placeholder="YYYY" value="<?= e($old['year'] ?? '') ?>"></div>
    </div>
    <div class="invalid-feedback" style="<?= isset($err['dob']) ? 'display:block' : '' ?>"><?= e($err['dob'] ?? '') ?></div>
  </div>
  <button class="btn-pill btn-signup" type="submit">Sign Up</button>
</form>
<p class="small-link">Already have an account? <a href="login.php">Login</a></p>
<?php page_footer(true);
