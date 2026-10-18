<?php
require '../inc.php';
const USERS = [
  'admin'  => ['pass' => 'admin123',  'role' => 'admin'],
  'editor' => ['pass' => 'editor123', 'role' => 'editor'],
  'viewer' => ['pass' => 'viewer123', 'role' => 'viewer'],
];
function require_role(array $allowed): void {
    if (empty($_SESSION['role'])) { header('Location: login.php'); exit; }
    if (!in_array($_SESSION['role'], $allowed, true)) {
        http_response_code(403);
        h('Access Denied'); echo '<p class="err">⛔ Your role (<b>' . e($_SESSION['role']) . '</b>) cannot open this page.</p><a href="menu.php">Back</a>'; f(); exit;
    }
}
