<?php
require 'includes/functions.php';
if (empty($_SESSION['user_email'])) { header('Location: login.php'); exit; }
page_header('Welcome'); ?>
<h1>Welcome 🎉</h1>
<p class="lead2">You are logged in as<br><b><?= e($_SESSION['user_email']) ?></b></p>
<p class="text-center">Glad to have you here. Enjoy your stay!</p>
<a class="btn-pill btn-signup" href="logout.php">Logout</a>
<?php page_footer();
