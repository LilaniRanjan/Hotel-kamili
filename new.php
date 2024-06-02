<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Room Booking</title>
</head>
<body>
    <h1>Search for Available Rooms</h1>
    <form action="filteredRoom.php" method="post">
        <label for="check_in_date">Check-in Date:</label>
        <input type="date" id="check_in_date" name="check_in_date" required>
        
        <label for="check_out_date">Check-out Date:</label>
        <input type="date" id="check_out_date" name="check_out_date" required>

        <label for="guest_count">Guest Count:</label>
        <input type="number" id="guest_count" name="guest_count" min="1" required>
        
        <button type="submit">Search</button>
    </form>
</body>
</html>
