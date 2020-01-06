<?php

session_start();
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
{ header("Location:logout.php");exit;}

?>

<html>
<script type="text/javascript">


</script>
    <head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Kovų langas</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
    </head>
    <body style="background-color:LIGHTYELLOW;">
    	<table style="border-width: 2px; border-style: dotted;"><tr><td>
         Atgal į [<a href="index.php">Pradžia</a>]
      </td></tr>
		</table><br>
			
		<div style="text-align: center;color:green"> <br><br>
            <h1>Kovų langas</h1>
			Pasirinkite su kuo kovosite:
        </div>
		
		<?php
include("include/nustatymai.php");
$link=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

$sql = "SELECT username FROM users";
echo '<form action="" method="post">';
$result = mysqli_query($link,$sql);
    echo '<label style="color:green">Priešininkas: ';
    echo '<select name="enemy">';

    $num_results = mysqli_num_rows($result);
    for ($i=0;$i<$num_results;$i++) {
        $row = mysqli_fetch_array($result);
		$name = $row['username'];
        echo '<option value="' .$name. '">' .$name. '</option>';
	}
	
	echo ' <input type="submit" name="Kovoti" class="button" value="Kovoti" />';

	echo '<br>';
    echo '</select>';
	echo '</label>';

	echo ' <input type="submit" name="Baigti" class="button" value="Baigti" />';

	echo '</form>';
	$starttime = 0;
function startTime(){
	$starttime = microtime(true);

	$ho = floor($starttime / 3600);
    $starttime -= $ho * 3600;
    $mi = floor($starttime / 60);
	$starttime -= $mi * 60;

	echo round($starttime);
}
function endTime(){
	$endtime = microtime(true);

	$h = floor($endtime / 3600);
    $endtime -= $h * 3600;
    $m = floor($endtime / 60);
	$endtime -= $m * 60;

	$user=$_SESSION['user'];
	$link=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	$enemy = $_POST['enemy'];
	$arsql = "SELECT kovosID, laikas1 FROM kovos WHERE zaidejas1 = '$enemy' AND zaidejas2 = '$user' AND laikas2 = '0'";
	$sql = "UPDATE kovos SET laikas1 = '$endtime' WHERE zaidejas1 = '$user'  AND zaidejas2 = '$enemy' AND laikas1 = '0'";
	$kovaSQL = "UPDATE kovos set laikas2 = '$endtime' WHERE zaidejas1 = '$enemy' AND zaidejas2 = '$user' AND laikas2 = '0'";
	$arKova = mysqli_query($link, $arsql);

	$row = mysqli_fetch_assoc($arKova);
	$vyksta = $row['kovosID'];
	$laikas1 = $row['laikas1'];

	if($vyksta != NULL)
	{
		if (mysqli_query($link, $kovaSQL)) {
			echo "Į kovą atsakyta.<br>";

			// laimejus
			if($endtime < $laikas1)
			{
				$opoSQL = "SELECT points FROM users WHERE username = '$enemy'";
				$opoRes = mysqli_query($link, $opoSQL);
				$row = mysqli_fetch_assoc($opoRes);
				$opoTaskai = $row['points'];
				$prize = round(0.1 * $opoTaskai);

				$takeSQL = "UPDATE users SET points = points - '$prize' WHERE username = '$enemy'";
				mysqli_query($link, $takeSQL);

				$upSQL = "UPDATE users SET points = points + '$prize' WHERE username = '$user'";
				mysqli_query($link, $upSQL);

				echo "Laimėta <b>".$prize."</b> taškų!";
			}

			// pralaimejus
			if($endtime > $laikas1)
			{
				$mySQL = "SELECT points FROM users WHERE username = '$user'";
				$myRes = mysqli_query($link, $mySQL);
				$row = mysqli_fetch_assoc($myRes);
				$myTaskai = $row['points'];
				$lost = round(0.1 * $myTaskai);

				$giveSQL = "UPDATE users SET points = points - '$lost' WHERE username = '$user'";
				mysqli_query($link, $giveSQL);

				$crySQL = "UPDATE users SET points = points + '$lost' WHERE username = '$enemy'";
				mysqli_query($link, $crySQL);

				echo "Prarasta <b>".$lost."</b> taškų!";
			}

		} else {
			echo "Error: " . $kovaSQL . "<br>" . mysqli_error($link);
		};
	} else {
		if (mysqli_query($link, $sql)) {
			echo "Pakviesta į kovą";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($link);
		};
	}
	
}

if(array_key_exists('Kovoti', $_POST)) { 
	fight(); 
} 
else if (array_key_exists('Pradeti', $_POST)){
	startTime();
}
else if (array_key_exists('Baigti', $_POST)){
	endTime();
}

function fight(){
	$user=$_SESSION['user'];
	$link=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

	$enemy = $_POST['enemy'];
	echo 'Kovojama su '.$enemy;

	$nsql = "INSERT INTO kovos (kovosID, zaidejas1, laikas1, zaidejas2, laikas2) VALUES (NULL, '$user', '', '$enemy', '')";
	if (mysqli_query($link, $nsql)) {
	} else {
		echo "Error: " . $nsql . "<br>" . mysqli_error($link);
	};

}


?>
<br>
<div id="result"> </div>
	<div id="startas" style="display:">

	</div>
	<br>
		
					
		<div id="sudoku" style="display:">
			<center>
		       <iframe src=https://widgetscode.com/wc/sudoku/all?skin=gold0 style='width:250px;height:370px;margin:0;'frameborder=0></iframe>
			</center>
			<br>					
		<br>
		</div>
		
		<p id="laikas" > </p>
		<div id="reg" style="display:none">
		<form>
		<button id="mygtukas1" type="button" >Registruoti laik1</button>
		</form>
		</div>
		</html>
