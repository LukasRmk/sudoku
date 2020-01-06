<?php

session_start();
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
{ header("Location:logout.php");exit;}

?>

<!DOCTYPE HTML>
<html>
<script type="text/javascript">
var t0;
var finish;
    function game(){       
			var div = document.getElementById("sudoku");
			var myg = document.getElementById("mygtukas");
            div.style.display = '';
			myg.style.display = 'none';
			t0 = performance.now();
	}
	
	function baigti(startTime) {
			var div = document.getElementById("sudoku");
			var myg = document.getElementById("mygtukas");
            div.style.display = 'none';
			myg.style.display = 'none';
			var t1 = performance.now();
			finish = t1 - t0;
			document.getElementById("laikas").innerHTML = "Žaista: " + Math.round(finish / 1000) + " sekundžių.";
	}
</script>
    <head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Žaidimo langas</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
    </head>
    <body style="background-color:LIGHTYELLOW;">
    <table style="border-width: 2px; border-style: dotted;"><tr><td>
         Atgal į [<a href="index.php">Pradžia</a>]
      </td></tr>
	</table>
			
		<div style="text-align: center;color:green"> <br>
            <h1>Sudoku 3x3</h1>
			Žadimo langas

        </div>
		<br>					
		<button id="mygtukas" type="button" onclick=game() >Pradėti žaidimą</button>
		<br>
		
					
		<div id="sudoku" style="display:none">
			<center>
		       <iframe src=https://widgetscode.com/wc/sudoku/all?skin=gold0 style='width:250px;height:370px;margin:0;'frameborder=0></iframe>
			</center>
			<br>					
		<button id="mygtukas1" type="button" onclick=baigti()>Baigti žaidimą</button>
		<br>
		</div>
		
		<p id="laikas" > </p>
		</html>



