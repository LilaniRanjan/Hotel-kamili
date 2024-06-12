<?php

namespace classes;

use PDO;
use PDOException;

class Room {
    private $room_id;
    private $room_type;
    private $adult_count;
    private $children_count;
    private $price_per_night;
    private $room_description;
    private $number_of_rooms;
    private $room_inside_normal_image;
    private $room_inside_360view_image;
    private $room_bathroom_360view_image;
    private $room_outdoor_360view_image;

    // Constructor
    public function __construct($room_type, $adult_count, $children_count, $price_per_night, $room_description, $number_of_rooms, $room_inside_normal_image, $room_inside_360view_image, $room_bathroom_360view_image, $room_outdoor_360view_image) {
        $this->room_type = $room_type;
        $this->adult_count = $adult_count;
        $this->children_count = $children_count;
        $this->price_per_night = $price_per_night;
        $this->room_description = $room_description;
        $this->number_of_rooms = $number_of_rooms;
        $this->room_inside_normal_image = $room_inside_normal_image;
        $this->room_inside_360view_image = $room_inside_360view_image;
        $this->room_bathroom_360view_image = $room_bathroom_360view_image;
        $this->room_outdoor_360view_image = $room_outdoor_360view_image;
    }

    // Getters
    public function getRoomId() {
        return $this->room_id;
    }

    public function getRoomType() {
        return $this->room_type;
    }

    public function getAdultCount() {
        return $this->adult_count;
    }

    public function getChildrenCount() {
        return $this->children_count;
    }

    public function getPricePerNight() {
        return $this->price_per_night;
    }

    public function getRoomDescription() {
        return $this->room_description;
    }

    public function getNumberOfRooms() {
        return $this->number_of_rooms;
    }

    public function getRoomInsideNormalImage() {
        return $this->room_inside_normal_image;
    }

    public function getRoomInside360ViewImage() {
        return $this->room_inside_360view_image;
    }

    public function getRoomBathroom360ViewImage() {
        return $this->room_bathroom_360view_image;
    }

    public function getRoomOutdoor360ViewImage() {
        return $this->room_outdoor_360view_image;
    }

    // Setters
    public function setRoomType($room_type) {
        $this->room_type = $room_type;
    }

    public function setAdultCount($adult_count) {
        $this->adult_count = $adult_count;
    }

    public function setChildrenCount($children_count) {
        $this->children_count = $children_count;
    }

    public function setPricePerNight($price_per_night) {
        $this->price_per_night = $price_per_night;
    }

    public function setRoomDescription($room_description) {
        $this->room_description = $room_description;
    }

    public function setNumberOfRooms($number_of_rooms) {
        $this->number_of_rooms = $number_of_rooms;
    }

    public function setRoomInsideNormalImage($room_inside_normal_image) {
        $this->room_inside_normal_image = $room_inside_normal_image;
    }

    public function setRoomInside360ViewImage($room_inside_360view_image) {
        $this->room_inside_360view_image = $room_inside_360view_image;
    }

    public function setRoomBathroom360ViewImage($room_bathroom_360view_image) {
        $this->room_bathroom_360view_image = $room_bathroom_360view_image;
    }

    public function setRoomOutdoor360ViewImage($room_outdoor_360view_image) {
        $this->room_outdoor_360view_image = $room_outdoor_360view_image;
    }

    // Create a new room record
    public function create($con) {
        try {
            $query = "INSERT INTO Room (room_type, adult_count, children_count, price_per_night, room_description, number_of_rooms, room_inside_normal_image, room_inside_360view_image, room_bathroom_360view_image, room_outdoor_360view_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare($query);
            $stmt->bindValue(1, $this->room_type);
            $stmt->bindValue(2, $this->adult_count);
            $stmt->bindValue(3, $this->children_count);
            $stmt->bindValue(4, $this->price_per_night);
            $stmt->bindValue(5, $this->room_description);
            $stmt->bindValue(6, $this->number_of_rooms);
            $stmt->bindValue(7, $this->room_inside_normal_image);
            $stmt->bindValue(8, $this->room_inside_360view_image);
            $stmt->bindValue(9, $this->room_bathroom_360view_image);
            $stmt->bindValue(10, $this->room_outdoor_360view_image);
            $stmt->execute();
            $this->room_id = $con->lastInsertId();
            return ($stmt->rowCount() > 0) ? $this->room_id : false;
        } catch (PDOException $e) {
            die("Error creating room: " . $e->getMessage());
        }
    }

    // Read a room record by ID
    public static function read($con, $room_id) {
        try {
            $query = "SELECT * FROM Room WHERE room_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bindValue(1, $room_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error reading room: " . $e->getMessage());
        }
    }

    // Update an existing room record
    public function update($con) {
        try {
            $query = "UPDATE Room SET room_type = ?, adult_count = ?, children_count = ?, price_per_night = ?, room_description = ?, number_of_rooms = ?, room_inside_normal_image = ?, room_inside_360view_image = ?, room_bathroom_360view_image = ?, room_outdoor_360view_image = ? WHERE room_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bindValue(1, $this->room_type);
            $stmt->bindValue(2, $this->adult_count);
            $stmt->bindValue(3, $this->children_count);
            $stmt->bindValue(4, $this->price_per_night);
            $stmt->bindValue(5, $this->room_description);
            $stmt->bindValue(6, $this->number_of_rooms);
            $stmt->bindValue(7, $this->room_inside_normal_image);
            $stmt->bindValue(8, $this->room_inside_360view_image);
            $stmt->bindValue(9, $this->room_bathroom_360view_image);
            $stmt->bindValue(10, $this->room_outdoor_360view_image);
            $stmt->bindValue(11, $this->room_id);
            $stmt->execute();
            return ($stmt->rowCount() > 0);
        } catch (PDOException $e) {
            die("Error updating room: " . $e->getMessage());
        }
    }

    // Delete a room record
    public static function delete($con, $room_id) {
        try {
            $query = "DELETE FROM Room WHERE room_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bindValue(1, $room_id);
            $stmt->execute();
            return ($stmt->rowCount() > 0);
        } catch (PDOException $e) {
            die("Error deleting room: " . $e->getMessage());
        }
    }

    // Add an amenity to a room
    public function addAmenity($con, $amenity_name) {
        $roomAmenity = new RoomAmenity($this->room_id, $amenity_name);
        return $roomAmenity->create($con);
    }

    // Get all amenities for a room
    public function getAmenities($con) {
        return RoomAmenity::readByRoomId($con, $this->room_id);
    }

    // Add an image to a room
    public function addImage($con, $image_path) {
        $roomImage = new RoomImages($this->room_id, $image_path);
        return $roomImage->create($con);
    }

    // Get all images for a room
    public function getImages($con) {
        return RoomImages::readByRoomId($con, $this->room_id);
    }
}
?>
