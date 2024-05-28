<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <form method="post" enctype="multipart/form-data" action="AddRoomProcess.php">
            <label for="room_type">Room Type:</label>
            <input type="text" id="room_type" name="room_type" required>
            <br>
            <br>
        
            <label for="guest_count">Guest Count:</label>
            <input type="number" id="guest_count" name="guest_count" required>
            <br>
            <br>
        
            <label for="price">Price:</label>
            <input type="number" step="0.01" id="price" name="price" required>
            <br>
            <br>
        
            <label for="room_description">Room Description:</label>
            <textarea id="room_description" name="room_description" required></textarea>
            <br>
            <br>
        
            <label for="room_image">Room Image:</label>
            <input type="file" id="room_image" name="room_image">
            <br>
            <br>
        
            <label for="view_image_360">360 View Image:</label>
            <input type="file" id="view_image_360" name="view_image_360">
            <br>
            <br>
            <br>
            <br>
        
            <div style="padding: 20px;">
                <div id="offers">
                    <div style="padding-left: 10px;">
                        <label for="offer_description_0">Offer Name:</label>
                        <input type="text" id="offer_description_0" name="offers[0][description]" required>
                        
                        <label for="offer_price_0">Offer Price:</label>
                        <input type="number" step="0.01" id="offer_price_0" name="offers[0][price]" required>
                        <br>
                        <br>
                    </div>
                </div>
            
                <button type="button" onclick="addOffer()">Add Another Offer</button>
            </div>
            <br>
            <br>
            <br>
            <button type="submit" name="submit">Create Room</button>
        </form>

        <script>
            function addOffer() {
                var offerIndex = document.querySelectorAll('#offers div').length;
                var newOffer = `
                    <div>
                        <label for="offer_description_${offerIndex}">Offer Description:</label>
                        <input type="text" id="offer_description_${offerIndex}" name="offers[${offerIndex}][description]" required>
                        
                        <label for="offer_price_${offerIndex}">Offer Price:</label>
                        <input type="number" step="0.01" id="offer_price_${offerIndex}" name="offers[${offerIndex}][price]" required>
                    </div>
                `;
                document.getElementById('offers').insertAdjacentHTML('beforeend', newOffer);
            }
        </script>

    </body>
</html>