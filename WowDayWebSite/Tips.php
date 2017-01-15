<html>
<body background="bk2.jpg">
<b> Tips Search query 3:  
<br>
Keyword <?php echo $_POST["keyword"]."<br>"; ?>
Morning <?php echo $_POST["isMorning"]."<br>"; ?>
Evening <?php echo $_POST["isEvening"]."<br>"; ?>
Night <?php echo $_POST["isNight"]."<br>"; ?>
</b>
<br><br><br>

<?php
$servername = "mysqlsrv.cs.tau.ac.il";
$username = "DbMysql03";
$password = "DbMysql03";
$dbname = "DbMysql03";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	echo "conn error<br>";
	die("Connection failed: " . $conn->connect_error);
}else{
	//echo "DB conn IS working!". PHP_EOL;
	echo "<br>";
}
$sql = "SELECT venueName, venueAddress, venueURL 
FROM Venues 
JOIN VenueToCategory ON VenueToCategory.venueID = Venues.venueID 
JOIN Category ON VenueToCategory.categoryID = Category.categoryID 
JOIN Tips ON Tips.venueID = Venues.venueID 
WHERE Category.isEvening = '".$_POST["isNight"]."'  
AND Category.isNoon = '".$_POST["isNoon"]."'  
AND Category.isMorning = '".$_POST["isMorning"]."'  
AND INSTR(Tips.tipText,'".$_POST["keyword"]."')
GROUP BY venueName
limit 20;";

$result = $conn->query($sql);

echo "results for query "."<br>". $sql ."<br>"." are:"."<br><br>";
$i = 0;
if ($result->num_rows > 0){
  while ($row = $result->fetch_assoc()) {
    $i++;
    echo "<mark> ";
    echo "Venue ".$i.":<br>";
    echo "Name :". $row["venueName"] . "<br>";
    echo "Address :". $row["venueAddress"] . "<br>";
    echo "URL :". $row["venueURL"] . "<br><br>";
	echo "</mark> <br>";
  }
} else {
  echo "0 results" ;
}
$conn -> close();
 ?>

 <nav class="nav">
<ul>
  <li><a href="Tips.html">Back to Wow day</a></li>
</ul>
</nav>

</body>
</html>