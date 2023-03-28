<html>
    <head>
        <style>
            
            body {
                height:100%;
                background: #aaaaa0;
                text-align:center;
            }
        </style>
    </head>
    <body>
        <h2 style="color:Red">Following error occurred while trying to update the badminton gear data.</h2>
    
<?php
    require_once("./../db/db_conn.php");
    $errors=[];
    
    if(empty($_POST["bp_id"])) {
        $bp_id = null;
        $errors[]="<p> Product ID is required</p>";
    }
    else 
        $bp_id=htmlspecialchars($_POST["bp_id"]);
        
        
        // retrieveData("Test", $errors);
    if(empty($_POST["name"]))
        $errors[]="<p> Name is required</p>";
    else {
        $name=htmlspecialchars($_POST["name"]);
        // if(!ctype_alpha(str_replace(' ', '', $name))) {   
        //     $errors[]="<p> Kindly enter a valid name which has only alphabets</p>";
            
        // }
    }
        
    if(empty($_POST["color"]))
        $errors[]="<p> Color is required</p>";
    else {
        $color=htmlspecialchars($_POST["color"]);
     
        if(!ctype_alpha(str_replace(' ', '', $color))) {   
            $errors[]="<p> Kindly enter a valid color</p>";
            
        }   
    }
    
    if(empty($_POST["image"]))
        $errors[]="<p> Image Name is required</p>";
    else 
        $bp_image=htmlspecialchars($_POST["image"]);
        
    if(empty($_POST["description"]))
        $errors[]="<p> Description is required</p>";
    else 
        $description=htmlspecialchars($_POST["description"]);
        
    if(empty($_POST["quantity"]))
        $errors[]="<p> Quantity is required</p>";
    else {
        $quantity= (int) htmlspecialchars($_POST["quantity"]);
        if($quantity == 0) {
            $errors[]="<p> Kindly enter a valid quantity</p>";
        }
    }
        
    if(empty($_POST["price"]))
        $errors[]="<p> Price is required</p>";
    else {
        $price= (float) htmlspecialchars($_POST["price"]);
        if($price == 0) {
            $errors[]="<p> Kindly enter a valid price</p>";
        }
    }

    if(count($errors)>0) {
        foreach($errors as $error)
            echo $error;
        echo "<a href='details.php'>Go back </a>";
    } else {
        $query = "UPDATE BadmintonProducts SET bp_name = ?, bp_color = ?, bp_description = ?, quantity = ?, price = ?, bp_image = ? WHERE bp_id = ?;";
        $stmt=mysqli_prepare($dbc, $query);
        
        mysqli_stmt_bind_param($stmt, "sssssss", $name, $color, $description, $quantity, $price, $bp_image, $bp_id);
        
        $result = @mysqli_stmt_execute($stmt);
        
        if($result){
            header("Location: details.php");
            exit();
        } else {
            echo ("Error occurred -> " . mysql_error($dbc));
        }
    }
?>

    </body>
</html>






