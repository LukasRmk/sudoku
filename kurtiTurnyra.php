<?php
// operacija1.php
// skirtapakeisti savo sudaryta operacija pratybose

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
        <title>Turnyro langas</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
<style>

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
    <table style="border-width: 2px; border-style: ; "><tr><td>
         Atgal į [<a href="index.php">Pradžia</a>]
      </td></tr>
	</table><br>
			
		<div style="text-align: center;color:green"> <br><br>
            <h1>Kurti naują turnyrą</h1><br>
        </div>

<?php
include("include/nustatymai.php");

echo '<form action="" method="post">';

echo ' <input type="submit" name="kurti" class="button" value="Sukurti naują turnyrą iš visų žaidėjų" />';
echo ' <input type="submit" name="naujinti" class="button" value="Atnaujinti" />';
//echo ' <input type="submit" name="rodyti" class="button" value="Atvaizduoti turnyrą" />';

echo '</form>';

function rodyti(){
    echo "turnyrinė lentelė: <br>";

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

    echo '
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
}

function create()
{
    $link=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    $delete="DELETE FROM turnyras";
    mysqli_query($link, $delete);

    $sql = "SELECT username FROM users WHERE userlevel = 4";
    $zaidejai = mysqli_query($link, $sql);

    $a = 0;
    while($row = mysqli_fetch_assoc($zaidejai))
	{
        $players[$a] = $row['username'];
        $a++;
    } 

    $ai = "ALTER TABLE turnyras AUTO_INCREMENT = 1";
    mysqli_query($link, $ai);

    foreach($players as $val){
      
        $nsql = "INSERT INTO turnyras (zaidejoVardas, Laikas, kova) VALUES ('$val', 0, 0)";
        mysqli_query($link, $nsql);
    }
    echo 'Turnyrinė lentelė suformuota';
}

