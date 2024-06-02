<?php

namespace classes;

use PDO;
use PDOException;

class Room {
    private $room_id;
    private $room_type;
    private $guest_count;
    private $price;
    private $room_description;
    private $room_image;
    private $view_image_360;

    // Constructor
    public function __construct($room_type, $guest_count, $price, $room_description, $room_image, $view_image_360) {
        $this->room_type = $room_type;
        $this->guest_count = $guest_count;
        $this->price = $price;
        $this->room_description = $room_description;
        $this->room_image = $room_image;
        $this->view_image_360 = $view_image_360;
    }

    // Getters
    public function getRoomId() {
        return $this->room_id;
    }

    public function getRoomType() {
        return $this->room_type;
    }

    public function getGuestCount() {
        return $this->guest_count;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getRoomDescription() {
        return $this->room_description;
    }

    public function getRoomImage() {
        return $this->room_image;
    }

    public function getViewImage360() {
        return $this->view_image_360;
    }

    // Setters
    public function setRoomType($room_type) {
        $this->room_type = $room_type;
    }

    public function setGuestCount($guest_count) {
        $this->guest_count = $guest_count;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setRoomDescription($room_description) {
        $this->room_description = $room_description;
    }

    public function setRoomImage($room_image) {
        $this->room_image = $room_image;
    }

    public function setViewImage360($view_image_360) {
        $this->view_image_360 = $view_image_360;
    }

    // Create a new room record
    public function create($con) {
        try {
            $query = "INSERT INTO Room (room_type, guest_count, price, room_description, room_image, view_image_360) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare($query);
            $stmt->bindValue(1, $this->room_type);
            $stmt->bindValue(2, $this->guest_count);
            $stmt->bindValue(3, $this->price);
            $stmt->bindValue(4, $this->room_description);
            $stmt->bindValue(5, $this->room_image);
            $stmt->bindValue(6, $this->view_image_360);
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
            $query = "UPDATE Room SET room_type = ?, guest_count = ?, price = ?, room_description = ?, room_image = ?, view_image_360 = ? WHERE room_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bindValue(1, $this->room_type);
            $stmt->bindValue(2, $this->guest_count);
            $stmt->bindValue(3, $this->price);
            $stmt->bindValue(4, $this->room_description);
            $stmt->bindValue(5, $this->room_image);
            $stmt->bindValue(6, $this->view_image_360);
            $stmt->bindValue(7, $this->room_id);
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

    // Get all room records
    public static function getAllRooms($con) {
        try {
            $query = "SELECT * FROM Room";
            $stmt = $con->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error fetching rooms: " . $e->getMessage());
        }
    }

    // Add an offer to a room
    public function addOffer($con, $offer, $offer_price) {
        $availableOffer = new AvailableOffers($this->room_id, $offer, $offer_price);
        return $availableOffer->create($con);
    }

    // Get all offers for a room
    public function getOffers($con) {
        return AvailableOffers::readByRoomId($con, $this->room_id);
    }

    public static function getAvailableRooms($con, $check_in_date, $check_out_date, $guest_count) {
        try {
            $query = "
                SELECT * FROM Room r
                WHERE r.guest_count >= :guest_count
                AND r.room_id NOT IN (
                    SELECT room_id FROM Reservation
                    WHERE (check_in_date <= :check_out_date AND check_out_date >= :check_in_date)
                )
            ";
            $stmt = $con->prepare($query);
            $stmt->bindValue(':check_in_date', $check_in_date);
            $stmt->bindValue(':check_out_date', $check_out_date);
            $stmt->bindValue(':guest_count', $guest_count);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error fetching available rooms: " . $e->getMessage());
        }
    }
}
?>
