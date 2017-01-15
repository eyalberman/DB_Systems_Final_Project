<html>
<body bgcolor = "orange">
<b> Best restaurant in  
<?php echo $_POST["city"]. "<br>"; ?>
</b>
<br><br><br>


Select * from venues where city =

<?php echo $_POST["city"]; ?>
 limit 3

<br><br>


<?php
$servername = "mysqlsrv.cs.tau.ac.il";
$username = "DbMysql03";
$password = "DbMysql03";
$dbname = "DbMysql03";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	echo "conn error";
	die("Connection failed: " . $conn->connect_error);
}else{
	echo "DB conn IS working!". PHP_EOL;
	echo "<br><br>";
}
$sql = "Select * from Venues limit 3";


$result = $conn->query($sql);



echo "results for query ". $sql. " are:"."<br><br>";
$i = 0;
if ($result->num_rows > 0){
  while ($row = $result->fetch_assoc()) {
    $i++;
    echo "restaurant ".$i.":". $row["venueName"] . "<br>";
  }
} else {
  echo "0 results" ;
}
$conn -> close();
 ?>




 <nav class="nav">
<ul>
  <li><a href="BestResturants.html">Back to Wow day</a></li>
</ul>
</nav>


</body>
</html>