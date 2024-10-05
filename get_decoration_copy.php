<?php
require_once './classes/DbConnector.php';
require_once './classes/DecorationOptions.php';

if (isset($_GET['event_id'])) {
    $eventId = intval($_GET['event_id']);
    $dbConnector = new \classes\DbConnector();
    $con = $dbConnector->getConnection();
    
    $decorations = DecorationOptions::getDecorationById($con, $eventId);
    
    echo json_encode($decorations);
}
?>
