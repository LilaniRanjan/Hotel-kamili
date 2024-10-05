<?php 

class DecorationOptions {
    private $decoration_id;
    private $event_type_id;
    private $decoration_name;
    private $decoration_image;
    private $decoration_price;
    private $created_at;
    private $modified_at;

    public function __construct($event_type_id, $decoration_name, $decoration_image, $decoration_price) {
        $this->event_type_id = $event_type_id;
        $this->decoration_name = $decoration_name;
        $this->decoration_image = $decoration_image;
        $this->decoration_price = $decoration_price;
    }

    // Getters
    public function getDecorationId() {
        return $this->decoration_id;
    }

    public function getEventTypeId() {
        return $this->event_type_id;
    }

    public function getDecorationName() {
        return $this->decoration_name;
    }

    public function getDecorationImage() {
        return $this->decoration_image;
    }

    public function getDecorationPrice() {
        return $this->decoration_price;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getModifiedAt() {
        return $this->modified_at;
    }

    // Setters
    public function setDecorationName($decoration_name) {
        $this->decoration_name = $decoration_name;
    }

    public function setDecorationImage($decoration_image) {
        $this->decoration_image = $decoration_image;
    }

    public function setDecorationPrice($decoration_price) {
        $this->decoration_price = $decoration_price;
    }

    // Method to fetch a decoration option by its ID
    public static function getDecorationById($con, $decoration_id) {
        try {
            $query = "SELECT * FROM DecorationOptions WHERE decoration_id = ?";
            $stmt = $con->prepare($query);
            $stmt->execute([$decoration_id]);
            
            // Fetch the result as an associative array
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            die("Error fetching decoration by ID: " . $e->getMessage());
        }
    }

    // Function to fetch decoration options by event type ID
    public static function getDecorationOptionsByEventTypeID($con, $event_type_id) {
        try {
            $query = "SELECT * FROM DecorationOptions WHERE event_type_id = ?";
            $stmt = $con->prepare($query);
            $stmt->execute([$event_type_id]);
            
            // Fetch all results as an associative array
            $decorations = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $decorations;
        } catch (PDOException $e) {
            die("Error fetching decoration options by event type ID: " . $e->getMessage());
        }
    }

    public static function getDecorationPriceByDecorationId($con, $decoration_id) {
        try {
            $query = "SELECT decoration_price FROM DecorationOptions WHERE decoration_id = ?";
            $stmt = $con->prepare($query);
            $stmt->execute([$decoration_id]);
            
            // Fetch the result as an associative array
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // If the result is found, return the decoration price
            if ($result) {
                return $result['decoration_price'];
            } else {
                return null;  // Return null if no record is found
            }
        } catch (PDOException $e) {
            die("Error fetching decoration price by ID: " . $e->getMessage());
        }
    }
    
}


?>