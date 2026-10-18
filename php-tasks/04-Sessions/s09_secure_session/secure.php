<?php
require '../inc.php';
function fingerprint(): string { return hash('sha256', ($_SERVER['REMOTE_ADDR'] ?? '') . '|' . ($_SERVER['HTTP_USER_AGENT'] ?? '')); }
function require_secure_login(): void {
    if (empty($_SESSION['user'])) { header('Location: login.php'); exit; }
    if (!hash_equals($_SESSION['fp'] ?? '', fingerprint())) {       // IP or browser changed => suspicious
        $_SESSION = []; session_destroy();
        header('Location: login.php?hijack=1'); exit;
    }
}
