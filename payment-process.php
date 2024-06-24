<?php 

use classes\Customer as ClassesCustomer;
use classes\DbConnector;
use classes\Reservation;

require_once './classes/DbConnector.php';
require_once './classes/Reservation.php';
require_once './classes/Customer.php';
require_once './classes/Room.php';
require_once './classes/RoomAmenity.php';
require_once './classes/RoomImages.php';

try {
    // Establish database connection
    $dbConnector = new \classes\DbConnector();
    $con = $dbConnector->getConnection();
} catch (PDOException $exc) {
    // Handle database connection error
    die("Error in DbConnection on payment-process file: " . $exc->getMessage());
}

$paymentMessage = '';
if (!empty($_POST['stripeToken'])) {

    // Get token and reservation details
    $stripeToken  = $_POST['stripeToken'];

    // Customer details
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $address = $_POST['address'];
    $country = $_POST['country'];

    // Reservation details
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    $number_of_adult = $_POST['number_of_adult'];
    $number_of_children = $_POST['number_of_children'];
    $number_of_room = $_POST['number_of_room'];
    $room_id = $_POST['room_id'];
    $total_price = ($_POST['room_price'] * $_POST['number_of_room']);
    $amountInCents = $total_price * 100;

    // Include Stripe PHP library
    require_once('stripe-php/init.php');

    // Set Stripe secret key and publishable key
    $stripe = array(
        "secret_key"      => "sk_test_51PSgUSGS5hz4ZPJThbe8FFgINQtGjs2ilOM1A8B4iDcZGVrQWbJu2AV446yKzp3unjEWXTJ0qOwmTQR6fuLKqREb004LI206Y8",
        "publishable_key" => "pk_test_51PSgUSGS5hz4ZPJTx4SCL283UTRrzE5omfnSFCBYQ7CU6Jef48NWNR1EquvzZEFEa8IIVSEQup1fVmzrgwoIPGkZ00m6OvExlQ"
    );

    \Stripe\Stripe::setApiKey($stripe['secret_key']);

    // Add customer to Stripe
    $customer = \Stripe\Customer::create(array(
        'name' => $fullName,
        'email' => $email,
        'phone' => $telephone,
        'source'  => $stripeToken,
        "address" => [
            "line1" => $address,
            "country" => $country
        ]
    ));

    // Details for which payment is made
    $payDetails = \Stripe\Charge::create(array(
        'customer' => $customer->id,
        'amount' => $amountInCents,
        'currency' => 'lkr',
        'description' => 'Room Booking',
        'metadata' => array(
            'room_id' => $room_id,
            'checkin' => $check_in_date,
            'checkout' => $check_out_date,
            'adultcount' => $number_of_adult,
            'childrencount' => $number_of_children,
            'roomcount' => $number_of_room
        )
    ));

    // Get payment details
    $paymentResponse = $payDetails->jsonSerialize();

    // Check whether the payment is successful
    if ($paymentResponse['amount_refunded'] == 0 && empty($paymentResponse['failure_code']) && $paymentResponse['paid'] == 1 && $paymentResponse['captured'] == 1) {

        // Transaction details
        $amountPaid = $paymentResponse['amount'];
        $balanceTransaction = $paymentResponse['balance_transaction'];
        $paidCurrency = $paymentResponse['currency'];
        $paymentStatus = $paymentResponse['status'];
        $paymentDate = date("Y-m-d H:i:s");

        // Insert customer into the database
        $customer = new ClassesCustomer($fullName, $email, $telephone, $address, $country);
        $customer->create($con); // Create customer record in the database

        // Retrieve the last inserted customer ID
        $customer_id = ClassesCustomer::getLastInsertedId($con);

        // Create reservation with the correct customer ID
        $reservation = new Reservation($customer_id, $room_id, $check_in_date, $check_out_date, $number_of_adult, $number_of_children, $number_of_room, $total_price, 'Completed');
        $reservation->setCreatedBy($customer_id);

        $reservation->create($con);

        if ($reservation) {
            echo "Success";
        } else {
            echo "Fail";
        }
    } else {
        echo "Payment Failed";
    }
} else {
    echo "No Stripe token";
}

?>
