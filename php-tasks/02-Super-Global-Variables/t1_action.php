<?php
$method = $_SERVER['REQUEST_METHOD'];           // "GET" or "POST"
$data = ($method === 'POST') ? $_POST : $_GET;
?><!DOCTYPE html><html><head><meta charset="UTF-8"><link rel="stylesheet" href="style.css"><title>Action</title></head><body>
<h2>Data was sent by <span class="ok"><?= htmlspecialchars($method) ?></span></h2>
<div class="box">Email: <?= htmlspecialchars($data['email'] ?? '-') ?><br>Password: <?= htmlspecialchars($data['password'] ?? '-') ?></div>
<a href="t1_form.php">&larr; back</a></body></html>
