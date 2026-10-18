<?php
require 'auth.php';
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = $_POST['username'] ?? '';
    if (isset(USERS[$u]) && USERS[$u]['pass'] === ($_POST['password'] ?? '')) {
        session_regenerate_id(true); $_SESSION['user'] = $u; $_SESSION['role'] = USERS[$u]['role'];
        header('Location: menu.php'); exit;
    }
    $err = 'Wrong credentials';
}
h('6. Login');
if ($err) echo "<p class='err'>$err</p>";
?><form method="post">Username <input name="username"><br>Password <input type="password" name="password"><br><button>Login</button></form>
<p>admin/admin123 &bull; editor/editor123 &bull; viewer/viewer123</p>
<?php f();
