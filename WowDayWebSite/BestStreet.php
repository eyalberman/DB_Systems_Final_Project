<html>
<body background="bk2.jpg">
<b> Street finding query 6:   
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
$sql = "SELECT 
  CASE WHEN street2 = street3 
    THEN street1 
  WHEN street3 = street4 
    THEN street2 
  WHEN street3 != street4 
    THEN street3 
  WHEN street2 != street3 
    THEN street2 END street, cityDesc, 
  count(*) 
FROM ( 

       SELECT 
         SUBSTRING_INDEX(venueAddress, ' ', 1) AS street1, 
         SUBSTRING_INDEX(venueAddress, ' ', 2) AS street2, 
         SUBSTRING_INDEX(venueAddress, ' ', 3) AS street3, 
         SUBSTRING_INDEX(venueAddress, ' ', 4) AS street4, 
         venueAddress                          AS street, 
         cityDesc, 
         Venues.venueID 
 
       FROM Venues 
         Join VenueToCategory vtc on vtc.VenueID = Venues.VenueID 
         Join Category c on c.categoryID = vtc.categoryID 
         join Cities on Cities.cityId = Venues.cityID 
       where CategoryMaster = '".$_POST["category"]."' 
     ) a 
group by 1,2 order by 3 DESC ) c 
where street is not null and street not in ('?','??','???','????','?????','??????','???????','????????');"; 

$result = $conn->query($sql);

echo "results for query "."<br>". $sql ."<br>"." are:"."<br><br>";
if ($result->num_rows > 0){
  while ($row = $result->fetch_assoc()) {
    echo "<mark> ";
    echo "street :". $row["street"] . "<br>";
    echo "street1 :". $row["street1"] . "<br>";
    echo "street2 :". $row["street2"] . "<br>";
    echo "street3 :". $row["street3"] . "<br>";
    echo "street4 :". $row["street4"] . "<br>";
    echo "cityDesc :". $row["cityDesc"] . "<br>";
    echo "count(*) :". $row["count(*)"] . "<br><br>";
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