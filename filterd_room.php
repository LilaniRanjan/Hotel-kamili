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

<header>
  <div class="content flex_space">
    <div class="logo">
      <img src="Assests/cropped-kamili-Copy-1.png" alt="Image" width="70px" height="70px">
    </div>
    
    <div class="navlinks">
      <ul id="menulist">
        <li><a href="./index.php">Home</a> </li>
        <li><a href="./about-us.php">About</a> </li>
        <li><a href="#rooms">Rooms</a> </li>
        <li><a href="#pages">Weddings</a> </li>
        <li><a href="#news">Services</a> </li>
        <li><a href="#around_us">Around Us</a> </li>
        <li><a href="#contact">Contact</a> </li>
        <li> <button class="primary-btn">BOOK NOW</button> </li>
      </ul>
      <span class="fa fa-bars" onclick="menutoggle()"></span>
    </div>
  </div>
</header>

<script>
  var menulist = document.getElementById('menulist');
  menulist.style.maxHeight = "0px";

  function menutoggle() {
    if (menulist.style.maxHeight == "0px") {
      menulist.style.maxHeight = "100vh";
    } else {
      menulist.style.maxHeight = "0px";
    }
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
