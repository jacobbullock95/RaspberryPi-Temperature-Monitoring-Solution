<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<title>RPi Temp - Archive </title>
</head>
<body>
<?php

echo "<div class='archive_header'>";

echo "<div class='title'><img class='logo' src='pitemp.png'/></div>";

echo "<div class='title'>Archive</div>";

echo "<a href='../'><div class='hlink'>Back<br>Home</div></a>";

echo "</div>";
$servername = "localhost";
$username = "root";
$password = "Nugget15";
$dbname = "temperature_1.0";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM temp ORDER BY tempID DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()){
        echo "<div class='container'>";

        echo "<p class='cont_title'>RPi Temperature Reading</p>";
        echo "<p class='date'>Date - ".$row[day_of_week]." ".$row[day]."/".$row[month]."/".$row[year]."</p>";
        echo "<p class='time'>Time - ".$row[hour].":".$row[minute]." AEST</p>";
        echo "<p class='temp_c'>Celsius - ".$row[celsius]."</p>";
        echo "<p class='temp_f'>Fahrenheit - ".$row[fahrenheit]."</p>";

        echo "</div>";
}
 }
else {
    echo "0 results";
}

$conn->close();
?>
</body>
</html>
