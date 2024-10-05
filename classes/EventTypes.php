<?php 

class EventTypes {
    private $event_type_id;
    private $event_name;
    private $created_at;
    private $modified_at;

    public function __construct($event_name) {
        $this->event_name = $event_name;
    }

    // Getters
    public function getEventTypeId() {
        return $this->event_type_id;
    }

    public function getEventName() {
        return $this->event_name;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getModifiedAt() {
        return $this->modified_at;
    }

    // Setters
    public function setEventName($event_name) {
        $this->event_name = $event_name;
    }

    // Method to fetch all event types from the database
    public static function getAllEventType($con) {
        try {
            $query = "SELECT * FROM EventTypes";
            $stmt = $con->prepare($query);
            $stmt->execute();
            
            // Fetch all rows as associative array
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            die("Error fetching event types: " . $e->getMessage());
        }
    }

    // Function to get the event name by ID
    public static function getEventNameById($con, $eventTypeId) {
        try {
            $query = "SELECT event_name FROM EventTypes WHERE event_type_id = ?";
            $stmt = $con->prepare($query);
            $stmt->execute([$eventTypeId]);
            
            // Fetch the result
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['event_name'] : null; // Return event name or null if not found

        } catch (PDOException $e) {
            die("Error fetching event name by ID: " . $e->getMessage());
        }
    }
}


?>