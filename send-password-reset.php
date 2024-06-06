<?php
// send-password-reset.php

use classes\staff;
use classes\EmailConnector;

require './classes/DbConnector.php';
require './classes/staff.php';
require './classes/EmailConnector.php';

try {
    // Establish database connection
    $dbconnector = new classes\DbConnector();
    $dbcon = $dbconnector->getConnection();
} catch (PDOException $exc) {
    // Handle database connection error
    die("Error in DbConnection on SignUp function: " . $exc->getMessage());
}

// Validate email input
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $email = trim($_POST["email"]);
} else {
    die("Invalid email address.");
}

$token = bin2hex(random_bytes(16));
$token_hash = hash("sha256", $token);
$expiry = date("Y-m-d H:i:s", time() + 60 * 30); // Token expiry set to 30 minutes from now

// Create staff instance for setting the token
$staff = new staff(null, null, null, null, null, $email, null, null);

if ($staff->setHashToken($dbcon, $token_hash, $expiry)) {
    // Configure the email
    $emailConnector = new EmailConnector();
    $emailConnector->setFromAddress('noreply@example.com');
    $emailConnector->setFromName('Your Company');
    $emailConnector->setToAddress($email);
    $emailConnector->setSubject('Password Reset');
    $emailConnector->setBody(<<<EOT
        Click <a href="http://localhost:8000/reset-password.php?token=$token">here</a> to reset your password.
    EOT);

    // Send the email
    if ($emailConnector->sendEmail()) {
        echo "Message sent, please check your inbox.";
    } else {
        echo "Failed to send email. Please try again.";
    }
} else {
    echo "Failed to generate reset token. Please try again.";
}
