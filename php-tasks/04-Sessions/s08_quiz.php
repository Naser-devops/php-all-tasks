<?php
require 'inc.php';
$quiz = [
  ['q' => 'Which function starts a session?', 'o' => ['session_start()', 'start_session()', 'new_session()'], 'a' => 0],
  ['q' => 'Sessions are stored in...', 'o' => ['$_COOKIE only', '$_SESSION', '$_FILES'], 'a' => 1],
  ['q' => 'Which function destroys a session?', 'o' => ['session_end()', 'session_delete()', 'session_destroy()'], 'a' => 2],
];
if (isset($_GET['restart'])) { unset($_SESSION['quiz']); header('Location: s08_quiz.php'); exit; }
$_SESSION['quiz'] = $_SESSION['quiz'] ?? ['i' => 0, 'results' => []];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer']) && $_SESSION['quiz']['i'] < count($quiz)) {
    $i = $_SESSION['quiz']['i'];
    $_SESSION['quiz']['results'][$i] = ((int)$_POST['answer'] === $quiz[$i]['a']);   // correct or not
    $_SESSION['quiz']['i']++;
    header('Location: s08_quiz.php'); exit;
}
h('8. Quiz with session score');
$i = $_SESSION['quiz']['i'];
if ($i >= count($quiz)) {
    $score = count(array_filter($_SESSION['quiz']['results']));
    echo "<div class='box ok'>Finished! Score: <b>$score / " . count($quiz) . '</b></div><a href="?restart=1">Try again</a>';
} else {
    echo '<p>Question ' . ($i + 1) . ' of ' . count($quiz) . '</p><form method="post"><b>' . e($quiz[$i]['q']) . '</b><br>';
    foreach ($quiz[$i]['o'] as $k => $o) echo '<label><input type="radio" name="answer" value="' . $k . '" required> ' . e($o) . '</label><br>';
    echo '<button>Next</button></form>';
}
f();
