<?php
require_once("./../dal/product.php");
require_once("./functions.inc.php");
redirectIfNotLoggedIn();
$product = new Product();
$product->setBpId($_GET["bp_id"]);

// validate if product errors are empty
if ($product->getErrors()) {
    echo "<article>";
    echo "<h3>Error</h3>";
    echo "<p>Product id not found in the database</p>";
    echo "</article>";
    echo '<button onclick="location.href=\'products.php\';" type="button">Go Back</button>';
    exit();
}

$product->findById($product->getBpId());


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_to_cart']) && $_POST['add_to_cart']) {
        addToCart($_GET['bp_id']);
        header("Location: products.php");
    }
}
?>

<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title>Product Detail</title>
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
    <link rel="stylesheet" href="./../css/custom.css">
</head>
<body>
<nav>
    <ul>
        <li>
            <h1>Detail</h1>
        </li>
    </ul>
    <ul>
        <li>
            <a href="./products.php" role="button" class="secondary"
            >Products</a>
        </li>
        <li>
            <a href="./cart.php" role="button"
            >Cart</a>
        </li>
    </ul>
</nav>

<div class="container">
    <h1><?php echo $product->getBpName(); ?></h1>
    <div class="product-detail-image">
        <img src="./../images/<?php echo $product->getBpImage(); ?>.png" alt="<?php echo $product->getBpName(); ?>">
    </div>
    <h3>Description</h3>
    <p><?php echo $product->getBpDescription(); ?></p>
    <h4>Color: <?php echo $product->getBpColor(); ?></h4>
    <h4>Price:<?php echo $product->getPrice() ?></h4>

    <form method="post" action="product_detail.php?bp_id=<?php echo $product->getBpId(); ?>">
        <input type="hidden" name="add_to_cart" value="<?php echo true ?>">
        <button type="submit" role="button" class="primary">Add to Cart</button>
    </form>
</div>
</body>
</html>