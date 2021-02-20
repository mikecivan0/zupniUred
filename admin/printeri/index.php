<?php
include_once '../../config/conf.php';
include_once '../../kontrole/isAdmin.php';
include_once '../../alati/Html.php';
$title = 'Printeri';
$bodyClass = 'matrix';
$footerScript = '<script src="' . $putanjaApp . 'js/admin/printeri/nadjiPrinterZaUpdate.js"></script>
				 <script src="' . $putanjaApp . 'js/admin/printeri/spremiPromjene.js"></script>';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
?>
<div class="row">
	<div class="large-1 columns large-centered mt15 mb15">	
		<a href="novi.php"><img src="<?= $putanjaApp ?>img/admin/new.png" alt="novo" /></a>
	</div>
	<div class="large-12 columns crnaPozadina">
		<fieldset>
			<legend>Pretraga printera</legend>
			<?= Html::Input('Upišite par slova printera kojeg tražite', 'text', 'printer', 'printer',null,null,null,array('autofocus'=>'autofocus')) ?>
		</fieldset>
	</div>
	<div class="large-12 columns crnaPozadina">
		<fieldset>
			<legend>Rezultat pretrage</legend>
			<?= Html::Input(null, 'hidden', 'hfPrinterId', 'hfPrinterId',null,null,null,null,false) ?>
			<?= Html::InputSaGreskom($greske, 'nazivPrintera', 'Naziv printera', null, 'text') ?>
		</fieldset>
		<div class="row">
				<div class="large-10 columns">
					<?= Html::Button('Spremi', array('siroko','secondary','spremi','round'),array('onclick'=>'spremi();'),array('display'=>'none')) ?>
				</div>
				<div class="large-2 columns">
					<a id="brisanje"><img  class="spremi pt0 right" style="display: none;" src="../../img/admin/bin.png" /></a>
				</div>
		</div>
	</div>
</div>

<?php
	include_once '../../masters/masterBottom.php';
?>