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
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css"> -->
        <link rel="stylesheet" href="./CSS/form.css">
        <link rel="stylesheet" href="/CSS/booking.css">
        <link rel="stylesheet" href="/CSS/payment.css">
        <link rel="stylesheet" href="./css/home.css">
        <link rel="stylesheet" href="./Footer/footer.css">
        <link rel="stylesheet" href="./CSS/customization.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://js.stripe.com/v2/"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-creditcardvalidator/1.0.0/jquery.creditCardValidator.js"></script>


    </head>
    <body>
        <?php
            require './NavBar/navbar.php';
        ?>


        <form action="customize_event.php" method="POST" enctype="multipart/form-data">
            <!-- Event Type Dropdown -->
            <!-- Event Type Dropdown -->
            <label for="event_type">Event Type:</label>
            <select name="event_type" id="event_type" required onchange="showDecorationOptions()">
                <option value="" disabled selected>Select Event Type</option>
                <option value="birthday">Birthday</option>
                <option value="wedding">Wedding</option>
                <option value="corporate">Corporate Event</option>
                <option value="anniversary">Anniversary</option>
            </select>
            <br><br>

            <!-- Decoration Options -->
            <div id="decoration_options" style="display: none;">
                <h4><label>Select your preferable Room Decorations:</label></h4>
                <div id="birthday_decorations" class="decoration-section" style="display: none;">
                    <div class="decoration-option" onclick="selectDecoration('birthday_banner', this)">
                        <img src="https://cheetah.cherishx.com/uploads/1608553443_large.jpg" alt="Birthday Decoration 1">
                        <p>Birthday Banner - $20</p>
                        <input type="hidden" name="decoration" value="birthday_banner">
                    </div>
                    <div class="decoration-option" onclick="selectDecoration('colorful_balloons', this)">
                        <img src="https://cheetah.cherishx.com/uploads/1608553443_large.jpg" alt="Birthday Decoration 2">
                        <p>Colorful Balloons - $15</p>
                        <input type="hidden" name="decoration" value="colorful_balloons">
                    </div>
                </div>

                <div id="anniversary_decorations" class="decoration-section" style="display: none;">
                    <div class="decoration-option" onclick="selectDecoration('romantic_candles', this)">
                        <img src="https://www.miraculousmemories.com/cdn/shop/products/IMG-20230117-WA0006.jpg?v=1678182760&width=1445" alt="Anniversary Decoration 1">
                        <p>Romantic Candles - $25</p>
                        <input type="hidden" name="decoration" value="romantic_candles">
                    </div>
                    <div class="decoration-option" onclick="selectDecoration('elegant_flowers', this)">
                        <img src="https://www.miraculousmemories.com/cdn/shop/products/IMG-20230117-WA0006.jpg?v=1678182760&width=1445" alt="Anniversary Decoration 2">
                        <p>Elegant Flowers - $30</p>
                        <input type="hidden" name="decoration" value="elegant_flowers">
                    </div>
                </div>
            </div>

            <script>
                function showDecorationOptions() {
                    const eventType = document.getElementById('event_type').value;
                    document.getElementById('birthday_decorations').style.display = eventType === 'birthday' ? 'block' : 'none';
                    document.getElementById('anniversary_decorations').style.display = eventType === 'anniversary' ? 'block' : 'none';
                    document.getElementById('decoration_options').style.display = 'block';
                }

                function selectDecoration(decorationValue, element) {
                    // Remove selected class from all options
                    const options = document.querySelectorAll('.decoration-option');
                    options.forEach(opt => {
                        opt.classList.remove('selected');
                    });

                    // Highlight the selected option
                    element.classList.add('selected');

                    // Update the hidden input field with the selected decoration value
                    document.querySelector(`input[name="decoration"][value="${decorationValue}"]`).checked = true;
                }
            </script>



            <!-- Theme Color Selection -->
            <label for="theme_color">Choose Theme Color:</label>
            <div id="color_palette" class="color-palette">
                <div class="color-option" style="background-color: #FFFFFF;" data-color="#FFFFFF"></div>
                <div class="color-option" style="background-color: #FF6F61;" data-color="#FF6F61"></div>
                <div class="color-option" style="background-color: #228B22;" data-color="#228B22"></div>
                <div class="color-option" style="background-color: #000000;" data-color="#000000"></div>
                <div class="color-option" style="background-color: #FFD700;" data-color="#FFD700"></div>
                <div class="color-option" style="background-color: #003366;" data-color="#003366"></div>
                <div class="color-option" style="background-color: #A9A9A9;" data-color="#A9A9A9"></div>
                <div class="color-option" style="background-color: #FF1493;" data-color="#FF1493"></div>
            </div>
            <input type="hidden" id="theme_color" name="theme_color" required>

            <br><br>

            <!-- Cake Customization -->
            <label>Do you want to order a cake?</label><br>
            <input type="radio" id="cake_yes" name="cake_order" value="yes" onclick="toggleCakeOptions(true)" required>
            <label for="cake_yes">Yes</label>
            <input type="radio" id="cake_no" name="cake_order" value="no" onclick="toggleCakeOptions(false)" required>
            <label for="cake_no">No</label>
            <br><br>

            <div id="cake_options" style="display: none;">
                <!-- Cake Kg Dropdown -->
                <label for="cake_kg">Cake Size (Kg):</label>
                <select name="cake_kg" id="cake_kg">
                    <option value="1">1 Kg</option>
                    <option value="1.5">1.5 Kg</option>
                    <option value="2">2 Kg</option>
                    <option value="2.5">2.5 Kg</option>
                    <option value="3">3 Kg</option>
                </select>
                <br><br>

                <label for="cake_message">Message on Cake:</label>
                <input type="text" id="cake_message" name="cake_message" placeholder="Enter cake message">
                <br><br>

                <!-- Optional Cake Design Upload -->
                <label for="cake_design">Upload Cake Design (Optional):</label>
                <input type="file" id="cake_design" name="cake_design" accept="image/*">
                <br><br>
            </div>

            <!-- Customization Suggestions -->
            <label for="suggestions">Any additional suggestions:</label><br>
            <textarea id="suggestions" name="suggestions" rows="4" cols="50" placeholder="Enter your suggestions"></textarea>
            <br><br>

            <input type="submit" value="Submit Customization">
        </form>

        <script>
            function toggleCakeOptions(show) {
                document.getElementById('cake_options').style.display = show ? 'block' : 'none';
            }
        </script>

        <script>
            const colorOptions = document.querySelectorAll('.color-option');
            const themeColorInput = document.getElementById('theme_color');

            colorOptions.forEach(option => {
                option.addEventListener('click', () => {
                    // Remove existing selected class
                    colorOptions.forEach(opt => opt.style.border = '2px solid transparent');
                    // Highlight selected color
                    option.style.border = '2px solid #000';
                    // Update hidden input with selected color
                    themeColorInput.value = option.dataset.color;
                });
            });
        </script>



        <?php
            require './Footer/footer.php';
        ?>
    </body>
</html>