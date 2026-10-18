<?php
require '../inc.php';
if (empty($_SESSION['form']['phone'])) { header('Location: step1.php'); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_SESSION['form']; unset($_SESSION['form']);     // here you would save $data in a database
    h('Done!'); echo '<div class="box ok">Thank you ' . e($data['name']) . '! Your data was submitted.</div><a href="step1.php">Start again</a>'; f(); exit;
}
h('Final step: Review & submit');
echo '<div class="box">';
foreach ($_SESSION['form'] as $k => $v) echo '<b>' . e(ucfirst($k)) . ':</b> ' . e($v) . '<br>';
echo '</div><form method="post"><a href="step2.php">&larr; Back</a> <button>Submit</button></form>';
f();
