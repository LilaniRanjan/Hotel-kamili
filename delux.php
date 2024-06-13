<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Deluxe Room - Kamili Beach Resort</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./CSS/delux.css">
    <link rel="stylesheet" href="./NavBar/navbar.css">
	<link rel="stylesheet" href="./Footer/footer.css">
    <script src="JS/deluxe.js"></script>
    <script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>
    <link rel="icon" href="images/picture_1.png" type="image/png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css"
        integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css">

</head>

<body>
    <!--header01-->
    <?php
        require './NavBar/navbar.php';
    ?>
    <!--end of header01-->

    <!-- fullscreen modal -->
    <div id="modal"></div>
    <!-- end of fullscreen modal -->

    <!-- body content  -->
    <section class="services sec-width" id="services">
        <div class="title"></div>
        <div class="services-container">
            <!--Introduction -->
            <article class="service">
                <div class="service-content">
                    <h2>Deluxe Rooms</h2>
                    <p>Experience the epitome of comfort and elegance in our Deluxe Rooms. Thoughtfully designed to
                        provide a serene and luxurious retreat, each room features plush bedding, modern furnishings,
                        and stunning views. Enjoy premium amenities including complimentary high-speed Wi-Fi, a
                        flat-screen TV, a well-stocked minibar, and an en-suite bathroom with a rain shower and designer
                        toiletries. Unwind in your private balcony or terrace, perfect for soaking up the natural beauty
                        of our resort's surroundings. Whether you're here for relaxation or adventure, our Deluxe Rooms
                        offer the ideal sanctuary for a memorable stay.
                    </p>
                    <br>
                    <button type="button" class="btn">BOOK NOW</button>
                </div>
            </article>

            <!-- Image -->
            <article class="service">
                <div id="panorama" class="service-content">
                    <!-- <img src="./Assests/images/picture_4.jpg" alt="room image"> -->
                    <!-- <div id="panorama"></div> -->
                </div>
            </article>

            <script>
                pannellum.viewer('panorama', {
                    "type": "equirectangular",
                    "panorama": './outroom.jpeg',
                    "autoLoad": true
                });
            </script>
        </div>
    </section>

    <!--Room Facilities-->
    <section class="rooms sec-width" id="rooms">
        <div class="title"></div>
        <div class="service-content">
            <h2>Rooms Amenties</h2>
            <div class="rooms-container">
                <article class="room">
                    <div class="room-image">
                        <img src="./Assests/images/picture_23.webp" alt="room image">
                    </div>
                    <div class="room-text">
                        <div class="text">
                            <p>
                            <div class="content">
                                <div class="box flex">
                                    <i class="fas fa-bed"></i>
                                    <span>Queen Size Double Bed</span>
                                </div>
                                <div class="box flex">
                                    <i class="fas fa-wifi"></i>
                                    <span>Free WiFi</span>
                                </div>
                                <div class="box flex">
                                    <i class="fas fa-bath"></i>
                                    <span>Bath Tub</span>
                                </div>
                                <div class="box flex">
                                    <i class="fas fa-toilet-paper"></i>
                                    <span>Complimentry Toiletries</span>
                                </div>
                                <div class="box flex">
                                    <i class="fas fa-tv"></i>
                                    <span>Cable TV</span>
                                </div>
                                <div class="box flex">
                                    <i class="fas fa-coffee"></i>
                                    <span>Tea & Coffee Making Facility</span>
                                </div>
                                <div class="box flex">
                                    <i class="fas fa-shower"></i>
                                    <span>Hot & Cold Water</span>
                                </div>
                                <div class="box flex">
                                    <i class="fas fa-shower"></i>
                                    <span>Rain Shower</span>
                                </div>
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
            </article>
        </div>
        </div>
    </section>

    <section class="rooms sec-width" id="rooms">
        <div class="containersss">
            <div id="panorama2" class="grid-item" id="grid-1" style="width: 600px; height: 400px;">
            </div>
            <div id="panorama3" class="grid-item" id="grid-3" style="width: 600px; height: 400px;">
            </div>
        </div>
    </section>
    <script>
        pannellum.viewer('panorama2', {
            "type": "equirectangular",
            "panorama": './outroom.jpeg',
            "autoLoad": true
        });
        pannellum.viewer('panorama3', {
            "type": "equirectangular",
            "panorama": './outroom.jpeg',
            "autoLoad": true
        });
    </script>

    <!--Gallery-->
    <section class="gallary mtop " id="gallary">
        <div class="container">
            <div class="heading_top flex1">
                <br>
                <br>
                <br>
                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <img src="./Assests/images/picture_4.jpg" alt="">
                    </div>
                    <div class="item">
                        <img src="./Assests/images/picture_23.webp" alt="">
                    </div>
                    <div class="item">
                        <img src="./Assests/images/picture_16.webp" alt="">
                    </div>
                    <div class="item">
                        <img src="./Assests/images/picture_13.jpg" alt="">
                    </div>
                    <div class="item">
                        <img src="./Assests/images/picture_2.webp" alt="">
                    </div>
                    <div class="item">
                        <img src="./Assests/images/picture_14.jpg" alt="">
                    </div>
                    <div class="item">
                        <img src="./Assests/images/picture_10.jpg" alt="">
                    </div>
                    <div class="item">
                        <img src="./Assests/images/picture_9.jpg" alt="">
                    </div>
                </div>

    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"
        integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        })
    </script>

    <?php
        require './Footer/footer.php';
    ?>

</body>

</html>



</body>

</html>