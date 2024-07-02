<?php
use classes\Customer as ClassesCustomer;
use classes\DbConnector;
use classes\Reservation;
use classes\Room;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Stripe\Stripe;
use Stripe\Event;
use FPDF;

require_once './classes/DbConnector.php';
require_once './classes/Reservation.php';
require_once './classes/Customer.php';
require_once './classes/Room.php';
require_once './classes/RoomAmenity.php';
require_once './classes/RoomImages.php';
require_once 'vendor/autoload.php'; // Ensure you have PHPMailer and Stripe PHP library installed

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
    $room_type = $_POST['room_type'];
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

    try {
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

            $reservedRoomCount = Room::getReservedRoomCount($con, $room_id, $check_in_date, $check_out_date);

            // Create reservation with the correct customer ID
            $reservation = new Reservation($customer_id, $room_id, $check_in_date, $check_out_date, $number_of_adult, $number_of_children, $number_of_room, $total_price, 'Completed');
            $reservation->setCreatedBy($customer_id);
            $reservation->create($con);

            if ($reservation) {
                $reservation_id = $reservation->getReservationId();

                for($i=1; $i<=$number_of_room; $i++){
                    $reserved_room_type_id = $room_type . " " . strval($reservedRoomCount + 1);
                    $reservation->insertReservedRoomTypeId($con, $reservation_id, $reserved_room_type_id);

                    $reservedRoomCount++;
                }

                // Generate PDF invoice
                $invoicePdf = generatePDFInvoice($fullName, $email, $telephone, $address, $country, $check_in_date, $check_out_date, $room_id, $total_price, $number_of_room);

                // Send email with invoice attached
                sendEmailWithAttachment($email, 'Your Invoice', 'Thank you for your payment.', $invoicePdf);

                echo "Success";
            } else {
                echo "Fail";
            }
        } else {
            echo "Payment Failed";
        }
    } catch (\Stripe\Exception\ApiErrorException $e) {
        echo 'Stripe error: ' . $e->getMessage();
    }
} else {
    echo "No Stripe token";
}

function generatePDFInvoice($fullName, $email, $telephone, $address, $country, $check_in_date, $check_out_date, $room_id, $total_price, $number_of_room) {
    $pdf = new FPDF();
    $pdf->AddPage();
    
    // Add Logo
    $pdf->Image('./Assests/cropped-kamili-Copy-1.png', 10, 10, 30);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(120); // Move to the right
    $pdf->Cell(30, 10, 'INVOICE', 0, 1, 'C');
    
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(120); // Move to the right
    $pdf->Cell(30, 10, 'Your Company', 0, 1, 'C');
    $pdf->Cell(120); // Move to the right
    $pdf->Cell(30, 10, 'Your Address', 0, 1, 'C');
    $pdf->Ln(20);
    
    $pdf->Cell(0, 10, 'Buyer Name', 0, 1);
    $pdf->Cell(0, 10, '123 Buyer Lane', 0, 1);
    $pdf->Cell(0, 10, '123 BLUE COUNTY', 0, 1);
    $pdf->Cell(0, 10, 'UNITED STATES', 0, 1);
    $pdf->Ln(10);
    
    $pdf->Cell(0, 10, 'Invoice Date: ' . date("d/m/Y"), 0, 1);
    $pdf->Cell(0, 10, 'Invoice No: ' . rand(100000, 999999), 0, 1);
    $pdf->Cell(0, 10, 'Due Date: ' . date("d/m/Y", strtotime("+30 days")), 0, 1);
    $pdf->Ln(10);

    // Table headers
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(80, 10, 'DESCRIPTION', 1);
    $pdf->Cell(40, 10, 'PRICE', 1);
    $pdf->Cell(40, 10, 'QTY', 1);
    $pdf->Cell(30, 10, 'AMOUNT', 1);
    $pdf->Ln();

    // Table data
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(80, 10, 'Room Booking', 1);
    $pdf->Cell(40, 10, number_format($total_price / $number_of_room, 2), 1);
    $pdf->Cell(40, 10, $number_of_room, 1);
    $pdf->Cell(30, 10, number_format($total_price, 2), 1);
    $pdf->Ln();

    // Total
    $pdf->Cell(160, 10, 'Total', 1);
    $pdf->Cell(30, 10, number_format($total_price, 2), 1);

    // Output as string
    return $pdf->Output('S'); 
}

function sendEmailWithAttachment($to, $subject, $message, $attachmentContent) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'ranjanlilani@gmail.com'; 
        $mail->Password = 'ssxl mbdo jhut pvko';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('ranjanlilani@gmail.com', 'Kamili Beach Villa');
        $mail->addAddress($to);

        // Attachments
        $mail->addStringAttachment($attachmentContent, 'invoice.pdf', 'base64', 'application/pdf');

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        echo 'Email sent successfully!';
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
