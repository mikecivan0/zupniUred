<?php
include_once '../../config/conf.php';
include_once '../../kontrole/isAdmin.php';
if(isset($_POST)&&isset($_POST["ime"])){
	$greske = array();
	include_once '../../kontrole/admin/osobe/nova.php';
	if(empty($greske)){
		echo "nema grešaka";
		include_once '../../sql/admin/osobe/nova.php';
	}	
}
$footerScript = '<script src="' . $putanjaApp . 'js/admin/osobe/nadjiMjesto.js"></script>';
$title = 'Nova osoba';
$bodyClass = 'matrix';
include_once '../../alati/Html.php';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';

?>
<div class="row mt40">
	<div class="large-12 columns">
		<form class="crnaPozadina" method="POST" action="<?= $_SERVER["PHP_SELF"] ?>">
			<fieldset>
				<legend><?= $title ?></legend>
				<?= Html::InputSaGreskom($greske, 'ime', 'Ime', null, 'text') ?>
				<?= Html::InputSaGreskom($greske, 'prezime', 'Prezime', null, 'text') ?>
				<?= Html::Input('Djevojačko prezime', 'text', 'dPrezime', 'dPrezime') ?>
				<?= Html::Select('Spol', 'spol', 'spol', null, array(array('value'=>'1','id'=>'spol1','text'=>'Muško'),array('value'=>'0','id'=>'spol0','text'=>'Žensko'))) ?>
				<?= Html::Input('JMBG', 'text', 'jmbg', 'jmbg') ?>
				<?= Html::Input('OIB', 'text', 'oib', 'oib') ?>
				<?= Html::InputSaGreskom($greske, 'mjesto', 'Mjesto prebivanja', null, 'text') ?>
				<?= Html::Input('Ulica', 'text', 'ulica', 'ulica') ?>
				<?= Html::Input('Kućni broj', 'text', 'kucniBroj', 'kucniBroj') ?>
				<?= Html::Input('Email', 'email', 'email', 'email') ?>
				<?= Html::Input('Vjera', 'text', 'vjera', 'vjera') ?>
				<?= Html::Input('Zanimanje', 'text', 'zanimanje', 'zanimanje') ?>	
			</fieldset>
			<?= Html::SpremiOdustani('index.php') ?>	
		</form>
	</div>
</div>

<?php
	include_once '../../masters/masterBottom.php';
?>