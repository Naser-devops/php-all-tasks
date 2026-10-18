<?php
require 'inc.php';
$info = null; $err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['myfile'] ?? null;
    if (!$file || $file['error'] !== UPLOAD_ERR_OK) $err = 'Upload failed (error code ' . ($file['error'] ?? '?') . ')';
    elseif ($file['size'] > 2 * 1024 * 1024) $err = 'File is bigger than 2MB';
    else {
        $safe = bin2hex(random_bytes(6)) . '_' . preg_replace('/[^A-Za-z0-9._-]/', '_', basename($file['name']));   // never trust the client name
        if (move_uploaded_file($file['tmp_name'], __DIR__ . '/uploads/' . $safe)) $info = $file + ['saved_as' => $safe];
        else $err = 'Could not save the file';
    }
}
h('7. File upload with $_FILES');
if ($err) echo "<p class='err'>" . e($err) . '</p>';
if ($info) echo '<div class="box ok">Original name: <b>' . e($info['name']) . '</b><br>Type: <b>' . e($info['type']) . '</b><br>Size: <b>' . number_format($info['size'] / 1024, 2) . ' KB</b><br>Saved as: ' . e($info['saved_as']) . '</div>';
?><form method="post" enctype="multipart/form-data"><input type="file" name="myfile" required> <button>Upload</button></form>
<?php f();
