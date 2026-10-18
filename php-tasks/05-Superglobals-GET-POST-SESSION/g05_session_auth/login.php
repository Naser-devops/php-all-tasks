<?php
require '../inc.php';
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (($_POST['username'] ?? '') === 'admin' && ($_POST['password'] ?? '') === '1234') {
        session_regenerate_id(true); $_SESSION['username'] = 'admin'; header('Location: dashboard.php'); exit;
    }
    $err = 'Wrong username or password';
}
h('5. Login with $_SESSION (admin / 1234)');
if ($err) echo "<p class='err'>$err</p>";
?><form method="post">Username <input name="username"><br>Password <input type="password" name="password"><br><button>Login</button></form>
<?php f();
