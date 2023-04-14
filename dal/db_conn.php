<?php

class DBHelper
{
    const DB_NAME = 'BadmintonGears';
    const DB_CHARSET = 'utf8mb4';
    static protected string $dbUser = 'root';
    static protected string $dbPass = '';
    static protected string $dbHost = 'localhost';
    static protected ?PDO $connection = null;

    static function loadConfig(): void
    {
        if (file_exists(__DIR__ . "/config.ini")) {
            $config = parse_ini_file(__DIR__ . "/config.ini");
            self::$dbUser = $config['user'];
            self::$dbPass = $config['password'];
            self::$dbHost = $config['host'];
        }
    }

    static function initializeDatabase(): void
    {
        try {
            // self::loadConfig();
            if(defined("INITIALIZING_DATABASE"))
            $data_source_name = "mysql:host=".self::$dbHost.";charset=".self::DB_CHARSET;
        else
            $data_source_name = "mysql:host=" . self::$dbHost . ";dbname=" . self::DB_NAME . ";charset=" . self::DB_CHARSET;
            
            $pdo = new PDO($data_source_name, self::$dbUser, self::$dbPass);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $pdo->query("DROP DATABASE IF EXISTS " . self::DB_NAME);
            $pdo->query("CREATE DATABASE " . self::DB_NAME);
            $pdo->query("USE " . self::DB_NAME);

            $pdo->query("CREATE TABLE BadmintonProducts (
                        bp_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
                        bp_name varchar(100) NOT NULL,
                        bp_color varchar(30) NOT NULL,
                        bp_image varchar(255) NOT NULL,
                        bp_description TEXT NOT NULL,
                        quantity mediumint(8) unsigned NOT NULL,
                        price decimal(15,2) NOT NULL,
                        product_added_by varchar(100) NOT NULL,
                        PRIMARY KEY(bp_id)
                    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4");

            $pdo->query(
                "INSERT INTO BadmintonProducts (bp_name, bp_color, bp_image, bp_description, quantity, price, product_added_by) VALUES
                                ('Yonex Astrox Racquet', 'Green', 'AstroxGreen', 'The Yonex Astrox Racquet is an excellent choice for badminton players looking for a high-quality and durable racquet. This racquet features advanced technology that helps players generate more power and speed with each swing, allowing them to deliver precise and impactful shots on the court.\\nThe Astrox racquet is designed with a head-heavy balance that enables players to generate more momentum and power with each swing. This feature is particularly helpful for players who like to play an attacking game, as it allows them to hit powerful smashes and clear shots with ease.\\nThe racquet also features a stiff shaft that provides more control and accuracy, allowing players to execute precise shots with ease. This is particularly helpful for players who like to play a defensive game, as it enables them to return their opponent\'s shots with accuracy and consistency.\\nOverall, the Yonex Astrox Racquet is an excellent choice for badminton players looking for a high-quality and versatile racquet that can help them take their game to the next level.', 500, 49.99,'Senthil'),
                                ('Yonex NanoRay Racquet', 'Yellow', 'NanoRayYellow', 'Introducing the Yonex NanoRay Racquet - the ultimate choice for badminton players who want to take their game to the next level! This racquet is designed with advanced nanotechnology that helps players generate more power and speed with each swing, allowing them to deliver precise and impactful shots on the court.\\nThe NanoRay racquet is a perfect blend of power and speed, making it a popular choice among competitive players. The aerodynamic frame design enables players to cut through the air with ease, allowing them to generate more speed and momentum with each swing. Additionally, the racquet\'s head-light balance enables players to maneuver the racquet with ease, allowing them to execute quick and precise shots.\\nThe racquet also features a stiff shaft that provides more control and accuracy, allowing players to execute precise shots with ease. This is particularly helpful for players who like to play a defensive game, as it enables them to return their opponent\'s shots with accuracy and consistency.\\nOverall, the Yonex NanoRay Racquet is a top-of-the-line badminton racquet that is perfect for competitive players who want to elevate their game to the next level. Get yours today and experience the power and speed of the NanoRay racquet!', 800, 64.49,'Senthil'),
                                ('Yonex Badminton Shoe', 'Green', 'ShoeGreen', 'The Yonex Badminton Shoe is the perfect choice for badminton players looking for a comfortable and durable shoe. It is designed to provide excellent support and stability during gameplay, so you can focus on your performance and not worry about your feet.\\nThe shoe is made from high-quality materials that are both durable and breathable, so your feet will stay cool and comfortable even during long matches. It features a cushioned sole that absorbs shock and reduces impact, which helps to prevent foot and leg fatigue.\\nThe Yonex Badminton Shoe is also designed to be lightweight and flexible, which allows for quick movements and easy maneuverability on the court. The outsole is made from a non-marking rubber material that provides excellent traction and grip, so you can make quick stops and starts without slipping.\\nOverall, the Yonex Badminton Shoe is an excellent investment for any badminton player looking for a high-quality shoe that will provide comfort, support, and durability throughout their gameplay.', 300, 124.99,'Senthil'),
                                ('Yonex Badminton Shoe', 'Blue', 'ShoeBlue', 'The Yonex Badminton Shoe in blue is a high-performance sports shoe designed specifically for the needs of badminton players. Made with premium materials and advanced technology, these shoes are engineered to deliver excellent support, comfort, and performance on the court.\\nThe shoe features a lightweight and breathable upper that provides a comfortable fit and allows your feet to stay cool and dry throughout the game. The cushioned insole and midsole offer superior shock absorption and help to reduce fatigue and strain on your feet, so you can stay focused and energized for longer.\\nThe Yonex Badminton Shoe also features a non-marking rubber outsole that provides excellent traction and stability on the court, allowing you to make quick and precise movements with confidence. The shoe is available in a sleek blue color that will complement your badminton outfit and add a touch of style to your game.\\nWith its superior quality and design, the Yonex Badminton Shoe in blue is the perfect choice for serious badminton players who demand the best from their gear. Whether you\'re a beginner or a seasoned pro, these shoes will help you to take your game to the next level.', 300, 134.99,'Senthil'),
                                ('Yonex BG65 Racquet String', 'Pink', 'BG65Pink', 'The Yonex BG65 Racquet String is a high-quality string that is specifically designed to provide players with more life for their racquet and an optimal playing experience. The string is made of a durable and high-quality material that ensures it can withstand the rigorous demands of intense gameplay. This means that players can rely on this string to provide them with exceptional durability and long-lasting performance.\\nIn addition to its impressive durability, the Yonex BG65 Racquet String is also designed to provide players with a fast game. The string is engineered to provide a quick and responsive feel, which is essential for players looking to gain an edge in their matches. With its fast and responsive performance, the Yonex BG65 Racquet String is a great choice for players looking to take their game to the next level.\\nOverall, the Yonex BG65 Racquet String is an excellent choice for players of all skill levels who are looking for a high-quality string that offers both durability and performance. Whether you are a beginner or an experienced player, this string is sure to provide you with the performance you need to succeed on the court.', 75, 13.78,'Senthil'),
                                ('Yonex BG65 Racquet String', 'White', 'BG65White', 'The Yonex BG65 Racquet String in white is an ideal choice for any badminton player looking for a durable, high-performance string. Made from a blend of high-quality nylon and polyurethane, this string is designed to provide exceptional durability, as well as enhanced repulsion and control. The white color of the string gives it a sleek, professional look on the court.\\nWith a thickness of 0.70mm, the Yonex BG65 string strikes a perfect balance between power and control. It provides enough power to help you hit powerful smashes and clears, while also giving you enough control to execute accurate drop shots and net shots. The string also has a high tension holding capability, allowing you to maintain your desired tension for a longer period of time.\\nThe Yonex BG65 string is perfect for players who prefer a faster game and want their racquet to have a more responsive feel. This string is suitable for both amateur and professional players, and its high-quality construction makes it a popular choice among badminton enthusiasts worldwide.', 75, 11.78,'Senthil');"
            );

            $pdo->query("CREATE TABLE user (
                        user_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
                        firstName varchar(255) NOT NULL,
                        lastName varchar(255) NOT NULL,
                        email varchar(255) NOT NULL,
                        imageName varchar(255) NOT NULL,
                        passwordHash varchar(255) NOT NULL,
                        user_type ENUM('Admin','User') DEFAULT 'User',
                        PRIMARY KEY(user_id)
                    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4");

            $hashAdmin=password_hash("admin",PASSWORD_DEFAULT);
            
            $pdo->query(
                "INSERT INTO user(firstName,lastName,email,passwordHash,user_type, imageName)
                 values
                ('Nikhil','Bathula','admin@gmail.com','$hashAdmin', 'Admin', '')");

            echo "<h3> Database Initialized</h3>";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    static function getConnection(): ?PDO
    {
        if (self::$connection == null) {
            try {
                self::loadConfig();
                $data_source_name = "mysql:host=" . self::$dbHost . ";dbname=" . self::DB_NAME . ";charset=" . self::DB_CHARSET;
                self::$connection = new PDO($data_source_name, self::$dbUser, self::$dbPass);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return self::$connection;
    }
}








