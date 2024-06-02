<?php
use classes\Room;

require './classes/DbConnector.php';
require './classes/Room.php';

try {
    $dbconnector = new classes\DbConnector();
    $dbcon = $dbconnector->getConnection();
} catch (PDOException $exc) {
    die("ERROR in index's Db Connection");
}

if (isset($_POST['check_in_date']) && isset($_POST['check_out_date']) && isset($_POST['guest_count'])) {
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    $guest_count = $_POST['guest_count'];

    $available_rooms = Room::getAvailableRooms($dbcon, $check_in_date, $check_out_date, $guest_count);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Available Rooms</title>
</head>
<body>
    <h1>Available Rooms from <?php echo htmlspecialchars($check_in_date); ?> to <?php echo htmlspecialchars($check_out_date); ?> for <?php echo htmlspecialchars($guest_count); ?> guests</h1>

    <?php if (!empty($available_rooms)) { ?>
        <?php foreach ($available_rooms as $room) { ?>
            <div class="items">
                <div class="image">
                    <img src="Assests/Luxary.jpg" alt="Room image">
                </div>
                <div class="text">
                    <h2><?php echo htmlspecialchars($room['room_type']); ?></h2>
                    <div class="rate flex">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <p>
                        <ul>
                            <li>Triple Beds</li>
                            <li>Wi-Fi</li>
                            <li>Air Condition</li>
                        </ul>
                    </p>
                    <div class="button flex">
                        <button class="primary-btn">BOOK NOW</button>
                        <h3>Rs.15000/= <span><br><b>Per Night</b></span></h3>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p>No rooms available for the selected dates and guest count.</p>
    <?php } ?>
</body>
</html>
