<html>
<head>
<link rel="stylesheet" type="text/css" href="./Stylesheet.css">
</head>
<body>
<form method="post" action="delete.php">
<table class="form">
	<?php
$servername = "localhost";
$username = "super";
$password = "super";
$dbname = "page";

$dbhandle = mysqli_connect($servername, $username, $password, $dbname) 
  or die("Unable to connect to MySQL");

  $lol = mysqli_query($dbhandle, "SELECT id, loc, obelix, serverIP FROM servers");

	if($lol === FALSE) { 
    	die(mysql_error());
	}
	echo "<tr><th>Select</th><th>Location</th><th>Obelix</th><th>Server IP</th></tr>";

	if ($lol->num_rows > 0) {
		while($row = $lol->fetch_assoc()) {
			echo "<tr><td><input type='checkbox' name='delete[]' value='" . $row['id'] . "'></td><td>" . $row['loc'] . "</td><td>" . $row['obelix'] . "</td><td>" . long2ip($row['serverIP']) . "</td></tr>";
		}
	}

?>
</table>
<input id="done" type="submit" name="submit" value="submit">
</form>
</body>
</html>
