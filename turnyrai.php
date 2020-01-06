<?php
// operacija1.php
// skirtapakeisti savo sudaryta operacija pratybose

session_start();
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
{ header("Location:logout.php");exit;}
?>

<html>
    <head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Turnyro langas</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
<style>
    /*
 *  Flex Layout Specifics
*/
main{
  display:flex;
  flex-direction:row;
}
.round{
  display:flex;
  flex-direction:column;
  justify-content:center;
  width:200px;
  list-style:none;
  padding:0;
}
  .round .spacer{ flex-grow:0.3; }
  .round .spacer:first-child,
  .round .spacer:last-child{ flex-grow:0.1; }

  .round .game-spacer{
    flex-grow:0.5;
  }

/*
 *  General Styles
*/
body{
  font-family:sans-serif;
  font-size:small;
  padding:10px;
  line-height:1.4em;
}

li.game{
  padding-left:20px;
}

  li.game.winner{
    font-weight:bold;
  }
  li.game span{
    float:right;
    margin-right:5px;
  }

  li.game-top{ border-bottom:1px solid #aaa; }

  li.game-spacer{ 
    border-right:1px solid #aaa;
    min-height:40px;
  }

  li.game-bottom{ 
    border-top:1px solid #aaa;
  }
</style>
		
    </head>
    <body style="background-color:LIGHTYELLOW;">
    <table style="border-width: 2px; border-style: ;"><tr><td>
         Atgal į [<a href="index.php">Pradžia</a>]
      </td></tr>
	</table><br>
			
		<div style="text-align: center;color:green"> <br><br>
            <h1>Sudoku turnyro turnyrinė lentelė</h1>
		</div>

	<?php
    include("include/nustatymai.php");

    $link=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    $sql="SELECT * FROM turnyras";
    $res = mysqli_query($link, $sql);

    $a = 0;
    while($row = mysqli_fetch_assoc($res))
     {
        $players[$a] = $row['zaidejoVardas'];
        $laikas[$a] = $row['Laikas'];
        $kova[$a] = $row['kova'];
        $a++;
    } 
    $players[8] = "";
    $laikas[8] = "";

    $winner1 = "SELECT * FROM winner1";
    $winner2 = "SELECT * FROM winner2";
    $winner3 = "SELECT * FROM winner3";

    $res1 = mysqli_query($link, $winner1);
    $res2 = mysqli_query($link, $winner2);
    $res3 = mysqli_query($link, $winner3);

    $b = 0;
    while($row = mysqli_fetch_assoc($res1))
     {
        $winners1[$b] = $row['zaidejoVardas'];
        $laikas1[$b] = $row['Laikas'];
        $b++;
    } 

    $c = 0;
    while($row = mysqli_fetch_assoc($res2))
     {
        $winners2[$c] = $row['zaidejoVardas'];
        $laikas2[$c] = $row['Laikas'];
        $c++;
    } 

    $row = mysqli_fetch_assoc($res3);
    $champ = $row['zaidejoVardas'];
    $time = $row['Laikas'];
    
    if(empty($winners1)){
        $winners1[0] = $players[8];
        $winners1[1] = $players[8];
        $winners1[2] = $players[8];
        $winners1[3] = $players[8];
        $laikas1[0] = $laikas[8];
        $laikas1[1] = $laikas[8];
        $laikas1[2] = $laikas[8];
        $laikas1[3] = $laikas[8];
    } 

    if(empty($winners2)){
        $winners2[0] = $players[8];
        $winners2[1] = $players[8];
        $laikas2[0] = $laikas[8];
        $laikas2[1] = $laikas[8];
    } 

    echo '<h1  style="text-align: center;color:green">Turnyras</h1>
  <main id="tournament" allign="center">
      <ul class="round round-1">
          <li class="spacer">&nbsp;</li>
          
          <li class="game game-top">'.$players[0].' <span>'.$laikas[0].'</span></li>
          <li class="game game-spacer">&nbsp;</li>
          <li class="game game-bottom ">'.$players[1].' <span>'.$laikas[1].'</span></li>
  
          <li class="spacer">&nbsp;</li>
          
          <li class="game game-top">'.$players[2].' <span>'.$laikas[2].'</span></li>
          <li class="game game-spacer">&nbsp;</li>
          <li class="game game-bottom ">'.$players[3].' <span>'.$laikas[3].'</span></li>0
  
          <li class="spacer">&nbsp;</li>
          
          <li class="game game-top">'.$players[4].' <span>'.$laikas[4].'</span></li>
          <li class="game game-spacer">&nbsp;</li>
          <li class="game game-bottom ">'.$players[5].' <span>'.$laikas[5].'</span></li>
  
          <li class="spacer">&nbsp;</li>
          
          <li class="game game-top">'.$players[6].' <span>'.$laikas[6].'</span></li>
          <li class="game game-spacer">&nbsp;</li>
          <li class="game game-bottom ">'.$players[7].' <span>'.$laikas[7].'</span></li>
  
          <li class="spacer">&nbsp;</li>
      </ul>
      <ul class="round round-2">
          <li class="spacer">&nbsp;</li>
          
          <li class="game game-top">'.$winners1[0].'<span>'.$laikas1[0].'</span></li>
          <li class="game game-spacer">&nbsp;</li>
          <li class="game game-bottom ">'.$winners1[1].'<span>'.$laikas1[1].'</span></li>
  
          <li class="spacer">&nbsp;</li>
          
          <li class="game game-top">'.$winners1[2].'<span>'.$laikas1[2].'</span></li>
          <li class="game game-spacer">&nbsp;</li>
          <li class="game game-bottom ">'.$winners1[3].'<span>'.$laikas1[3].'</span></li>
  
          <li class="spacer">&nbsp;</li>
      </ul>
      <ul class="round round-3">
          <li class="spacer">&nbsp;</li>
          
          <li class="game game-top">'.$winners2[0].'<span>'.$laikas2[0].'</span></li>
          <li class="game game-spacer">&nbsp;</li>
          <li class="game game-bottom ">'.$winners2[1].'<span>'.$laikas2[1].'</span></li>
      </ul>   
      <ul class="round round-4">
          <li class="spacer">&nbsp;</li>
          
          <li class="game game-top">'.$champ.'<span>'.$time.'</span></li>
      </ul>     
  </main>';

	?>


			
			