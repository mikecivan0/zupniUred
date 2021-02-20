<?php
include_once '../../config/conf.php';
include_once '../../kontrole/isAdmin.php';
include_once '../../alati/Html.php';
$title = 'Osobe';
$bodyClass = 'matrix';
$footerScript = '<script src="' . $putanjaApp . 'js/admin/osobe/nadjiOsobu.js"></script>
 				 <script src="' . $putanjaApp . 'js/admin/osobe/nadjiMjesto.js"></script>
				 <script src="' . $putanjaApp . 'js/admin/osobe/spremiPromjene.js"></script>';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
?>
<div class="row">
	<div class="large-1 columns large-centered mt15 mb15">
		<a href="nova.php"><img src="<?= $putanjaApp ?>img/admin/new.png" alt="novo" /></a>
	</div>
	<div class="large-12 columns crnaPozadina">
		<fieldset>
			<legend>
				Pretraga osoba
			</legend>
			<?= Html::Input('Upišite par slova imena/prezimena osobe koju tražite', 'text', 'osoba', 'osoba', null, null, null, array('autofocus' => 'autofocus')) ?>
		</fieldset>
	</div>
	<div class="large-12 columns crnaPozadina end">
		<fieldset class="podaci" style="display: none;">
			<legend>
				Rezultat pretrage
			</legend>
			<?= Html::Input(null, 'hidden', 'osoba_id', 'osoba_id', null, null, null, null, false) ?>
			<?= Html::InputSaGreskom($greske, 'ime', 'Ime', null, 'text') ?>
			<?= Html::InputSaGreskom($greske, 'prezime', 'Prezime', null, 'text') ?>
			<?= Html::Input('Djevojačko prezime', 'text', 'dPrezime', 'dPrezime') ?>
			<?= Html::Select('Spol', 'spol', 'spol', null, array(array('value'=>'1','id'=>'spol1','text'=>'Muško'),array('value'=>'0','id'=>'spol0','text'=>'Žensko'))) ?>
			<?= Html::Input('JMBG', 'text', 'jmbg', 'jmbg') ?>
			<?= Html::Input('OIB', 'text', 'oib', 'oib') ?>
			<?= Html::Input('Mjesto prebivališta', 'text', 'mjesto', 'mjesto') ?>
			<?= Html::Input('Ulica', 'text', 'ulica', 'ulica') ?>
			<?= Html::Input('Kućni broj', 'text', 'kucniBroj', 'kucniBroj') ?>
			<?= Html::Input('Email', 'email', 'email', 'email') ?>
			<?= Html::Input('Vjera', 'text', 'vjera', 'vjera') ?>
			<?= Html::Input('Zanimanje', 'text', 'zanimanje', 'zanimanje') ?>	
		</fieldset>
		<div class="row">
			<div class="large-10 columns">
				<?= Html::Button('Spremi', array('siroko', 'secondary', 'spremi'), array('onclick' => 'spremi()'), array('display' => 'none')) ?>
			</div>
			<div class="large-2 columns">
				<a id="brisanje"><img  class="right spremi pt0" style="display: none;" src="../../img/admin/bin.png" /></a>
			</div>
		</div>
	</div>
</div>

<?php
include_once '../../masters/masterBottom.php';
?>