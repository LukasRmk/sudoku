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
        <title>Turnyrinis mačas</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
    </head>
    <body style="background-color:LIGHTYELLOW;">
     <table style="border-width: 2px; border-style: dotted;"><tr><td>
         Atgal į [<a href="index.php">Pradžia</a>]
      </td></tr>
	</table><br>
			
		<div style="text-align: center;color:green"> <br><br>
			Sužaiskite SUDOKU Turnyro laikui
        </div>
		
	<?php
    include("include/nustatymai.php");
    echo '<form action="" method="post">';
	echo ' <input type="submit" name="Baigti" class="button" value="Baigti" />';

	echo '</form>';

function endTime(){
	$endtime = microtime(true);

	$h = floor($endtime / 3600);
    $endtime -= $h * 3600;
    $m = floor($endtime / 60);
	$endtime -= $m * 60;

	$user=$_SESSION['user'];
	$link=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	$suzaistas = "UPDATE turnyras SET Laikas = '$endtime' WHERE zaidejoVardas = '$user'";
    mysqli_query($link, $suzaistas);

}

if (array_key_exists('Baigti', $_POST)){
	endTime();
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
