<?php
require_once("./../dal/db_conn.php");

class Product
{
    const TB_NAME = 'BadmintonProducts';

    // Properties
    protected int $bp_id;
    protected string $bp_name;
    protected string $bp_color;
    protected string $bp_image;
    protected string $bp_description;
    protected int $quantity;
    protected float $price;
    protected string $product_added_by;

    protected array $errors = [];

    // Constructor
    public function __construct($properties = [])
    {
        if (isset($properties["bp_id"])) $this->setBpId($properties["bp_id"]);
        if (isset($properties["bp_name"])) $this->setBpName($properties["bp_name"]);
        if (isset($properties["bp_color"])) $this->setBpColor($properties["bp_color"]);
        if (isset($properties["bp_image"])) $this->setBpImage($properties["bp_image"]);
        if (isset($properties["bp_description"])) $this->setBpDescription($properties["bp_description"]);
        if (isset($properties["quantity"])) $this->setQuantity($properties["quantity"]);
        if (isset($properties["price"])) $this->setPrice($properties["price"]);
    }


    /////////////////////////// CRUD ///////////////////////////
    public static function getAll(): false|PDOStatement
    {
        $pdo = DBHelper::getConnection();
        $query = "SELECT * FROM " . self::TB_NAME;
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function findById(int $watch_id): void
    {
        $pdo = DBHelper::getConnection();
        $query = "SELECT * FROM " . self::TB_NAME . " WHERE bp_id = :bp_id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['bp_id' => $watch_id]);

        $product = $stmt->fetch();
        if ($product) {
            $this->bp_id = $product["bp_id"];
            $this->bp_name = $product["bp_name"];
            $this->bp_color = $product["bp_color"];
            $this->bp_image = $product["bp_image"];
            $this->bp_description = $product["bp_description"];
            $this->quantity = $product["quantity"];
            $this->price = $product["price"];
            $this->product_added_by = $product["product_added_by"];
        }
    }

    public function delete(): bool
    {
        $pdo = DBHelper::getConnection();
        $stmt = $pdo->prepare("DELETE FROM " . self::TB_NAME . " WHERE bp_id = :bp_id");
        return $stmt->execute(['bp_id' => $this->bp_id]);
    }

    public function insert(): bool|PDOStatement
    {
        $pdo = DBHelper::getConnection();
        $stmt = $pdo->prepare("INSERT INTO " . self::TB_NAME . " (bp_name, bp_color, bp_image, bp_description, quantity, price, product_added_by) VALUES (:bp_name, :bp_color, :bp_image, :bp_description, :quantity, :price, :product_added_by)");
        $stmt->execute([
            "bp_name" => $this->bp_name,
            "bp_color" => $this->bp_color,
            "bp_image" => $this->bp_image,
            "bp_description" => $this->bp_description,
            "quantity" => $this->quantity,
            "price" => $this->price,
            "product_added_by" => "admin" // Change this to the user who is logged in
        ]);

        $this->bp_id = $pdo->lastInsertId();
        return $stmt;
    }

    public function update(): bool
    {
        $pdo = DBHelper::getConnection();
        $stmt = $pdo->prepare("UPDATE " . self::TB_NAME . " SET bp_name = :bp_name, bp_color = :bp_color, bp_image = :bp_image, bp_description = :bp_description, quantity = :quantity, price = :price WHERE bp_id = :bp_id");
        return $stmt->execute([
            "bp_name" => $this->bp_name,
            "bp_color" => $this->bp_color,
            "bp_image" => $this->bp_image,
            "bp_description" => $this->bp_description,
            "quantity" => $this->quantity,
            "price" => $this->price,
            "bp_id" => $this->bp_id
        ]);
    }

    ///////////////////////////// SETTERS AND GETTERS /////////////////////////////

    /**
     * @return int
     */
    public function getBpId(): int
    {
        return $this->bp_id;
    }

    /**
     * @param String $bp_id
     */
    public function setBpId(string $bp_id): void
    {
        $id = trim(htmlspecialchars($bp_id));

        // validate product id
        if (empty($id)) {
            $this->errors[] = "<p>Product id is required</p>";
        } else if (!filter_var($id, FILTER_VALIDATE_INT)) {
            $this->errors[] = "<p>Product id must be a number</p>";
        }
        $this->bp_id = (int)$id;
    }

    /**
     * @return String
     */
    public function getBpName(): string
    {
        return $this->bp_name;
    }

    /**
     * @param String $bp_name
     */
    public function setBpName(string $bp_name): void
    {
        $this->bp_name = trim(htmlspecialchars($bp_name));

        // validate product name
        if (empty($this->bp_name)) {
            $this->errors[] = "<p>Product name is required</p>";
        } else if (strlen($this->bp_name) > 50) {
            $this->errors[] = "<p>Product name must be less than 50 characters</p>";
        }
    }

    /**
     * @return String
     */
    public function getBpColor(): string
    {
        return $this->bp_color;
    }

    /**
     * @param String $bp_color
     */
    public function setBpColor(string $bp_color): void
    {
        $this->bp_color = $bp_color;

        // validate product color
        if (empty($this->bp_color)) {
            $this->errors[] = "<p>Product color is required</p>";
        }

        if (!ctype_alpha(str_replace(' ', '', $this->bp_color))) {
            $this->errors[] = "<p> Kindly enter a valid color</p>";
        }
    }

    /**
     * @return String
     */
    public function getBpImage(): string
    {
        return $this->bp_image;
    }

    /**
     * @param String $bp_image
     */
    public function setBpImage(string $bp_image): void
    {
        $this->bp_image = $bp_image;

        // validate product image
        if (empty($this->bp_image)) {
            $this->errors[] = "<p>Product image is required</p>";
        }
    }

    /**
     * @return String
     */
    public function getBpDescription(): string
    {
        return $this->bp_description;
    }

    /**
     * @param String $bp_description
     */
    public function setBpDescription(string $bp_description): void
    {
        $this->bp_description = $bp_description;

        // validate product description
        if (empty($this->bp_description)) {
            $this->errors[] = "<p>Product description is required</p>";
        }
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;

        // validate product quantity
        if (empty($this->quantity)) {
            $this->errors[] = "<p>Product quantity is required</p>";
        } else if (!filter_var($this->quantity, FILTER_VALIDATE_INT)) {
            $this->errors[] = "<p>Product quantity must be a number</p>";
        } else if ($this->quantity < 0) {
            $this->errors[] = "<p>Product quantity must be non-negative</p>";
        }
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;

        // validate product price
        if (empty($this->price)) {
            $this->errors[] = "<p>Product price is required</p>";
        } else if (!filter_var($this->price, FILTER_VALIDATE_FLOAT)) {
            $this->errors[] = "<p>Product price must be a number</p>";
        } else if ($this->price <= 0) {
            $this->errors[] = "<p>Product price must be greater than 0</p>";
        }
    }

    /**
     * @return String
     */
    public function getProductAddedBy(): string
    {
        return $this->product_added_by;
    }

    /**
     * @param String $product_added_by
     */
    public function setProductAddedBy(string $product_added_by): void
    {
        $this->product_added_by = $product_added_by;

        // validate product added by
        if (empty($this->product_added_by)) {
            $this->errors[] = "<p>Product added by is required</p>";
        }
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
