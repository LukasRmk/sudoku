<?php
// operacija1.php
// skirtapakeisti savo sudaryta operacija pratybose

session_start();
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
{ header("Location:logout.php");exit;}

?>

<!DOCTYPE html>
<html>
    <head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>SUDOKU Pamoka</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
		
		<style>

		</style>
    </head>
    <body style="background-color:LIGHTYELLOW;">
    <table style="border-width: 2px; border-style: dotted;"><tr><td>
         Atgal į [<a href="index.php">Pradžia</a>]
      </td></tr>
	</table><br>
			
		<div style="text-align: center;color:green"> <br><br>
            <h1>SUDOKU taisyklės</h1>
			SUDOKU lentelė susideda iš devynių vertikalių stulpelių ir devynių horizontalių eilučių, <br>
			kurie yra suskirstyti į 9 langelius. Visa lentelė dar yra suskirstyta į kvadratėlius, <br>
			kurie susideda iš 3x3 langelių. Šiame žaidime nereikia naudoti aritmetikos, jį galima <br>
			pradėti žaisti nuo bet kurios lentelės vietos. Žaidimo esmė, kad visi stulpeliai,  <br> 
			eilutės ir 3x3 kvadratėliai turėtų skaičių seką nuo 1 iki 9, nei vienas skaičius negali kartotis.
			
        </div><br>
		<div style="text-align: center;color:green">
		<h1>Kaip žaisti?</h1>
		<div class="row">
		
		<table  cellpadding="0" cellspacing="0" align="center" width="600">
		
 <tbody>
 <tr><td columnspan="2">
 <h2>1 žingsnis</h2></td>
 </tr><tr>
 <td style="padding-bottom:8px;" width="226"><img src="include/step1.jpg" width="226" height="226"></td>
 <td>1 žingsnyje turime „Sudoku“ pavyzdį. Turime lengvą lygį, tačiau šiam pavyzdžiui jo pakaks. Galimas būdas pradėti tokį galvosūkį - ieškoti skaičiaus, kuris pasirodo dažniausiai.   </td>
 </tr><tr>
 <td columnspan="2">
 <h2>2 žingsnis</h2>
 </td></tr><tr><td style="padding-bottom:8px;"><img src="include/step2.jpg" width="226" height="226"></td>
 <td >Pirmiausia išbandysime 4. Dabar ieškome regionų, kuriuose nėra 4, ir bandome juos išdėstyti pašalinimo būdu. Šiuo tikslu nustatome, kuriuose stulpeliuose ir eilutėse yra 4, nes šių eilučių ir stulpelių langeliuose negalime dėti 4. Jei regione liko tik viena galima vieta, mes įdedame 4 ten. Štai taip mes gavome du 4 paveiksle. Ši strategija vadinama kryžminimu.</td></tr>
 <tr><td columnspan="2">
 <h2>3 žingsnis</h2></td>
 </tr><tr><td style="padding-bottom:8px;"><img src="include/step3.jpg" width="226" height="226"></td>
 <td class="text_td">Pakartojame kryžminį perėjimą su skaičiumi 5. Tai yra dar veiksmingiau nei su skaičiumi 4, nes mes galime sudėti tris 5.</td></tr><tr><td columnspan="2">
 <h2>4 žingsnis</h2>
 </td></tr><tr><td style="padding-bottom:8px;"><img src="include/step4.jpg" width="226" height="226"></td>
 <td class="text_td">Šiame etape mes galime užpildyti eiles, stulpelius ir regionus, likę tik du tušti langeliai. Tai lengva padaryti, nes kiekvienai iš dviejų ląstelių grupių vienam langeliui liko tik vienas galimas skaičius. Kad tai būtų lengviau suprasti, aš jį paryškinau spalvomis. Jei tai padarysite dabar, bus lengviau atlikti kryžminimą ir skaičiavimą atliekant kitus veiksmus.</td></tr>
 <tr><td columnspan="2">
 <h2>5 žingsnis</h2>
 </td></tr><tr><td style="padding-bottom:8px;"><img src="include/step5.jpg" width="226" height="226"></td>
 <td class="text_td">Apatiniame kairiajame krašte negalime nustatyti tikslios skaičiaus 6 padėties, tačiau mes žinome, į kurią eilę turime jį įterpti (trys raudonieji langeliai). Todėl dabar galime išdėstyti 6 apatiniame dešiniajame regione. Tada mes galime gauti 7 ir 2, kaip ir 4 žingsnyje.</td></tr><tr><td columnspan="2">
 <h2>6 žingsnis</h2>
 </td></tr><tr><td style="padding-bottom:8px;"><img src="include/step6.jpg" width="226" height="226"></td><td class="text_td">
Dabar nerandame daugiau skaičių kryžminiu keliu. Štai kodėl mes tai išbandome skaičiuodami. Suskaičiuojame regionus, eiles ir stulpelius, kad nustatytume trūkstamus langelio skaitmenis. Jei po suskaičiavimo radome langelį, kuriame liko tik vienas galimas skaičius, įdedame jį į langelį. Naudinga įrašyti mažus skaičius į langelį, kad būtų lengviau įsiminti skaičiavimo išvadas. Suskaičiavę, šiame žingsnyje gavome šešis skaičius.</td></tr>
 <tr><td columnspan="2">
 <h2>7 žingsnis</h2>
 </td></tr><tr><td style="padding-bottom:8px;"><img src="include/step7.jpg" width="226" height="226"></td><td class="text_td">Kaip ir 4 žingsny, dabar galime užpildyti savo dėlionės eilutę ir stulpelį.</td></tr><tr><td columnspan="2">
 <h2>8 žingsnis</h2>
 </td></tr><tr><td style="padding-bottom:8px;"><img src="include/step8.jpg" width="226" height="226"></td><td class="text_td">Šiame žingsnyje galime rasti keletą skaičių, suskaičiavę, kaip 6 žingsnyje.</td></tr>
 <tr><td columnspan="2">
 <h2>9 žingsnis</h2>
 </td></tr><tr><td style="padding-bottom:0px;"><img src="include/step9.jpg" width="226" height="226"></td><td style="padding-bottom:0px;" class="text_td">Dabar turime „Sudoku“ dėlionės sprendimus. Mes praleidome keletą žingsnių, nes juose nebuvo nieko naujo, tik buvo pakartoti kiti veiksmai.</td></tr></tbody>
</table>
</div>
<br>
		</div>
		
