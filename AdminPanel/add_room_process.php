<?php
session_start();

// Include the necessary files
require_once '../classes/DbConnector.php';
require_once '../classes/Room.php';
require_once '../classes/RoomAmenity.php';
require_once '../classes/RoomImages.php';

$message = "";

try {
    // Establish database connection
    $dbConnector = new \classes\DbConnector();
    $con = $dbConnector->getConnection();
} catch (PDOException $exc) {
    // Handle database connection error
    die("Error in DbConnection on add_room_process file" . $exc->getMessage());
}

// Check if the form is submitted
if(isset($_POST['submit'])) {
    if(isset($_POST['room_type'], $_POST['adult_count'], $_POST['children_count'], $_POST['room_description'], $_POST['price_per_night'])){
        if(!empty($_POST['room_type']) || !empty($_POST['adult_count']) || !empty($_POST['children_count']) || !empty($_POST['room_description']) || !empty($_POST['price_per_night'])){
            // Retrieve form data
            $room_type = $_POST['room_type'];
            $adult_count = $_POST['adult_count'];
            $children_count = $_POST['children_count'];
            $price_per_night = $_POST['price_per_night'];
            $room_description = $_POST['room_description'];
            $room_inside_normal_image = $_FILES['room_inside_normal_image']['name'];
            $room_inside_360view_image = $_FILES['room_inside_360view_image']['name'];
            $room_bathroom_360view_image = $_FILES['room_bathroom_360view_image']['name'];
            $room_outdoor_360view_image = $_FILES['room_outdoor_360view_image']['name'];
            $amenities = $_POST['amenities'];
            $additional_photos = $_FILES['additional_photos'];

            // Upload images and store their paths
            $imageUploadPath = "../uploads/";
            $room_inside_normal_image_path = $imageUploadPath . basename($_FILES["room_inside_normal_image"]["name"]);
            move_uploaded_file($_FILES["room_inside_normal_image"]["tmp_name"], $room_inside_normal_image_path);

            $room_inside_360view_image_path = $imageUploadPath . basename($_FILES["room_inside_360view_image"]["name"]);
            move_uploaded_file($_FILES["room_inside_360view_image"]["tmp_name"], $room_inside_360view_image_path);

            $room_bathroom_360view_image_path = $imageUploadPath . basename($_FILES["room_bathroom_360view_image"]["name"]);
            move_uploaded_file($_FILES["room_bathroom_360view_image"]["tmp_name"], $room_bathroom_360view_image_path);

            $room_outdoor_360view_image_path = $imageUploadPath . basename($_FILES["room_outdoor_360view_image"]["name"]);
            move_uploaded_file($_FILES["room_outdoor_360view_image"]["tmp_name"], $room_outdoor_360view_image_path);

            // Create a new Room instance
            $room = new \classes\Room($room_type, $adult_count, $children_count, $price_per_night, $room_description, $room_inside_normal_image_path, $room_inside_360view_image_path, $room_bathroom_360view_image_path, $room_outdoor_360view_image_path);

            // Save room details to the database
            $roomId = $room->create($con);

            // Save amenities to the database
            if($roomId && !empty($amenities)) {
                foreach($amenities as $amenity) {
                    $roomAmenity = new \classes\RoomAmenity($roomId, $amenity);
                    $roomAmenity->create($con);
                }
            }

            // Save additional photos to the database
            if($roomId && !empty($additional_photos)) {
                foreach($additional_photos['name'] as $key => $additional_photo) {
                    $additional_photo_path = $imageUploadPath . basename($additional_photos['name'][$key]);
                    move_uploaded_file($additional_photos['tmp_name'][$key], $additional_photo_path);
                    
                    $roomImages = new \classes\RoomImages($roomId, $additional_photo_path);
                    $roomImages->create($con);
                }
            }

            $_SESSION['message'] = "SUCCESS";

        }else{
            $_SESSION['message'] = "Required fields are empty";
        }

    }else{
        $_SESSION['message'] = "Data not received from the form";
    }
}else{
    $_SESSION['message'] = "Something went wrong, Try Again !";
}

header("Location:AddRoomForm.php");
?>
