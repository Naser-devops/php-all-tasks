<?php
require '../inc.php';
const TIMEOUT = 300;      // 5 minutes of inactivity (put 10 to test quickly)
function check_session(): void {
    if (empty($_SESSION['user'])) { header('Location: login.php'); exit; }
    if (time() - ($_SESSION['last_activity'] ?? 0) > TIMEOUT) {      // inactive too long
        $_SESSION = []; session_destroy();
        header('Location: login.php?expired=1'); exit;
    }
    $_SESSION['last_activity'] = time();                              // refresh the timer
}
