<html>
<head>
<link rel="stylesheet" type="text/css" href="./Stylesheet.css">
</head>
<body>
<div id='editInt'>Select what you would like to edit</div>
<br>
<form method="post" action="edit2.php">
<table class="form">
<?php
$servername = "localhost";
$username = "super";
$password = "super";
$dbname = "page";

$dbhandle = mysqli_connect($servername, $username, $password, $dbname) 
  or die("Unable to connect to MySQL");

  $edit = $_POST['select'];
  if(empty($edit)){
    echo("<div>You didn't select any assets to edit!<br><a href='serverTest.html'>Back</a></div>");
  }
  else{
  	$lol = mysqli_query($dbhandle, "SELECT id, loc, obelix, serverIP, raritanIP, RedRatIRIP, MoxaIP FROM servers WHERE id='$edit'");
  	if($lol === FALSE) { 
    	die(mysql_error());
	}
	echo "<tr><th><input type='radio' name='edit' value='loc'></th><th><input type='radio' name='edit' value='obelix'></th><th><input type='radio' name='edit' value='serverIP'></th><th><input type='radio' name='edit' value='raritanIP'></th><th><input type='radio' name='edit' value='RedRatIRIP'></th><th><input type='radio' name='edit' value='MoxaIP'></th></tr>";
	if ($lol->num_rows > 0) {
		while($row = $lol->fetch_assoc()) {
	echo "<tr><td>".$row['loc']."</td><td>".$row['obelix']."</td><td>".long2ip($row['serverIP'])."</td><td>".long2ip($row['raritanIP'])."</td><td>".long2ip($row['RedRatIRIP'])."</td><td>".long2ip($row['MoxaIP'])."</td></tr>";
	echo "<input id='hide' type='text' value='".$row['id']."' name='inst'>";
		}
	}
  }
 ?>
</table>
<div id='editInt'>What would you like to replace it with?</div>
<input type='text' name='newVal' id='fill'>
<input type="submit" name="submit" value="submit">
</form>
</body>
</html>