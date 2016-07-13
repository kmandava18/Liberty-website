<!DOCTYPE html>
<html>
<head>
  <title>New Server Added</title>
  <link rel="stylesheet" type="text/css" href="./Stylesheet.css">
  <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
</head>
</html>


<?php
$location=$_POST['loc'];
$obelix=$_POST['Obelix'];
$servIP=ip2long($_POST['serverIP']);
$rarIP=ip2long($_POST['raritanIP']);
$redIP=ip2long($_POST['RedRatIRIP']);
if (empty($_POST['MoxaIP'])) {
	$moxaIP='-999';
}else if(strpos($_POST['MoxaIP'], "Moxa IP(Optional)") !== false){
  $moxaIP='-999';
}else{
$moxaIP=ip2long($_POST['MoxaIP']);
}


// ip2long(
$servername = "localhost";
$username = "super";
$password = "super";
$dbname = "page";

$dbhandle = mysqli_connect($servername, $username, $password, $dbname) 
  or die("No connection");


  $dupe = mysqli_query($dbhandle, "SELECT name FROM servers WHERE loc='$location'");
  $dupeOb = mysqli_query($dbhandle, "SELECT name FROM servers WHERE obelix='$obelix'");
  $dupeServIp = mysqli_query($dbhandle, "SELECT name FROM servers WHERE serverIP='$servIP'");
  $duperarIp = mysqli_query($dbhandle, "SELECT name FROM servers WHERE raritanIP='$rarIP'");
  $duperedIp = mysqli_query($dbhandle, "SELECT name FROM servers WHERE RedRatIRIP='$redIP'");
  $dupeMoxaIp = mysqli_query($dbhandle, "SELECT name FROM servers WHERE MoxaIP='$moxaIP'");
echo "<div class='info'>Location: " . $location . "</div><br>";
echo "<div class='info'>Obelix Server: " . $obelix . "</div><br>";
echo "<div class='info'>Server IP: " . long2ip($servIP) . "</div><br>";
echo "<div class='info'>Raritan IP: " . long2ip($rarIP) . "</div><br>";
echo "<div class='info'>RedRat IR IP: " . long2ip($redIP) . "</div><br>";

  if($moxaIP==='-999'){
    echo "<div class='info'>Moxa IP: Null</div><br>";}
  else{
    echo "<div class='info'>Moxa IP: " . long2ip($moxaIP) . "<div><br>";
  }

 	if ($dupe->num_rows > 0) {
  	echo "<div class='info'>There is another server with the same location as the one you are creating.<br><a href='serverTest.html'>Back</a></div>";}
	else if ($dupeOb->num_rows > 0) {
	echo "<div class='info'>There is another server with the same name as the one you are creating.<br><a href='serverTest.html'>Back</a></div>";}
	else if ($dupeServIp->num_rows > 0) {
	echo "<div class='info'>There is another server with the same Server IP as the one you are creating.<br><a href='serverTest.html'>Back</a></div>";}
	else if ($duperarIp->num_rows > 0) {
	echo "<div class='info'>There is another server with the same Raritan PDU IP as the one you are creating.<br><a href='serverTest.html'>Back</a></div>";}
	else if ($duperedIp->num_rows > 0) {
	echo "<div class='info'>There is another server with the same RedRat IR IP as the one you are creating.<br><a href='serverTest.html'>Back</a></div>";}
	else if ($dupeMoxaIp->num_rows > 0) {
	echo "<div class='info'>There is another server with the same Moxa IP as the one you are creating.<br><a href='serverTest.html'>Back</a></div>";}
	else{
mysqli_query($dbhandle,"INSERT INTO servers (loc, obelix, serverIP, raritanIP, RedRatIRIP, MoxaIP) VALUES ('$location', '$obelix', '$servIP', '$rarIP', '$redIP', '$moxaIP')");

if(mysqli_affected_rows($dbhandle) > 0){
    echo "<div class='info'>New server created successfully";
    echo "<br><br><a href='ServerTest.html'>Back</a></div>";
} else {
    echo "<div class='info'><p>There was an error while attempting to add this asset. </p><br><a href='serverTest.html'>Back</a></div>";
}
}

$dbhandle->close();
?>