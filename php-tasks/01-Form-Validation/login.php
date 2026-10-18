<?php
require 'includes/functions.php';
$failed = false; $email = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? ''); $pass = $_POST['password'] ?? '';
    $user = find_user_by_email($email);
    if ($user && password_verify($pass, $user['password'])) {
        $users = load_users(); $users[$user['id']]['last_login'] = date('Y-m-d H:i:s'); save_users($users);
        session_regenerate_id(true);
        $_SESSION['user_email'] = $user['email'];
        header('Location: welcome.php'); exit;
    }
    $failed = true;
}
page_header('Login', 'index.php'); ?>
<h1>Login</h1><p class="lead2">Welcome back ! Login with your credentials</p>
<?php if (isset($_GET['registered'])): ?><div class="alert alert-success">Account created! Please log in.</div><?php endif; ?>
<form method="post" data-validate novalidate>
  <?php field('email', 'Email', 'email', ['email' => $email], [], 'email');
  field('password', 'Password', 'password', [], [], 'loginpass'); ?>
  <button class="btn-pill btn-login" type="submit">Login</button>
</form>
<p class="small-link">Don't have an account? <a href="signup.php">Sign Up</a></p>
<?php if ($failed): ?><script>alert('Invalid email or password. Please try again.');</script><?php endif;
page_footer(true);
