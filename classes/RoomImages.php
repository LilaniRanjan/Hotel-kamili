<?php

namespace classes;

use PDO;
use PDOException;

class RoomImages {
    private $room_image_id;
    private $room_id;
    private $image_path;

    // Constructor
    public function __construct($room_id, $image_path) {
        $this->room_id = $room_id;
        $this->image_path = $image_path;
    }

    // Getters
    public function getRoomImageId() {
        return $this->room_image_id;
    }

    public function getRoomId() {
        return $this->room_id;
    }

    public function getImagePath() {
        return $this->image_path;
    }

    // Setters
    public function setRoomId($room_id) {
        $this->room_id = $room_id;
    }

    public function setImagePath($image_path) {
        $this->image_path = $image_path;
    }

    // Create a new room image record
    public function create($con) {
        try {
            $query = "INSERT INTO RoomImages (room_id, image_path) VALUES (?, ?)";
            $stmt = $con->prepare($query);
            $stmt->bindValue(1, $this->room_id);
            $stmt->bindValue(2, $this->image_path);
            $stmt->execute();
            $this->room_image_id = $con->lastInsertId();
            return ($stmt->rowCount() > 0) ? $this->room_image_id : false;
        } catch (PDOException $e) {
            die("Error creating room image: " . $e->getMessage());
        }
    }

    // Read room images by room ID
    public static function readByRoomId($con, $room_id) {
        try {
            $query = "SELECT * FROM RoomImages WHERE room_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bindValue(1, $room_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error reading room images: " . $e->getMessage());
        }
    }

    // Delete a room image record
    public static function delete($con, $room_image_id) {
        try {
            $query = "DELETE FROM RoomImages WHERE room_image_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bindValue(1, $room_image_id);
            $stmt->execute();
            return ($stmt->rowCount() > 0);
        } catch (PDOException $e) {
            die("Error deleting room image: " . $e->getMessage());
        }
    }
}
?>
