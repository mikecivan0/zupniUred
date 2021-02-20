<?php
include_once '../../config/conf.php';
include_once '../../kontrole/dozvola.php';
include_once '../../alati/Html.php';
$title = 'Potvrdnica';
$legend = 'Potvrdnica';
$formId = 'potvrdnica';
$postURL = $putanjaApp . 'printanje/ostalo/potvrdnica.php?vrstaDokumenta=17';
$bodyClass = 'papinskaZastava';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
?>
<div class="row mt40 polja">
	<div class="large-12 columns">
		<?= Html::Input('<b>Učitajte podatke iz matica</b> (pretraga po prezimenu i/ili prezimenu osobe)', 'text', 'zapis', 'zapis') ?>
	</div>
</div>
<?php
include_once '../osnovaDokumentaTop.php';
?>
	 
    <div class="row">
    		<div class="large-2 end columns">
				<?php Html::Input("Broj", "text", "brojDokumenta", "brojDokumenta") ?>
			</div>
            <div class="large-12 columns">
				<?php Html::Input("Ovim se potvrđuje da je (ime i prezime)", "text", "imePrezime", "imePrezime") ?>
            </div>     
			<div class="large-2 columns">
				<?php Html::Select("Sin/kći", "spol", "spol", null, array(array('value'=>'1','text'=>'Sin'),array('value'=>'0','text'=>'Kći'))) ?>
			</div>
			<div class="large-5 columns">
				<?php Html::Input("Ime i prezime oca", "text", "otac", "otac") ?>
            </div>
            <div class="large-5 columns">
				<?php Html::Input("Ime i djev. prezime majke", "text", "majka", "majka") ?>
            </div>       
    </div>
    <div class="row">    
            <div class="large-6 columns">
				<?php Html::Input("Rođen(a) - datum i mjesto", "text", "rodjen", "rodjen") ?>
            </div>
            <div class="large-6 columns">
				<?php Html::Input("Kršten(a) - datum i mjesto", "text", "krsten", "krsten") ?>
            </div>
            <div class="large-6 columns">
				<?php Html::Input("Pričešćen(a)", "text", "datumPricesti", "datumPricesti") ?>
            </div>
            <div class="large-6 columns">
				<?php Html::Input("Potvrđen(a)", "text", "datumPotvrde", "datumPotvrde") ?>
            </div>
            <div class="large-6 columns end">
				<?php Html::Input("Crkveno vjenčan(a)", "text", "datumVjencanja", "datumVjencanja") ?>
            </div>
            <hr />
            <div class="large-9 columns">
				<?php Html::Input("U", "text", "mjesto", "mjesto") ?>
            </div>
            <div class="large-3 columns end">
				<?php Html::Input("Datum", "date", "datum", "datum",null,null,date("Y-m-d")) ?>
            </div>
    </div>
<?php 
include_once '../osnovaDokumentaBottom.php'; 
$footerScript = $footerScript . '<script src="' . $putanjaApp . 'js/skripteStranica/ostalo/potvrdnica.js"></script>';
include_once '../../masters/masterBottom.php';
?>