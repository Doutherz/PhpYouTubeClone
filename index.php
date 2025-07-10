<?php
    session_start();
    if (!empty($_SESSION)) {
        // User has session data
        header("Location: home.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\style.css">
    <title>Login</title>
</head>
<body>
    <div class="login-container">
    <form action="phpscripts/loginProcess.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" required>

        <label for="password">Password</label>
        <input type="password" name="password" required>

        <input type="submit" value="Login">

        <button onclick="window.location.href = 'register.php';">Register</button>
    </form>
    </div>
    

</body>
</html>