<?php
require_once("./../dal/product.php");

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
<html>
<head>
    <style>
        #registration_form {
            margin-top: 50px;
        }

        input {
            border-radius: 10px;
            height: 20px;
            margin-top: 10px;
            color: #212529;
            background-color: #f1c3f3;
        }

        button {
            background-color: #4d4ae2;
            border-radius: 8px;
            border-style: none;
            box-sizing: border-box;
            color: #FFFFFF;
            height: 40px;
            width: 150px;
        }

        a {
            border-radius: 8px;
            height: 50px;
            width: 200px;
        }

        label {
            color: #d30064;
            font-weight: bold;
            font-size: 20px;

        }

        #title {
            color: #0900d3;
            font-weight: bold;
            text-transform: capitalize;
        }

        #heading {
            color: darkviolet;
            font-weight: bold;
            text-transform: capitalize;
        }

        body {
            height: 100%;
            /*background: linear-gradient(to bottom, rgb(100 100 100 / 80%) 0%, rgb(123 119 158 / 80%) 10%), url(./images/badminton.jpeg); background-size:cover;background-repeat: no-repeat;background-position: center center;*/
            background: rgb(189, 220, 240);
            text-align: center
        }


        tr {
            text-align: left;

        }

        td {
            padding-left: 15px;
        }

        #tableDiv {
            margin-left: 150px;
        }

        h3 {
            text-align: left;
            text-transform: Capitalize;
        }

        h3 a {
            color: #2f3be0;
        }
    </style>
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

















































