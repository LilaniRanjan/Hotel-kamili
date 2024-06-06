<?php 
session_start();

require './classes/DbConnector.php';
require './classes/staff.php';

use classes\DbConnector;
use classes\staff;

// Establish database connection
$db_connector = new DbConnector;
$con = $db_connector->getConnection();

// Check if username and password are provided
if(isset($_POST['user_name'], $_POST['password'])){
    if(!empty($_POST['user_name']) || !empty($_POST['password'])){
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        // Create staff instance for authentication
        $staff = new staff(null, null, $user_name, $password, null, null, null, null);

        // Authenticate user
        if($staff->authenticate($con)){
            // Store user information in session
            $_SESSION['staff_id'] = $staff->getStaffId();
            $_SESSION['first_name'] = $staff->getFirstName();
            $_SESSION['last_name'] = $staff->getLastName();
            $_SESSION['user_name'] = $staff->getUserName();
            $_SESSION['role'] = $staff->getRole();
            $role = $staff->getRole();

            // Redirect user based on role
            switch($staff->getRole()) {
                case 'Staff':
                    header("Location: AdminPanel/initialPage.php");
                    break;
                case 'Room_manager':
                    header("Location: AdminPanel/SpecialRoomRequestDetails.php");
                    break;
                case 'Receptionist':
                case 'Admin':
                    header("Location: AdminPanel/Dashboard.php");
                    break;
                default:
                    header("Location: index.php");
            }
            // Exit to prevent further execution
            exit();
        }else{
            // Invalid username or password
            header("Location: login.php?status=1");
            // $locattion = "login.php?status=1";
        }
    }else{
        // Required fields are empty
        header("Location: login.php?status=2");
        // $locattion = "login.php?status=2";
    }
}else{
    // Data not received from the form
    header("Location: login.php?status=3");
    // $locattion = "login.php?status=3";
}

// Redirect the user based on the determined location
// header("Location: $location");

// Set HTTP response code
http_response_code(400);

// Exit to prevent further execution
exit(); 

?>