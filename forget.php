<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./CSS/login.css">
    <title>Forgot Password</title>
</head>
<body>
 <div class="wrapper">
    

<!----------------------------- Form box ----------------------------------->    
    <div class="form-box">
        
        <!-------------------  form -------------------------->

        <form action="send-password-reset.php" method="POST" class="login-container" id="login">
            <div class="top">
                 
                <header>Forgot Password</header>
            </div> 

            <div class="input-box">
                <input type="text" class="input-field" placeholder="Email" name="email">
                <i class="bx bx-envelope"></i>
            </div>
            <br>
            <div class="input-box">
                <input type="submit" class="submit" value="Submit">
            </div>
             <div class="account">
                 <span>Back to the <a href="login.html" >Login</a></span>
            </div> 
             
        </form>

</body>
</html>