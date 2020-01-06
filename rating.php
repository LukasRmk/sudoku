<?php

session_start();
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
{ header("Location:logout.php");exit;}

?>

<!DOCTYPE HTML>
<html>

    <head>
    <style>
table {
  border-collapse: collapse;
  width: auto;
}

th, td {
  padding: 8px;
  text-align: center;
  border-bottom: 1px solid #ddd;
}

tr:hover {background-color:#f5f5f5;}
</style>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Reitingai</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
    </head>
    <body style="background-color:LIGHTYELLOW;>
    <table style="border-width: 2px; border-style: dotted; "><tr><td>
         Atgal į [<a href="index.php">Pradžia</a>]
      </td></tr>
	</table>
			
		<div style="text-align: center;color:green"> <br>
            <h1>Žaidėjų reitingai</h1>
        </div>
<?php
include("include/nustatymai.php");

$link=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$sql = "SELECT username, points FROM users WHERE userlevel = 4 ORDER BY points DESC";
$zaidejai = mysqli_query($link, $sql);

$a = 0;
while($row = mysqli_fetch_assoc($zaidejai))
{
    $players[$a] = $row['username'];
    $points[$a] = $row['points'];
    $a++;
} 

echo 
'<table style="width:25%" align="center">
<tr>
  <th>Vieta</th>
  <th>Žaidėjas</th>
  <th>Taškai</th> 
</tr>
<tr>
  <td>1</td>
  <td>'.$players[0].'</td>
  <td>'.$points[0].'</td>
</tr>
<tr>
<td>2</td>
  <td>'.$players[1].'</td>
  <td>'.$points[1].'</td>
</tr>
<tr>
<td>3</td>
  <td>'.$players[2].'</td>
  <td>'.$points[2].'</td>
</tr>
<tr>
<td>4</td>
  <td>'.$players[3].'</td>
  <td>'.$points[3].'</td>
</tr>
<tr>
<td>5</td>
  <td>'.$players[4].'</td>
  <td>'.$points[4].'</td>
</tr>
<tr>
<td>6</td>
  <td>'.$players[5].'</td>
  <td>'.$points[5].'</td>
</tr>
<tr>
<td>7</td>
  <td>'.$players[6].'</td>
  <td>'.$points[6].'</td>
</tr>
<tr>
<td>8</td>
  <td>'.$players[7].'</td>
  <td>'.$points[7].'</td>
</tr>
</table>';

?>



