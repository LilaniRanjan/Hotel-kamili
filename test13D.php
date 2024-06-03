<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kabana Room Exterior 3D View</title>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css">
</head>
<body>
    <h1>Kabana Room Exterior 3D View</h1>
    <div id="panorama" style="width: 600px; height: 400px;"></div>

    <script>
        pannellum.viewer('panorama', {
            "type": "equirectangular",
            "panorama": './outroom.jpeg',
            "autoLoad": true
        });
    </script>
</body>
</html>
