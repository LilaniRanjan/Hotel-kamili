<?php 

namespace classes;

use PDO;
use PDOException;

class Reservation {
    private $reservation_id;
    private $customer_id;
    private $room_id;
    private $check_in_date;
    private $check_out_date;
    private $number_of_adult;
    private $number_of_children;
    private $number_of_room;
    private $total_price;
    private $payment_status;

    public function __construct($customer_id, $room_id, $check_in_date, $check_out_date, $number_of_adult, $number_of_children, $number_of_room, $total_price, $payment_status = 'pending') {
        $this->customer_id = $customer_id;
        $this->room_id = $room_id;
        $this->check_in_date = $check_in_date;
        $this->check_out_date = $check_out_date;
        $this->number_of_adult = $number_of_adult;
        $this->number_of_children = $number_of_children;
        $this->number_of_room = $number_of_room;
        $this->total_price = $total_price;
        $this->payment_status = $payment_status;
    }

    public function getReservationId() {
        return $this->reservation_id;
    }

    public function getCustomerId() {
        return $this->customer_id;
    }

    public function getRoomId() {
        return $this->room_id;
    }

    public function getCheckInDate() {
        return $this->check_in_date;
    }

    public function getCheckOutDate() {
        return $this->check_out_date;
    }

    public function getNumberOfAdult() {
        return $this->number_of_adult;
    }

    public function getNumberOfChildren() {
        return $this->number_of_children;
    }

    public function getNumberOfRoom() {
        return $this->number_of_room;
    }

    public function getTotalPrice() {
        return $this->total_price;
    }

    public function getPaymentStatus() {
        return $this->payment_status;
    }

    public function setCustomerId($customer_id) {
        $this->customer_id = $customer_id;
    }

    public function setRoomId($room_id) {
        $this->room_id = $room_id;
    }

    public function setCheckInDate($check_in_date) {
        $this->check_in_date = $check_in_date;
    }

    public function setCheckOutDate($check_out_date) {
        $this->check_out_date = $check_out_date;
    }

    public function setNumberOfAdult($number_of_adult) {
        $this->number_of_adult = $number_of_adult;
    }

    public function setNumberOfChildren($number_of_children) {
        $this->number_of_children = $number_of_children;
    }

    public function setNumberOfRoom($number_of_room) {
        $this->number_of_room = $number_of_room;
    }

    public function setTotalPrice($total_price) {
        $this->total_price = $total_price;
    }

    public function setPaymentStatus($payment_status) {
        $this->payment_status = $payment_status;
    }

    public function create($con) {
        try {
            $query = "INSERT INTO Reservation (customer_id, room_id, check_in_date, check_out_date, number_of_adult, number_of_children, number_of_room, total_price, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare($query);
            $stmt->bindValue(1, $this->customer_id);
            $stmt->bindValue(2, $this->room_id);
            $stmt->bindValue(3, $this->check_in_date);
            $stmt->bindValue(4, $this->check_out_date);
            $stmt->bindValue(5, $this->number_of_adult);
            $stmt->bindValue(6, $this->number_of_children);
            $stmt->bindValue(7, $this->number_of_room);
            $stmt->bindValue(8, $this->total_price);
            $stmt->bindValue(9, $this->payment_status);
            $stmt->execute();
            $this->reservation_id = $con->lastInsertId();
            return ($stmt->rowCount() > 0);
        } catch (PDOException $e) {
            die("Error creating reservation: " . $e->getMessage());
        }
    }

    public static function read($con, $reservation_id) {
        try {
            $query = "SELECT * FROM Reservation WHERE reservation_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bindValue(1, $reservation_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error reading reservation: " . $e->getMessage());
        }
    }

    public function update($con) {
        try {
            $query = "UPDATE Reservation SET customer_id = ?, room_id = ?, check_in_date = ?, check_out_date = ?, number_of_adult = ?, number_of_children = ?, number_of_room = ?, total_price = ?, payment_status = ? WHERE reservation_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bindValue(1, $this->customer_id);
            $stmt->bindValue(2, $this->room_id);
            $stmt->bindValue(3, $this->check_in_date);
            $stmt->bindValue(4, $this->check_out_date);
            $stmt->bindValue(5, $this->number_of_adult);
            $stmt->bindValue(6, $this->number_of_children);
            $stmt->bindValue(7, $this->number_of_room);
            $stmt->bindValue(8, $this->total_price);
            $stmt->bindValue(9, $this->payment_status);
            $stmt->bindValue(10, $this->reservation_id);
            $stmt->execute();
            return ($stmt->rowCount() > 0);
        } catch (PDOException $e) {
            die("Error updating reservation: " . $e->getMessage());
        }
    }

    public static function delete($con, $reservation_id) {
        try {
            $query = "DELETE FROM Reservation WHERE reservation_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bindValue(1, $reservation_id);
            $stmt->execute();
            return ($stmt->rowCount() > 0);
        } catch (PDOException $e) {
            die("Error deleting reservation: " . $e->getMessage());
        }
    }
}
?>
