<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
        <meta charset="UTF-8">
        <title>Insert Gear</title>
        <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
        <link rel="stylesheet" href="./../css/custom.css">
    </head>
    <body>
        <h3><a href="details.php">All products</h3></a>
        <form class="form" action="register.php" method="post" id="registration_form">
            <h1 id="heading">Add a new Product</h1>
            <h2 id="title">Please enter the new badminton gear details to be saved in the Database</h2><br>
            <div id="tableDiv" >
                <table class="justify-content-center">

                    <tr>
                        <td><label for="name" class="placeholder" >Name:</label></td>
                        <td><input type="text" class="input" id="name" name="bp_name" placeholder="Enter the product name" value="Yonex Astrox Racquet"/></td>
                    </tr>
                    
                    <tr>
                        <td><label for="color" class="placeholder" >Color:</label></td>
                        <td><input type="text" class="input" id="color" name="bp_color" placeholder="Enter the color" value="Green"/></td>
                    </tr>
                    
                    <tr>
                        <td><label for="image" class="placeholder" >Image Name:</label></td>
                        <td><input type="text" class="input" id="image" name="bp_image" placeholder="Enter the color"  value="AstroxGreen"/></td>
                    </tr>                
                    
                    <tr>
                        <td><label for="description" class="placeholder" >Description:</label></td>
                        <td><input type="text" class="input" id="description" name="bp_description" placeholder="Enter product's description" value="A racquet with a high durability."/></td>
                    </tr>
                    
                    <tr>
                        <td><label for="quantity" class="placeholder" >Quantity:</label></td>
                        <td><input type="number" class="input" id="quantity" name="quantity" min="1" max="100000" value="500" /></td>
                    </tr>
                    
                    <tr>
                        <td><label for="price" class="placeholder">Price:</label></td>
                        <td><input type="text" class="input" id="price" name="price" placeholder="Value with 2 decimals" value="49.99"/></td>
                    </tr>

                </table>
            </div>
            
            <br>

            <button type="submit" class="submit">Insert gear..!!</button>
            
            <!--<h1 id="title">To view/edit all the products <br>-->
            <!--<h2><a href="details.php" color="blue">Click here..!!</h2></a>-->
            <!--</h1>-->
            <br>
        </form>
    </body>
</html>







































