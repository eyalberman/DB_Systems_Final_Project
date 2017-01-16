<html>
<body background="bk2.jpg">
<b> Day planing:  
<?php echo $_POST["city"]; ?>
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

/////////

$time = array("isMorning", "isNoon", "isEvening"); 

foreach ($time as $value) {
    echo "<mark><b>$value </b></mark><br>";
	$sql = "select * 
			FROM ( 
			SELECT distinct Venues.venueName, Venues.venueAddress, Venues.venueURL 
			FROM Venues 
			JOIN VenueToCategory ON VenueToCategory.venueID = Venues.venueID 
			JOIN Category ON Category.categoryID = VenueToCategory.categoryID 
			JOIN Cities ON Cities.cityID = Venues.cityID 
			WHERE Category.". $value ." = '1' 
			AND Cities.cityDesc = '".$_POST["city"]."'
			AND venueAddress is not null 
			) as t 
			ORDER BY RAND() 
			LIMIT 1;" 
			;
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
	}

/////////

$conn -> close();
 ?>

 <nav class="nav">
<ul>
  <li><a href="Default.html">Back to Wow day</a></li>
</ul>
</nav>

</body>
</html>