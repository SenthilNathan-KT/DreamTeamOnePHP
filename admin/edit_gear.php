<?php
    require_once("./../db/db_conn.php");
    
    $error=null;
    
    if(!empty($_GET["bp_id"])) {
        $bp_id = (int)htmlspecialchars($_GET["bp_id"]);
    } else {
        $bp_id = null;
        $error="<p> Product id is not found</p>";
    }
    
    if($error == null) {
        $query="select * from BadmintonProducts where bp_id=?";
        $stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, "i", $bp_id);
        $result = mysqli_stmt_execute($stmt);
        
        if($result){
            $result = mysqli_stmt_get_result($stmt);
            $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
            $bp_name = $row["bp_name"];
            $bp_color = $row["bp_color"];
            $bp_image = $row["bp_image"];
            $bp_description = $row["bp_description"];
            $quantity = $row["quantity"];
            $price = $row["price"];
        }
        
    } else {
        echo ("<html><body><div<p style='background: #aaaaa0;color:Red'>" . $error . "</p></div></body></html>");
        echo"<br><a href='details.php'> Go Back to details page </a>";
        exit();
    }
?>
<!DOCTYPE html>
<html>
        <head>
        <style>
            #registration_form {
                margin-top:50px;
            }
            
            input {
                border-radius:10px;
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
                height:50px;
                width: 200px;
            }
            
            label {
                color: #d30064;
                font-weight: bold;
                font-size:20px;
                
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
                height:100%;
                /*background: linear-gradient(to bottom, rgb(100 100 100 / 80%) 0%, rgb(123 119 158 / 80%) 10%), url(./images/badminton.jpeg); background-size:cover;background-repeat: no-repeat;background-position: center center;*/
                background: rgb(189, 220, 240);
                text-align:center
            }
            
            
            tr{
                text-align:left;
              
            }
            
            td{
                padding-left:15px;
            }
            
            #tableDiv {
                margin-left:150px;
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
            <div id="tableDiv" >
                <table class="justify-content-center">

                    <tr>
                        <input type="hidden" id="bp_id" name="bp_id" value="<?php echo($bp_id);?>"/>
                        <td><label for="name" class="placeholder" >Name:</label></td>
                        <td><input type="text" class="input" id="name" name="name" placeholder="Enter the product name" value="<?php echo($bp_name); ?>"/></td>
                    </tr>
                    
                    <tr>
                        <td><label for="color" class="placeholder" >Color:</label></td>
                        <td><input type="text" class="input" id="color" name="color" placeholder="Enter the color" value="<?php echo($bp_color); ?>"/></td>
                    </tr>
                    
                    <tr>
                        <td><label for="image" class="placeholder" >Image Name:</label></td>
                        <td><input type="text" class="input" id="image" name="image" placeholder="Enter the color"  value="<?php echo($bp_image); ?>"/></td>
                    </tr>                
                    
                    <tr>
                        <td><label for="description" class="placeholder" >Description:</label></td>
                        <td><input type="text" class="input" id="description" name="description" placeholder="Enter product's description" value="<?php echo($bp_description); ?>"/></td>
                    </tr>
                    
                    <tr>
                        <td><label for="quantity" class="placeholder" >Quantity:</label></td>
                        <td><input type="number" class="input" id="quantity" name="quantity" min="1" max="100000" value="<?php echo($quantity); ?>" /></td>
                    </tr>
                    
                    <tr>
                        <td><label for="price" class="placeholder">Price:</label></td>
                        <td><input type="text" class="input" id="price" name="price" placeholder="Value with 2 decimals" value="<?php echo($price); ?>"/></td>
                    </tr>

                </table>
            </div>
            <br>

            <button type="submit" class="submit">Update Data</button><br><br><br>
            <!--<h1 id="title">To view/edit all the products <br>-->
            <!--<h2><a href="details.php" color="blue">Click here..!!</h2></a>-->
            <!--</h1>-->
            .
        </form>
    </body>
</html>

















































