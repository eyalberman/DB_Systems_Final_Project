<html>
<body background="bk2.jpg">
<b> House recommendation query 1:  
<?php echo $_POST["city1"]; ?>
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
$sql = "SELECT a.venueName, a.venueAddress, a.venueURL, a.likesCount ".
"FROM ( ".
	"SELECT Venues.venueName, Venues.venueAddress, Venues.venueURL, Venues.likesCount ".
	"FROM Venues INNER JOIN Cities ON Venues.cityID = Cities.cityID and Cities.cityDesc = '".$_POST["city1"]."'".
") as a ".
"JOIN ( ".
    "select count(*) total_rows ".
    "FROM ( ".
		"SELECT Venues.venueName, Venues.venueAddress, Venues.venueURL, Venues.likesCount ".
		"FROM Venues INNER JOIN Cities ON Venues.cityID = Cities.cityID and Cities.cityDesc = '".$_POST["city1"]."'".
	") as t1 ".
") as b ".
"WHERE ( ".
    "select count(*) ".
    "FROM ( ".
		"SELECT Venues.venueName, Venues.venueAddress, Venues.venueURL, Venues.likesCount ".
		"FROM Venues INNER JOIN Cities ON Venues.cityID = Cities.cityID and Cities.cityDesc = '".$_POST["city1"]."'".
    ") as c ".
    "WHERE c.likesCount >= a.likesCount ".
") / total_rows <= .1 ".
"ORDER BY a.likesCount DESC ".
"limit 20;"
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
    echo "URL :". $row["venueURL"] . "<br>";
    echo "LikesCount :". $row["likesCount"] . "<br><br>";
	echo "</mark> <br>";
  }
} else {
  echo "0 results" ;
}
$conn -> close();
 ?>

 <nav class="nav">
<ul>
  <li><a href="house.html">Back to Wow day</a></li>
</ul>
</nav>

</body>
</html>