<?php
    session_start();
    if (empty($_SESSION)) {
        header("Location: index.php");
    }
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
$sql = "SELECT * FROM userdata where username ='". $_SESSION["user"] . "'";
$result = $conn->query($sql);
$row = $result -> fetch_assoc();
$username = $row["username"];
$age = $row["age"];
$dateofbirth = $row["dateofbirth"];
$about = $row["info"];
$conn -> close();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/homestyle.css?v=2">
    <title>Home</title>
</head>
<body>
<header>
    <div class="header-container">
      <div class="logo">
        <h1>Profile</h1>
      </div>
      <nav>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Contact</a></li>
          <li><a href="phpscripts/logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
</header>
    <div class="profile">
        <img src="" alt="">
        <p><?php echo $username ?></p>
        <p><?php echo $age ?></p>
        <p><?php echo $dateofbirth ?></p>
        <p><?php echo $about ?></p>
        <br>
        <form action="phpscripts/upload.php" method="post" enctype="multipart/form-data">
          <input type="file" name="videoFile" accept="video/*" required>
          <label for="ispublic">Make it public</label>
          <input type="checkbox" name="ispublic" value=1>
          <input type="submit" value="Upload Video" required>
        </form>
    </div> 

    <div class="videofeed">
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
        $sql = "SELECT name, location FROM uservideos WHERE BINARY user = ? or ispublic = true;";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($_SESSION["user"]));
        $result = $stmt->get_result();
        

        $stmt->close();
      ?>
      <?php while ($row = $result->fetch_assoc()): ?>
      <div class="video">
          <h3><?= htmlspecialchars($row["name"]) ?></h3>
          <a href="videoplayer.php?video='<?= urlencode($row["location"])?>'">Play</a>
      </div>
      <?php endwhile; ?>
      <?php $conn->close(); ?>
    </div>
</body>
</html>