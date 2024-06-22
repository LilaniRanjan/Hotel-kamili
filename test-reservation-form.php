<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Form</title>
    <script src="https://js.stripe.com/v2/"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .require {
            border: 1px solid red;
        }
        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <?php

use classes\Customer;

        require_once './classes/DbConnector.php';
        require_once './classes/Reservation.php';
        require_once './classes/Customer.php';

        try {
            // Establish database connection
            $dbConnector = new \classes\DbConnector();
            $con = $dbConnector->getConnection();
        } catch (PDOException $exc) {
            // Handle database connection error
            die("Error in DbConnection on payment-process file: " . $exc->getMessage());
        }

        $cus = new Customer(null, null, null, null, null);
        $cus_id = $cus->getLastInsertedId($con);

        echo $cus_id;
    ?>
    <form id="paymentForm" action="payment-process.php" method="POST">
        <!-- Customer Details -->
        <label for="fullName">Full Name:</label>
        <input type="text" id="customerName" name="full_name" />
        <span id="errorCustomerName" class="error-message"></span><br>
        
        <label for="email">Email:</label>
        <input type="email" id="emailAddress" name="email" />
        <span id="errorEmailAddress" class="error-message"></span><br>
        
        <label for="telephone">Telephone:</label>
        <input type="text" id="telephone" name="telephone" /><br>
        
        <label for="address">Address:</label>
        <input type="text" id="customerAddress" name="address" />
        <span id="errorCustomerAddress" class="error-message"></span><br>
        
        <label for="country">Country:</label>
        <input type="text" id="customerCountry" name="country" />
        <span id="errorCustomerCountry" class="error-message"></span><br>

        <!-- Card Details -->
        <label for="cardNumber">Card Number:</label>
        <input type="text" id="cardNumber" name="cardNumber" onkeypress="return validateNumber(event)" />
        <span id="errorCardNumber" class="error-message"></span><br>
        
        <label for="cardCVC">CVC:</label>
        <input type="text" id="cardCVC" name="cardCVC" onkeypress="return validateNumber(event)" />
        <span id="errorCardCvc" class="error-message"></span><br>
        
        <label for="cardExpMonth">Expiration Month:</label>
        <input type="text" id="cardExpMonth" name="cardExpMonth" onkeypress="return validateNumber(event)" />
        <span id="errorCardExpMonth" class="error-message"></span><br>
        
        <label for="cardExpYear">Expiration Year:</label>
        <input type="text" id="cardExpYear" name="cardExpYear" onkeypress="return validateNumber(event)" />
        <span id="errorCardExpYear" class="error-message"></span><br>

        <!-- Reservation Details -->
        <label for="checkInDate">Check-in Date:</label>
        <input type="date" id="checkInDate" name="check_in_date" /><br>
        
        <label for="checkOutDate">Check-out Date:</label>
        <input type="date" id="checkOutDate" name="check_out_date" /><br>
        
        <label for="numberOfAdults">Number of Adults:</label>
        <input type="number" id="numberOfAdults" name="number_of_adult" /><br>
        
        <label for="numberOfChildren">Number of Children:</label>
        <input type="number" id="numberOfChildren" name="number_of_children" /><br>
        
        <label for="numberOfRooms">Number of Rooms:</label>
        <input type="number" id="numberOfRooms" name="number_of_room" /><br>
        
        <label for="roomID">Room ID:</label>
        <input type="text" id="roomID" name="room_id" /><br>
        
        <label for="totalPrice">Total Price:</label>
        <input type="number" id="totalPrice" name="total_price" step="0.01" /><br>

        <!-- Submit Button -->
        <input type="submit" id="payNow" value="Pay Now" onclick="stripePay(event)" />
    </form>
    <div id="message" class="error-message"></div>

    <script>
        Stripe.setPublishableKey('pk_test_51PSgUSGS5hz4ZPJTx4SCL283UTRrzE5omfnSFCBYQ7CU6Jef48NWNR1EquvzZEFEa8IIVSEQup1fVmzrgwoIPGkZ00m6OvExlQ');

        function stripePay(event) {
            event.preventDefault();
            if (validateForm()) {
                $('#payNow').attr('disabled', 'disabled');
                $('#payNow').val('Payment Processing....');
                Stripe.card.createToken({
                    number: $('#cardNumber').val(),
                    cvc: $('#cardCVC').val(),
                    exp_month: $('#cardExpMonth').val(),
                    exp_year: $('#cardExpYear').val()
                }, stripeResponseHandler);
                return false;
            }
        }

        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('#payNow').attr('disabled', false);
                $('#message').html(response.error.message).show();
            } else {
                var stripeToken = response.id;
                $('#paymentForm').append("<input type='hidden' name='stripeToken' value='" + stripeToken + "' />");
                $('#paymentForm')[0].submit();  // Use vanilla JS to submit the form
            }
        }

        function validateForm() {
            var valid = true;
            var cardCVC = $('#cardCVC').val();
            var cardExpMonth = $('#cardExpMonth').val();
            var cardExpYear = $('#cardExpYear').val();
            var cardNumber = $('#cardNumber').val();
            var emailAddress = $('#emailAddress').val();
            var customerName = $('#customerName').val();
            var customerAddress = $('#customerAddress').val();
            var customerCountry = $('#customerCountry').val();
            var validateName = /^[a-z ,.'-]+$/i;
            var validateEmail = /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/;
            var validateMonth = /^(0[1-9]|1[0-2])$/;
            var validateYear = /^(20[2-9][0-9]|20[3-9][0-9])$/;
            var cvvExpression = /^[0-9]{3,4}$/;

            if(!validateMonth.test(cardExpMonth)) {
                $('#cardExpMonth').addClass('require');
                $('#errorCardExpMonth').text('Invalid Month');
                valid = false;
            } else {
                $('#cardExpMonth').removeClass('require');
                $('#errorCardExpMonth').text('');
            }

            if(!validateYear.test(cardExpYear)) {
                $('#cardExpYear').addClass('require');
                $('#errorCardExpYear').text('Invalid Year');
                valid = false;
            } else {
                $('#cardExpYear').removeClass('require');
                $('#errorCardExpYear').text('');
            }

            if(!cvvExpression.test(cardCVC)) {
                $('#cardCVC').addClass('require');
                $('#errorCardCvc').text('Invalid CVC');
                valid = false;
            } else {
                $('#cardCVC').removeClass('require');
                $('#errorCardCvc').text('');
            }

            if(!validateName.test(customerName)) {
                $('#customerName').addClass('require');
                $('#errorCustomerName').text('Invalid Name');
                valid = false;
            } else {
                $('#customerName').removeClass('require');
                $('#errorCustomerName').text('');
            }

            if(!validateEmail.test(emailAddress)) {
                $('#emailAddress').addClass('require');
                $('#errorEmailAddress').text('Invalid Email Address');
                valid = false;
            } else {
                $('#emailAddress').removeClass('require');
                $('#errorEmailAddress').text('');
            }

            if(customerAddress === '') {
                $('#customerAddress').addClass('require');
                $('#errorCustomerAddress').text('Enter Address Detail');
                valid = false;
            } else {
                $('#customerAddress').removeClass('require');
                $('#errorCustomerAddress').text('');
            }

            if(customerCountry === '') {
                $('#customerCountry').addClass('require');
                $('#errorCustomerCountry').text('Enter Country Detail');
                valid = false;
            } else {
                $('#customerCountry').removeClass('require');
                $('#errorCustomerCountry').text('');
            }

            return valid;
        }

        function validateNumber(event) {
            var charCode = (event.which) ? event.which : event.keyCode;
            if (charCode != 32 && charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
