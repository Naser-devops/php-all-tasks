<?php
require 'inc.php';
$quiz = [
  ['q' => 'Which function sets a cookie?', 'o' => ['setcookie()', 'cookie_set()', 'make_cookie()'], 'a' => 0],
  ['q' => 'Which superglobal reads cookies?', 'o' => ['$_SESSION', '$_COOKIE', '$_FILES'], 'a' => 1],
  ['q' => 'To delete a cookie you set its expiry...', 'o' => ['in the future', 'to 0 forever', 'in the past'], 'a' => 2],
];
$justSubmitted = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = 0;
    foreach ($quiz as $i => $q) if (isset($_POST["q$i"]) && (int)$_POST["q$i"] === $q['a']) $score++;
    setcookie('quiz_score', (string)$score, time() + 30 * 24 * 3600, '/');
    $_COOKIE['quiz_score'] = $score; $justSubmitted = true;
}
h('10. Quiz with cookies');
if (isset($_COOKIE['quiz_score'])) echo '<div class="box ok">' . ($justSubmitted ? 'Your score now' : 'Your last score') . ': <b>' . (int)$_COOKIE['quiz_score'] . ' / ' . count($quiz) . '</b></div>';
echo '<form method="post">';
foreach ($quiz as $i => $q) {
    echo '<div class="box"><b>' . e($q['q']) . '</b><br>';
    foreach ($q['o'] as $k => $opt) echo '<label><input type="radio" name="q' . $i . '" value="' . $k . '" required> ' . e($opt) . '</label><br>';
    echo '</div>';
}
echo '<button>Submit</button></form>';
f();
