<?php
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
$sql = "SELECT password FROM users WHERE BINARY username = ?";
$stmt = $conn->prepare($sql);
$stmt->execute(array($_POST["username"]));
$result = $stmt->get_result();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    if (password_verify($_POST["password"], $row["password"])){
        session_start();
        $_SESSION["user"] = $_POST["username"];
        header("Location: ../home.php");
    }else {
        header("Location: ../index.php?error=wrongpass");
    }
  }
} else {
    header("Location: ../index.php?error=nouser");
}
$stmt->close();
$conn->close();