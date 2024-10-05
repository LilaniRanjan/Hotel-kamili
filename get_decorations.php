<?php
require_once './classes/DbConnector.php';
require_once './classes/DecorationOptions.php';

try {
    // Establish database connection
    $dbConnector = new \classes\DbConnector();
    $con = $dbConnector->getConnection();
} catch (PDOException $exc) {
    // Handle database connection error
    die("Error in DbConnection on DisplayRooms file: " . $exc->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_type'])){
    $eventId = $_POST['event_type'];
    
    $decorations = DecorationOptions::getDecorationOptionsByEventTypeID($con, $eventId);

    return $decorations;
}
?>
