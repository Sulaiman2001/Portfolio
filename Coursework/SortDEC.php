<?php

//step 1: start the session, check if the user is not logged in, redirect to start
session_start();

if (!isset($_SESSION['email'])){
	header("Location: index.php");
	exit();
}
function Welcome(){
	$email=$_SESSION['email'];
	echo "Welcome ".$_SESSION['email']."! ";
}
// Step2. include the connectdb.php to connect to the database, the PDO object is called $db and run the query to get all the course information
require_once ('connectdb.php');
// Ascending Order

    $asc_query = "SELECT * FROM event ORDER BY event_time DESC";
    $result = executeQuery($asc_query);



function executeQuery($query)
{
    $connect = mysqli_connect("localhost", "u-200108120", "Agtj8n0fsBKiG2T", "u_200108120_db");
    $result = mysqli_query($connect, $query);
    return $result;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Homepage</title>
  <link href="css/HomepageLayout.css" rel="stylesheet" />
  <script src="js/validate_password.js"></script>
  <script src="js/main.js"></script>
</head>
<body>
  <div class ="header">
    <h1><?php echo "Welcome ".$_SESSION['email']."! ";?></h1>
  </div>
	<div class="navbar">
<a href="Homepage.php">Home</a>
<a href="logout.php">Log out</a>

<div class="dropdown">
<button class="dropbtn">Sort/Filter
	<i class="fa fa-caret-down"></i>
</button>
<div class="dropdown-content">
	<a href="SortASC.php">Sort(Ascending)</a>
<a href="SortDEC.php">Sort(Descending)</a>
	<a href="SortSport.php">Sort(Sport)</a>
	<a href="SortOther.php">Sort(Other)</a>
	<a href="SortCulture.php">Sort(Culture)</a>
</div>
</div>
</div>
  <br><div class = "content">
      <table style = "margin-left: auto; margin-right: auto;">
        <tr><th align='center'><b></th>   <th align='center'><b></b></th> <th align='center'><b></b></th ></tr>
                <!-- populate table from mysql database -->
                <?php while ($row = mysqli_fetch_array($result)):
									?><div class = "card"><?php
                  echo "<tr>
  								<td>"?><img src="<?php echo $row["imageurl"];?>" height="250" width= "350"><?php echo "</td>
  								";
  								echo  "
  								<td>" ."Event name: " . $row['event_name'].
  								"<br>Event category: " . $row['event_category'] .
  								"<br>Event time: " . $row['event_time'] ."</td>
  								";
                  ?></div>
  								<td><button>
  									<a href="<?php echo $row['moreInfoLink'];?>"><p style="color:white">Click to find out more information</p></a>
  								</button></td></tr>
                <?php endwhile;?>
            </table>
        </form>

    </body>
</html>
