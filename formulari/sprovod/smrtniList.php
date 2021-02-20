<?php
include_once '../../config/conf.php';
include_once '../../kontrole/dozvola.php';
include_once '../../alati/Html.php';
$title = 'Smrtni list';
$legend = 'Smrtni list';
$formId = 'smrtniList';
$postURL = $putanjaApp . 'printanje/sprovod/smrtniList.php?vrstaDokumenta=14';
$bodyClass = 'papinskaZastava';
$zaglavljeDokumenta = 'U Matici umrlih rimokatoličke župe';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php'; ?>
<div class="row mt40 polja">
	<div class="large-12 columns">
		<?= Html::Input('<b>Učitajte zapis iz matica umrlih svih Vaših župa</b> (pretraga po prezimenu i/ili prezimenu preminulog)', 'text', 'zapis', 'zapis') ?>
	</div>
</div>
<?php
include_once '../osnovaDokumentaTop.php';
?>
	 
   <div class="row">
            <div class="large-3 columns end">
				<?php Html::Input("Datum smrti", "date", "datumSmrti", "datumSmrti") ?>
            </div>
            <div class="large-12 columns">
				<?php Html::Input("Mjesto smrti", "text", "mjestoSmrti", "mjestoSmrti") ?>
            </div>
            <div class="large-10 columns">
				<?php Html::Input("Ime", "text", "ime", "ime") ?>
            </div>
            <div class="large-2 columns">
            	<?php Html::Select("Muško/žensko", "spol", "spol", null, array(array('value'=>'1','text'=>'muško'),array('value'=>'0','text'=>'žensko'))) ?>
            </div>
            <div class="large-12 columns">
				<?php Html::Input("Prezime", "text", "prezime", "prezime")?>
            </div>
            <div class="large-12 columns">
				<?php Html::Input("Mjesto rođenja", "text", "mjestoRodjenja", "mjestoRodjenja") ?>
            </div>
            <div class="large-3 columns">
				<?php Html::Input("Datum rođenja", "date", "datumRodjenja", "datumRodjenja") ?>
            </div>
            <div class="large-12 columns">
				<?php Html::Input("Jedinstveni matični broj građana", "number", "jmbg", "jmbg") ?>
            </div>
            <div class="large-12 columns">
            	<?php Html::Input("Suprug-a (ime, prezime)", "text", "supruznik", "supruznik") ?>
            </div>
            <div class="large-12 columns">
				<?php Html::Input("Otac (ime, prezime, vjera)", "text", "otac", "otac") ?>
            </div>
            <div class="large-12 columns">
				<?php Html::Input("Majka (ime, djev. prezime, vjera)", "text", "majka", "majka") ?>
            </div>
            <div class="large-12 columns">
            	<?php Html::Input("Prebivalište (adresa prebivališta)", "text", "prebivaliste", "prebivaliste")?>
            </div>
            <div class="large-12 columns">
            	<?php Html::Input("Potvrđen-a sakramentima", "text", "sakramenti", "sakramenti")?>
            </div>
            <div class="large-12 columns">
            	<?php Html::Input("Mjesto i datum pokopa", "text", "mjestoIDatumPokopa", "mjestoIDatumPokopa")?>
            </div>
            <div class="large-12 columns">
            	<?php Html::Input("Crkveni službenik kod sprovoda", "text", "sluzbenik", "sluzbenik")?>
            </div>
            <div class="large-12 columns mb15">
            	<?php Html::Textarea("Bilješke", "zabiljeske", "zabiljeske") ?>	
            </div>
            <div class="large-3 columns end">
				<?php Html::Input("Datum", "date", "datum", "datum",null,null,date("Y-m-d")) ?>
            </div>
    </div>
<?php 
include_once '../osnovaDokumentaBottom.php'; 
$footerScript = $footerScript . '<script src="' . $putanjaApp . 'js/skripteStranica/sprovod/smrtniList.js"></script>';
include_once '../../masters/masterBottom.php';
?>