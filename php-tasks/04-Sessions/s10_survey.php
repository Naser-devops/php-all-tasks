<?php
require 'inc.php';
if (isset($_GET['reset'])) { unset($_SESSION['survey']); header('Location: s10_survey.php'); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['survey'] = [
        'Favorite language' => $_POST['lang'] ?? '', 'Experience level' => $_POST['level'] ?? '',
        'Topics you like'   => $_POST['topics'] ?? [], 'Comments' => trim($_POST['comments'] ?? ''),
    ];
    header('Location: s10_survey.php'); exit;
}
h('10. Session-based survey');
if (!empty($_SESSION['survey'])) {
    echo '<div class="box ok"><b>Thank you! Your answers:</b><ul>';
    foreach ($_SESSION['survey'] as $q => $a) echo '<li>' . e($q) . ': <b>' . e(is_array($a) ? implode(', ', $a) : $a) . '</b></li>';
    echo '</ul></div><a href="?reset=1">Take the survey again</a>';
} else { ?>
<form method="post">
<p>Favorite language: <select name="lang"><option>PHP</option><option>JavaScript</option><option>Python</option></select></p>
<p>Level: <label><input type="radio" name="level" value="Beginner" required> Beginner</label> <label><input type="radio" name="level" value="Advanced"> Advanced</label></p>
<p>Topics: <label><input type="checkbox" name="topics[]" value="Frontend"> Frontend</label> <label><input type="checkbox" name="topics[]" value="Backend"> Backend</label> <label><input type="checkbox" name="topics[]" value="Databases"> Databases</label></p>
<p><textarea name="comments" placeholder="Comments" rows="3" cols="40"></textarea></p><button>Submit</button></form>
<?php } f();
