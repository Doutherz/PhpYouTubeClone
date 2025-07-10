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
    <form action="phpscripts/createuser.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" required autocomplete="off">

        <label for="password">Password</label>
        <input type="password" name="password" required autocomplete="off">

        <label for="retype">Retype password</label>
        <input type="password" name="retype" required autocomplete="off">

        <label for="age">age</label>
        <input type="number" name="age" required autocomplete="off">

        <label for="date">Date of birth</label>
        <input type="date" name="date" required autocomplete="off">

        <label for="about">About me</label>
        <input type="text" name="about" required autocomplete="off">

        <input type="submit" value="Register">
    </form>
    </div>

</body>
</html>