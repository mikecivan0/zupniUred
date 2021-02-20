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
}
include_once '../../sql/financije/izvjesca/nadjiKvartale.php';
include_once '../../alati/Html.php';
$bodyClass = "papinskaZastava";
$title = 'Kvartalno izvješće';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
?>

<div class="row">
	<div class="large-12 columns mt15">
		<fieldset class="polja">
			<legend>Kvartalna izvješća župe <?= $zupa->nazivZupe ?></legend>	
				<form id="forma" target="_blank" method="POST" action="izradaKvartalnogIzvjesca.php?id=<?= $_GET["id"] ?>">
					<div class="row">
						<div class="large-12 columns">
							<label for="godinaIKvartal">Izbor godine i kvartala za koji se želi kreirati izvješće</label>
							<?= $select ?>
						</div>
						<div class="large-2 columns">
							<?= Html::Input('Broj', 'text', 'broj', 'broj') ?>
						</div>
						<div class="large-6 columns">
							<?= Html::Input('Mjesto', 'text', 'mjesto', 'mjesto') ?>
						</div>
						<div class="large-4 columns">
							<?= Html::Input('Datum', 'date', 'datum', 'datum') ?>
						</div>
					</div>
					
					<?= Html::Input(null, 'hidden', 'hfZupaId', 'hfZupaId', null, null, $_GET["id"]) ?>
				</form>				
		</fieldset>		
	</div>
</div>
<div class="row pt60">	
	<div class="large-2 columns end">
		<img id="previewImg" class="ml15" src="<?= $putanjaApp ?>img/print-preview.ico" alt="Pregled" />
	</div>
	<div class="large-2 columns end">
		<img id="printImg" class="ml35" id="print" src="<?= $putanjaApp ?>img/print.ico" alt="Ispis" />
	</div>
</div>
<?php
	$footerScript .= '<script src="' . $putanjaApp . 'js/financije/izvjesca/ispis/kvartalnoIzvjesce.js"></script>';
	include_once '../../masters/masterBottom.php';
?>