<?php

session_start();
require_once '../classes/DbConnector.php';
require_once '../classes/room.php';
require_once '../classes/staff.php';
require_once '../classes/faq.php';
require_once '../classes/Reservation.php';
require_once '../classes/RoomAmenity.php';
require_once '../classes/RoomImages.php';

use classes\DbConnector;
use classes\Room;
use classes\staff;
use classes\Reservation;
use classes\faq;


$dbConnector = new DbConnector();
$con = $dbConnector->getConnection();

$rooms = Room::getAllRooms($con);


$staff = new staff('', '', '', '', '', '', '', '');
$staffList = $staff->getAllStaff($con);

$reservations = Reservation::getAllReservations($con);

$faq = new faq('', '');
$faqList = $faq->getAllFaq($con);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <!-- Include Date Range Picker CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- My CSS -->
    <link rel="stylesheet" href="../CSS/Admin_style.css">

    <title>Admin Dashboard</title>

</head>

<body>

    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <img class="img" src="../Assests/cropped-kamili-Copy-1.png" alt="Kamili Beach Resort"><br>
            <span class="text">Kamili Beach Resort</span>
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="#" onclick="showDashboard()">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Recent </span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showRoomDetails()">
                    <i class='bx bxs-institution'></i>
                    <span class="text">Room</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showReservationDetails()">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text">Reservation</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showStaffDetails()">
                    <i class='bx bxs-group'></i>
                    <span class="text">Staff</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showFAQs()">
                    <i class='bx bxs-message-dots'></i>
                    <span class="text">FAQ</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showSettings()">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Settings</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">

        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a>
            <a href="#" class="profile">
                <img src="../Assests/people.png">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="#" id="breadcrumb">Recent</a>
                        </li>
                    </ul>
                </div>
            </div>

            <ul class="box-info">
                <li>
                    <i id="calendar-icon" class='bx bxs-calendar-check'></i>
                    <span class="text">
                        <h3>Pick a date</h3>
                        <input type="date" name="date" id="date">
                    </span>
                </li>
                <li>
                    <i class='bx bxs-group'></i>
                    <span class="text">
                        <h3>12</h3>
                        <p>Available</p>
                    </span>
                </li>
                <li>
                    <i class='bx bx-registered'></i>
                    <span class="text">
                        <h3>10</h3>
                        <p>Not Available</p>
                    </span>
                </li>
            </ul>

            <div class="table-data">
                <form action="" method="post">
                    <div class="order">
                        <?php include('message.php'); ?>
                        <div class="head">
                            <h3>Recent Bookings</h3>

                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Reservation No</th>
                                    <th>Customer Name</th>
                                    <th>Check in</th>
                                    <th>Check out</th>
                                    <th>Payment status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($reservations)) : ?>
                                    <?php foreach ($reservations as $reservation) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($reservation['reservation_id']); ?></td>
                                            <td><?php echo htmlspecialchars($reservation['full_name']); ?></td>
                                            <td><?php echo htmlspecialchars($reservation['check_in_date']); ?></td>
                                            <td><?php echo htmlspecialchars($reservation['check_out_date']); ?></td>
                                            <td><?php echo htmlspecialchars($reservation['payment_status']); ?></td>
                                            <td>
                                                <div class="icon-button">
                                                    <a href="viewReservations.php?reservation_id=<?php echo htmlspecialchars($reservation['reservation_id']); ?>">
                                                        <button type="button"><img src="../Assests/view.png" alt="View"></button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="5">No reservations found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </form>

                <!-- Room section start -->
                <?php include('message.php'); ?>
                <form action="AddRoom.php" method="post">
                    <div class="order" id="roomDetails">
                        <div class="head" style="margin-top: -32px;">
                            <h3>Room Details</h3>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Room ID</th>
                                    <th>Room Type</th>
                                    <th>Guest count</th>
                                    <th>Price per night</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rooms as $room) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($room['room_id']); ?></td>
                                        <td><?php echo htmlspecialchars($room['room_type']); ?></td>
                                        <td><?php echo htmlspecialchars($room['adult_count'] + $room['children_count']); ?></td>
                                        <td><?php echo htmlspecialchars($room['price_per_night']); ?></td>
                                        <td>
                                            <div class="icon-button" id="roomDetailsSection">
                                                <button type="button" class="viewButton"><a href="ViewRoom.php?room_id=<?php echo $room['room_id']; ?>"><img src="../Assests/view.png" alt="View"></a></button>
                                                <button type="button" class="editButton"><a href="EditRoom.php?room_id=<?php echo $room['room_id']; ?>"><img src="../Assests/edit.png" alt="Edit"></a></button>
                                                <button type="button" onclick="DeleteProcess(<?php echo $room['room_id']; ?>, 'room')"><img src="../Assests/delete.png" alt="Delete"></button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div><button type="submit" class="btn-add">Add +</button></div>

                    </div>
                </form>

                <!-- Room section end -->


                <!-- Reservation start -->
                <?php include('message.php'); ?>
                <form action="AddReservation.php" method="post">
                    <div class="order" id="reservation" style="display:none;">
                        <div class="head" style="margin-top: -32px;">
                            <h3>Reservations</h3>
                            <i class='bx bx-search'></i>
                            <i class='bx bx-filter'></i>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Reservation ID</th>
                                    <th>Room Number</th>
                                    <th>Amount</th>
                                    <th>Guest count</th>
                                    <th>Payment status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($reservations as $reservation) : ?>
                                    <tr id="reservation-row-<?php echo htmlspecialchars($reservation['reservation_id']); ?>">
                                        <td><?php echo htmlspecialchars($reservation['reservation_id']); ?></td>
                                        <td><?php echo htmlspecialchars($reservation['room_id']); ?></td>
                                        <td><?php echo htmlspecialchars($reservation['total_price']); ?></td>
                                        <td><?php echo htmlspecialchars($reservation['number_of_adult'] + $reservation['number_of_children']); ?></td>
                                        <td><?php echo htmlspecialchars($reservation['payment_status']); ?></td>
                                        <td>
                                            <div class="icon-button">
                                                <?php if ($reservation['reservation_status'] === 'cancelled') : ?>
                                                    <button type="button" style="color: red;">
                                                        <span><b>Reservation Cancelled</b></span>
                                                    </button>
                                                <?php else : ?>
                                                    <a href="viewReservations.php?reservation_id=<?php echo htmlspecialchars($reservation['reservation_id']); ?>">
                                                        <button type="button"><img src="../Assests/view.png" alt="View"></button>
                                                    </a>
                                                    <button type="button" onclick="cancelReservation(<?php echo htmlspecialchars($reservation['reservation_id']); ?>)">
                                                        <img src="../Assests/icons8-cancel-30.png" alt="Cancel">
                                                    </button>
                                                    <button type="button" onclick="DeleteProcess(<?php echo htmlspecialchars($reservation['reservation_id']); ?>, 'reservation')">
                                                        <img src="../Assests/delete.png" alt="Delete">
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                        <div><button class="btn-add" id="show-staff">Add +</button></div>
                    </div>
                </form>
                <!-- Reservation end -->

                <!-- Staff Strt -->

                <form action="AddStaff.php" method="post">
                    <?php include('message.php'); ?>
                    <div class="order" id="staff" style="display:none;">
                        <div class="head" style="margin-top: -32px;">
                            <h3>Staff details</h3>
                            <i class='bx bx-search'></i>
                            <i class='bx bx-filter'></i>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Staff ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <!-- <th>Username</th> -->
                                    <!-- <th>NIC</th> -->
                                    <th>Email</th>
                                    <!-- <th>Contact No</th> -->
                                    <th>Role</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($staffList as $staff) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($staff['staff_id']); ?></td>
                                        <td><?php echo htmlspecialchars($staff['firstname']); ?></td>
                                        <td><?php echo htmlspecialchars($staff['lastname']); ?></td>


                                        <td><?php echo htmlspecialchars($staff['email']); ?></td>

                                        <td><?php echo htmlspecialchars($staff['role']); ?></td>
                                        <td>
                                            <div class="icon-button">
                                                <button type="button" onclick="viewStaff(<?php echo $staff['staff_id']; ?>)"><a href="ViewStaff.php?staff_id=<?php echo $staff['staff_id']; ?>"><img src="../Assests/view.png" alt="View"></button>
                                                <button type="button" onclick="editStaff(<?php echo $staff['staff_id']; ?>)"><a href="EditStaff.php?staff_id=<?php echo $staff['staff_id']; ?>"><img src="../Assests/edit.png" alt="Edit"></a></button>
                                                <button type="button" onclick="DeleteProcess(<?php echo $staff['staff_id']; ?>, 'staff')"><img src="../Assests/delete.png" alt="Delete"></button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>

                        </table>
                        <div><button class="btn-add" id="show-staff">Add +</button></div>
                    </div>
                </form>

                <!-- Staff end -->


                <!-- FAQ strt -->

                <form action="" method="post" style="width: 100%;">
                    <?php include('message.php'); ?>
                    <div class="order" id="faq" style="display:none;">
                        <div class="head" style="margin-top: -32px;">
                            <h3>FAQ</h3>
                        </div>

                        <div class="faq" style="background-color: #cebcca; padding: 10px;">
                            <?php $count = 1; ?>
                            <?php foreach ($faqList as $faqItem) : ?>
                                <div class="faq-item" style="border-bottom: 1px solid #ccc; padding-bottom: 10px;">
                                    <div class="faq-question" style="display: flex; justify-content: space-between; align-items: center;">
                                        <div style="flex-grow: 1;">
                                            <?php echo $count . ". " . htmlspecialchars($faqItem['faq_question']); ?>
                                        </div>
                                        <div class="icon-button" style="display: flex; gap: 5px;">
                                            <button type="button" style="background: none; border: none;"><img src="../Assests/edit.png" alt="Edit" style="width: 20px; height: 20px;"></button>
                                            <button type="button" style="background: none; border: none;"><img src="../Assests/delete.png" alt="Delete" style="width: 20px; height: 20px;"></button>
                                            <button type="button" style="background: none; border: none;"><img src="../Assests/icons8-upload-26.png" alt="upload" style="width: 20px; height: 20px;"></button>

                                        </div>
                                    </div>
                                    <div class="faq-answer" style="display: none; padding: 10px; background-color: #f9f9f9; margin-top: 10px;">
                                        <?php echo htmlspecialchars($faqItem['faq_answer']); ?>
                                    </div>
                                </div>
                                <?php $count++; ?>
                            <?php endforeach; ?>
                        </div>

                        <div><button class="btn-add" id="show-faq">Add +</button></div>

                        <script>
                            document.querySelectorAll('.faq-question').forEach(question => {
                                question.addEventListener('click', () => {
                                    const answer = question.nextElementSibling;
                                    if (answer.style.display === 'none' || !answer.style.display) {
                                        answer.style.display = 'block';
                                    } else {
                                        answer.style.display = 'none';
                                    }
                                });
                            });
                        </script>

                    </div>
                </form>

                <!-- FAQ end -->

                <!-- Settings strt -->

                <div class="order" id="settings" style="display:none;">
                    <div class="head">
                        <h3>Settings</h3>
                        <i class='bx bx-search'></i>
                        <i class='bx bx-filter'></i>
                    </div>

                    <ul class="Home-settings">

                        <li>
                            <i class='AboutUs content'></i>
                            <button>Home Settings</button>
                        </li>
                        <li>
                            <i class='ContactUs'></i>
                            <button>ContactUs</button>
                        </li>
                        <li>
                            <i class='Feedback'></i>
                            <button>Feedback</button>
                        </li>

                    </ul>

                </div>

                <!-- Settings end -->

        </main>
        <!-- MAIN end-->

    </section>
    <!-- CONTENT -->

    <script src="../JS/Admin_script.js"></script>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Moment.js -->
    <script src="https://cdn.jsdelivr.net/momentjs/2.29.1/moment.min.js"></script>

    <!-- Include Date Range Picker JS -->
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('date').value = today;

        });
    </script>

</body>

</html>