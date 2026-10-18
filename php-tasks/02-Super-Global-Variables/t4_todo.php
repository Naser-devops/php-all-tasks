<?php
session_start();
$_SESSION['todos'] = $_SESSION['todos'] ?? [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'add' && trim($_POST['task'] ?? '') !== '') $_SESSION['todos'][] = ['text' => trim($_POST['task']), 'done' => false];
    if ($action === 'toggle' && isset($_SESSION['todos'][$_POST['i']])) $_SESSION['todos'][$_POST['i']]['done'] ^= true;
    if ($action === 'delete') { unset($_SESSION['todos'][$_POST['i']]); $_SESSION['todos'] = array_values($_SESSION['todos']); }
    header('Location: ' . $_SERVER['PHP_SELF']); exit;      // PRG pattern: avoids re-submit on refresh
}
?><!DOCTYPE html><html><head><meta charset="UTF-8"><link rel="stylesheet" href="style.css"><title>Task 4</title></head><body>
<h2>Task 4: To-Do List</h2>
<form method="post"><input type="hidden" name="action" value="add"><input name="task" placeholder="New task" required> <button>Add</button></form>
<?php foreach ($_SESSION['todos'] as $i => $t): ?>
<div class="box"><form method="post" style="display:inline"><input type="hidden" name="i" value="<?= $i ?>">
<button name="action" value="toggle"><?= $t['done'] ? '✅' : '⬜' ?></button>
<span style="<?= $t['done'] ? 'text-decoration:line-through;color:#888' : '' ?>"><?= htmlspecialchars($t['text']) ?></span>
<button name="action" value="delete">🗑️</button></form></div>
<?php endforeach; ?></body></html>
