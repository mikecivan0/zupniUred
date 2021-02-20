<?php
include_once '../../config/conf.php';
include_once '../../kontrole/dozvola.php';
include_once '../../alati/Html.php';
$title = 'Krsni list';
$legend = 'Krsni list';
$formId = 'krsniList';
$postURL = $putanjaApp . 'printanje/krstenje/krsniList.php?vrstaDokumenta=1';
$bodyClass = 'papinskaZastava';
$zaglavljeDokumenta = 'U Matici krštenih rimokatoličke župe';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php'; ?>
<div class="row mt40 polja">
	<div class="large-12 columns">
		<?= Html::Input('<b>Učitajte zapis iz matica krštenih svih Vaših župa</b> (pretraga po imenu i/ili prezimenu osobe)', 'text', 'zapis', 'zapis') ?>
	</div>
</div>
<?php
include_once '../osnovaDokumentaTop.php';
?>

<div class="row">	
	<div class="large-3 columns end">
		<?php Html::Input("Datum krštenja", "date", "datumKrstenja", "datumKrstenja") ?>
	</div>
	<div class="large-10 columns">
		<?php Html::Input("Ime", "text", "ime", "ime") ?>
	</div>
	<div class="large-2 columns">
		<?php Html::Select("Sin/kći", "spol", "spol", null, array(array('value'=>'1','text'=>'Sin'),array('value'=>'0','text'=>'Kći'))) ?>
	</div>
	<div class="large-12 columns">
		<?php Html::Input("Prezime", "text", "prezime", "prezime")?>
	</div>
	<div class="large-3 columns">
		<?php Html::Input("Datum rođenja", "date", "datumRodjenja", "datumRodjenja") ?>
	</div>
	<div class="large-12 columns">
		<?php Html::Input("Mjesto rođenja", "text", "mjestoRodjenja", "mjestoRodjenja") ?>
	</div>
	<div class="large-12 columns">
		<?php Html::Input("Jedinstveni matični broj građana", "number", "jmbg", "jmbg") ?>
	</div>
	<div class="large-12 columns">
		<?php Html::Input("Otac (ime, prezime, vjera)", "text", "otac", "otac") ?>
	</div>
	<div class="large-12 columns">
		<?php Html::Input("Majka (ime, djev. prezime, vjera)", "text", "majka", "majka") ?>
	</div>
	<div class="large-3 columns end">
		<?php Html::Select("Roditelji kanonski vjenčani", "roditeljiVjencani", "roditeljiVjencani", null, array(array('value'=>'Da','text'=>'Da'),array('value'=>'Ne','text'=>'Ne'))) ?>
	</div>
	<div class="large-12 columns">
		<?php Html::Input("Prebivalište (adresa)", "text", "prebivaliste", "prebivaliste") ?>
	</div>
	<div class="large-12 columns">
		<?php Html::Input("Kum-a (ime, prezime)", "text", "kum", "kum") ?>
	</div>
	<div class="large-12 columns">
		<?php Html::Input("Krstitelj (ime, prezime, služba)", "text", "krstitelj", "krstitelj")	?>
	</div>
	<div class="large-12 columns mb15">
		<?php Html::Textarea("Naknadni upisi i bilješke (mjesto i datum potvrde; župa i datum ženidbe; ime supruga-e i ostale bilješke)", "zabiljeske", "zabiljeske") ?>	
	</div>
	<div class="large-3 columns end">
		<?php Html::Input("Datum", "date", "datum", "datum",null,null,date("Y-m-d")) ?>
	</div>
</div>
<?php
include_once '../osnovaDokumentaBottom.php';
$footerScript = $footerScript . '<script src="' . $putanjaApp . 'js/skripteStranica/krstenje/krsniList.js"></script>';
include_once '../../masters/masterBottom.php';
?>