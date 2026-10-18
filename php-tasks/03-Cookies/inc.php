<?php
function e($s): string { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
function h(string $title, string $bodyStyle = ''): void {
    echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>' . e($title)
       . '</title><link rel="stylesheet" href="style.css"></head><body style="' . e($bodyStyle) . '"><h2>' . e($title) . '</h2>';
}
function f(): void { echo '</body></html>'; }
