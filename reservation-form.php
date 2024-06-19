<!DOCTYPE html>
<?php 
    session_start();

    if(!empty($_SESSION['check_in_date']) || !empty($_SESSION['check_out_date']) || !empty($_SESSION['guest_count']) || !empty($_SESSION['children_count'])){
        if(!empty($_SESSION['room_id']) || !empty($_SESSION['room_type'])){
            $room_id = $_SESSION['room_id'];
            $room_type = $_SESSION['room_type'];
            unset($_SESSION['room_id']);
            unset($_SESSION['room_type']);
        }
        $check_in_date = $_SESSION['check_in_date'];
        $check_out_date = $_SESSION['check_out_date'];
        $guest_count = $_SESSION['guest_count'];
        $children_count = $_SESSION['children_count'];
        unset($_SESSION['check_in_date']);
        unset($_SESSION['check_out_date']);
        unset($_SESSION['guest_count']);
        unset($_SESSION['children_count']);
    }
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Booking-Kamili Beach Resort</title>
        <link rel="icon" href="images/picture_1.png" type="image/png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
            integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css">
        <link rel="stylesheet" href="./CSS/form.css">
        <link rel="stylesheet" href="/CSS/booking.css">
        <link rel="stylesheet" href="/CSS/payment.css">
        <link rel="stylesheet" href="./Footer/footer.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    </head>
    <body>
        <div class="navbar">
            <img src="./Assests/images/picture_1.png" height=60 width=60 class="companylogo">
        </div>
        <br>
        <br>
        <br> 
        <div id="multi-step-form-container" style="margin: 40px 250px;">
            <!-- Form Steps / Progress Bar -->
            <ul class="form-stepper form-stepper-horizontal text-center mx-auto pl-0">
                <!-- Step 1 -->
                <li class="form-stepper-active text-center form-stepper-list" step="1">
                    <a class="mx-2">
                        <span class="form-stepper-circle">
                            <span>1</span>
                        </span>
                        <div class="label">Booking Details</div>
                    </a>
                </li>
                <!-- Step 2 -->
                <li class="form-stepper-unfinished text-center form-stepper-list" step="2">
                    <a class="mx-2">
                        <span class="form-stepper-circle text-muted">
                            <span>2</span>
                        </span>
                        <div class="label text-muted">Personal Details</div>
                    </a>
                </li>
                <!-- Step 3 -->
                <li class="form-stepper-unfinished text-center form-stepper-list" step="3">
                    <a class="mx-2">
                        <span class="form-stepper-circle text-muted">
                            <span>3</span>
                        </span>
                        <div class="label text-muted">Payment Details</div>
                    </a>
                </li>
            </ul>
            <!-- Step Wise Form Content -->
            <form id="userAccountSetupForm" name="userAccountSetupForm" enctype="multipart/form-data" method="POST">
                <!-- Step 1 Content -->
                <section id="step-1" class="form-step">
                    <h2 class="font-normal" style="text-align: center; color: rgb(112, 41, 99);">Booking Details</h2>
                    <br>
                    <!-- Step 1 input fields -->
                    <div class="container">
                        <div class="blocks">
                            <div class="left">
                                <p>Check In</p>
                                <div class="date-input-container">
                                    <i class="fas fa-calendar-alt date-icon"></i>
                                    <input class="date-input-field" type="text" id="sourcedatepicker" placeholder="yyyy-mm-dd" value="<?php if(!empty($check_in_date)){echo htmlspecialchars($check_in_date);} ?>" required>
                                </div>
                                <p>Check Out</p>
                                <div class="date-input-container">
                                    <i class="fas fa-calendar-alt date-icon"></i>
                                    <input class="date-input-field" type="text" id="destinationdatepicker" placeholder="yyyy-mm-dd" value="<?php if(!empty($check_out_date)){echo htmlspecialchars($check_out_date);} ?>" required>
                                </div>
                                <p>Number of Adults</p>
                                <div class="date-input-container">
                                    <i class="fas fa-user-alt date-icon"></i>
                                    <input class="date-input-field" type="number" placeholder="Adult count" value="<?php if(!empty($guest_count)){echo htmlspecialchars($guest_count);} ?>" required>
                                </div>
                                <p>Number of Children</p>
                                <div class="date-input-container">
                                    <i class="fas fa-child date-icon"></i>
                                    <input class="date-input-field" type="number" placeholder="Children count" value="<?php if(!empty($children_count)){echo htmlspecialchars($children_count);} ?>" required>
                                </div>
                                <?php 
                                    if(!empty($room_type)){
                                        ?>
                                        <p>Room Type</p>
                                        <div class="date-input-container">
                                            <i class="fas fa-bed date-icon"></i>
                                            <input class="date-input-field" type="text" value="<?php echo htmlspecialchars($room_type); ?>" required>
                                        </div>
                                        <?php
                                    }else{
                                        ?>
                                        <p>Room Type</p>
                                        <div class="date-input-container">
                                            <i class="fas fa-bed date-icon"></i>
                                            <select class="date-input-field" required>
                                                <option value="" disabled selected>Select Room Type</option>
                                                <option value="Deluxe Room">Deluxe Room</option>
                                                <option value="Superior Room">Superior Room</option>
                                                <option value="Deluxe Family Room">Deluxe Family Room</option>
                                            </select>
                                        </div>
                                        <?php
                                    }
                                ?>

                                <?php 
                                    if(!empty($room_type)){
                                        ?>
                                        <p>No of Rooms</p>
                                        <div class="date-input-container">
                                            <i class="fas fa-door-closed date-icon"></i>
                                            <select class="date-input-field" required>
                                                <option value="" disabled>Select no of Rooms</option>
                                                <option value="1" selected>1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                        </div>
                                        <?php
                                    }else{
                                        ?>
                                            <p>No of Rooms</p>
                                            <div class="date-input-container">
                                                <i class="fas fa-door-closed date-icon"></i>
                                                <select class="date-input-field" required>
                                                    <option value="" disabled selected>Select no of Rooms</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                </select>
                                            </div>
                                        <?php
                                    }
                                ?>

                                <div style="text-align: right; padding-top: 25px;">
                                    <button class="button btn-navigate-form-step" type="button" onclick="window.location.href='filterd_room.php'">
                                        Prev
                                    </button>
                                    <button class="button btn-navigate-form-step" type="button" step_number="2">
                                        Next
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Step 2 Content, default hidden on page load. -->
                <section id="step-2" class="form-step d-none">
                    <h2 class="font-normal" style="text-align: center; color: rgb(112, 41, 99);">Personal Details</h2>
                    <br>
                    <!-- Step 2 input fields -->
                    <div class="container">
                        <div class="blocks">
                            <div class="left">
                                <p>Full Name</p>
                                <div class="date-input-container">
                                    <i class="fas fa-user-alt date-icon"></i>
                                    <input class="date-input-field" type="text" placeholder="Enter Your Name" required>
                                </div>
                                <p>Email Address</p>
                                <div class="date-input-container">
                                    <i class="fas fa-pen-alt date-icon"></i>
                                    <input class="date-input-field" type="text" placeholder="Enter Your Email" required>
                                </div>
                                <p>Contact Details</p>
                                <div class="date-input-container">
                                    <i class="fas fa-phone date-icon"></i>
                                    <input class="date-input-field" type="text" placeholder="Enter Your Phone Number" required>
                                </div>
                                <p>Address</p>
                                <div class="date-input-container">
                                    <i class="fas fa-map-marker-alt date-icon"></i>
                                    <input class="date-input-field" type="text" placeholder="Enter Your Address" required>
                                </div>
                                <p>Country</p>
                                <div class="date-input-container">
                                    <i class="fas fa-globe date-icon"></i>
                                    <input class="date-input-field" type="text" placeholder="Enter Your Country" required>
                                </div>
                                <div style="text-align: right; padding-top: 25px;">
                                    <button class="button btn-navigate-form-step" type="button" step_number="1">
                                        Prev
                                    </button>
                                    <button class="button btn-navigate-form-step" type="button" step_number="3">
                                        Next
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Step 3 Content, default hidden on page load. -->
                <section id="step-3" class="form-step d-none">
                    <h2 class="font-normal" style="text-align: center; color: rgb(112, 41, 99);">Payment Details</h2>
                    <br>
                    <!-- Step 3 input fields -->
                    <div class="container">
                        <div class="blocks">
                            <div class="left">
                                <p>Credit Card Number</p>
                                <div class="date-input-container">
                                    <i class="fas fa-credit-card date-icon"></i>
                                    <input class="date-input-field" id="ccnumber" type="text" placeholder="0000 0000 0000 0000">
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <p>Month</p>
                                        <div class="date-input-container">
                                            <i class="fas fa-calendar-alt date-icon"></i>
                                            <input class="date-input-field" type="number" placeholder="Month" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <p>Year</p>
                                        <div class="date-input-container">
                                            <i class="fas fa-calendar-alt date-icon"></i>
                                            <input class="date-input-field" type="number" placeholder="Year" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <p>CVV/CVC</p>
                                        <div class="date-input-container">
                                            <i class="fas fa-lock date-icon"></i>
                                            <input class="date-input-field" id="cvv" type="text" placeholder="123">
                                        </div>
                                    </div>
                                </div>
                                <div style="text-align: right; padding-top: 25px;">
                                    <button class="button btn-navigate-form-step" type="button" step_number="2">
                                        Prev
                                    </button>
                                    <button class="button submit-btn" type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>

        <?php
            require './Footer/footer.php';
        ?>

        <script src="./JS/script.js"></script>
    </body>
</html>
