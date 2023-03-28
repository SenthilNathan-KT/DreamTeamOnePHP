<!doctype html>
<html>
    <body>
        <?php
        
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                define("INITIALIZING_DATABASE", 1);
                require_once("db_conn.php");
                mysqli_query($dbc, "DROP DATABASE IF EXISTS BadmintonGears");
                mysqli_query($dbc, "CREATE DATABASE BadmintonGears");
                mysqli_query($dbc, "USE BadmintonGears");
                
                mysqli_query($dbc, 
                    "CREATE TABLE BadmintonProducts (
                        bp_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
                        bp_name varchar(100) NOT NULL,
                        bp_color varchar(30) NOT NULL,
                        bp_image varchar(255) NOT NULL,
                        bp_description varchar(255) NOT NULL,
                        quantity mediumint(8) unsigned NOT NULL,
                        price decimal(15,2) NOT NULL,
                        product_added_by varchar(100) NOT NULL,
                        PRIMARY KEY(bp_id)
                    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4");
                    
                mysqli_query($dbc, "INSERT INTO BadmintonProducts (bp_name, bp_color, bp_image, bp_description, quantity, price, product_added_by) VALUES
                                ('Yonex Astrox Racquet', 'Green', 'AstroxGreen', 'A racquet with a high durability.', 500, 49.99,'Senthil'),
                                ('Yonex NanoRay Racquet', 'Yellow', 'NanoRayYellow', 'A very competitive racquet for tournament play.', 800, 64.49,'Senthil'),
                                ('Yonex Badminton Shoe', 'Green', 'ShoeGreen', 'A perfect sport shoe for a comfortable game', 300, 124.99,'Senthil'),
                                ('Yonex Badminton Shoe', 'Blue', 'ShoeBlue', 'A perfect sport shoe for a comfortable game', 300, 134.99,'Senthil'),
                                ('Yonex BG65 Racquet String', 'Pink', 'BG65Pink', 'A string which has more life for the racquet for a fast game', 75, 13.78,'Senthil'),
                                ('Yonex BG65 Racquet String', 'White', 'BG65White', 'A string which has more life for the racquet for a fast game', 75, 11.78,'Senthil');");
                
                
                mysqli_query($dbc, 
                    "CREATE TABLE User (
                        user_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
                        username varchar(255) NOT NULL,
                        password varchar(255) NOT NULL,
                        user_type ENUM('Admin','User') DEFAULT 'USER',
                        PRIMARY KEY(user_id)
                    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4");
                    
                mysqli_query($dbc, "INSERT INTO User (username, password, user_type) VALUES
                                ('Admin', 'Admin', 'Admin'),
                                ('User1', 'User1', 'User'),
                                ('User2', 'User2', 'User');");
                                
            
                
            
                echo "<h3> Database Initialized </h3>";
            }
        
        ?>
        <form method="POST">
            <input type="submit" value="Initialize Database">
        </form>
    </body>
</html>








