<?php
$servername = "localhost";
$username = "super";
$password = "super";
$dbname = "page";

$dbhandle = mysqli_connect($servername, $username, $password, $dbname) 
  or die("Unable to connect to MySQL");

  $lol = mysqli_query($dbhandle, "SELECT id, loc, obelix, serverIP, raritanIP, RedRatIRIP, MoxaIP FROM servers");

	if($lol === FALSE) { 
    	die(mysql_error());
	}
//***create table***//
  echo "<tr><th>Location</th><th>ObelixServer</th><th>Server IP</th><th>Server Status</th><th>Raritan PDU IP</th><th>Raritan PDU Status</th><th>RedRat IR</th><th>RedRat IR Status</th><th>Moxa IP</th><th>Moxa Status</th></tr>";

  //***rows***//
if ($lol->num_rows > 0) {
	while($row = $lol->fetch_assoc()) {
    if($row['MoxaIP']==='-999'){
      $moxa='Null';
      //***ping servers***//
    $servIP=long2ip($row['serverIP']);
    exec(sprintf('ping -c 1 -W 2 %s', escapeshellarg($servIP)), $res, $rval);
            $up = $rval === 0;
            $raritanIP=long2ip($row['raritanIP']);
            exec(sprintf('ping -c 1 -W 2 %s', escapeshellarg($raritanIP)), $res, $rval);
            $up1 = $rval === 0;
            $redIP=long2ip($row['RedRatIRIP']);
            exec(sprintf('ping -c 1 -W 2 %s', escapeshellarg($redIP)), $res, $rval);
            $up2 = $rval === 0;

            //***Set Status'***//
 $serverStatus="<div id='stats' ".($up2 ? "style='color:green;'>Live</div>" : "style='color:red;'>Dead</div>")."<img id='status'".($up ? "src='https://upload.wikimedia.org/wikipedia/commons/4/4b/Green_Light_Icon.svg'" : "src='https://upload.wikimedia.org/wikipedia/commons/thumb/1/1f/Red_Light_Icon.svg/232px-Red_Light_Icon.svg.png'")."></img>";
 
 $rarStatus="<div id='stats' ".($up2 ? "style='color:green;'>Live</div>" : "style='color:red;'>Dead</div>")."<img id='status'".($up1 ? "src='https://upload.wikimedia.org/wikipedia/commons/4/4b/Green_Light_Icon.svg'" : "src='https://upload.wikimedia.org/wikipedia/commons/thumb/1/1f/Red_Light_Icon.svg/232px-Red_Light_Icon.svg.png'")."></img>";

 $redStatus="<div id='stats' ".($up2 ? "style='color:green;'>Live</div>" : "style='color:red;'>Dead</div>")."<img id='status'".($up2 ? "src='https://upload.wikimedia.org/wikipedia/commons/4/4b/Green_Light_Icon.svg'" : "src='https://upload.wikimedia.org/wikipedia/commons/thumb/1/1f/Red_Light_Icon.svg/232px-Red_Light_Icon.svg.png'")."></img>";

 $moxaStatus="<div id='stats' style='color:yellow;'>Null</div><img id='status' src='https://upload.wikimedia.org/wikipedia/commons/thumb/4/45/Yellow_Light_Icon.svg/232px-Yellow_Light_Icon.svg.png'></img>";
    }
else{
      $moxa=long2ip($row['MoxaIP']);

      //***ping servers***//
    $servIP=long2ip($row['serverIP']);
    exec(sprintf('ping -c 1 -W 2 %s', escapeshellarg($servIP)), $res, $rval);
            $up = $rval === 0;
            $raritanIP=long2ip($row['raritanIP']);
            exec(sprintf('ping -c 1 -W 2 %s', escapeshellarg($raritanIP)), $res, $rval);
            $up1 = $rval === 0;
            $redIP=long2ip($row['RedRatIRIP']);
            exec(sprintf('ping -c 1 -W 2 %s', escapeshellarg($redIP)), $res, $rval);
            $up2 = $rval === 0;
            exec(sprintf('ping -c 1 -W 2 %s', escapeshellarg($moxa)), $res, $rval);
            $up3 = $rval === 0;

        //***Set Status'***//
 $serverStatus="<div id='stats' ".($up2 ? "style='color:green;'>Live</div>" : "style='color:red;'>Dead</div>")."<img id='status'".($up ? "src='https://upload.wikimedia.org/wikipedia/commons/4/4b/Green_Light_Icon.svg'" : "src='https://upload.wikimedia.org/wikipedia/commons/thumb/1/1f/Red_Light_Icon.svg/232px-Red_Light_Icon.svg.png'")."></img>";
 
 $rarStatus="<div id='stats' ".($up2 ? "style='color:green;'>Live</div>" : "style='color:red;'>Dead</div>")."<img id='status'".($up1 ? "src='https://upload.wikimedia.org/wikipedia/commons/4/4b/Green_Light_Icon.svg'" : "src='https://upload.wikimedia.org/wikipedia/commons/thumb/1/1f/Red_Light_Icon.svg/232px-Red_Light_Icon.svg.png'")."></img>";

 $redStatus="<div id='stats' ".($up2 ? "style='color:green;'>Live</div>" : "style='color:red;'>Dead</div>")."<img id='status'".($up2 ? "src='https://upload.wikimedia.org/wikipedia/commons/4/4b/Green_Light_Icon.svg'" : "src='https://upload.wikimedia.org/wikipedia/commons/thumb/1/1f/Red_Light_Icon.svg/232px-Red_Light_Icon.svg.png'")."></img>";

 $moxaStatus="<div id='stats' ".($up2 ? "style='color:green;'>Live</div>" : "style='color:red;'>Dead</div>")."<img id='status'".($up3 ? "src='https://upload.wikimedia.org/wikipedia/commons/4/4b/Green_Light_Icon.svg'" : "src='https://upload.wikimedia.org/wikipedia/commons/thumb/1/1f/Red_Light_Icon.svg/232px-Red_Light_Icon.svg.png'")."></img>";
    }
//***print Everything***//
    echo "<tr><td id='loc'>" . $row['loc'] . "</td><td id='obe'>" . $row['obelix'] . "</td><td id='serv'>" . long2ip($row['serverIP']) . "</td><td id='servstat'>" . $serverStatus . "</td><td id='rar'>" . long2ip($row['raritanIP']) . "</td><td id='rarstat'>" . $rarStatus . "</td><td id='red'>" . long2ip($row['RedRatIRIP']) . "</td><td id='redstat'>" . $redStatus . "</td><td id='mox'>" . $moxa . "</td><td id='moxstat'>" . $moxaStatus . "</td></tr>";
}
}

$dbhandle->close();
?>