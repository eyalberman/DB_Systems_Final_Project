<html>
<body background="bk2.jpg">
<b> House recommendation query 4:   
<?php echo $_POST["category"]; ?>
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
$sql = "SELECT Cities.cityDesc, avg(Venues.likesCount) as averageLikes,  avg(Venues.venueRating) as averageRating 
FROM Cities 
JOIN Venues ON Venues.cityID = Cities.cityID 
JOIN VenueToCategory ON VenueToCategory.venueID = Venues.venueID 
JOIN Category ON VenueToCategory.categoryID =  Category.categoryID 
WHERE Category.CategoryMaster = '".$_POST["category"]."' 
GROUP BY Cities.cityDesc 
ORDER BY avg(Venues.likesCount)*0.01 + avg(Venues.venueRating)*0.99 DESC 
LIMIT 1;";

$result = $conn->query($sql);

echo "results for query "."<br>". $sql ."<br>"." are:"."<br><br>";
$i = 0;
if ($result->num_rows > 0){
  while ($row = $result->fetch_assoc()) {
    $i++;
    echo "<mark> ";
    echo "Venue ".$i.":<br>";
    echo "cityDesc :". $row["cityDesc"] . "<br>";
    echo "averageLikes :". $row["averageLikes"] . "<br>";
    echo "averageRating :". $row["averageRating"] . "<br><br>";
	echo "</mark> <br>";
  }
} else {
  echo "0 results" ;
}
$conn -> close();
 ?>

 <nav class="nav">
<ul>
  <li><a href="BestInsideCategory.html">Back to Wow day</a></li>
</ul>
</nav>

</body>
</html>