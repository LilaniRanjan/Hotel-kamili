<?php

namespace classes;

use PDO;
use PDOException;

class RoomAmenity {
    private $room_amenity_id;
    private $room_id;
    private $amenity_name;

    // Constructor
    public function __construct($room_id, $amenity_name) {
        $this->room_id = $room_id;
        $this->amenity_name = $amenity_name;
    }

    // Getters
    public function getRoomAmenityId() {
        return $this->room_amenity_id;
    }

    public function getRoomId() {
        return $this->room_id;
    }

    public function getAmenityName() {
        return $this->amenity_name;
    }

    // Setters
    public function setRoomId($room_id) {
        $this->room_id = $room_id;
    }

    public function setAmenityName($amenity_name) {
        $this->amenity_name = $amenity_name;
    }

    // Create a new room amenity record
    public function create($con) {
        try {
            $query = "INSERT INTO RoomAmenity (room_id, amenity_name) VALUES (?, ?)";
            $stmt = $con->prepare($query);
            $stmt->bindValue(1, $this->room_id);
            $stmt->bindValue(2, $this->amenity_name);
            $stmt->execute();
            $this->room_amenity_id = $con->lastInsertId();
            return ($stmt->rowCount() > 0) ? $this->room_amenity_id : false;
        } catch (PDOException $e) {
            die("Error creating room amenity: " . $e->getMessage());
        }
    }

    // Read room amenities by room ID
    public static function readByRoomId($con, $room_id) {
        try {
            $query = "SELECT * FROM RoomAmenity WHERE room_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bindValue(1, $room_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Ensure it fetches associative array
        } catch (PDOException $e) {
            die("Error fetching room amenities: " . $e->getMessage());
        }
    }

    // Delete a room amenity record
    public static function delete($con, $room_amenity_id) {
        try {
            $query = "DELETE FROM RoomAmenity WHERE room_amenity_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bindValue(1, $room_amenity_id);
            $stmt->execute();
            return ($stmt->rowCount() > 0);
        } catch (PDOException $e) {
            die("Error deleting room amenity: " . $e->getMessage());
        }
    }
}
?>
