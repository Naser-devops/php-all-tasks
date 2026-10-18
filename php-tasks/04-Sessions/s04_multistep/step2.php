<?php
require '../inc.php';
if (empty($_SESSION['form']['name'])) { header('Location: step1.php'); exit; }     // must finish step 1 first
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['form']['address'] = trim($_POST['address']); $_SESSION['form']['phone'] = trim($_POST['phone']);
    header('Location: final.php'); exit;
}
h('Step 2: More details');
?><form method="post">Address <input name="address" value="<?= e($_SESSION['form']['address'] ?? '') ?>" required><br>
Phone <input name="phone" value="<?= e($_SESSION['form']['phone'] ?? '') ?>" required><br><a href="step1.php">&larr; Back</a> <button>Next &rarr;</button></form>
<?php f();
