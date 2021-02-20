<?php
include_once '../../config/conf.php';
include_once '../../kontrole/dozvola.php';
include_once '../../alati/Html.php';
$title = 'Posvjedočenje';
$legend = 'Posvjedočenje';
$formId = 'posvjedocenje';
$postURL = $putanjaApp . 'printanje/ostalo/posvjedocenje.php?vrstaDokumenta=16';
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
           <div class="large-6 columns">
				<?php Html::Input("Rođen(a) - datum i mjesto", "text", "rodjen", "rodjen") ?>
            </div>
            <div class="large-6 columns">
				<?php Html::Input("Kršten(a) - datum i mjesto", "text", "krsten", "krsten") ?>
            </div>
            <div class="large-6 columns">
				<?php Html::Input("Potvrđen(a)", "text", "datumPotvrde", "datumPotvrde") ?>
            </div>
            <div class="large-6 columns">
				<?php Html::Input("Crkveno vjenčan(a)", "text", "datumVjencanja", "datumVjencanja") ?>
            </div>           
			<div class="large-4 columns">
				<?php Html::Select("da je prikladan/prikladna za kumovanje", "spol", "spol", null, array(array('value'=>'1','text'=>'Prikladan'),array('value'=>'0','text'=>'Prikladna'))) ?>
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
$footerScript = $footerScript . '<script src="' . $putanjaApp . 'js/skripteStranica/ostalo/posvjedocenje.js"></script>';
include_once '../../masters/masterBottom.php';
?>