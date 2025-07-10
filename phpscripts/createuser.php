<?php
//check input data
//is the retyped password the same
if ($_POST["password"] != $_POST["retype"]){
    header("Location: ../register.php?error=passwordsdontmatch");
    exit();
}
//check age and date match

//connect to datebase
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "mywebsite";

//make connection
$conn = new mysqli($servername, $username, $password, $dbname);

//check if connection is good
if ($conn -> connect_error){
    die("connection failed;" . $conn->connect_error);
}
$sql = "SELECT password FROM users where username ='". $_POST["username"] . "'";
$result = $conn->query($sql);
//check if user alread exists
if ($result->num_rows > 0) {
    header("Location: ../register.php?error=nametaken");
    exit();
}

//create user and password
$sql = "INSERT INTO users (username, password) VALUES (?, ?);";
$stmt = $conn->prepare($sql);

$hashedPassword = password_hash($_POST["password"], PASSWORD_BCRYPT);

if ($stmt->execute(array($_POST["username"], $hashedPassword)) === TRUE) {
    echo "user created <br>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
//save all user data
$sql = "INSERT INTO userdata (username, dateofbirth, age, info) VALUES (?, ?, ?,?);";
$stmt =  $conn->prepare($sql);
if ($stmt->execute(array($_POST["username"], $_POST["date"], $_POST["age"], $_POST["about"])) === TRUE) {
    echo "userdata saved <br>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();