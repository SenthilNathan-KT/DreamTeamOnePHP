<?php
require_once("./../dal/product.php");
require_once("../app/functions.inc.php");
redirectIfNotAdmin();

$product = new Product();
$product->setBpId($_GET["bp_id"]);

// validate if product errors are empty
if ($product->getErrors()) {
    echo "<article>";
    echo "<h3>Error</h3>";
    echo "<p>Product id not found in the database</p>";
    echo "</article>";
    echo '<button onclick="location.href=\'details.php\';" type="button">Go Back</button>';
    exit();
}

$result = $product->delete();

if ($result) {
    header("Location: details.php");
    exit();
} else {
    echo "<br> Some error deleting the product";
}
?>



