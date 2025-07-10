<?php
    session_start();
    if (empty($_SESSION)) {
        header("Location: index.php");
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Player</title>
</head>
<body>
    <video width="50%" height="50%" controls>
        <source src=<?php echo urldecode($_GET['video']);?> type="video/mp4">
        Your browser does not support the video tag.
    </video>
</body>
</html>