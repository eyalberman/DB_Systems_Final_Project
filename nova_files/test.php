<?php
$servername = "mysqlsrv.cs.tau.ac.il";
$username = "DbMysql03";
$password = "DbMysql03";
$dbname = "DbMysql03";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  echo "conn error";
  die("Connection failed: " . $conn->connect_error);
}

echo "DB conn IS working!". PHP_EOL;


// $sql = "Select rental_id, rental_date from rental where inventory_id = 10 and customer_id = 3";
$limit = intval($_POST['limit']);

$sql = "Select * from Tips limit ".$limit ;

echo "the limit you've entered is ".$limit. " times 5 is ".$limit*5;

//$sql = "Select * from Tips limit 1";
$result = $conn->query($sql);



echo "results for query ". $sql. " are \r\n";

if ($result->num_rows > 0){
  while ($row = $result->fetch_assoc()) {
    echo "text: ". $row["tipText"] . "<br>";
  }
} else {
  echo "0 results" ;
}
$conn -> close();
 ?>
