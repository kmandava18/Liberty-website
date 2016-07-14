<?php
$servername = "localhost";
$username = "super";
$password = "super";
$dbname = "page";

$dbhandle = mysqli_connect($servername, $username, $password, $dbname) 
  or die("Unable to connect to MySQL");

  $deleted = $_POST['delete'];
  if(empty($deleted)){
    echo("<div>You didn't select any assets to delete<br><a href='serverTest.html'>Back</a></div>");
  }
  else{
    $j = count($deleted);
    for($i=0; $i < $j; $i++){

    	$sql = "DELETE FROM servers WHERE id='$deleted[$i]'";
      if ($dbhandle->query($sql) === TRUE) {
          echo "<div>success<br><a href='serverTest.html'>Back</a></div>";
      } else {
          echo "Error deleting record: " . $dbhandle->error . "<br><a href='serverTest.html'>Back</a>";
}
    }
  }
 ?>



