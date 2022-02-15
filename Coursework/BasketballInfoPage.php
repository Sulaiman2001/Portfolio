<?php
session_start();

if (!isset($_SESSION['email'])){
  header("Location: index.php");
  exit();
}
function Welcome(){
  $email=$_SESSION['email'];
  echo "Welcome ".$_SESSION['email']."! ";
}
require_once ('connectdb.php');
try {
	$query="SELECT  * FROM  event WHERE event_name='Basketball'";
	//run  the query
	$rows =  $conn->query($query);

	//step 3: display the course list in a table
	if ( $rows && $rows->rowCount()> 0) {


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>BasketballEventPage</title>
  <link href="css/InformationPage.css" rel="stylesheet" />
</head>
<body>
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
      <a href="SortCat.php">Sort(Category)</a>
    </div>
  </div>
</div>

  <div class="content">
    <div class="column">
      <div class="slideshow-container">

        <div class="mySlides fade">
          <div class="numbertext">1 / 3</div>
          <img src="images/basketballpic1.jpeg" style="width:100%" height="550">
        </div>

        <div class="mySlides fade">
          <div class="numbertext">2 / 3</div>
          <img src="images/basketballpic2.jpeg" style="width:100%" height="550">
        </div>

        <div class="mySlides fade">
          <div class="numbertext">3 / 3</div>
          <img src="images/basketballpic3.jpeg" style="width:100%" height="550">
        </div>

      </div>
      <br>

      <div style="text-align:center">
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
      </div>
      <h1> Basketball event</h1>
      <h2><?php echo "Welcome ".$_SESSION['email']."! ";?>
      </h2>

      <form method = "post" action="BasketballInfoPage.php">

        <input type="submit" name="like" value="Like"/>
        <?php
        if (isset($_POST['like'])){
          $db_host = 'localhost';
          $db_name = 'u_200108120_db';
          $username = 'u-200108120';
          $password = 'Agtj8n0fsBKiG2T';
          $_POST=$_SESSION['email'];
          // Create connection
          $conn = new mysqli($db_host, $username, $password, $db_name);
          // Check connection
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          $sql = "UPDATE event_likes SET likes = likes+1 WHERE event = '2'";

          if ($conn->query($sql) === TRUE) {
            echo "You have successfully liked the event";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }


          $conn->close();
        }

         ?>
        <input type= "Submit" name = "Submit"  value = "Register"/><br><br><br>
        <?php
        if (isset($_POST['Submit'])){
          $db_host = 'localhost';
          $db_name = 'u_200108120_db';
          $username = 'u-200108120';
          $password = 'Agtj8n0fsBKiG2T';
          $_POST=$_SESSION['email'];
          // Create connection
          $conn = new mysqli($db_host, $username, $password, $db_name);
          // Check connection
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          $sql = "INSERT INTO user_event (email, event)
          VALUES ('$_POST', '2')";

          if ($conn->query($sql) === TRUE) {
            echo "You have successfully registered for the event";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }


          $conn->close();
        }
        ?>
        <input type="hidden" name="submitted" value="true"/>
      </form>
      <table style = "margin-left: auto; margin-right: auto;">
        <tr><th align='center'><b></th>   <th align='center'><b></b></th> <th align='center'><b></b></th ></tr>
          <?php
          // Fetch and  print all  the records.
          while  ($row =  $rows->fetch())	{
            echo  "<tr>
            <td>" ."<u><b>Event name:</u></b> " . $row['event_name'].
            "<br><br><u><b>Event category:</u></b> " . $row['event_category'] .
            "<br><br><u><b>Event description:</u></b> " . $row['event_description'] .
            "<br><br><u><b>Event organiser:</u></b> " . $row['organiser'] .
            "<br><br><u><b>Location:</u></b> " . $row['place'] .
            "<br><br><u><b>Event time:</u></b> " . $row['event_time'] ."</td>
            </tr>";
          }
          echo  '</table>';
        }
        else {
          echo  "<p>No  course in the list.</p>\n"; //no match found
        }
      }
      catch (PDOexception $ex){
        echo "Sorry, a database error occurred! <br>";
        echo "Error details: <em>". $ex->getMessage()."</em>";
      }

      ?>
    </div>
    <script>
    var slideIndex = 0;
    showSlides();

    function showSlides() {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("dot");
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      slideIndex++;
      if (slideIndex > slides.length) {slideIndex = 1}
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block";
      dots[slideIndex-1].className += " active";
      setTimeout(showSlides, 4000); // Change image every 4 seconds
    }
  </script>

    </html>
