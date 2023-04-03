<?php
require_once("./../dal/product.php");
require_once("./functions.inc.php");


// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['bp_id_to_modify']) && isset($_POST['quantity'])) {
        modifyCart($_POST['bp_id_to_modify'], $_POST['quantity']);
    }

    if (isset($_POST['bp_id_to_remove'])) {
        modifyCart($_POST['bp_id_to_remove'], 0);
    }
}

$results = Product::getAll();
$products = [];

// Get the products from the database and filter out the ones that are not in the cart
foreach ($results as $result) {
    if (getCountForProduct($result["bp_id"]) == 0) continue;

    $product = new Product($result);
    $products[] = $product;
}

// Calculate the subtotal, tax and total
$subtotal = array_reduce($products, function ($carry, $product) {
    return $carry + $product->getPrice() * getCountForProduct($product->getBpId());
});
$tax = $subtotal * 0.13;
$total = $subtotal + $tax;
?>

<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title>Cart</title>
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
    <link rel="stylesheet" href="./../css/custom.css">
</head>
<body>
<nav>
    <ul>
        <li>
            <h1>Cart</h1>
        </li>
    </ul>
    <ul>
        <li>
            <a href="./products.php">Products</a>
        </li>
        <?php if (count($products) > 0): ?>
            <li>
                <a href="./checkout.php">Checkout</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
<div class="container">
    <h2>Products</h2>


    <?php if (count($products) == 0): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>


        <table class="cart-table">
            <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $cart_item): ?>
                <tr>
                    <td><?php echo $cart_item->getBpName(); ?></td>
                    <td><?php echo $cart_item->getPrice(); ?></td>
                    <td>
                        <form method="post" action="cart.php">
                            <input type="hidden" name="bp_id_to_modify" value="<?php echo $cart_item->getBpId(); ?>">
                            <input type="number" name="quantity"
                                   value="<?php echo getCountForProduct($cart_item->getBpId()); ?>"
                                   min="1" max="100" onchange="this.form.submit()">
                        </form>
                    </td>
                    <td><?php echo $cart_item->getPrice() * getCountForProduct($cart_item->getBpId()); ?></td>
                    <td>
                        <form method="post" action="cart.php">
                            <input type="hidden" name="bp_id_to_remove" value="<?php echo $cart_item->getBpId(); ?>">
                            <button type="submit" role="button" class="secondary">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <div class="cart-summary">
            <h2>Cart Summary</h2>
            <table>
                <tr>
                    <td>Subtotal:</td>
                    <td><?php echo '$' . number_format($subtotal, 2); ?></td>
                </tr>
                <tr>
                    <td>Tax:</td>
                    <td><?php echo '$' . number_format($tax, 2); ?></td>
                </tr>
                <tr>
                    <td>Total:</td>
                    <td><?php echo '$' . number_format($total, 2); ?></td>
                </tr>
            </table>
            <button onclick="window.location.href='checkout.php'" role="button" class="primary">Checkout</button>
        </div>

    <?php endif; ?>


</div>

</body>
</html>