<html>
<head>
    <meta charset="UTF-8">
    <title>Insert Product</title>
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
    <link rel="stylesheet" href="./../css/custom.css">
</head>
<body>
<h2 style="color:Red">Following error occurred while trying to update the badminton gear data.</h2>

<?php
require_once("./../dal/product.php");
$product = new Product(array_merge(
        [
            "bp_id" => "",
            "bp_name" => "",
            "bp_color" => "",
            "bp_image" => "",
            "bp_description" => "",
            "quantity" => "",
            "price" => ""
        ], $_POST
    )
);

if (count($product->getErrors()) > 0) {
    echo "<h3>Errors</h3>";
    echo "<article>";
    echo "<ul>";
    foreach ($product->getErrors() as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
    echo "</article>";

    echo '<button onclick="location.href=\'edit_gear.php?bp_id=' . $product->getBpId() . '\';" type="button">Go Back</button>';
    exit();
} else {
    $result = $product->update();

    if ($result) {
        header("Location: details.php");
        exit();
    } else {
        echo "<h3>Product update failed</h3>";
        echo '<button onclick="location.href=\'edit_gear.php?bp_id=' . $product->getBpId() . '\';" type="button">Go Back</button>';
    }
}
?>

</body>
</html>






