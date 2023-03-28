<?php
    require_once("./../db/db_conn.php");
    
    if(empty($_GET["bp_id"])) {
        echo ("<p> Product ID not found </p>");
        echo ("<br><a href='details.php'>Go Back </a>");
        exit();
    } else {
        $bp_id=(int)htmlspecialchars($_GET["bp_id"]);
        $query="DELETE FROM BadmintonProducts where bp_id = ?";
        $stmt=mysqli_prepare($dbc, $query);
        
        mysqli_stmt_bind_param($stmt, "i", $bp_id);
        
        $result = mysqli_stmt_execute($stmt);
        
        if($result) {
            header("Location: details.php");
            exit();
        } else {
            echo ("<br> some error deleting records: " . mysqli_error($dbc));
        }
    }
?>