function atnaujinti()
{
    $link=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    $sql="SELECT * FROM turnyras";
    $res = mysqli_query($link, $sql);

    $a = 0;
    while($row = mysqli_fetch_assoc($res))
	  {
      $vardas[$a] = $row['zaidejoVardas'];
      $kova[$a] = $row['kova'];
      $laikas[$a] = $row['Laikas'];
      $a++;
    } 

    if($kova[0] == 0){
      $pirma = "UPDATE turnyras SET kova = 1 WHERE id = 1";
      $antra = "UPDATE turnyras SET kova = 1 WHERE id = 2";
      $trec = "UPDATE turnyras SET kova = 2 WHERE id = 3";
      $ketv = "UPDATE turnyras SET kova = 2 WHERE id = 4";
      $p = "UPDATE turnyras SET kova = 3 WHERE id = 5";
      $s = "UPDATE turnyras SET kova = 3 WHERE id = 6";
      $se = "UPDATE turnyras SET kova = 4 WHERE id = 7";
      $as = "UPDATE turnyras SET kova = 4 WHERE id = 8";
      mysqli_query($link, $pirma);
      mysqli_query($link, $antra);
      mysqli_query($link, $trec);
      mysqli_query($link, $ketv);
      mysqli_query($link, $p);
      mysqli_query($link, $s);
      mysqli_query($link, $se);
      mysqli_query($link, $as);

      $wipe1 = "DELETE FROM winner1";
      $wipe2 = "DELETE FROM winner2";
      $wipe3 = "DELETE FROM winner3";
      mysqli_query($link, $wipe1);
      mysqli_query($link, $wipe2);
      mysqli_query($link, $wipe3);


    } else {

      // round 1
      if($kova[0] == $kova[1]){
        if($laikas[0] < $laikas[1]){
          $win1 = "UPDATE turnyras SET kova = 5 WHERE id = 1";
          $table = "INSERT INTO winner1 (zaidejoVardas, Laikas) VALUES('$vardas[0]', '$laikas[0]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
         // return;
        } 

        if ($laikas[0] > $laikas[1]){
          $win11 = "UPDATE turnyras SET kova = 5 WHERE id = 2";
          $table = "INSERT INTO winner1 (zaidejoVardas, Laikas) VALUES('$vardas[1]', '$laikas[1]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
         // return;
        } 
      }

      if($kova[2] == $kova[3]){
        if($laikas[2] < $laikas[3]){
          $win1 = "UPDATE turnyras SET kova = 5 WHERE id = 3";
          $table = "INSERT INTO winner1 (zaidejoVardas, Laikas) VALUES('$vardas[2]', '$laikas[2]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
         // return;
        } 

        if ($laikas[2] > $laikas[3]){
          $win11 = "UPDATE turnyras SET kova = 5 WHERE id = 4";
          $table = "INSERT INTO winner1 (zaidejoVardas, Laikas) VALUES('$vardas[3]', '$laikas[3]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
        //  return;
        } 
      }

      if($kova[4] == $kova[5]){
        if($laikas[4] < $laikas[5]){
          $win1 = "UPDATE turnyras SET kova = 6 WHERE id = 5";
          $table = "INSERT INTO winner1 (zaidejoVardas, Laikas) VALUES('$vardas[4]', '$laikas[4]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
         // return;
        } 

        if ($laikas[4] > $laikas[5]){
          $win11 = "UPDATE turnyras SET kova = 6 WHERE id = 6";
          $table = "INSERT INTO winner1 (zaidejoVardas, Laikas) VALUES('$vardas[5]', '$laikas[5]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
         // return;
        } 
      }

      if($kova[6] == $kova[7]){
        if($laikas[6] < $laikas[7]){
          $win1 = "UPDATE turnyras SET kova = 6 WHERE id = 7";
          $table = "INSERT INTO winner1 (zaidejoVardas, Laikas) VALUES('$vardas[6]', '$laikas[6]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
          //return;
        } 

        if ($laikas[6] > $laikas[7]){
          $win11 = "UPDATE turnyras SET kova = 6 WHERE id = 8";
          $table = "INSERT INTO winner1 (zaidejoVardas, Laikas) VALUES('$vardas[7]', '$laikas[7]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
         //return;
        } 
      }

      // round 2 pirmas fight
      if($kova[0] == $kova[2]){
        if($laikas[0] < $laikas[2]){
          $win1 = "UPDATE turnyras SET kova = 7 WHERE id = 1";
          $table = "INSERT INTO winner2 (zaidejoVardas, Laikas) VALUES('$vardas[0]', '$laikas[0]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
          //return;
        } 

        if ($laikas[0] > $laikas[2]){
          $win11 = "UPDATE turnyras SET kova = 7 WHERE id = 3";
          $table = "INSERT INTO winner2 (zaidejoVardas, Laikas) VALUES('$vardas[2]', '$laikas[2]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
         // return;
        } 
      }

      if($kova[0] == $kova[3]){
        if($laikas[0] < $laikas[3]){
          $win1 = "UPDATE turnyras SET kova = 7 WHERE id = 1";
          $table = "INSERT INTO winner2 (zaidejoVardas, Laikas) VALUES('$vardas[0]', '$laikas[0]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
          //return;
        } 

        if ($laikas[0] > $laikas[3]){
          $win11 = "UPDATE turnyras SET kova = 7 WHERE id = 4";
          $table = "INSERT INTO winner2 (zaidejoVardas, Laikas) VALUES('$vardas[3]', '$laikas[3]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
         // return;
        } 
      }

      if($kova[1] == $kova[2]){
        if($laikas[1] < $laikas[2]){
          $win1 = "UPDATE turnyras SET kova = 7 WHERE id = 2";
          $table = "INSERT INTO winner2 (zaidejoVardas, Laikas) VALUES('$vardas[1]', '$laikas[1]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
         // return;
        } 

        if ($laikas[1] > $laikas[2]){
          $win11 = "UPDATE turnyras SET kova = 7 WHERE id = 3";
          $table = "INSERT INTO winner2 (zaidejoVardas, Laikas) VALUES('$vardas[2]', '$laikas[2]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
         // return;
        } 
      }

      if($kova[1] == $kova[3]){
        if($laikas[1] < $laikas[3]){
          $win1 = "UPDATE turnyras SET kova = 7 WHERE id = 2";
          $table = "INSERT INTO winner2 (zaidejoVardas, Laikas) VALUES('$vardas[1]', '$laikas[1]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
          //return;
        } 

        if ($laikas[1] > $laikas[3]){
          $win11 = "UPDATE turnyras SET kova = 7 WHERE id = 4";
          $table = "INSERT INTO winner2 (zaidejoVardas, Laikas) VALUES('$vardas[3]', '$laikas[3]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
          //return;
        } 
      }
      
      // round 2 antras fight

      if($kova[4] == $kova[6]){
        if($laikas[4] < $laikas[6]){
          $win1 = "UPDATE turnyras SET kova = 7 WHERE id = 5";
          $table = "INSERT INTO winner2 (zaidejoVardas, Laikas) VALUES('$vardas[4]', '$laikas[4]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
          //return;
        } 

        if ($laikas[4] > $laikas[6]){
          $win11 = "UPDATE turnyras SET kova = 7 WHERE id = 7";
          $table = "INSERT INTO winner2 (zaidejoVardas, Laikas) VALUES('$vardas[6]', '$laikas[6]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
          //return;
        } 
      }

      if($kova[4] == $kova[7]){
        if($laikas[4] < $laikas[7]){
          $win1 = "UPDATE turnyras SET kova = 7 WHERE id = 5";
          $table = "INSERT INTO winner2 (zaidejoVardas, Laikas) VALUES('$vardas[4]', '$laikas[4]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
         // return;
        } 

        if ($laikas[4] > $laikas[7]){
          $win11 = "UPDATE turnyras SET kova = 7 WHERE id = 8";
          $table = "INSERT INTO winner2 (zaidejoVardas, Laikas) VALUES('$vardas[7]', '$laikas[7]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
          //return;
        } 
      }

      if($kova[5] == $kova[6]){
        if($laikas[5] < $laikas[6]){
          $win1 = "UPDATE turnyras SET kova = 7 WHERE id = 6";
          $table = "INSERT INTO winner2 (zaidejoVardas, Laikas) VALUES('$vardas[5]', '$laikas[5]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
          //return;
        } 

        if ($laikas[5] > $laikas[6]){
          $win11 = "UPDATE turnyras SET kova = 7 WHERE id = 7";
          $table = "INSERT INTO winner2 (zaidejoVardas, Laikas) VALUES('$vardas[6]', '$laikas[6]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
          //return;
        } 
      }

      if($kova[5] == $kova[7]){
        if($laikas[5] < $laikas[7]){
          $win1 = "UPDATE turnyras SET kova = 7 WHERE id = 6";
          $table = "INSERT INTO winner2 (zaidejoVardas, Laikas) VALUES('$vardas[5]', '$laikas[5]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
          //return;
        } 

        if ($laikas[5] > $laikas[7]){
          $win11 = "UPDATE turnyras SET kova = 7 WHERE id = 8";
          $table = "INSERT INTO winner2 (zaidejoVardas, Laikas) VALUES('$vardas[7]', '$laikas[7]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
          //return;
        } 
      }

      // round 3 1st check
      
      if($kova[0] == $kova[4]){
        if($laikas[0] < $laikas[4]){
          $win1 = "UPDATE turnyras SET kova = 8 WHERE id = 1";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[0]', '$laikas[0]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
          //return;
        } 

        if ($laikas[0] > $laikas[4]){
          $win11 = "UPDATE turnyras SET kova = 8 WHERE id = 5";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[4]', '$laikas[4]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
          //return;
        } 
      }

      if($kova[0] == $kova[5]){
        if($laikas[0] < $laikas[5]){
          $win1 = "UPDATE turnyras SET kova = 8 WHERE id = 1";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[0]', '$laikas[0]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
          //return;
        } 

        if ($laikas[0] > $laikas[5]){
          $win11 = "UPDATE turnyras SET kova = 8 WHERE id = 6";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[5]', '$laikas[5]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
          //return;
        } 
      }

      if($kova[0] == $kova[6]){
        if($laikas[0] < $laikas[6]){
          $win1 = "UPDATE turnyras SET kova = 8 WHERE id = 1";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[0]', '$laikas[0]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
          //return;
        } 

        if ($laikas[0] > $laikas[6]){
          $win11 = "UPDATE turnyras SET kova = 8 WHERE id = 7";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[6]', '$laikas[6]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
         // return;
        } 
      }

      if($kova[0] == $kova[7]){
        if($laikas[0] < $laikas[7]){
          $win1 = "UPDATE turnyras SET kova = 8 WHERE id = 1";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[0]', '$laikas[0]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
         // return;
        } 

        if ($laikas[0] > $laikas[7]){
          $win11 = "UPDATE turnyras SET kova = 8 WHERE id = 8";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[7]', '$laikas[7]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
          //return;
        } 
      }

      // round 3 2nd check
      
      if($kova[1] == $kova[4]){
        if($laikas[1] < $laikas[4]){
          $win1 = "UPDATE turnyras SET kova = 8 WHERE id = 2";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[1]', '$laikas[1]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
         // return;
        } 

        if ($laikas[1] > $laikas[4]){
          $win11 = "UPDATE turnyras SET kova = 8 WHERE id = 5";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[4]', '$laikas[4]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
         // return;
        } 
      }

      if($kova[1] == $kova[5]){
        if($laikas[1] < $laikas[5]){
          $win1 = "UPDATE turnyras SET kova = 8 WHERE id = 2";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[1]', '$laikas[1]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
          //return;
        } 

        if ($laikas[1] > $laikas[5]){
          $win11 = "UPDATE turnyras SET kova = 8 WHERE id = 6";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[5]', '$laikas[5]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
         // return;
        } 
      }

      if($kova[1] == $kova[6]){
        if($laikas[1] < $laikas[6]){
          $win1 = "UPDATE turnyras SET kova = 8 WHERE id = 2";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[1]', '$laikas[1]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
         // return;
        } 

        if ($laikas[1] > $laikas[6]){
          $win11 = "UPDATE turnyras SET kova = 8 WHERE id = 7";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[6]', '$laikas[6]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
         // return;
        } 
      }

      if($kova[1] == $kova[7]){
        if($laikas[1] < $laikas[7]){
          $win1 = "UPDATE turnyras SET kova = 8 WHERE id = 2";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[1]', '$laikas[1]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
         // return;
        } 

        if ($laikas[1] > $laikas[7]){
          $win11 = "UPDATE turnyras SET kova = 8 WHERE id = 8";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[7]', '$laikas[7]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
          //return;
        } 
      }

      // round 3 3rd check
      
      if($kova[2] == $kova[4]){
        if($laikas[2] < $laikas[4]){
          $win1 = "UPDATE turnyras SET kova = 8 WHERE id = 3";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[2]', '$laikas[2]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
         // return;
        } 

        if ($laikas[2] > $laikas[4]){
          $win11 = "UPDATE turnyras SET kova = 8 WHERE id = 5";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[4]', '$laikas[4]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
         // return;
        } 
      }

      if($kova[2] == $kova[5]){
        if($laikas[2] < $laikas[5]){
          $win1 = "UPDATE turnyras SET kova = 8 WHERE id = 3";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[2]', '$laikas[2]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
         // return;
        } 

        if ($laikas[2] > $laikas[5]){
          $win11 = "UPDATE turnyras SET kova = 8 WHERE id = 6";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[5]', '$laikas[5]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
         // return;
        } 
      }

      if($kova[2] == $kova[6]){
        if($laikas[2] < $laikas[6]){
          $win1 = "UPDATE turnyras SET kova = 8 WHERE id = 3";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[2]', '$laikas[2]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
         // return;
        } 

        if ($laikas[2] > $laikas[6]){
          $win11 = "UPDATE turnyras SET kova = 8 WHERE id = 7";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[6]', '$laikas[6]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
         // return;
        } 
      }

      if($kova[2] == $kova[7]){
        if($laikas[2] < $laikas[7]){
          $win1 = "UPDATE turnyras SET kova = 8 WHERE id = 3";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[2]', '$laikas[2]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
         // return;
        } 

        if ($laikas[2] > $laikas[7]){
          $win11 = "UPDATE turnyras SET kova = 8 WHERE id = 8";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[7]', '$laikas[7]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
         // return;
        } 
      }

      // round 3 4th check
      
      if($kova[3] == $kova[4]){
        if($laikas[3] < $laikas[4]){
          $win1 = "UPDATE turnyras SET kova = 8 WHERE id = 4";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[3]', '$laikas[3]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
         // return;
        } 

        if ($laikas[3] > $laikas[4]){
          $win11 = "UPDATE turnyras SET kova = 8 WHERE id = 5";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[4]', '$laikas[4]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
        //  return;
        } 
      }

      if($kova[3] == $kova[5]){
        if($laikas[3] < $laikas[5]){
          $win1 = "UPDATE turnyras SET kova = 8 WHERE id = 4";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[3]', '$laikas[3]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
         // return;
        } 

        if ($laikas[3] > $laikas[5]){
          $win11 = "UPDATE turnyras SET kova = 8 WHERE id = 6";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[5]', '$laikas[5]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
         // return;
        } 
      }

      if($kova[3] == $kova[6]){
        if($laikas[3] < $laikas[6]){
          $win1 = "UPDATE turnyras SET kova = 8 WHERE id = 4";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[3]', '$laikas[3]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
         // return;
        } 

        if ($laikas[3] > $laikas[6]){
          $win11 = "UPDATE turnyras SET kova = 8 WHERE id = 7";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[6]', '$laikas[6]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
          //return;
        } 
      }

      if($kova[3] == $kova[7]){
        if($laikas[3] < $laikas[7]){
          $win1 = "UPDATE turnyras SET kova = 8 WHERE id = 4";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[3]', '$laikas[3]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win1);
         // return;
        } 

        if ($laikas[3] > $laikas[7]){
          $win11 = "UPDATE turnyras SET kova = 8 WHERE id = 8";
          $table = "INSERT INTO winner3 (zaidejoVardas, Laikas) VALUES('$vardas[7]', '$laikas[7]')";
          mysqli_query($link, $table);
          mysqli_query($link, $win11);
          //return;
        } 
      }


    }
    echo "Atnaujinta";
    rodyti();
}

if(array_key_exists('kurti', $_POST)) { 
  create(); 
} else if (array_key_exists('naujinti', $_POST)) {
  atnaujinti();
} else if (array_key_exists('rodyti', $_POST)) {
  rodyti(); 
}
?>

        