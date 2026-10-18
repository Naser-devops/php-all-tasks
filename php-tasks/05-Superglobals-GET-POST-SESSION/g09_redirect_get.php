<?php
require 'inc.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fn = trim($_POST['first_name'] ?? ''); $ln = trim($_POST['last_name'] ?? '');
    if ($fn !== '' && $ln !== '') { header('Location: g09_welcome.php?' . http_build_query(['first' => $fn, 'last' => $ln])); exit; }
    $err = 'Both names are required';
}
h('9. Redirect with URL parameters');
if (!empty($err)) echo "<p class='err'>$err</p>";
?><form method="post">First name <input name="first_name"><br>Last name <input name="last_name"><br><button>Go</button></form>
<?php f();
