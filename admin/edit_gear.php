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

$product->findById($product->getBpId());

?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title>Update Gear</title>
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
    <link rel="stylesheet" href="./../css/custom.css">
</head>
<body>
<h3><a href="details.php" color="blue">All products</h3></a>
<form class="form" action="update_gear.php" method="post" id="registration_form">
    <h1 id="heading">Edit an existing Product</h1>
    <h2 id="title">Please enter the data to be saved in the Database</h2><br>
    <div id="tableDiv">
        <table class="justify-content-center">

            <tr>
                <input type="hidden" id="bp_id" name="bp_id" value="<?php echo($product->getBpId()); ?>"/>
                <td><label for="name" class="placeholder">Name:</label></td>
                <td><input type="text" class="input" id="name" name="bp_name" placeholder="Enter the product name"
                           value="<?php echo($product->getBpName()); ?>"/></td>
            </tr>

            <tr>
                <td><label for="color" class="placeholder">Color:</label></td>
                <td><input type="text" class="input" id="color" name="bp_color" placeholder="Enter the color"
                           value="<?php echo($product->getBpColor()); ?>"/></td>
            </tr>

            <tr>
                <td><label for="image" class="placeholder">Image Name:</label></td>
                <td><input type="text" class="input" id="image" name="bp_image" placeholder="Enter the color"
                           value="<?php echo($product->getBpImage()); ?>"/></td>
            </tr>

            <tr>
                <td><label for="description" class="placeholder">Description:</label></td>
                <td><input type="text" class="input" id="description" name="bp_description"
                           placeholder="Enter product's description"
                           value="<?php echo($product->getBpDescription()); ?>"/></td>
            </tr>

            <tr>
                <td><label for="quantity" class="placeholder">Quantity:</label></td>
                <td><input type="number" class="input" id="quantity" name="quantity" min="1" max="100000"
                           value="<?php echo($product->getQuantity()); ?>"/></td>
            </tr>

            <tr>
                <td><label for="price" class="placeholder">Price:</label></td>
                <td><input type="text" class="input" id="price" name="price" placeholder="Value with 2 decimals"
                           value="<?php echo($product->getPrice()); ?>"/></td>
            </tr>

        </table>
    </div>
    <br>

    <button type="submit" class="submit">Update Data</button>
    <br><br><br>
    <!--<h1 id="title">To view/edit all the products <br>-->
    <!--<h2><a href="details.php" color="blue">Click here..!!</h2></a>-->
    <!--</h1>-->
    .
</form>
</body>
</html>

















































