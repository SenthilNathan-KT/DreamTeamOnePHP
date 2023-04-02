<?php
require_once("./../dal/product.php");
$results = Product::getAll();
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Product Details</title>
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
    <link rel="stylesheet" href="./../css/custom.css">
</head>
<body>
<nav>
    <ul>
        <li>
            <h1>Admin</h1>
        </li>
    </ul>
    <ul>
        <li>
            <a href="insert.php">Add product</a>
        </li>
    </ul>
</nav><!-- ./ Nav -->
<table role="grid" class="pico-table">
    <thead>
    <tr align="left">
        <th>Gear ID</th>
        <th>Name</th>
        <th>Color</th>
        <th>Image</th>
        <th>Description</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Added By</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php

    $sr_no = 0;
    while ($row = $results->fetch()) {
        $sr_no++;
        $str_to_print = "<tr><td>{$row['bp_id']}</td>";
        $str_to_print .= "<td>{$row['bp_name']}</td>";
        $str_to_print .= "<td>{$row['bp_color']}</td>";
        $str_to_print .= "<td><img style='background: white; padding: 5px' src='./../images/{$row['bp_image']}.png' height=75 width=60></td>";
        $str_to_print .= "<td>{$row['bp_description']}</td>";
        $str_to_print .= "<td>{$row['quantity']}</td>";
        $str_to_print .= "<td>{$row['price']}</td>";
        $str_to_print .= "<td>{$row['product_added_by']}</td>";
        $str_to_print .= "<td>
                        <a href='edit_gear.php?bp_id={$row['bp_id']}'>Edit</a>
                        <a href='delete_gear.php?bp_id={$row['bp_id']}'>Delete</a>
                        </td></tr>";

        echo $str_to_print;
    }
    ?>
    </tbody>
</table>
<br>
</body>
</html>