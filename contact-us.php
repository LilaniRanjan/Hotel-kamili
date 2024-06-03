<!doctype html>
<html lang="en">
  <head>
  	<title>Contact Form 03</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/contact-us.css">
    <link rel="stylesheet" href="css/home.css">

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

          <!-- <li> <i class="fa fa-search"></i> </li> -->
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

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="wrapper">
						<div class="row mb-5">
							<div class="col-md-3">
								<div class="dbox w-100 text-center">
			        		<div class="icon d-flex align-items-center justify-content-center">
			        			<span class="fa fa-map-marker"></span>
			        		</div>
			        		<div class="text">
				            <p><span>Address:</span> No. 531First Station Road, Waskaduwa</p>
				          </div>
			          </div>
							</div>
							<div class="col-md-3">
								<div class="dbox w-100 text-center">
			        		<div class="icon d-flex align-items-center justify-content-center">
			        			<span class="fa fa-phone"></span>
			        		</div>
			        		<div class="text">
				            <p><span>Phone:</span> <a href="tel://1234567920">+94342231677</a></p>
				          </div>
			          </div>
							</div>
							<div class="col-md-3">
								<div class="dbox w-100 text-center">
			        		<div class="icon d-flex align-items-center justify-content-center">
			        			<span class="fa fa-paper-plane"></span>
			        		</div>
			        		<div class="text">
				            <p><span>Email:</span> <a href="mailto:info@yoursite.com">sales@kamilibeach.com</a></p>
				          </div>
			          </div>
							</div>
							<div class="col-md-3">
								<div class="dbox w-100 text-center">
			        		<div class="icon d-flex align-items-center justify-content-center">
			        			<span class="fa fa-globe"></span>
			        		</div>
			        		<div class="text">
				            <p><span>Website</span> <a href="#">www.kamilibeach.com</a></p>
				          </div>
			          </div>
							</div>
						</div>
						<div class="row no-gutters">
							<div class="col-md-7">
								<div class="contact-wrap w-100 p-md-5 p-4">
									<h3 class="mb-4">Contact Us</h3>
									<div id="form-message-warning" class="mb-4"></div> 
				      		<div id="form-message-success" class="mb-4">
				            Your message was sent, thank you!
				      		</div>
									<form method="POST" id="contactForm" name="contactForm" class="contactForm">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="label" for="name">Full Name</label>
													<input type="text" class="form-control" name="name" id="name" placeholder="Name">
												</div>
											</div>
											<div class="col-md-6"> 
												<div class="form-group">
													<label class="label" for="email">Email Address</label>
													<input type="email" class="form-control" name="email" id="email" placeholder="Email">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label class="label" for="subject">Subject</label>
													<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label class="label" for="#">Message</label>
													<textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Message"></textarea>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<input type="submit" value="Send Message" class="btn btn-primary">
													<div class="submitting"></div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="col-md-5 d-flex align-items-stretch">
								<div class="info-wrap w-100 p-5 img" style="background-image: url(./Assests/contact-us-image.png);">
			          </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

    <footer>
    <div class="container grid">
      
      <div class="box">
        <img src="Assests/cropped-kamili-Copy-1.png" alt="Logo" width="120px" height="120px">
        <p>We draw our inspiration from the word ‘Kamili’ which denotes the city of Kalutara, an age-old symbol in Buddhism that stands for purity of body, mind and soul.We draw our inspiration from the word ‘Kamili’ which denotes the city of Kalutara, an age-old symbol in Buddhism that stands for purity of body, mind and soul.</p>

        <div class="icon">
          <i class="fa fa-facebook-f"></i>
          <i class="fa fa-instagram"></i>
          <i class="fa fa-twitter"></i>
          <i class="fa fa-youtube"></i>
        </div>
      </div>

      <div class="box">
        <h2>Links</h2>
        <ul>
          <li>Home</li>
          <li>About Us</li>
          <li>Contact Us</li>
          <li>Services</li>
          <li>Weddings</li>
          <li>Around Us</li>
        </ul>
      </div>

      <div class="box">
        <h2>Contact Us</h2>
        <i class="fa fa-location-dot"> Location</i>
        <label><br>No. 531,<br>
            First Station Road,<br>
            Waskaduwa,<br>
             Kalutara,<br>
             Sri Lanka.</label> <br>
        <i class="fa fa-phone">  Hotline</i><br>
        <label>+ (94) 76 2 760 765</label> <br>
        <i class="fa fa-envelope">  Email</i><br>
        <label>reservation@kamilibeach.com</label> <br>
      </div>
    </div>
    <section>
      
    </section>
  </footer>

  <div class="legal">
    <p class="container" style="margin-left: 600px;">Copyright (c) 2024 - All Rights Reserved.</p>
  </div> 

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

