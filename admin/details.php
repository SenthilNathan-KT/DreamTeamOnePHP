<?php
require_once("./../dal/product.php");
$results = Product::getAll();
?>
<html>
    <head>
        <style>
            #registration_form {
                text-align: center;
                margin-top:50px;
            }
            
            input {
                border-radius:10px;
                height: 20px;
                margin-top: 10px;
                color: #212529;
                background-color: #abe3ea;
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
            
            #link {
                border-radius: 8px;
                height:50px;
                width: 200px;
            }
            
            label {
                color: #03fc6b;
                font-weight: bold;
            }
            
            #title {
                color: #FFA500;
                font-weight: bold;
                text-transform: capitalize;
            }
            
            
            th{
                color:#fcba03;
            }
            
            table {
                width: 90%;
                margin-left: auto;
                margin-right: auto;
            }
    
            table th {
                background: rgb(65,132, 42);
                color: #eee;
            }

            tr:nth-child(even) {
                background: rgb(205, 214, 163);
            }
            
            tr:nth-child(odd) {
                background: rgb(143, 191, 173);
            }

            td,th {
                padding: 5px 8px;
                text-align: center;
            }

            table > caption {
                font-weight: 600;
            }
            
            h1 {
                text-align: center;
                Color: darkviolet;
                text-transform: Capitalize;
                padding-top: 20px;
            }
            h2 {
                text-align: center;
                
                text-transform: Capitalize;
                
            }
            h3 {
                text-align: left;
                text-transform: Capitalize;
            }
            h3 a {
                color: #2f3be0;
            }
            body {
                background: rgb(189, 220, 240);
            }
        </style>
    </head>
    <body>
        <h3><a href="insert.php" color="blue">Add product</h3></a>
        <h1>Product details</h1>
        <table>
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
                    while($row= $results -> fetch()) {
                        $sr_no++;
                        $str_to_print="<tr><td>{$row['bp_id']}</td>";
                        $str_to_print.="<td>{$row['bp_name']}</td>";
                        $str_to_print.="<td>{$row['bp_color']}</td>";
                        $str_to_print.="<td><img src='./../images/{$row['bp_image']}.png' height=75 width=60></td>";
                        $str_to_print.="<td>{$row['bp_description']}</td>";
                        $str_to_print.="<td>{$row['quantity']}</td>";
                        $str_to_print.="<td>{$row['price']}</td>";
                        $str_to_print.="<td>{$row['product_added_by']}</td>";
                        $str_to_print.="<td>
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