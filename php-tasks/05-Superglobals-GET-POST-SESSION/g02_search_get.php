<?php
require 'inc.php';
h('2. Search with $_GET');
?><form method="get"><input name="q" value="<?= e($_GET['q'] ?? '') ?>" placeholder="Search..."> <button>Search</button></form>
<?php
if (isset($_GET['q'])) {
    $q = trim($_GET['q']);
    echo $q === '' ? '<p class="err">Type something first</p>' : '<div class="box">You searched for: <b>' . e($q) . '</b><br><small>Look at the URL: ?q=' . e(urlencode($q)) . '</small></div>';
}
f();
