<?php
include_once '../../config/conf.php';
include_once '../../kontrole/dozvola.php';
include_once '../../alati/Html.php';
$title = 'Dopuštenje za sklapanje ženidbe izvan vlastite župe';
$legend = 'Dopuštenje za sklapanje ženidbe izvan vlastite župe';
$formId = 'dopustenje';
$postURL = $putanjaApp . 'printanje/vjencanje/dopustenje.php?vrstaDokumenta=6';
$bodyClass = 'papinskaZastava';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
include_once '../osnovaDokumentaTop.php';
?>
<div class="row mb40">
	<div class="large-2 end columns">
		<?php Html::Input("Broj", "text", "brojDokumenta", "brojDokumenta") ?>
		
	</div>
</div>

<div class="row">

	<h5 class="siroko center"><i>Zaručnik</i></h5>

	<div class="large-12 columns">
		<?php Html::Input('Zaručnik', 'text', 'zarucnik', 'zarucnik')
		?>
	</div>
	<div class="large-3 columns end">
		<?php Html::Input('Rođen dana', 'date', 'datumRodjenjaOn', 'datumRodjenjaOn')
		?>
	</div>
	<div class="large-9 columns">
		<?php Html::Input('Nastanjen u', 'text', 'mjestoOn', 'mjestoOn')
		?>
	</div>
	<div class="large-10 columns">
		<?php Html::Input('ulica', 'text', 'ulicaOn', 'ulicaOn')
		?>
	</div>
	<div class="large-2 columns">
		<?php Html::Input('broj', 'text', 'brojOn', 'brojOn')
		?>
	</div>

	<hr />
	<h5 class="siroko center"><i>Zaručnica</i></h5>

	<div class="large-12 columns">
		<?php Html::Input('Zaručnica', 'text', 'zarucnica', 'zarucnica')
		?>
	</div>
	<div class="large-3 columns end">
		<?php Html::Input('Rođena dana', 'date', 'datumRodjenjaOna', 'datumRodjenjaOna')
		?>
	</div>
	<div class="large-9 columns">
		<?php Html::Input('Nastanjena u', 'text', 'mjestoOna', 'mjestoOna')
		?>
	</div>
	<div class="large-10 columns">
		<?php Html::Input('ulica', 'text', 'ulicaOna', 'ulicaOna')
		?>
	</div>
	<div class="large-2 columns">
		<?php Html::Input('broj', 'text', 'brojOna', 'brojOna')
		?>
	</div>

	<hr />
	<div class="large-3 columns end">
		<?php Html::Input("Datum", "date", "datum", "datum",null,null,date("Y-m-d")) 
		?>
	</div>
</div>
<?php
include_once '../osnovaDokumentaBottom.php';
$footerScript = $footerScript . '<script src="' . $putanjaApp . 'js/skripteStranica/vjencanje/dopustenje.js"></script>';
include_once '../../masters/masterBottom.php';
?>