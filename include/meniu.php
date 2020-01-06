<?php
// meniu.php  rodomas meniu pagal vartotojo rolę

if (!isset($_SESSION)) { header("Location: logout.php");exit;}
include("include/nustatymai.php");


$user=$_SESSION['user'];

$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$nsql = "SELECT points FROM users where username='$user'";
			  $result = mysqli_query($db, $nsql);

			  $row = mysqli_fetch_assoc($result);
			  $_SESSION['points']=$row['points'];

$userlevel=$_SESSION['ulevel'];
$points=$_SESSION['points'];
$role="";
{foreach($user_roles as $x=>$x_value)
			      {if ($x_value == $userlevel) $role=$x;}
} 

     echo "<table width=100% border=\"0\" cellspacing=\"1\" cellpadding=\"3\" class=\"meniu\">";
        echo "<tr><td>";
        echo "Prisijungęs vartotojas: <b>".$user."</b>     Rolė: <b>".$role."</b>   Turimi taškai: <b>".$points."</b>";
        echo "</td></tr><tr><td>";
        if ($_SESSION['user'] != "guest") echo "[<a href=\"useredit.php\">Redaguoti paskyrą</a>] &nbsp;&nbsp;";
        echo "[<a href=\"pamokos.php\">Sudoku Pamokos</a>] &nbsp;&nbsp;";
		echo "[<a href=\"zaisti.php\">Žaisti</a>] &nbsp;&nbsp;";
		
     //Trečia operacija tik rodoma pasirinktu kategoriju vartotojams, pvz.:
        if (($userlevel == $user_roles["Žaidėjas"]) ) {
			echo "[<a href=\"kovos.php\">Sudoku Kovos</a>] &nbsp;&nbsp;";
            echo "[<a href=\"turnyrai.php\">Turnyro lentelė</a>] &nbsp;&nbsp;";
            echo "[<a href=\"turny.php\">Turnyro mačas</a>] &nbsp;&nbsp;";
            echo "[<a href=\"rating.php\">Reitingai</a>] &nbsp;&nbsp;";
       		}   
        //Administratoriaus sąsaja rodoma tik administratoriui
        if ($userlevel == $user_roles[ADMIN_LEVEL] ) {
            echo "[<a href=\"kurtiTurnyra.php\">Turnyro administravimas</a>] &nbsp;&nbsp;";
            echo "[<a href=\"admin.php\">Administratoriaus sąsaja</a>] &nbsp;&nbsp;";
        }
        echo "[<a href=\"logout.php\">Atsijungti</a>]";
      echo "</td></tr></table>";
?>       
    
 