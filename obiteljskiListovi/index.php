<?php
include_once '../config/conf.php';
include_once '../kontrole/isLogged.php';
$prezime = null;
$adresa = null;
$telefon = null;
$dosliIz = null;
$lukna = null;
if($_POST){
	include_once '../kontrole/obiteljskiListovi/novi.php';
	if(!empty($greske)){
		$prezime = $_POST["prezime"];
		$adresa = $_POST["adresa"];
		$telefon = $_POST["telefon"];
		$dosliIz = $_POST["dosliIz"];
		$lukna = $_POST["lukna"];
	}else{
		include_once '../sql/obiteljskiListovi/novi.php';
		header('location: promjena.php?id=' . $noviOLId);
	}
}
include_once '../alati/Html.php';
$title = 'Obiteljski listovi';
$bodyClass = 'papinskaZastava';
$footerScript .= '<script src="' . $putanjaApp . 'js/obiteljskiListovi/nadjiOL.js"></script>';
include_once '../sql/formulari/dohvatiZupe.php';
include_once '../alati/Alati.php';
include_once '../masters/masterHead.php';
include_once '../config/izbornik.php';
?>
<div class="row mt40">
	<div class="large-12 columns polja">
		<div class="row">
			<div class="large-12 columns center">
				<h3 class="plavaSlova"><i>Pretražite obiteljske listove</i></h3>
			</div>
			<hr>
			<div class="row">
				<div class="large-10 columns">
					<?= Html::Input('<b>Pretraga obiteljskih listova svih Vaših župa</b> (pretraga po imenu ili prezimenu jednoga od članova)', 'text', 'obiteljskiList', 'obiteljskiList') ?>
				</div>
				<div class="large-2 columns">
					<?= Html::Submit('Nađi', array('siroko','mt20'),array('id'=>'gumbPretrage')) ?>
				</div>
					<?= Html::Input(null, 'hidden', 'hfOlId', 'hfOlId', null, null, null, null, false) ?>
			</div>
			<hr />
			<div class="large-12 columns center mt40">
				<h3 class="plavaSlova"><i>Započnite kreiranje novog obiteljskog lista</i></h3>
			</div>
			<div class="large-12 columns">
				<form method="POST" action="<?= $_SERVER["PHP_SELF"] ?>" class="mt40">
					<fieldset class="polja">
						<legend>
							Novi obiteljski list
						</legend>
						<div class="row">
							<div class="large-8 columns end">
								<h5><u>Označite župu čije podatke želite koristiti</u></h5>
								<?php
								if(!$_POST){
									$footerScript .= '<script src="' . $putanjaApp . 'js/skripteStranica/oznaciPrviRadioButton.js"></script>';   
								}						                    					                	
												
								foreach ($zupe as $zupa): ?>							
									<input type="radio" name="zupa" id="zupa<?= $zupa -> id ?>" nazivZupe="<?= $zupa -> nazivZupe ?>" 
									value="<?= $zupa -> id ?>"
									<?= ($_POST&&$_POST["zupa"]==$zupa->id) ? "checked=\"checked\"" : null ?> />
									<?= $zupa -> nazivZupe . ", " . $zupa -> nazivMjesta ?>
									<br>   
								<?php endforeach; ?>
							</div>	                
						</div>
						<div class="row">
							<div class="large-12 columns" id="osnovniPodaci">
								<?php
								include_once 'osnovniPodaci.php';
								?>
							</div>
						</div>
						<div class="row mb40 mt40">
							<div class="large-12 columns">
								<?= Html::Submit('Spremi', array('siroko', 'secondary', 'spremi', 'round', 'button')) ?>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
include_once '../masters/masterBottom.php';
?>