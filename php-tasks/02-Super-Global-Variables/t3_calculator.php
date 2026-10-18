<?php
$result = null; $error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = $_POST['a'] ?? ''; $b = $_POST['b'] ?? ''; $op = $_POST['op'] ?? '';
    if (!is_numeric($a) || !is_numeric($b)) $error = 'Enter two valid numbers';
    else switch ($op) {
        case '+': $result = $a + $b; break;
        case '-': $result = $a - $b; break;
        case '*': $result = $a * $b; break;
        case '/': if ($b == 0) $error = 'Cannot divide by zero'; else $result = $a / $b; break;
        default: $error = 'Unknown operation';
    }
}
?><!DOCTYPE html><html><head><meta charset="UTF-8"><link rel="stylesheet" href="style.css"><title>Task 3</title></head><body>
<h2>Task 3: Calculator</h2>
<form method="post"><input type="number" step="any" name="a" value="<?= htmlspecialchars($_POST['a'] ?? '') ?>" required>
<select name="op"><?php foreach (['+', '-', '*', '/'] as $o) echo "<option" . (($_POST['op'] ?? '') === $o ? ' selected' : '') . ">$o</option>"; ?></select>
<input type="number" step="any" name="b" value="<?= htmlspecialchars($_POST['b'] ?? '') ?>" required> <button>=</button></form>
<?php if ($error) echo "<p class='err'>$error</p>"; elseif ($result !== null) echo "<h3 class='ok'>Result: $result</h3>"; ?></body></html>
