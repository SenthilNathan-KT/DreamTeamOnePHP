<?php
require_once("./../dal/db_conn.php");
$results = Product::getAll();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
    <link rel="stylesheet" href="./../css/custom.css">
</head>
<body>
<header class="container">
    <hgroup>
        <h1>Badminton Shop</h1>
        <h2>An e-commerce website</h2>
    </hgroup>
</body>
</html>