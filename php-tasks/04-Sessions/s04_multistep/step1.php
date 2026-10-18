<?php
require '../inc.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['form']['name'] = trim($_POST['name']); $_SESSION['form']['email'] = trim($_POST['email']);
    header('Location: step2.php'); exit;
}
h('Step 1: Basic info');
?><form method="post">Name <input name="name" value="<?= e($_SESSION['form']['name'] ?? '') ?>" required><br>
Email <input type="email" name="email" value="<?= e($_SESSION['form']['email'] ?? '') ?>" required><br><button>Next &rarr;</button></form>
<?php f();
