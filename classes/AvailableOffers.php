<?php

namespace classes;

use PDO;
use PDOException;

class AvailableOffers {
    private $offer_id;
    private $room_id;
    private $available_offer;
    private $offer_price;

    // Constructor
    public function __construct($room_id, $available_offer, $offer_price) {
        $this->room_id = $room_id;
        $this->available_offer = $available_offer;
        $this->offer_price = $offer_price;
    }

    // Getters
    public function getOfferId() {
        return $this->offer_id;
    }

    public function getRoomId() {
        return $this->room_id;
    }

    public function getAvailableOffer() {
        return $this->available_offer;
    }

    public function getOfferPrice() {
        return $this->offer_price;
    }

    // Setters
    public function setRoomId($room_id) {
        $this->room_id = $room_id;
    }

    public function setAvailableOffer($available_offer) {
        $this->available_offer = $available_offer;
    }

    public function setOfferPrice($offer_price) {
        $this->offer_price = $offer_price;
    }

    // Create a new offer record
    public function create($con) {
        try {
            $query = "INSERT INTO AvailableOffers (room_id, available_offer, offer_price) VALUES (?, ?, ?)";
            $stmt = $con->prepare($query);
            $stmt->bindValue(1, $this->room_id);
            $stmt->bindValue(2, $this->available_offer);
            $stmt->bindValue(3, $this->offer_price);
            $stmt->execute();
            return ($stmt->rowCount() > 0);
        } catch (PDOException $e) {
            die("Error creating offer: " . $e->getMessage());
        }
    }

    // Read offers by room ID
    public static function readByRoomId($con, $room_id) {
        try {
            $query = "SELECT * FROM AvailableOffers WHERE room_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bindValue(1, $room_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error reading offers: " . $e->getMessage());
        }
    }

    // Update an existing offer record
    public function update($con) {
        try {
            $query = "UPDATE AvailableOffers SET available_offer = ?, offer_price = ? WHERE offer_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bindValue(1, $this->available_offer);
            $stmt->bindValue(2, $this->offer_price);
            $stmt->bindValue(3, $this->offer_id);
            $stmt->execute();
            return ($stmt->rowCount() > 0);
        } catch (PDOException $e) {
            die("Error updating offer: " . $e->getMessage());
        }
    }

    // Delete an offer record
    public static function delete($con, $offer_id) {
        try {
            $query = "DELETE FROM AvailableOffers WHERE offer_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bindValue(1, $offer_id);
            $stmt->execute();
            return ($stmt->rowCount() > 0);
        } catch (PDOException $e) {
            die("Error deleting offer: " . $e->getMessage());
        }
    }

}
?>
