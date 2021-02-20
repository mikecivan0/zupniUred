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
$title = 'Godišnje izvješće';
include_once '../../alati/Html.php';
include_once '../../alati/Alati.php';
include_once '../../alati/Printanje.php';
include_once '../../klase/SQL.php';
include_once '../../alati/IspisFinancija.php';
include_once '../../klase/izvjesca/Grupa.php';
include_once '../../klase/izvjesca/Stavka.php';
include_once '../../klase/izvjesca/Transakcija.php';
$ukupnoA = 0.00;
$ukupnoC = 0.00;

$grupe = new Grupa;
$grupe = $grupe->dohvatiSve(); 
?>

<html>
	
	<meta http-equiv="Expires" content="<?= gmdate('D, d M Y H:i:s', time()+86400) . ' GMT' ?>">
	<meta http-equiv="Pragma" content="no-cache">
	<?php 
	header('Cache-Control: no-store, no-cache, must-revalidate'); 
	header('Cache-Control: post-check=0, pre-check=0', FALSE); 
	?>
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<?php include_once '../../masters/printStyle.php' ?>
		<style>
			.f {
				margin: 0 !important;
				padding: 0 !important;
				position: absolute;
				font-size: 19px;
			}
			
			td{
				border: 1px solid black;
			}
		</style>
	</head>
	<body style="font-family:  Arial, 'Helvetica Neue', Helvetica, sans-serif;">	
		
		<!-- stranica 1 --> 
		<div style="margin-left: 2mm; margin-bottom: 13mm; width: 208mm; height: 297mm; background-image: url('../../img/predlosci/godisnji.jpg'); background-size: cover;">
			<?= IspisFinancija::polje('34mm;', '40mm;', $zupa->nazivZupe , 'f rukopis fwb', 'width: 120mm; text-align: center;') ?>
			<?= IspisFinancija::polje('46.3mm;', '50mm;', $zupa->adresaUreda . ", " . $zupa->nazivMjesta . " " . $zupa->pbr, 'f rukopis fwb', 'width: 110mm; text-align: center;') ?>
			<?= IspisFinancija::polje('180.7mm;', '91mm;', $_POST["godina"] . ".", 'f rukopis fwb', 'width: 22mm; text-align: center;') ?>
			<?= IspisFinancija::polje('192.2mm;', '91mm;', $_POST["broj"], 'f rukopis fwb', 'width: 20mm; text-align: center; float: left;') ?>
			<?= IspisFinancija::polje('192.2mm;', '124mm;', $_POST["podbroj"], 'f rukopis fwb', 'width: 15mm; text-align: left; float: left;') ?>
		</div>
		
		
			
		<!-- stranica  2 i 3 --> 
		<div>
		<?php foreach($grupe as $grupa): 
					IspisFinancija::zaglavlje($grupa);
					IspisFinancija::naslovUGI($grupa);
					
			?>			
					<table style="line-height: 0.8rem; width: 100%; border-collapse: collapse; margin-bottom: 9mm; font-family: "Times New Roman", Georgia, Serif; mergin-top: 10mm;">
						<tbody>	
		<?php
				$stavke = new Stavka();
				$stavke = $stavke->dohvatiStavkeZaGI($grupa->id, $_GET["id"]);				
				$count = 1;
				$ukupno = 0.00;
				foreach ($stavke as $stavka) {
					$transakcija = new Transakcija();
					$iznos = $transakcija->dohvatiIznoseZaGI($stavka->id, $_GET["id"], $_POST["godina"]);
					IspisFinancija::redUGI($count, $stavka, $iznos);
					$count++;
					$ukupno +=  $iznos;
				} 
				if($grupa->id==1){
					$ukupnoA = $ukupno;
				}elseif($grupa->id==3){
					$ukupnoC = $ukupno;					
				}
				
					IspisFinancija::ukupnoZaGrupuUGI($grupa->nazivGrupe, $ukupno);
				?>
					</tbody>	
				</table>									
		<?php endforeach; 		
			
			//izračuni stanja računa i ukupnog stanja
			$gotovinaUBlagajni = ($_POST["gotovina"]!=null) ? $_POST["gotovina"] : 0.00;
			$stanjeBR = $ukupnoA-$ukupnoC;
			$balgajnaIBanka = $stanjeBR+$gotovinaUBlagajni;
			
			//konvert podataka da nema točke i zareza
			$gotovinaUBlagajni = ($gotovinaUBlagajni!=0.00) ? IspisFinancija::bezTockeIZareza($gotovinaUBlagajni) : null;			
			$stanjeBR = IspisFinancija::bezTockeIZareza($stanjeBR);
			$balgajnaIBanka = IspisFinancija::bezTockeIZareza($balgajnaIBanka);
			$investicije = ($_POST["investicije"]!=null) ? IspisFinancija::bezTockeIZareza($_POST["investicije"]) : null;
			$redovitiZivot = ($_POST["redovitiZivot"]!=null) ? IspisFinancija::bezTockeIZareza($_POST["redovitiZivot"]) : null;
			
		?>
		</div>
		
		<!-- stranica 4 -->
		<div style="margin-top: 1mm; margin-left: 2mm; margin-bottom: 13mm; width: 208mm; height: 297mm; background-image: url('../../img/predlosci/godisnji4.jpg'); background-size: cover;">
			<?= IspisFinancija::polje('927mm;', '110mm;', substr($_POST["godina"], -2) , 'f rukopis fwb', 'width: 15mm; text-align: center;') ?>
			<?= IspisFinancija::polje('941mm;', '105mm;', $gotovinaUBlagajni , 'f rukopis fwb ls', 'text-align: right; width: 50mm;') ?>
			<?= IspisFinancija::polje('949mm;', '105mm;', $stanjeBR , 'f rukopis fwb ls', 'text-align: right; width: 50mm;') ?>
			<?= IspisFinancija::polje('957.4mm;', '105mm;', $balgajnaIBanka , 'f rukopis fwb ls', 'text-align: right; width: 50mm;') ?>
			<?= IspisFinancija::polje('968.8mm;', '105mm;', $investicije , 'f rukopis fwb ls', 'text-align: right; width: 50mm;') ?>
			<?= IspisFinancija::polje('976.2mm;', '105mm;', $redovitiZivot , 'f rukopis fwb ls', 'text-align: right; width: 50mm;') ?>
			<?= IspisFinancija::polje('994.3mm;', '30mm;', $_POST["napomena"] , 'f rukopis fwb', 'text-align: justify; width: 160mm; font-size: 16px; line-height: 9.8mm;') ?>
			<?= IspisFinancija::polje('1061mm;', '26mm;', $_POST["mjesto"] , 'f napomena rukopis fwb', 'text-align: center; width: 70mm; height: 5mm; font-size: 16px; float: left;') ?>
			<?= IspisFinancija::polje('1061mm;', '104mm;', Alati::datum($_POST["datum"]) , 'f rukopis fwb', 'text-align: center; width: 55mm; font-size: 16px; float: left;') ?>
		</div>
		
		<script src="<?= $putanjaApp ?>js/jquery-1.9.1.js"></script>
		<script type="text/javascript">
			$("table").last().css("margin-bottom","0");
			window.onload = function() {
				window.print();
			}
		</script>
	</body>
</html>
<?php } ?>

