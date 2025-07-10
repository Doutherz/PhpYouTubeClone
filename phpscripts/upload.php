<?php
session_start();
if (empty($_SESSION)) {
    header("Location: index.php");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_FILES['videoFile']) && $_FILES['videoFile']['error'] === UPLOAD_ERR_OK) {

        $targetDir = '../userVideos/' .  $_SESSION["user"] . '/';
        
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true); // Create directory recursively with permissions
        }

        $targetFile = $targetDir . basename($_FILES['videoFile']['name']);

        if (move_uploaded_file($_FILES['videoFile']['tmp_name'], $targetFile)) {
            echo 'Upload successful!';

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

            $sql = "SELECT location FROM uservideos WHERE location = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(substr($targetFile, 3)));  
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                header("Location: ../home.php?error=videoexist");
                $stmt->close();
                $conn->close();
                exit();
            }
            $sql = "INSERT INTO uservideos (user, location, name, ispublic) VALUES (?, ?, ?, ?);";
            $stmt = $conn->prepare($sql);
            $isPublic = isset($_POST['ispublic']) ? 1 : 0;
            $stmt->execute(array($_SESSION["user"], substr($targetFile, 3), basename($_FILES['videoFile']['name']), $isPublic));
            $conn->close();
            $stmt->close();

        } else {
            echo 'Error uploading file.';
        }
    }
}