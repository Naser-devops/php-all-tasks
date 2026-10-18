<?php
require 'inc.php';
$products = [1 => ['Laptop', 700], 2 => ['Phone', 450], 3 => ['Headphones', 60], 4 => ['Keyboard', 35]];
$_SESSION['cart'] = $_SESSION['cart'] ?? [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'], $products[$_POST['add']])) {
        [$n, $p] = $products[$_POST['add']];
        $_SESSION['cart'][] = ['name' => $n, 'price' => $p];
    }
    if (isset($_POST['clear'])) { unset($_SESSION['cart']); }         // clear the cart
    header('Location: s03_shopping_cart.php'); exit;
}
h('3. Shopping cart (sessions)');
foreach ($products as $id => [$n, $p]) echo '<form method="post" class="box">' . e($n) . ' - $' . $p . ' <button name="add" value="' . $id . '">Add to Cart</button></form>';
$total = array_sum(array_column($_SESSION['cart'] ?? [], 'price'));
echo '<div class="box"><b>Cart</b><ul>';
foreach ($_SESSION['cart'] ?? [] as $it) echo '<li>' . e($it['name']) . ' - $' . $it['price'] . '</li>';
echo "</ul>Total: <b>\$$total</b><form method='post'><button name='clear' value='1'>Clear cart</button></form></div>";
f();
