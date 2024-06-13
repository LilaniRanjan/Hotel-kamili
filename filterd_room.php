<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KAMILI BEACH RESORT</title>
  <link rel="stylesheet" href="./css/home.css">
  <link rel="stylesheet" href="./css/filtered_room.css">
  <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
</head>

<body>
<?php
    require './NavBar/navbar.php';
?>

<script>

  function toggleFilterPanel() {
      var filterPanel = document.getElementById('filter-panel');
      if (filterPanel.style.display === 'block') {
        filterPanel.style.display = 'none';
      } else {
        filterPanel.style.display = 'block';
      }
    }

    function updatePriceValue(value) {
      document.getElementById('price_value').textContent = 'Rs. ' + value;
    }
</script>

<section class="book">
  <div class="container flex_space">
    <div class="text">
      <h1> <span>Book </span> Your Rooms </h1>
    </div>
    <div class="form">
      <form class="grid" action="filteredRoom.php" method="post">
        <input type="date" placeholder="Arrival Date" name="check_in_date" required>
        <input type="date" placeholder="Departure Date" name="check_out_date" required>
        <input type="number" placeholder="Guest Count" name="guest_count" min="1" required>
        <input type="number" placeholder="Children">
        <input type="submit" value="CHECK AVAILABILITY">
      </form>
    </div>
  </div>
</section>

<section class="rooms">
  <div class="container top">
    <div class="heading">
      <h1>EXPLORE</h1>
      <h2>Our Accommodations</h2>
      <p>Exceptional Facilities Provided For You - Accommodations.</p>
    </div>

    <!-- Filter function Start -->
 <section>
    <div class="filter-icon">
        <span class="fa fa-filter" onclick="toggleFilterPanel()"> </span>
    </div>

    <div id="filter-panel" class="filter-panel">
        <div class="filter-header">
          <h3>Filter Rooms</h3>
          <span class="fa fa-times" onclick="toggleFilterPanel()"></span>
        </div>
        <div class="filter-body">
          <form id="filter-form" action="filteredRoom.php" method="post">
            <label for="room_type">Room Type</label>
            <select name="room_type" id="room_type">
              <option value="">Select Type</option>
              <option value="Premium Deluxe">Premium Deluxe</option>
              <!-- Add more room types as needed -->
            </select>
            <label for="price_range">Price Range</label>
            <input type="range" name="price_range" id="price_range" min="0" max="50000" step="1000" oninput="updatePriceValue(this.value)">
            <span id="price_value">Rs. 0</span>
            <input type="submit" value="Apply Filters">
          </form>
        </div>
      </div>
  </section>

  <!-- Filter function end -->

    <div class="content mtop rooms-grid">
    <div class="room-item">
        <div class="image">
          <img src="Assests/Luxary.jpg" alt="Premium Deluxe">
        </div>
        <div class="text">
          <h2>Premium Deluxe</h2>
          <div class="rate flex">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
          </div>
          <h4 style="text-align: right; color: rgb(255, 0, 255);">5 Rooms Left</h4>
          <p>
          <ul type="disk">
            <li>Double Beds</li>
            <li>Wi-Fi</li>
            <li>Air Condition</li>
          </ul>
          </p>
          <div class="button flex">
            <button class="primary-btn">VIEW MORE</button>
            <h3>Rs.25000 <span><br> Per Night </span></h3>
          </div>
        </div>
      </div>

      <div class="room-item">
        <div class="image">
          <img src="Assests/Luxary.jpg" alt="Premium Deluxe">
        </div>
        <div class="text">
          <h2>Premium Deluxe</h2>
          <div class="rate flex">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
          </div>
          <h4 style="text-align: right; color: rgb(255, 0, 255);">5 Rooms Left</h4>
          <p>
          <ul type="disk">
            <li>Double Beds</li>
            <li>Wi-Fi</li>
            <li>Air Condition</li>
          </ul>
          </p>
          <div class="button flex">
            <button class="primary-btn">VIEW MORE</button>
            <h3>Rs.25000 <span><br> Per Night </span></h3>
          </div>
        </div>
      </div>
      
      <div class="room-item">
        <div class="image">
          <img src="Assests/Luxary.jpg" alt="Premium Deluxe">
        </div>
        <div class="text">
          <h2>Premium Deluxe</h2>
          <div class="rate flex">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
          </div>
          <h4 style="text-align: right; color: rgb(255, 0, 255);">5 Rooms Left</h4>
          <p>
          <ul type="disk">
            <li>Double Beds</li>
            <li>Wi-Fi</li>
            <li>Air Condition</li>
          </ul>
          </p>
          <div class="button flex">
            <button class="primary-btn">VIEW MORE</button>
            <h3>Rs.25000 <span><br> Per Night </span></h3>
          </div>
        </div>
      </div>

      <div class="room-item">
        <div class="image">
          <img src="Assests/Luxary.jpg" alt="Premium Deluxe">
        </div>
        <div class="text">
          <h2>Premium Deluxe</h2>
          <div class="rate flex">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
          </div>
          <h4 style="text-align: right; color: rgb(255, 0, 255);">5 Rooms Left</h4>
          <p>
          <ul type="disk">
            <li>Double Beds</li>
            <li>Wi-Fi</li>
            <li>Air Condition</li>
          </ul>
          </p>
          <div class="button flex">
            <button class="primary-btn">VIEW MORE</button>
            <h3>Rs.25000 <span><br> Per Night </span></h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<br>

<!--------------------------------------------------------------------- Footer --------------------------------------------------------------->
 
<?php
    require './Footer/footer.php';
?>
</body>

</html>
