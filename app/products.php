<?php
require_once("./../dal/product.php");
require_once("./functions.inc.php");
$results = Product::getAll();
redirectIfNotLoggedIn();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  redirectIfNotLoggedIn();
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

<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
    <link rel="stylesheet" href="./../css/custom.css">
</head>
<body>
<nav>
  <?php
    // Do something with the object
    echo $_SESSION["user_data"]["imageName"];
  ?>
    <ul>
        <li>
            <h1>Badminton Products</h1>
        </li>
    </ul>
    <ul>
        <li>
            <details role="list">
                <summary aria-haspopup="listbox" role="button" class="secondary">Sort by <?php
                    if (isset($_GET['sort-by'])) {
                        echo $_GET['sort-by'];
                    } ?></summary>
                <ul role="listbox" aria-label="Sort by">
                    <li><a href="./products.php">Default</a></li>
                    <li><a href="./products.php?sort-by=name">Name</a></li>
                    <li><a href="./products.php?sort-by=price">Price</a></li>

                </ul>
            </details>
        </li>
        <li>
            <a href="./cart.php" role="button">Cart</a>
        </li>
        <li>
            <a href="./logout.php">Logout</a>
        </li>
        <li>
          <img style="height: 65px; width: 65px; border-radius: 32px" src="./../images/<?php echo $_SESSION['user_data']['imageName']; ?>"alt="Display Picture">
        </li>
    </ul>
</nav>


<div class="container">

    <div class="grid-container">
        <?php foreach ($results as $product): ?>
            <div class="grid-item">
                <img src="./../images/<?php echo $product['bp_image']; ?>.png"
                     style="max-height: 200px; min-height: 100px;"
                     onclick="window.location.href='product_detail.php?bp_id=<?php echo $product['bp_id']; ?>'">
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
                            <a onclick="window.location.href='cart.php'" class="secondary">
                                View Cart
                            </a>
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
<footer
    <div style="display: flex; justify-content: space-between">
        <div class="footer-column">
            <h3>Company</h3>
            <ul>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Our Services</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms of Service</a></li>
            </ul>
        </div>

        <div class="footer-column">
            <h3>Contact Us</h3>
            <p>Phone: 123-456-7890</p>
            <p>Email: info@yourwebsite.com</p>
            <p>Address: 123 Main St, Anytown, USA</p>
        </div>

        <div class="footer-column">
            <h3>Follow Us</h3>
            <ul>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Twitter</a></li>
                <li><a href="#">Instagram</a></li>
            </ul>
        </div>
    </div>
</footer>
</body>
</html>