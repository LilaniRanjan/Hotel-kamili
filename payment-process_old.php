<?php
session_start();
$paymentMessage = '';

if(!empty($_POST['stripeToken'])){
    // Get token and reservation details
    $stripeToken  = $_POST['stripeToken'];
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    $number_of_adult = $_POST['number_of_adult'];
    $number_of_children = $_POST['number_of_children'];
    $number_of_room = $_POST['number_of_room'];
    $room_id = $_POST['room_id'];
    $total_price = $_POST['total_price'];

    // Include Stripe PHP library
    require_once('stripe-php/init.php'); 
    
    // Set stripe secret key
    \Stripe\Stripe::setApiKey('sk_test_51PSgUSGS5hz4ZPJThbe8FFgINQtGjs2ilOM1A8B4iDcZGVrQWbJu2AV446yKzp3unjEWXTJ0qOwmTQR6fuLKqREb004LI206Y8');

    // Add customer to stripe
    $customer = \Stripe\Customer::create(array(
        'name' => $fullName,
        'email' => $email,
        'telno' => $telephone,
        'source'  => $stripeToken,
        "address" => [
            "line1" => $address,
            "country" => $country
        ]
    ));

    // Details for which payment is made
    $payDetails = \Stripe\Charge::create(array(
        'customer' => $customer->id,
        'amount'   => $total_price * 100, // Stripe amount should be in cents
        'currency' => 'usd',
        'description' => 'Room Booking',
        'metadata' => array(
            'order_id' => uniqid()
        )
    ));

    // Get payment details
    $paymentResponse = $payDetails->jsonSerialize();

    // Check whether the payment is successful
    if($paymentResponse['amount_refunded'] == 0 && empty($paymentResponse['failure_code']) && $paymentResponse['paid'] == 1 && $paymentResponse['captured'] == 1){
        // Transaction details
        $amountPaid = $paymentResponse['amount'];
        $balanceTransaction = $paymentResponse['balance_transaction'];
        $paidCurrency = $paymentResponse['currency'];
        $paymentStatus = $paymentResponse['status'];
        $paymentDate = date("Y-m-d H:i:s");

        // Insert reservation details into database
        include_once("include/db_connect.php");

        // Insert customer details
        $insertCustomerSQL = "INSERT INTO Customer (full_name, email, telephone, address, country, created_at, updated_at) VALUES ('$fullName', '$email', '$telephone', '$address', '$country', '$paymentDate', '$paymentDate')";
        mysqli_query($conn, $insertCustomerSQL) or die("database error: ". mysqli_error($conn));
        $customerId = mysqli_insert_id($conn);

        // Insert reservation details
        $insertReservationSQL = "INSERT INTO Reservation (customer_id, room_id, check_in_date, check_out_date, number_of_adult, number_of_children, number_of_room, total_price, payment_status, created_at, updated_at) VALUES ('$customerId', '$room_id', '$check_in_date', '$check_out_date', '$number_of_adult', '$number_of_children', '$number_of_room', '$total_price', 'completed', '$paymentDate', '$paymentDate')";
        mysqli_query($conn, $insertReservationSQL) or die("database error: ". mysqli_error($conn));

        // If reservation inserted successfully
        if(mysqli_insert_id($conn)){
            echo "The payment was successful. Reservation ID: " . mysqli_insert_id($conn);
        } else{
            echo "Hello.. Payment failed, please try again.";
        }
    } else{
        echo "Hiiii.. Payment failed, please try again.";
    }
} else{
    echo "Hellallo.. Payment failed, please try again.";
}
// $_SESSION["message"] = $paymentMessage;
// header('location:reservation-form.php');
?>
