<?php
if (file_exists('config.txt')) {
    rename('config.txt', 'config.bak');
    echo 'config.txt was renamed to config.bak';
} else {
    die('Error: config.txt does not exist!');
}
