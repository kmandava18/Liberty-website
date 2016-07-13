<?php
$servername = "localhost";
$username = "super";
$password = "super";
$dbname = "page";

$dbhandle = mysqli_connect($servername, $username, $password, $dbname) 
  or die("Unable to connect to MySQL");

  $rep = $_POST['newVal'];
  $edit = $_POST['edit'];
  $inst = $_POST['inst'];
  if(empty($rep)){
    echo("<div>You didn't input anything!<br><a href='serverTest.html'>Back</a></div>");
  }
  else if(empty($edit)){
    echo("<div>You didn't select anything!<br><a href='serverTest.html'>Back</a></div>");
  }
  else{
      $sql = "UPDATE servers SET ".$edit."='".$rep."' WHERE id='".$inst."'";
      if ($dbhandle->query($sql) === TRUE) {
          echo "<div>success<br><a href='serverTest.html'>Back</a></div>";
      } else {
          echo "Error deleting record: " . $dbhandle->error . "<br><a href='serverTest.html'>Back</a>";
}
}
 ?>
