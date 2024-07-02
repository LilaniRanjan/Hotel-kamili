<?php
session_start();

require '../classes/DbConnector.php';
require '../classes/Room.php';
require '../classes/staff.php';
require '../classes/Reservation.php';
require '../classes/Customer.php';
require '../message.php';

use classes\DbConnector;
use classes\Room;
use classes\Reservation;
use classes\Customer;
use classes\staff;

// Add Room Process
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['RoomSubmit'])) {
        $roomType = $_POST['roomType'];
        $adultCount = $_POST['adultCount'];
        $childrenCount = $_POST['childrenCount'];
        $pricePerNight = $_POST['pricePerNight'];
        $roomDescription = $_POST['roomDescription'];
        $numberOfRooms = $_POST['numberOfRooms'];

        $uploadDir = 'uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Initialize image variables
        $roomInsideImage = '';
        $roomInside360Image = '';
        $bathroom360Image = '';
        $outdoor360Image = '';

        $files = [
            'roomInsideImageUpload' => &$roomInsideImage,
            'roomInside360ImageUpload' => &$roomInside360Image,
            'bathroom360ImageUpload' => &$bathroom360Image,
            'outdoor360ImageUpload' => &$outdoor360Image
        ];

        foreach ($files as $fileKey => &$fileName) {
            if (!empty($_FILES[$fileKey]['name'])) {
                $fileTmpPath = $_FILES[$fileKey]['tmp_name'];
                $fileName = basename($_FILES[$fileKey]['name']);
                $destPath = $uploadDir . $fileName;
                // Assuming moving the file was missed in the provided code
                move_uploaded_file($fileTmpPath, $destPath);
            }
        }

        $dbConnector = new DbConnector();
        $con = $dbConnector->getConnection();

        $room = new Room(
            $roomType,
            $adultCount,
            $childrenCount,
            $pricePerNight,
            $roomDescription,
            $numberOfRooms,
            $roomInsideImage,
            $roomInside360Image,
            $bathroom360Image,
            $outdoor360Image
        );

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
        } else {if ($room->create($con)) {
            $_SESSION['message'] = "Room details saved successfully!";
        } else {
            $_SESSION['errors'] = "Failed to save room details.";
        }
    }

        header('Location: AddRoom.php');
        exit();
    }

    // Add staff process
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Add staff process
        if (isset($_POST['staffSubmit'])) {
            $first_name = $_POST['fname'];
            $last_name = $_POST['lname'];
            $user_name = $_POST['uname'];
            $password = $_POST['pwd'];
            $nic_no = $_POST['nic'];
            $email = $_POST['email'];
            $contact_no = $_POST['contact'];
            $role = $_POST['role'];

            // staff error handlings
            $errors = [];

            if (empty($first_name) || empty($last_name) || empty($user_name) || empty($password) || empty($nic_no) || empty($email) || empty($contact_no) || empty($role)) {
                $errors[] = "All fields are required.";
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format.";
            }

            $dbConnector = new DbConnector();
            $con = $dbConnector->getConnection();

            $staff = new staff($first_name, $last_name, $user_name, $password, $nic_no, $email, $contact_no, $role);

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
            } else {
                if ($staff->register($con)) {
                    $_SESSION['message'] = "Staff details saved successfully!";
                } else {
                    $_SESSION['errors'] = ["Failed to save staff details."];
                }
            }

            header('Location: AddStaff.php');
            exit();
        }
    }

    // add reservation

    if (isset($_POST['ReservationSubmit'])) {

        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $country = $_POST['country'];

        $dbConnector = new DbConnector();
        $con = $dbConnector->getConnection();

        $customer = new Customer($fullname, $email, $contact, $address, $country);

        if ($con) {
            if ($customer->create($con)) {
                $customer_id = $customer->getCustomerId(); 

                $room = $_POST['room_id'];
                $check_in_date = $_POST['check_in_date'];
                $check_out_date = $_POST['check_out_date'];
                $number_of_children = $_POST['number_of_children'];
                $number_of_adult = $_POST['number_of_adult'];
                $number_of_room = $_POST['number_of_room'];
                $total_price = $_POST['total_price'];
                $payment_status = $_POST['payment_status'];

                $reservation = new Reservation($customer_id, $room, $check_in_date, $check_out_date, $number_of_children, $number_of_adult, $number_of_room, $total_price, $payment_status);

                // Create reservation
                if ($reservation->create($con)) {
                    $_SESSION['message'] = "Reservation added successfully!";
                } else {
                    $_SESSION['message'] = "Failed to add reservation.";
                }
            } else {
                $_SESSION['message'] = "Failed to add customer.";
            }
        } else {
            $_SESSION['message'] = "Database connection error.";
        }

        header('Location: AddReservation.php');
        exit();
    }
}