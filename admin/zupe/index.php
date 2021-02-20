<?php
include_once '../../config/conf.php';
include_once '../../kontrole/isAdmin.php';
include_once '../../alati/Html.php';
$title = 'Župe';
$bodyClass = 'matrix';
$footerScript = '<script src="' . $putanjaApp . 'js/admin/zupe/nadjiZupuZaUpdate.js"></script>
				 <script src="' . $putanjaApp . 'js/admin/printeri/nadjiPrinter.js"></script>
				 <script src="' . $putanjaApp . 'js/admin/biskupije/nadjiBiskupiju.js"></script>
				 <script src="' . $putanjaApp . 'js/admin/mjesta/nadjiMjesto.js"></script>
				 <script src="' . $putanjaApp . 'js/admin/zupe/spremiPromjene.js"></script>';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
?>
<div class="row">
	<div class="large-1 columns large-centered mt15 mb15">	
		<a href="nova.php"><img src="<?= $putanjaApp ?>img/admin/new.png" alt="novo" /></a>
	</div>
	<div class="large-12 columns crnaPozadina">
		<fieldset>
			<legend>Pretraga župa</legend>
			<?= Html::Input('Upišite par slova tražene župe ili mjesta u kojem se župa nalazi', 'text', 'zupa', 'zupa',null,null,null,array('autofocus'=>'autofocus')) ?>
		</fieldset>
	</div>
	<div class="large-12 columns crnaPozadina">
		<fieldset>
			<legend>Rezultat pretrage</legend>
			<?= Html::Input(null, 'hidden', 'hfZupaId', 'hfZupaId',null,null,null,null,false) ?>
			<?= Html::Input(null, 'hidden', 'hfMjestoId', 'hfMjestoId',null,null,null,null,false) ?>
			<?= Html::Input(null, 'hidden', 'hfBiskupijaId', 'hfBiskupijaId',null,null,null,null,false) ?>
			<?= Html::Input(null, 'hidden', 'hfPrinterId', 'hfPrinterId',null,null,null,null,false) ?>
			<?= Html::Input('Naziv župe', 'text', 'nazivZupe', 'nazivZupe') ?>
			<?= Html::Input('Adresa ureda', 'text', 'adresaUreda', 'adresaUreda') ?>
			<?= Html::Input('Mjesto', 'text', 'mjesto', 'mjesto') ?> 
			<?= Html::Input('Telefon', 'text', 'telefon', 'telefon') ?>
			<?= Html::Input('Printer', 'text', 'printer', 'printer') ?>
			<?= Html::Input('Biskupija', 'text', 'biskupija', 'biskupija') ?>
			<div class="large-6 columns large-centered">
				
					<?= Html::Input(null, 'button', null, 'gumbFilijala', array('button','round','alert','siroko','uredjivanjeFilijala'),array('display'=>'none'),									'Uredi popis filijala',false) ?>			
				
			</div>		
		</fieldset>
			<div class="row">
				
				<div class="large-10 columns">
					<?= Html::Button('Spremi', array('siroko','secondary','spremi','round'), array('onclick'=>'spremi();'),array('display'=>'none')) ?>
				</div>
				<div class="large-2 columns">
					<a id="brisanje"><img class="spremi pt0 right" style="display: none;" src="../../img/admin/bin.png" /></a>
				</div>
			</div>

	</div>
</div>

<?php
	include_once '../../masters/masterBottom.php';
?>