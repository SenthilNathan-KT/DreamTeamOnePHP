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
            self::loadConfig();
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
                        bp_description varchar(255) NOT NULL,
                        quantity mediumint(8) unsigned NOT NULL,
                        price decimal(15,2) NOT NULL,
                        product_added_by varchar(100) NOT NULL,
                        PRIMARY KEY(bp_id)
                    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4");

            $pdo->query(
                "INSERT INTO BadmintonProducts (bp_name, bp_color, bp_image, bp_description, quantity, price, product_added_by) VALUES
                                ('Yonex Astrox Racquet', 'Green', 'AstroxGreen', 'A racquet with a high durability.', 500, 49.99,'Senthil'),
                                ('Yonex NanoRay Racquet', 'Yellow', 'NanoRayYellow', 'A very competitive racquet for tournament play.', 800, 64.49,'Senthil'),
                                ('Yonex Badminton Shoe', 'Green', 'ShoeGreen', 'A perfect sport shoe for a comfortable game', 300, 124.99,'Senthil'),
                                ('Yonex Badminton Shoe', 'Blue', 'ShoeBlue', 'A perfect sport shoe for a comfortable game', 300, 134.99,'Senthil'),
                                ('Yonex BG65 Racquet String', 'Pink', 'BG65Pink', 'A string which has more life for the racquet for a fast game', 75, 13.78,'Senthil'),
                                ('Yonex BG65 Racquet String', 'White', 'BG65White', 'A string which has more life for the racquet for a fast game', 75, 11.78,'Senthil');"
            );

            $pdo->query("CREATE TABLE User (
                        user_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
                        username varchar(255) NOT NULL,
                        password varchar(255) NOT NULL,
                        user_type ENUM('Admin','User') DEFAULT 'USER',
                        PRIMARY KEY(user_id)
                    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4");

            $pdo->query(
                "INSERT INTO User (username, password, user_type) VALUES
                                ('Admin', 'Admin', 'Admin'),
                                ('User1', 'User1', 'User'),
                                ('User2', 'User2', 'User');");

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








