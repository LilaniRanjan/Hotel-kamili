<?php 

namespace classes;

use PDO;
use PDOException;

class Reservation {
    private $reservation_id;
    private $customer;
    private $room;
    private $check_in_date;
    private $check_out_date;
    private $number_of_adult;
    private $number_of_children;
    private $number_of_room;
    private $total_price;
    private $payment_status;
    private $created_by;
    private $modified_by;

    public function __construct($customer, $room, $check_in_date, $check_out_date, $number_of_adult, $number_of_children, $number_of_room, $total_price, $payment_status = 'pending') {
        $this->customer = $customer;
        $this->room = $room;
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
        return $this->customer;
    }

    public function getRoomId() {
        return $this->room;
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

    public function setCustomerId($customer) {
        $this->customer = $customer;
    }

    public function setRoomId($room) {
        $this->room = $room;
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

    public function setCreatedBy($created_by) {
        $this->created_by = $created_by;
    }

    public function setUpdatedBy($modified_by) {
        $this->modified_by = $modified_by;
    }

    public function create($con) {
        try {
            $query = "INSERT INTO Reservation (customer_id, room_id, check_in_date, check_out_date, number_of_adult, number_of_children, number_of_room, total_price, payment_status, created_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare($query);
            $stmt->bindValue(1, $this->customer);
            $stmt->bindValue(2, $this->room);
            $stmt->bindValue(3, $this->check_in_date);
            $stmt->bindValue(4, $this->check_out_date);
            $stmt->bindValue(5, $this->number_of_adult);
            $stmt->bindValue(6, $this->number_of_children);
            $stmt->bindValue(7, $this->number_of_room);
            $stmt->bindValue(8, $this->total_price);
            $stmt->bindValue(9, $this->payment_status);
            $stmt->bindValue(10, $this->created_by);
            $stmt->execute();
            $this->reservation_id = $con->lastInsertId();
            return ($stmt->rowCount() > 0);
        } catch (PDOException $e) {
            die("Error creating reservation: " . $e->getMessage());
        }
    }

    public function insertReservedRoomTypeId($con, $reservation_id, $reserved_room_type_id) {
        try {
            $query = "INSERT INTO ReservedRoomTypeId (reservation_id, reserved_room_type_id) VALUES (?, ?)";
            $stmt = $con->prepare($query);
            $stmt->bindValue(1, $reservation_id);
            $stmt->bindValue(2, $reserved_room_type_id);
            $stmt->execute();
            return ($stmt->rowCount() > 0);
        } catch (PDOException $e) {
            die("Error inserting reserved room type ID: " . $e->getMessage());
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
            $stmt->bindValue(1, $this->customer);
            $stmt->bindValue(2, $this->room);
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

    public static function filterAvailableRooms($con, $check_in_date, $check_out_date, $number_of_adult, $number_of_children) {
        try {
            $query = "
                SELECT r.*
                FROM Room r
                WHERE r.room_id NOT IN (
                    SELECT rv.room_id
                    FROM Reservation rv
                    WHERE NOT (
                        rv.check_out_date <= :check_in_date
                        OR rv.check_in_date >= :check_out_date
                    )
                )
                AND r.adult_count >= :number_of_adult
                AND r.children_count >= :number_of_children
            ";
            
            $stmt = $con->prepare($query);
            $stmt->bindValue(':check_in_date', $check_in_date, PDO::PARAM_STR);
            $stmt->bindValue(':check_out_date', $check_out_date, PDO::PARAM_STR);
            $stmt->bindValue(':number_of_adult', $number_of_adult, PDO::PARAM_INT);
            $stmt->bindValue(':number_of_children', $number_of_children, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error filtering available rooms: " . $e->getMessage());
        }
    }
    
}
?>
