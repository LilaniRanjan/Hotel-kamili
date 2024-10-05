<!DOCTYPE html>

<?php
  session_start();

  require_once './classes/DbConnector.php';
  require_once './classes/EventTypes.php';
  require_once './classes/DecorationOptions.php';

  $message = "";

  try {
      // Establish database connection
      $dbConnector = new \classes\DbConnector();
      $con = $dbConnector->getConnection();
  } catch (PDOException $exc) {
      // Handle database connection error
      die("Error in DbConnection on DisplayRooms file: " . $exc->getMessage());
  }

  // Fetch all EventType
  $eventTypes = EventTypes::getAllEventType($con);

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

            <?php 
                $eventId = "";
            ?>

            <!-- Event Type Dropdown -->
            <label for="event_type">Event Type:</label>
            <select name="event_type" id="event_type" required onchange="showDecorationOptions()">
                <option value="" disabled selected>Select Event Type</option>
                <?php 
                    foreach ($eventTypes as $eventType){
                        // Correcting double dollar sign
                        $eventId = $eventType['event_type_id'];
                        ?>
                        <option value="<?php echo $eventId; ?>"><?php echo htmlspecialchars($eventType['event_name']); ?></option>
                        <?php
                    }
                ?>
            </select>
            <br><br>

            <!-- Decoration Options -->
            <div id="decoration_options">
                <h4><label>Select Your Preferred Room Decoration:</label></h4>
                <div id="birthday_decorations" class="decoration-section">
                <!-- Decoration options will be dynamically loaded here -->
                </div>
            </div>

            <script>
                function showDecorationOptions() {
                    const eventType = document.getElementById('event_type').value;

                    if (eventType) {
                        fetch(`get_decorations.php?event_id=${eventType}`)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(`HTTP error! Status: ${response.status}`);
                                }
                                return response.json();
                            })
                            .then(decorations => {
                                console.log('Fetched decorations:', decorations);

                                // If a single object is returned, wrap it in an array
                                if (!Array.isArray(decorations)) {
                                    decorations = [decorations];
                                }

                                const decorationContainer = document.getElementById('birthday_decorations');
                                decorationContainer.innerHTML = '';

                                decorations.forEach(decoration => {
                                    const decorationDiv = document.createElement('div');
                                    decorationDiv.classList.add('decoration-option');
                                    decorationDiv.onclick = () => selectDecoration(decoration.decoration_id, decorationDiv);
                                    decorationDiv.innerHTML = `
                                        <img src="${decoration.decoration_image}" alt="${decoration.decoration_name}">
                                        <p>${decoration.decoration_name} - Rs ${decoration.decoration_price}</p>
                                        <input type="hidden" name="decoration" value="${decoration.decoration_id}">
                                    `;
                                    decorationContainer.appendChild(decorationDiv);
                                });

                                document.getElementById('decoration_options').style.display = 'block';
                            })
                            .catch(error => {
                                console.error('Error fetching decorations:', error);
                                // Display a message to the user if no decorations are found
                                document.getElementById('birthday_decorations').innerHTML = '<p>Error fetching decorations. Please try again later.</p>';
                            });
                    }
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

                <!-- Cake Type Dropdown -->
                <label for="cake_type">Select Cake Type:</label>
                <select name="cake_type" id="cake_type" required>
                    <option value="" disabled selected>Select your cake type</option>
                    <option value="Chocolate Cake">Chocolate Cake</option>
                    <option value="Vanilla Cake">Vanilla Cake</option>
                    <option value="Red Velvet Cake">Red Velvet Cake</option>
                    <option value="Fruit Cake">Fruit Cake</option>
                    <option value="Carrot Cake">Carrot Cake</option>
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