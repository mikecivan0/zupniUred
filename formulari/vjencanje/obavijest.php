<?php
include_once '../../config/conf.php';
include_once '../../kontrole/dozvola.php';
include_once '../../alati/Html.php';
$title = 'Obavijest o sklopljenoj ženidbi';
$legend = 'Obavijest o sklopljenoj ženidbi';
$formId = 'obavijest';
$postURL = $putanjaApp . 'printanje/vjencanje/obavijest.php?vrstaDokumenta=13&dio=gornji';
$bodyClass = 'papinskaZastava';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
?>
<div class="row mt15">
	<div class="large-4 large-centered columns center">
		<ul class="tabs" data-tab>
			<li class="tab-title active">
				<a id="gornji" href="#dioStranice1">Gornji dio</a>
			</li>
			<li class="tab-title">
				<a class="pl55" id="donji" href="#dioStranice2">Donji dio</a>
			</li>
		</ul>
	</div>
</div>
<?php
include_once '../osnovaDokumentaTop.php';
Html::Input('hfDio', 'hidden', 'hfDio', 'hfDio', '', '', 'gornji', '', false);
?>
<div class="tabs-content">
	<div class="row">
		<div class="large-2 end columns">
			<?php Html::Input("Broj", "text", "brojDokumenta", "brojDokumenta") ?>
			
		</div>
	</div>
	<div class="row">
		<div class="large-8 large-centered columns">
			<?php Html::Input('Župnom uredu', 'text', 'zupnomUredu', 'zupnomUredu','','','','',true)
			?>
		</div>
	</div>
	<div class="content active" id="dioStranice1">
		<div class="row">
			<?php
			include_once 'obavijestGornjiDio.php';
			?>
		</div>
	</div>
	<div class="content" id="dioStranice2">
	</div>
	<div class="row">
		<div class="large-3 end columns">
			<?php Html::Input('Datum', 'date', 'datum', 'datum','','',date("Y-m-d"),'',true)
			?>
		</div>
	</div>
</div>
<?php
include_once '../osnovaDokumentaBottom.php';
$footerScript = $footerScript . '<script src="' . $putanjaApp . 'js/skripteStranica/vjencanje/obavijest.js"></script>';
include_once '../../masters/masterBottom.php';
?>