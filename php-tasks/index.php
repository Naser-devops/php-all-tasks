<?php
// Launcher: lists every task file in every folder
$dirs = glob(__DIR__ . '/0*', GLOB_ONLYDIR); sort($dirs);
echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>PHP Tasks</title><style>body{font-family:Arial;max-width:760px;margin:30px auto}li{margin:4px 0}</style></head><body><h1>PHP Tasks</h1>';
foreach ($dirs as $d) {
    $name = basename($d); echo '<h2>' . htmlspecialchars($name) . '</h2><ul>';
    $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($d, FilesystemIterator::SKIP_DOTS));
    $files = [];
    foreach ($it as $f) {
        $rel = substr($f->getPathname(), strlen(__DIR__) + 1);
        if ($f->getExtension() === 'php' && !preg_match('#(inc|functions|auth|config|secure)\.php$|includes/#', $rel)) $files[] = $rel;
    }
    sort($files);
    foreach ($files as $rel) echo '<li><a href="' . htmlspecialchars($rel) . '">' . htmlspecialchars(substr($rel, strlen($name) + 1)) . '</a></li>';
    echo '</ul>';
}
echo '</body></html>';
