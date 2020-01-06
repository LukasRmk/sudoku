<?php

session_start();
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
{ header("Location:logout.php");exit;}
include("include/nustatymai.php");

$user=$_SESSION['user'];
$laikas = $_POST['postlaikas'];
$link=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$sql = "UPDATE kovos SET laikas1 = '$laikas' WHERE zaidejas1 = '$user'";

if (mysqli_query($link, $sql)) {
} else {
    echo "Error: " . $nsql . "<br>" . mysqli_error($link);
};


?>