<?php
require 'inc.php';
$products = ['Laptop', 'Phone', 'Headphones', 'Keyboard'];
$cart = json_decode($_COOKIE['cart'] ?? '[]', true) ?: [];
if (isset($_GET['clear'])) { setcookie('cart', '', time() - 3600, '/'); header('Location: c05_cart.php'); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST' && in_array($_POST['product'] ?? '', $products, true)) {
    $cart[] = $_POST['product'];
    setcookie('cart', json_encode($cart), time() + 24 * 3600, '/');
    header('Location: c05_cart.php'); exit;
}
h('5. Shopping cart (cookies)');
foreach ($products as $p) echo '<form method="post" class="box"><input type="hidden" name="product" value="' . e($p) . '">' . e($p) . ' <button>Add to Cart</button></form>';
?><div class="box"><b>Cart (<?= count($cart) ?>)</b><ul><?php foreach ($cart as $i) echo '<li>' . e($i) . '</li>'; ?></ul>
<?php if ($cart) echo '<a href="?clear=1">Clear cart</a>'; ?></div>
<?php f();
