<?php
include_once '../config/conf.php';
include_once '../kontrole/isLogged.php';
include_once '../alati/Html.php';
$title = 'Osobni podaci';
$footerScript .= '<script src="' . $putanjaApp . 'js/profil/nadjiMjesto.js"></script>';
$bodyClass = ($podaci -> razina < 3) ? "papinskaZastava" : "matrix";
$pozadina = ($podaci -> razina < 3) ? "polja" : "crnaPozadina";

if (isset($_POST) && isset($_POST["ime"])) {
	include_once '../kontrole/profil/spremiPromjeneOsobnihPodataka.php';
	if (empty($greske)) {
		include_once '../sql/profil/spremiPromjeneOsobnihPodataka.php';
	}
}
include '../sql/profil/nadjiOsobnePodatke.php';

include_once '../masters/masterHead.php';
include_once '../config/izbornik.php';
?>
<div class="row mt40">
	<div class="large-12 columns">
		<?php if(strlen($porukaOSpremanju)>0){
		?>
		<div class="large-10 large-centered columns">
			<div data-alert="" class="alert-box alert round center">
				<?php echo $porukaOSpremanju; ?>
				<a href="" class="close">×</a>
			</div>
		</div>
		<?php } ?>
		<form method="POST" action="<?= $_SERVER["PHP_SELF"] ?>" class="mt40">
			<fieldset class="<?= $pozadina ?>">
				<legend>
					Osobni podaci
				</legend>
				<?= Html::InputSaGreskom($greske, 'ime', 'Ime', $osoba -> ime,'text') ?>
				<?= Html::InputSaGreskom($greske, 'prezime', 'Prezime', $osoba -> prezime,'text') ?>
				<?= Html::InputSaGreskom($greske, 'email', 'Email', $osoba -> email,'text') ?>
				<?= Html::Input('Mjesto prebivanja', 'text', 'mjestoPrebivanja', 'mjestoPrebivanja', null, null, $osoba -> mjestoPrebivanja) ?>
				<?= Html::Input('Ulica', 'text', 'ulica', 'ulica', null, null, $osoba -> ulica) ?>
				<?= Html::Input('Kućni broj', 'text', 'kucniBroj', 'kucniBroj', null, null, $osoba -> kucniBroj) ?>
				<?= Html::Input('JMBG', 'text', 'jmbg', 'jmbg', null, null, $osoba -> jmbg) ?>
				<?= Html::Input('OIB', 'text', 'oib', 'oib', null, null, $osoba -> oib) ?>
			</fieldset>
			<div class="row">
				<div class="large-12 columns mb40">
					<?= Html::Submit('Spremi', array('button','round','secondary','siroko')) ?>
				</div>
			</div>
		</form>
	</div>
</div>
<?php
include_once '../masters/masterBottom.php';
?>