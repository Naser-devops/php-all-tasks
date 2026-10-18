<?php
require 'inc.php';
setcookie('shared_msg', 'Hello from Page 1', time() + 3600, '/');   // path "/" => visible on every page of the site
h('8. Page 1: cookie is set');
?><p>The cookie <code>shared_msg</code> was set.</p><a href="c08_page2.php">Go to Page 2 &rarr;</a>
<?php f();
