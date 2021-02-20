<?php
include_once '../../config/conf.php';
include_once '../../kontrole/dozvola.php';
include_once '../../alati/Html.php';
$title = 'Izvadak iz Knjige primljenih u potpuno zajedništvo Katoličke crkve';
$legend = 'Izvadak iz Knjige primljenih u potpuno zajedništvo Katoličke crkve';
$formId = 'izvadakPrimljenih';
$postURL = $putanjaApp . 'printanje/izvadci/izvadakPrimljenih.php?vrstaDokumenta=15';
$bodyClass = 'papinskaZastava';
$zaglavljeDokumenta = 'U Knjizi primljenih rimokatoličke župe';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
include_once '../osnovaDokumentaTop.php';
?>

<div class="row">
	<div class="large-3 columns end">
		<?php Html::Input("Datum primanja", "date", "datumPrimanja", "datumPrimanja") ?>
	</div>
	<div class="large-12 columns">
		<?php Html::Input("Ime, prezime, zanimanje", "text", "imePrezimeZanimanje", "imePrezimeZanimanje") ?>
	</div>
	<div class="large-9 columns">
		<?php Html::Input("Datum rođenja", "date", "datumRodjenja", "datumRodjenja") ?>
	</div>
	<div class="large-3 columns">
		<?php Html::Select("Muško/žensko", "spol", "spol", null, array(array('value'=>'1','text'=>'Muško'),array('value'=>'0','text'=>'Žensko'))) ?>
	</div>
	<div class="large-12 columns">
		<?php Html::Input("Mjesto rođenja", "text", "mjestoRodjenja", "mjestoRodjenja") ?>
	</div>
	<div class="large-12 columns">
		<?php Html::Input("Otac (ime, prezime, vjera)", "text", "otac", "otac") ?>
	</div>
	<div class="large-12 columns">
		<?php Html::Input("Majka (ime, djev. prezime, vjera)", "text", "majka", "majka") ?>
	</div>
	<div class="large-12 columns">
		<?php Html::Input("Kršćanska zajednica krštenja", "text", "zajednica", "zajednica") ?>
	</div>
	<div class="large-12 columns">
		<?php Html::Input("Mjesto i datum krštenja", "text", "mjestoIDatum", "mjestoIDatum") ?>
	</div>
	<div class="large-12 columns">
		<?php Html::Input("Svjedok (ime, prezime, vjera)", "text", "svjedok1", "svjedok1") ?>
	</div>
	<div class="large-12 columns">
		<?php Html::Input("Svjedok (ime, prezime, vjera)", "text", "svjedok2", "svjedok2") ?>
	</div>
	<div class="large-12 columns">
		<?php Html::Input("Primatelj (ime, prezime, služba)", "text", "primatelj", "primatelj")	?>
	</div>
	<div class="large-12 columns mb15">
		<?php Html::Textarea("Napomene, upisi i biljeske", "napomene", "napomene") ?>	
	</div>
	<div class="large-3 columns end">
		<?php Html::Input("Datum", "date", "datum", "datum",null,null,date("Y-m-d")) ?>
	</div>
</div>
<?php
include_once '../osnovaDokumentaBottom.php';
$footerScript = $footerScript . '<script src="' . $putanjaApp . 'js/skripteStranica/izvadci/izvadakPrimljenih.js"></script>';
include_once '../../masters/masterBottom.php';
?>