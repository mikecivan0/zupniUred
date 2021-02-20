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
include_once '../../klase/izvjesca/Grupa.php';
include_once '../../klase/izvjesca/Stavka.php';
include_once '../../klase/izvjesca/Transakcija.php';

$grupe = new Grupa;
$grupe = $grupe->dohvatiGrupeZaKI(); 

$transakcija = new Transakcija();
$transakcija->dohvatiKvartalIGodinu($_POST["hfZupaId"], $_POST["godinaIKvartal"]);
$godina = $transakcija->godina;
$kvartal = $transakcija->kvartal;

include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
?>

<div class="row">
	<div class="large-12 columns mt15 polja">
		<h3 class="mt15 mb15">Kvartalno izvješće župe <?= $zupa->nazivZupe ?> za <?= Alati::rimski_broj($kvartal) ?>. kvartal <?= $godina ?>. godine</h3>
		<?php foreach($grupe as $grupa): ?>
			<fieldset>
				<legend><?= $grupa->nazivGrupe ?></legend>
					<table style="width: 100%;">
						<tbody>	
		<?php
				$stavke = new Stavka();
				$stavke = $stavke->dohvatiStavkeZaKI($grupa->id, $_GET["id"]);				
				$count = 1;
				$ukupno = 0.00;
				foreach ($stavke as $stavka) {
					$transakcija = new Transakcija();
					$iznos = $transakcija->dohvatiIznoseZaKI($stavka->id, $_GET["id"], $kvartal, $godina);	
					$iznos = ($iznos!=null) ? Alati::hrIznos(number_format($iznos, 2)) : null;
					?>
					<tr>
						<td style='text-align: center;'><?= $count ?>.</td>
						<td><?= $stavka->nazivStavke ?></td>
						<td style='text-align: right; padding-right: 10px;'><?= $iznos ?></td>
					 </tr>
					 <?php
					$count++;
					$ukupno +=  $iznos;
				} ?>
						<tr>
							<td></td>
							<td style='text-align: right; padding-right: 10px;'><b>UKUPNO</b></td>
							<td style='text-align: right; padding-right: 10px;'><b><?= Alati::hrIznos(number_format($ukupno, 2)) ?></b></td>
						</tr>
					</tbody>	
				</table>									
			</fieldset>	
		<?php endforeach; 
		echo  Html::Button('Zatvori', array('button','alert','siroko'),array('onclick'=>'window.close();'));
		?>	
	</div>
</div>

<?php
include_once '../../masters/masterBottom.php';
}
?>