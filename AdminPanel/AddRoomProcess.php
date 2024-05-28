<?php 

require '../classes/DbConnector.php';
require '../classes/Room.php';
require '../classes/AvailableOffers.php';

try {
    $dbconnector = new classes\DbConnector();
    $dbcon = $dbconnector->getConnection();
} catch (PDOException $exc) {
    die("ERROR in AddRoomProcess's Db Connection");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    if (isset($_POST['room_type'], $_POST['guest_count'], $_POST['price'], $_POST['room_description'])) {
        $room_type = trim($_POST['room_type']);
        $guest_count = trim($_POST['guest_count']);
        $price = trim($_POST['price']);
        $room_description = trim($_POST['room_description']);
        $offers = isset($_POST['offers']) ? $_POST['offers'] : [];

        if (empty($room_type) || empty($guest_count) || empty($price) || empty($room_description)) {
            die("All fields are required.");
        }

        $room_image = handleFileUpload($_FILES['room_image']);
        $view_image_360 = handleFileUpload($_FILES['view_image_360']);

        $room = new classes\Room($room_type, $guest_count, $price, $room_description, $room_image, $view_image_360);
        $room_id = $room->create($dbcon);

        if ($room_id) {
            foreach ($offers as $offer) {
                $offer_description = trim($offer['description']);
                $offer_price = trim($offer['price']);

                if (!empty($offer_description) && !empty($offer_price)) {
                    $availableOffer = new classes\AvailableOffers($room_id, $offer_description, $offer_price);
                    $availableOffer->create($dbcon);
                }
            }
            echo "Room created successfully.";
        } else {
            echo "Failed to create room.";
        }
    } else {
        die("All fields are required.");
    }
}

function handleFileUpload($file) {
    if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/';
        $fileTmpPath = $file['tmp_name'];
        $fileName = $file['name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        if ($fileError !== UPLOAD_ERR_OK) {
            die("File upload error: " . $fileError);
        }

        if ($fileSize > 5000000) {
            die("File is too large.");
        }

        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = uniqid() . '.' . $fileExtension;
        $dest_path = $uploadDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            return $newFileName;
        } else {
            die("Error moving file to upload directory.");
        }
    }
    return null;
}

?>
