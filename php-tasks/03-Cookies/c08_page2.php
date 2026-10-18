<?php
require 'inc.php';
h('8. Page 2: cookie is read');
echo '<div class="box">Message: <b>' . e($_COOKIE['shared_msg'] ?? 'No cookie. Visit page 1 first.') . '</b></div><a href="c08_page1.php">&larr; Page 1</a>';
f();
