<?php
session_start();
require '../classes/DbConnector.php';
require '../classes/Room.php';
require '../classes/Staff.php';
require '../classes/Reservation.php';

use classes\DbConnector;
use classes\Room;
use classes\Staff;
use classes\Reservation;

$dbConnector = new DbConnector();
$con = $dbConnector->getConnection();
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['deleteItemId']) && isset($_POST['itemType'])) {
        $itemId = $_POST['deleteItemId'];
        $itemType = $_POST['itemType'];

        switch ($itemType) {
            case 'room':
                if (Room::delete($con, $itemId)) {
                    $_SESSION['message'] = "Room deleted successfully!";
                } else {
                    $_SESSION['message'] = "Failed to delete room.";
                }
                break;
            case 'staff':
                if (Staff::delete($con, $itemId)) {
                    $_SESSION['message'] = "Staff deleted successfully!";
                } else {
                    $_SESSION['message'] = "Failed to delete staff.";
                }
                break;
            case 'reservation':
                if (Reservation::delete($con, $itemId)) {
                    $_SESSION['message'] = "Reservation deleted successfully!";
                } else {
                    $_SESSION['message'] = "Failed to delete reservation.";
                }
                break;
            default:
                $_SESSION['message'] = "Invalid item type.";
                break;
        }
    } else {
        $_SESSION['message'] = "Failed to delete item. Required data not received.";
    }
    header('Location: admin.php');
    exit();
}
?>