<?php 

namespace classes;

class CakeOptions {
    private $cake_option_id; // INT, Primary Key
    private $cake_size;      // INT (weight in kilograms)
    private $cake_type;      // VARCHAR(50)
    private $cake_price;     // DECIMAL(10, 2)
    private $created_at;     // TIMESTAMP
    private $modified_at;    // TIMESTAMP

    // Constructor to initialize properties
    public function __construct($cake_size, $cake_type, $cake_price) {
        $this->cake_size = $cake_size;
        $this->cake_type = $cake_type;
        $this->cake_price = $cake_price;
        // created_at and modified_at will be handled by the database
    }

    // Getter for cake_option_id
    public function getCakeOptionId() {
        return $this->cake_option_id;
    }

    // Getter and Setter for cake_size
    public function getCakeSize() {
        return $this->cake_size;
    }

    public function setCakeSize($cake_size) {
        $this->cake_size = $cake_size;
    }

    // Getter and Setter for cake_type
    public function getCakeType() {
        return $this->cake_type;
    }

    public function setCakeType($cake_type) {
        $this->cake_type = $cake_type;
    }

    // Getter and Setter for cake_price
    public function getCakePrice() {
        return $this->cake_price;
    }

    public function setCakePrice($cake_price) {
        $this->cake_price = $cake_price;
    }

    // Getter for created_at (optional, since it's handled by the database)
    public function getCreatedAt() {
        return $this->created_at;
    }

    // Getter for modified_at (optional, since it's handled by the database)
    public function getModifiedAt() {
        return $this->modified_at;
    }

    // Method to fetch all cake options from the database
    public static function getAllCakeOptions($con) {
        try {
            $query = "SELECT * FROM CakeOptions";
            $stmt = $con->prepare($query);
            $stmt->execute();
            
            // Fetch all rows as associative array
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            die("Error fetching cake options: " . $e->getMessage());
        }
    }

    public static function getCakePriceByCakeOptionId($con, $cake_option_id) {
        try {
            $query = "SELECT cake_price FROM CakeOptions WHERE cake_option_id = ?";
            $stmt = $con->prepare($query);
            $stmt->execute([$cake_option_id]);
            
            // Fetch the result as an associative array
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            // If the result is found, return the cake price
            if ($result) {
                return $result['cake_price'];
            } else {
                return null;  // Return null if no record is found
            }
        } catch (\PDOException $e) {
            die("Error fetching cake price by ID: " . $e->getMessage());
        }
    }
    
}
?>
