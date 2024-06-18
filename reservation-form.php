<!DOCTYPE html>
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
                        <div class="label">Room Details</div>
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
                    <h2 class="font-normal" style="text-align: center; color: rgb(112, 41, 99);">Room Details</h2>
                    <br>
                    <!-- Step 1 input fields -->
                    <div class="container">
                        <div class="blocks">
                            <div class="left">
                                <p>Check In</p>
                                <div class="date-input-container">
                                    <i class="fas fa-calendar-alt date-icon"></i>
                                    <input class="date-input-field " type="text" id="sourcedatepicker" placeholder="mm/dd/yyyy">
                                </div>
                                <p>Check Out</p>
                                <div class="date-input-container">
                                    <i class="fas fa-calendar-alt date-icon"></i>
                                    <input class="date-input-field" type="text" id="destinationdatepicker" placeholder="mm/dd/yyyy">
                                </div>
                                <p> Number of Adults</p>
                                <div class="date-input-container">
                                    <i class="fas fa-user-alt date-icon"></i>
                                    <input class="date-input-field" type="text" placeholder="Enter Number">
                                </div>
                                <p>Number of Children</p>
                                <div class="date-input-container">
                                    <i class="fas fa-child date-icon"></i>
                                    <input class="date-input-field" type="text" placeholder="Enter Number">
                                </div>
                                <p>Room Catergory</p>
                                <div class="select">
                                    <div class="selectBtn" data-type="firstOption"><i class="fas fa-hotel"></i>Select Room Catergory
                                    </div>
                                    <div class="selectDropdown">
                                        <div class="option" data-type="firstOption">Deluxe Room</div>
                                        <div class="option" data-type="secondOption">Superior Room</div>
                                        <div class="option" data-type="thirdOption">Deluxe Family Room</div>
                                    </div>
                                </div>
                                <div style="text-align: right; padding-top: 25px;">
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
                                    <input class="date-input-field" type="text" placeholder="Enter Your Name">
                                </div>
                                <p>Email Address</p>
                                <div class="date-input-container">
                                    <i class="fas fa-pen-alt date-icon"></i>
                                    <input class="date-input-field" type="text" placeholder="Enter Your Email">
                                </div>
                                <p>Contact Details</p>
                                <div class="date-input-container">
                                    <i class="fas fa-phone date-icon"></i>
                                    <input class="date-input-field" type="text" placeholder="Enter Your Phone Number">
                                </div>
                                <p>Address</p>
                                <div class="date-input-container">
                                    <i class="fas fa-map-marker-alt date-icon"></i>
                                    <input class="date-input-field" type="text" placeholder="Enter Your Address">
                                </div>
                                <p>Country</p>
                                <div class="date-input-container">
                                    <i class="fas fa-globe date-icon"></i>
                                    <input class="date-input-field" type="text" placeholder="Enter Your Country">
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
                    <!-- <div class="mt-3">
                        <button class="button btn-navigate-form-step" type="button" step_number="1">
                            Prev
                        </button>
                        <button class="button btn-navigate-form-step" type="button" step_number="3">
                            Next
                        </button>
                    </div> -->
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
                                            <select class="date-input-field" id="ccmonth">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                                <option>10</option>
                                                <option>11</option>
                                                <option>12</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <p>Year</p>
                                        <div class="date-input-container">
                                            <i class="fas fa-calendar-alt date-icon"></i>
                                            <select class="date-input-field" id="ccyear">
                                                <option>2023</option>
                                                <option>2024</option>
                                                <option>2025</option>
                                                <option>2026</option>
                                                <option>2027</option>
                                                <option>2028</option>
                                                <option>2029</option>
                                                <option>2030</option>
                                            </select>
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