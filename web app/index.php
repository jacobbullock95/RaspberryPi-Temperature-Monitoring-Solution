
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<title>RPi Temp - Home</title>
</head>
<body>
<?php

echo "<div class='home_header'>";

echo "<div class='htitle'><img class='hlogo' src='pitemp.png'/></div>";

echo "<div class='htitle'>Home</div>";

echo "<a href='archive.php'><div class='hlink'>Visit The Archive</div></a>";

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

$sql = "SELECT * FROM temp ORDER BY tempID DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()){
        echo "<div class='current_container'>";

        echo "<p class='hcont_title'>Current Temperature</p>";
        echo "<p class='hdate'>Date - ".$row[day_of_week]." ".$row[day]."/".$row[month]."/".$row[year]."</p>";
        echo "<p class='htime'>Time - ".$row[hour].":".$row[minute]." AEST</p>";
        echo "<p class='htemp_c'>Celsius - ".$row[celsius]."</p>";
        echo "<p class='htemp_f'>Fahrenheit - ".$row[fahrenheit]."</p>";

        echo "</div>";
}
 }
else {
    echo "0 results";
}

$sql = "SELECT * FROM temp ORDER BY celsius DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()){
        echo "<div class='high_container'>";

        echo "<p class='hcont_title'>Highest Temperature</p>";
        echo "<p class='hdate'>Date - ".$row[day_of_week]." ".$row[day]."/".$row[month]."/".$row[year]."</p>";
        echo "<p class='htime'>Time - ".$row[hour].":".$row[minute]." AEST</p>";
        echo "<p class='htemp_c'>Celsius - ".$row[celsius]."</p>";
        echo "<p class='htemp_f'>Fahrenheit - ".$row[fahrenheit]."</p>";

        echo "</div>";
}
 }
else {
    echo "0 results";
}

$sql = "SELECT * FROM temp ORDER BY celsius ASC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()){
        echo "<div class='low_container'>";

        echo "<p class='hcont_title'>Lowest Temperature</p>";
        echo "<p class='hdate'>Date - ".$row[day_of_week]." ".$row[day]."/".$row[month]."/".$row[year]."</p>";
        echo "<p class='htime'>Time - ".$row[hour].":".$row[minute]." AEST</p>";
        echo "<p class='htemp_c'>Celsius - ".$row[celsius]."</p>";
        echo "<p class='htemp_f'>Fahrenheit - ".$row[fahrenheit]."</p>";

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

