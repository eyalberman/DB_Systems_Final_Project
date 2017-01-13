
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

if (isset($_POST['limit']) && isset($_POST['keyword'])){
$limit = $_POST['limit']
$keyword = $_POST['keyword']


echo "you've asked limit".$limit
}

// $sql = "Select rental_id, rental_date from rental where inventory_id = 10 and customer_id = 3";
$sql = "Select * from Tips limit 1";

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

<!DOCTYPE html>
<html>
<head>
<style>
.flex-container {
    display: -webkit-flex;
    display: flex;
    -webkit-flex-flow: row wrap;
    flex-flow: row wrap;
    text-align: center;
}

.flex-container > * {
    padding: 15px;
    -webkit-flex: 1 100%;
    flex: 1 100%;
}

.article {
    text-align: left;
}

header {background: black;color:white;}
footer {background: #aaa;color:white;}
.nav {background:#eee;}

.nav ul {
    list-style-type: none;
    padding: 0;
}
.nav ul a {
    text-decoration: none;
}

@media all and (min-width: 768px) {
    .nav {text-align:left;-webkit-flex: 1 auto;flex:1 auto;-webkit-order:1;order:1;}
    .article {-webkit-flex:5 0px;flex:5 0px;-webkit-order:2;order:2;}
    footer {-webkit-order:3;order:3;}
}
</style>
</head>
<body background="grass2.jpg">

<div class="flex-container">
<header>
  <h1>Wow Day</h1>
</header>

<nav class="nav">
<ul>
  <li><a href="WowDay.html">Day planing</a></li>
  <li><a href="BestResturants.html">Best Resturents</a></li>
  <li><a href="BestCity.html">Best City</a></li>
  <li><a href="Old.html">Early sleeping</a></li>
  <li><a href="Addlocation.html">Add location</a></li>
</ul>
</nav>

<article class="article">
  <h1>Day Planing</h1>
  <p>WOW day, from early on until early morning, whatever your desires, we will
	help you schedule everything, to one single extraordinary WOW day.</p>
  <br><br><br>
  <p><strong>Select your desired location, to start </strong></p>
</article>

<div align="center">
<select name="PartOfTheDayDropdown">
  <option value="T">Tel Aviv </option>
  <option value="A">Amsterdam</option>
  <option value="Ba">Bagdad</option>
  <option value="Be">Berlin</option>
</select>
<button type="button">Start Planing!</button>
</div>


<form action="test.php" method = "POST">
  <input type = "text" name = "limit" />
  <input type = "text" name = "keyword" />
  <input type = "submit" value = "Submit" />
</form>



<footer>Copyright &copy; Amit,Liran,Noam,Eyal</footer>
</div>

</body>
</html>
