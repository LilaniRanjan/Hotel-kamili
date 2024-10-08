<?php
class EventCustomization {
    // Properties
    public $customization_id;
    public $reservation_id;
    public $event_type_id;
    public $selected_decoration_id;
    public $theme_color;
    public $cake_order;
    public $cake_kg;
    public $cake_type_id;
    public $cake_message;
    public $cake_design;
    public $suggestions;
    public $total_customization_price; // New property
    public $created_at;
    public $updated_at;

    // Constructor with parameters
    public function __construct($reservation_id, $event_type_id, $selected_decoration_id, $theme_color, 
                                $cake_order, $cake_kg, $cake_type_id, $cake_message, 
                                $cake_design, $suggestions, $total_customization_price) {
        $this->reservation_id = $reservation_id;
        $this->event_type_id = $event_type_id;
        $this->selected_decoration_id = $selected_decoration_id;
        $this->theme_color = $theme_color;
        $this->cake_order = $cake_order;
        $this->cake_kg = $cake_kg;
        $this->cake_type_id = $cake_type_id;
        $this->cake_message = $cake_message;
        $this->cake_design = $cake_design;
        $this->suggestions = $suggestions;
        $this->total_customization_price = $total_customization_price;
    }

    // Create a new EventCustomization
    public function create($con) {
        $query = "INSERT INTO EventCustomizations (reservation_id, event_type_id, selected_decoration_id, theme_color, 
                  cake_order, cake_kg, cake_type_id, cake_message, cake_design, suggestions, total_customization_price) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        $stmt = $con->prepare($query);
    
        // Bind parameters
        $stmt->bindParam(1, $this->reservation_id);
        $stmt->bindParam(2, $this->event_type_id);
        $stmt->bindParam(3, $this->selected_decoration_id);
        $stmt->bindParam(4, $this->theme_color);
        $stmt->bindParam(5, $this->cake_order);
        $stmt->bindParam(6, $this->cake_kg);
        $stmt->bindParam(7, $this->cake_type_id);
        $stmt->bindParam(8, $this->cake_message);
        $stmt->bindParam(9, $this->cake_design);
        $stmt->bindParam(10, $this->suggestions);
        $stmt->bindParam(11, $this->total_customization_price); // Bind the new property
    
        // Execute the query
        if ($stmt->execute()) {
            $this->customization_id = $con->lastInsertId(); // Use $con to get last inserted ID
            return true;
        } else {
            // Optionally log the error
            // $errorInfo = $stmt->errorInfo();
            // error_log("Error executing query: " . $errorInfo[2]);
            return false;
        }
    }
}
?>
