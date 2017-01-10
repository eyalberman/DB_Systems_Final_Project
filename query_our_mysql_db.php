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

echo "conn good";

// $sql = "Select rental_id, rental_date from rental where inventory_id = 10 and customer_id = 3";
$sql = "Select * from Tips limit 1";

$result = $conn->query($sql);


    echo $_POST['value'];
?>

<html>
<form method="post" action="">
<input type="text" name="value">
<input type="submit">
</form>
</html>
<?php
echo "results". $result->num_rows;

if ($result->num_rows > 0){
  while ($row = $result->fetch_assoc()) {
    echo "text: ". $row["tipText"] . "<br>";
  }
} else {
  echo "0 results" ;
}
$conn -> close();
 ?>
