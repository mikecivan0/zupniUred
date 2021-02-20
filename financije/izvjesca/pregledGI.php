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
include_once '../../klase/SQL.php';
include_once '../../klase/izvjesca/Grupa.php';
include_once '../../klase/izvjesca/Stavka.php';
include_once '../../klase/izvjesca/Transakcija.php';

$grupe = new Grupa;
$grupe = $grupe->dohvatiSve(" order by FIELD(id,1,3,2,4);"); 

include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
?>

<div class="row">
	<div class="large-12 columns mt15 polja">
	<h3 class="mt15 mb15">Godišnje izvješće župe <?= $zupa->nazivZupe ?> za <?= $_POST["godina"] ?>. godinu</h3>
		<?php foreach($grupe as $grupa): ?>
			<fieldset>
				<legend><?= $grupa->nazivGrupe ?></legend>
					<table style="width: 100%;">
						<tbody>	
		<?php
				$stavke = new Stavka();
				$stavke = $stavke->dohvatiStavkeZaGI($grupa->id, $_GET["id"]);				
				$count = 1;
				$ukupno = 0.00;
				
				foreach ($stavke as $stavka) {
					$transakcija = new Transakcija();
					$iznos = $transakcija->dohvatiIznoseZaGI($stavka->id, $_GET["id"], $_POST["godina"]);	
					?>
					<tr>
						<td style='text-align: center;'><?= $count ?>.</td>
						<td><?= $stavka->nazivStavke ?></td>
						<td style='text-align: right; padding-right: 10px; min-width: 57px !important;'><?= ($iznos!=0) ? Alati::hrIznos(number_format($iznos, 2)) : null ?></td>
					 </tr>
					 <?php
					$count++;
					$ukupno +=  $iznos;
				} 
				if($grupa->id==1){
					$ukupnoA = $ukupno;
				}elseif($grupa->id==3){
					$ukupnoC = $ukupno;					
				}
				?>
						<tr>
							<td></td>
							<td style='text-align: right; padding-right: 10px;'><b>UKUPNO</b></td>
							<td style='text-align: right; padding-right: 10px; min-width: 57px !important;'><b><?= ($ukupno!=0) ? Alati::hrIznos(number_format($ukupno, 2)) : null ?></b></td>
						</tr>
					</tbody>	
				</table>										
			</fieldset>	
		<?php endforeach; 
			$gotovinaUBlagajni = ($_POST["gotovina"]==null) ? 0.00 : $_POST["gotovina"];
			$racunBanke = $ukupnoA-$ukupnoC;
			$ukupnoStanje = $racunBanke+$gotovinaUBlagajni;
			
			$gotovinaUBlagajni = ($gotovinaUBlagajni!=null) ? Alati::hrIznos(number_format($gotovinaUBlagajni, 2)) : null;			
			$racunBanke = Alati::hrIznos(number_format($racunBanke, 2));
			$ukupnoStanje = Alati::hrIznos(number_format($ukupnoStanje, 2));
			$investicije = ($_POST["investicije"]!=null) ? Alati::hrIznos(number_format($_POST["investicije"], 2)) : null;
			$redovitiZivot = ($_POST["redovitiZivot"]!=null) ? Alati::hrIznos(number_format($_POST["redovitiZivot"], 2)) : null;
		?>
		
		<table style="margin: 0 auto 40px auto;">
					<tbody>
						<tr>
							<td>Gotovina u blagajni</td>
							<td><?= $gotovinaUBlagajni ?></td>
						</tr>
						<tr>
							<td>Na računu banke</td>
							<td><?= $racunBanke ?></td>
						</tr>
						<tr>
							<td>UKUPNO STANJE</td>
							<td><?= $ukupnoStanje ?></td>
						</tr>
						<tr>
							<td>Od ukupnog stanja investicijska sredstva</td>
							<td><?= $investicije ?></td>
						</tr>
						<tr>
							<td>Od ukupnog stanja sredstva redovitog života</td>
							<td><?= $redovitiZivot ?></td>
						</tr>
					</tbody>
				</table>		
		<?= Html::Button('Zatvori', array('button','alert','siroko'),array('onclick'=>'window.close();')); ?>			
	</div>
</div>

<?php
include_once '../../masters/masterBottom.php';
}
?>