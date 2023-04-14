<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title>Insert Product</title>
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
    <link rel="stylesheet" href="./../css/custom.css">
</head>
<body>
<h2 style="color:Red">Following error occurred while trying to add the new badminton gear.</h2>

<?php
require_once("./../dal/product.php");
require_once("../app/functions.inc.php");
redirectIfNotAdmin();

$product = new Product(array_merge(
        [
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

    echo '<button onclick="location.href=\'insert.php\';" type="button">Go Back</button>';
    exit();
} else {
    $result = $product->insert();

    if ($result) {
        header("Location: details.php");
        exit();
    } else {
        echo "<h3>Product insert failed</h3>";
        echo '<button onclick="location.href=\'insert.php\';" type="button">Go Back</button>';
    }
}
// function retrieveData($field_name, $errors) {
//     echo("Method called with param -> " . $field_name);

//     if(empty($_POST[$field_name]))
//     $errors[]="<p> $field_name is required</p>";
//     else
//     $name=htmlspecialchars($_POST["name"]);

// }
?>

</body>
</html>




