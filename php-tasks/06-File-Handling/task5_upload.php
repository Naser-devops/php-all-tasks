<?php
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $f = $_FILES['avatar'] ?? null;
    $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png'];
    if (!$f || $f['error'] !== UPLOAD_ERR_OK) $msg = '❌ Upload error';
    elseif ($f['size'] > 2 * 1024 * 1024) $msg = '❌ File is larger than 2MB';
    else {
        $mime = (new finfo(FILEINFO_MIME_TYPE))->file($f['tmp_name']);                  // real type, not the client-sent one
        if (!isset($allowed[$mime]) || !getimagesize($f['tmp_name'])) $msg = '❌ Only JPG or PNG images are allowed';
        else {
            if (!is_dir('uploads')) mkdir('uploads', 0755, true);
            $name = bin2hex(random_bytes(8)) . '.' . $allowed[$mime];                   // our own safe filename
            $msg = move_uploaded_file($f['tmp_name'], "uploads/$name") ? "✅ Uploaded as uploads/$name" : '❌ Could not save the file';
        }
    }
}
?><!DOCTYPE html><html><head><meta charset="UTF-8"><title>Upload</title></head><body>
<h2>Profile picture</h2><p><?= htmlspecialchars($msg) ?></p>
<form method="post" enctype="multipart/form-data"><input type="file" name="avatar" accept="image/png,image/jpeg" required> <button>Upload</button></form></body></html>
