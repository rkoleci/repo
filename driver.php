<?php
  include('api.php');
  session_start();

  $str = file_get_contents('data.json');
  $json = json_decode($str, true);


  echo "List of Restaurants: ";
  echo "<br></br>";
  showListOfRestaurants($json);
  echo "<br></br>";


  if (isset($_POST['submit'])) {
    if (isset($_POST['nameR'])) {
      $nameR = $_POST['nameR'];
      echo $nameR;

      $_SESSION['nameR'] = $nameR;
      $url = "details.php";
      header( "Location: $url" );

    }
  }


 ?>



<!DOCTYPE html>
<html>
<body>

<form method="post">
  Restorant Name<br>
  <input type="text" name="nameR" value="Enter">
  <br>
  <input type="submit" name="submit" value="Search">
</form>



</body>
</html>
