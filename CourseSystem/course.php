<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "course";
$role = 0;
$subscription = array("None", "Silver", "Gold");
echo "Current subscription : ".$subscription[$role];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
$sql = "SELECT * FROM videos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    if($row["free"] == "true"){
        echo "<div class='videos-free'>
            <video controls src='".$row["video_link"]."'></video>
            </div>";
    }else{
        if ($row["role"] > $role){
            echo "<div class='videos-blocked'>
            <img src='https://www.freeiconspng.com/thumbs/lock-icon/lock-icon-11.png'></img>
            <h3>You must subscribe to open this video</h3>
            </div>";
        }else{
            echo "<div class='videos'>
            <video controls src='".$row["video_link"]."'></video>
            </div>";
        }
    }
    
  }
} else {
  echo "0 results";
}
?>
</body>
</html>