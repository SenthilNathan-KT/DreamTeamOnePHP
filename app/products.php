<?php
require_once("./../dal/product.php");
require_once("./functions.inc.php");
$results = Product::getAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['bp_id_to_add'])) {
        addToCart($_POST['bp_id_to_add']);
    }
}

$results = $results->fetchAll();

// Sort products based on the selected option
if (isset($_GET['sort-by'])) {
    $sort_by = $_GET['sort-by'];
    if ($sort_by === 'name') {
        usort($results, function ($a, $b) {
            return strcmp($a["bp_name"], $b["bp_name"]);
        });
    } else if ($sort_by === 'price') {
        usort($results, function ($a, $b) {
            return $a["price"] - $b["price"];
        });
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
    <link rel="stylesheet" href="./../css/custom.css">
</head>
<body>
<!-- Nav -->
<nav>
    <ul>
        <li>
            <h1>Badminton Shop</h1>
        </li>
    </ul>
    <ul>
        <li>
            <a href="./cart.php" aria-label="Cart">
                <svg class="svg-icon" viewBox="0 0 20 20">
                    <path fill="none"
                          d="M17.671,13.945l0.003,0.002l1.708-7.687l-0.008-0.002c0.008-0.033,0.021-0.065,0.021-0.102c0-0.236-0.191-0.428-0.427-0.428H5.276L4.67,3.472L4.665,3.473c-0.053-0.175-0.21-0.306-0.403-0.306H1.032c-0.236,0-0.427,0.191-0.427,0.427c0,0.236,0.191,0.428,0.427,0.428h2.902l2.667,9.945l0,0c0.037,0.119,0.125,0.217,0.239,0.268c-0.16,0.26-0.257,0.562-0.257,0.891c0,0.943,0.765,1.707,1.708,1.707S10,16.068,10,15.125c0-0.312-0.09-0.602-0.237-0.855h4.744c-0.146,0.254-0.237,0.543-0.237,0.855c0,0.943,0.766,1.707,1.708,1.707c0.944,0,1.709-0.764,1.709-1.707c0-0.328-0.097-0.631-0.257-0.891C17.55,14.182,17.639,14.074,17.671,13.945 M15.934,6.583h2.502l-0.38,1.709h-2.312L15.934,6.583zM5.505,6.583h2.832l0.189,1.709H5.963L5.505,6.583z M6.65,10.854L6.192,9.146h2.429l0.19,1.708H6.65z M6.879,11.707h2.027l0.189,1.709H7.338L6.879,11.707z M8.292,15.979c-0.472,0-0.854-0.383-0.854-0.854c0-0.473,0.382-0.855,0.854-0.855s0.854,0.383,0.854,0.855C9.146,15.596,8.763,15.979,8.292,15.979 M11.708,13.416H9.955l-0.189-1.709h1.943V13.416z M11.708,10.854H9.67L9.48,9.146h2.228V10.854z M11.708,8.292H9.386l-0.19-1.709h2.512V8.292z M14.315,13.416h-1.753v-1.709h1.942L14.315,13.416zM14.6,10.854h-2.037V9.146h2.227L14.6,10.854z M14.884,8.292h-2.321V6.583h2.512L14.884,8.292z M15.978,15.979c-0.471,0-0.854-0.383-0.854-0.854c0-0.473,0.383-0.855,0.854-0.855c0.473,0,0.854,0.383,0.854,0.855C16.832,15.596,16.45,15.979,15.978,15.979 M16.917,13.416h-1.743l0.189-1.709h1.934L16.917,13.416z M15.458,10.854l0.19-1.708h2.218l-0.38,1.708H15.458z"></path>
                </svg>
            </a>
            <h5>Cart</h5>
        </li>
    </ul>
</nav><!-- ./ Nav -->
<!-- Filter form -->
<label for="sort-by">Sort by:</label>
<nav>
    <ul>
        <li>
            <details role="list">
                <summary aria-haspopup="listbox" role="button" class="secondary">Sort by <?php

                    if (isset($_GET['sort-by'])) {
                        echo $_GET['sort-by'];
                    } ?></summary>
                <ul role="listbox">
                    <li><a href="./products.php">Default</a></li>
                    <li><a href="./products.php?sort-by=name">Name</a></li>
                    <li><a href="./products.php?sort-by=price">Price</a></li>

                </ul>
            </details>
        </li>
    </ul>
</nav><!-- ./ Nav -->

<div class="container">

    <div class="grid-container">
        <?php foreach ($results as $product): ?>
            <div class="grid-item">
                <img src="./../images/<?php echo $product['bp_image']; ?>.png" height=75 width=120 onclick="window.location.href='product_detail.php?bp_id=<?php echo $product['bp_id']; ?>'">
                <h3><?php echo $product['bp_name']; ?></h3>
                <p><?php echo $product['price']; ?></p>
                <?php
                $count = getCountForProduct($product['bp_id']);
                if ($count > 0): ?>
                    <div>
                        <p>Added to cart: <?php echo $count; ?></p>

                        <div>
                            <form method="post" action="products.php">
                                <input type="hidden" name="bp_id_to_add" value="<?php echo $product['bp_id']; ?>">
                                <button type="submit" role="button" class="primary">Add to Cart</button>
                            </form>
                            <button onclick="window.location.href='cart.php'" role="button" class="secondary">
                                View Cart
                            </button>
                        </div>

                    </div>
                <?php else: ?>
                    <form method="post" action="products.php">
                        <input type="hidden" name="bp_id_to_add" value="<?php echo $product['bp_id']; ?>">
                        <button type="submit" role="button" class="primary">Add to Cart</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>