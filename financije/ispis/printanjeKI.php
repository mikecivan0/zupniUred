<?php

if(!isset($_GET["id"])){
	header('location: ../../predlosci.php');
}
include_once '../../config/conf.php';
include_once '../../kontrole/isLogged.php';
include_once '../../sql/financije/nadjiZupu.php';

if (empty($zupa)) { //ako se pokuša mijenjati get[id] na župu u kojoj se nije župnik onda ga izbaci van
	session_destroy();
	header("location: ../../auth/prijava.php");
}else{
$bodyClass = "papinskaZastava";
$title = 'Kvartalno izvješće';
include_once '../../alati/Html.php';
include_once '../../alati/Alati.php';
include_once '../../klase/SQL.php';
include_once '../../alati/IspisFinancija.php';
include_once '../../klase/izvjesca/Grupa.php';
include_once '../../klase/izvjesca/Stavka.php';
include_once '../../klase/izvjesca/Transakcija.php';

$grupe = new Grupa;
$grupe = $grupe->dohvatiGrupeZaKI(); 

$transakcija = new Transakcija();
$transakcija->dohvatiKvartalIGodinu($_POST["hfZupaId"], $_POST["godinaIKvartal"]);
$godina = $transakcija->godina;
$kvartal = $transakcija->kvartal;
?>

<html>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<head>
		<?php include_once '../../masters/printStyle.php' ?>
		<style>		
			td{
				border: 1px solid black;
			}
			
			div{ 
				font-family: TimesNewRoman, 'Times New Roman', Georgia, serif;
				font-size: 19px;
			}
				
			table{ 
				font-size: 19px;
				}
			
			td,tr{ 
				line-height: 10mm;
				height: 10mm;
				}
				
			.visina{ 
				line-height: normal;
				height: 10mm; 
				}			
		</style>
	</head>
	<body>
		<div style="width: 170mm; margin: 0 auto;"">
			<div style="text-align: left; margin-bottom: 5mm; margin-top: 5mm;">Župa: <span class="rukopis"><?= $zupa->nazivZupe . ", " . $zupa->adresaUreda . ", " . $zupa->nazivMjesta . " " . $zupa->pbr ?></span></div>
			<div style="text-align: left; margin-bottom: 5mm;">Broj: <span class="rukopis"><?= $_POST["broj"] ?></span></div>
			<div style="padding-left: 82mm;">Za mjesec:<span style="padding-left: 122px !important;"><span class="rukopis"><?= $godina ?>.</span> godine</span></div>
			<div style="padding-left: 82mm; margin-bottom: 6mm;">
				Za tromjesečje: 
				<span class="rukopis" ><?= IspisFinancija::kvartalUMjesece($kvartal) ?></span>
				<span class="rukopis"  style="padding-left: 15px !important;"><?= $godina ?>. </span>
				godine
			</div>
			<div style="text-align: center; font-size: 25px; margin-bottom: 3mm;"><b>Obračunski list</b></div>
			<table style="border-collapse: collapse;">
						<tbody>	
							<tr class="visina">
								<td class="visina" style="width: 9%; text-align: center;"><b>Redni broj</b></td>
								<td class="visina" style="width: 71%; text-align: center;"><b>Opis</b></td>
								<td class="visina" style="width: 20%; text-align: center;"><b>Kuna</b></td>
							</tr>
							<tr style="line-height: 7mm; height: 7mm;">
								<td style='text-align: center; width: 9%; line-height: 7mm; height: 7mm;'><b>1.</b></td>
								<td style='text-align: left; width: 71%; padding-left: 1mm; line-height: 7mm; height: 7mm;'><b>Milosinja po direkotrijumu</b></td>
								<td style='text-align: right; width: 20%; padding-right: 1mm; line-height: 7mm; height: 7mm;'></td>
							 </tr>
		<?php
				$stavke = new Stavka();
				$stavke = $stavke->dohvatiStavkeZaKI(2, $_GET["id"]);				
				$count = 2;
				$slovo = "a";
				$ukupno = 0.00;
				$prviNiz = '';
				$drugiNiz = '';
				foreach ($stavke as $stavka) {
					$transakcija = new Transakcija();
					$iznos = $transakcija->dohvatiIznoseZaKI($stavka->id, $_GET["id"], $kvartal, $godina);	
					$ukupno +=  $iznos;	
					$iznos = ($iznos!=null) ? Alati::hrIznos(number_format($iznos, 2)) : null; //da se ne bi prikazivale nule
					if($stavka->markStavke==1||$stavka->markStavke==2||$stavka->markStavke==3||$stavka->markStavke==4||
					   strpos($stavka->nazivStavke,'Božji grob')>0||strpos($stavka->nazivStavke,'Petrov novčić')>0||
					   strpos($stavka->nazivStavke,'Misije')>0||strpos($stavka->nazivStavke,'Caritas')>0){ 
					   		$prviNiz .= "<tr>
							<td style='text-align: center; width: 9%;'></td>
							<td style='text-align: left; width: 71%; padding-left: 1mm;'>" . $slovo . ") " . $stavka->nazivStavke . "</td>
							<td class='rukopis fwn' style='text-align: right; width: 20%; padding-right: 1mm;'>" . $iznos . "</td>
						 </tr>";
						$slovo++;
					}else{	
						$drugiNiz .= "<tr>
						<td style='text-align: center; width: 9%;'><b>" . $count . ".</b></td>
						<td style='text-align: left; width: 71%; padding-left: 1mm;'><b>" . $stavka->nazivStavke . "</b></td>
						<td class='rukopis fwn' style='text-align: right; width: 20%; padding-right: 1mm;'>" . $iznos . "</td>
					 </tr>";
					$count++;					
					}									
				}
					echo $prviNiz . $drugiNiz;
					for($i=$count; $i<11; $i++){ ?>
							<tr>
								<td style='text-align: center; width: 9%;'></td>
								<td style='text-align: right; width: 71%; padding-right: 2mm;'></td>
								<td style='text-align: right; width: 20%; padding-right: 1mm;'></td>
							</tr>
					<?php } ?>
						<tr>
							<td style='text-align: center; width: 9%;'></td>
							<td style='text-align: right; width: 71%; padding-right: 2mm;'><b>UKUPNO:</b></td>
							<td class='rukopis fwn b' style='text-align: right; width: 20%; padding-right: 1mm;'><?= Alati::hrIznos(number_format($ukupno, 2)) ?></td>
						</tr>
					</tbody>	
				</table>	
				<div style="padding-left: 10mm; margin-top: 9mm;">U <span class='rukopis'><?= $_POST["mjesto"] ?></span>, <span class='rukopis fwn'><?= Alati::datum($_POST["datum"]) ?></span></div>	
				<div style="text-align: center; margin-top: 3mm;">MP</div>	
				<div style="padding-left: 100mm; margin-top: 5mm;">_____________________</div>	
				<div style="padding-left: 120mm;">župnik</div>	
		</div>
		<script type="text/javascript">
			window.onload = function() {
				window.print();
			}
		</script>
	</body>
</html>
<?php } ?>

