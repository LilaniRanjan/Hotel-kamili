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
    private $number_of_guests;
    private $total_price;
    private $reservation_status;
    private $payment_status;
    private $additional_request;

    public function __construct($customer_id, $room_id, $check_in_date, $check_out_date, $number_of_guests, $total_price, $reservation_status = 'pending', $payment_status = 'pending', $additional_request = '') {
        $this->customer_id = $customer_id;
        $this->room_id = $room_id;
        $this->check_in_date = $check_in_date;
        $this->check_out_date = $check_out_date;
        $this->number_of_guests = $number_of_guests;
        $this->total_price = $total_price;
        $this->reservation_status = $reservation_status;
        $this->payment_status = $payment_status;
        $this->additional_request = $additional_request;
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

    public function getNumberOfGuests() {
        return $this->number_of_guests;
    }

    public function getTotalPrice() {
        return $this->total_price;
    }

    public function getReservationStatus() {
        return $this->reservation_status;
    }

    public function getPaymentStatus() {
        return $this->payment_status;
    }

    public function getAdditionalRequest() {
        return $this->additional_request;
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

    public function setNumberOfGuests($number_of_guests) {
        $this->number_of_guests = $number_of_guests;
    }

    public function setTotalPrice($total_price) {
        $this->total_price = $total_price;
    }

    public function setReservationStatus($reservation_status) {
        $this->reservation_status = $reservation_status;
    }

    public function setPaymentStatus($payment_status) {
        $this->payment_status = $payment_status;
    }

    public function setAdditionalRequest($additional_request) {
        $this->additional_request = $additional_request;
    }

    public function create($con) {
        try {
            $query = "INSERT INTO Reservation (customer_id, room_id, check_in_date, check_out_date, number_of_guests, total_price, reservation_status, payment_status, additional_request) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare($query);
            $stmt->bindValue(1, $this->customer_id);
            $stmt->bindValue(2, $this->room_id);
            $stmt->bindValue(3, $this->check_in_date);
            $stmt->bindValue(4, $this->check_out_date);
            $stmt->bindValue(5, $this->number_of_guests);
            $stmt->bindValue(6, $this->total_price);
            $stmt->bindValue(7, $this->reservation_status);
            $stmt->bindValue(8, $this->payment_status);
            $stmt->bindValue(9, $this->additional_request);
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
            $query = "UPDATE Reservation SET customer_id = ?, room_id = ?, check_in_date = ?, check_out_date = ?, number_of_guests = ?, total_price = ?, reservation_status = ?, payment_status = ?, additional_request = ? WHERE reservation_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bindValue(1, $this->customer_id);
            $stmt->bindValue(2, $this->room_id);
            $stmt->bindValue(3, $this->check_in_date);
            $stmt->bindValue(4, $this->check_out_date);
            $stmt->bindValue(5, $this->number_of_guests);
            $stmt->bindValue(6, $this->total_price);
            $stmt->bindValue(7, $this->reservation_status);
            $stmt->bindValue(8, $this->payment_status);
            $stmt->bindValue(9, $this->additional_request);
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


?>