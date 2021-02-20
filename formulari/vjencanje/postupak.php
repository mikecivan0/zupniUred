<?php
include_once '../../config/conf.php';
include_once '../../kontrole/dozvola.php';
include_once '../../alati/Html.php';
$title = 'Postupak za ženidbu';
$legend = 'Postupak za ženidbu';
$formId = 'postupakZaZenidbu';
$postURL = $putanjaApp . 'printanje/vjencanje/postupak.php?vrstaDokumenta=4&stranica=1';
$bodyClass = 'papinskaZastava';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
?>
<div class="row mt15">
	<div class="large-7 large-centered columns">
		<ul class="tabs" data-tab>
			<li class="tab-title active">
				<a id="1" href="#stranica1">Stranica 1</a>
			</li>
			<li class="tab-title">
				<a id="2" href="#stranica2">Stranica 2</a>
			</li>
			<li class="tab-title">
				<a id="3" href="#stranica3">Stranica 3</a>
			</li>
			<li class="tab-title">
				<a id="4" href="#stranica4">Stranica 4</a>
			</li>
		</ul>
	</div>
</div>
<?php include_once '../osnovaDokumentaTop.php'; 
		Html::Input(null, 'hidden', 'hfStranica', 'hfStranica',null,null,1,null,false)
?>
<div class="tabs-content">
	<div class="content active" id="stranica1">
		<div class="row">
	         <div class="large-2 end columns">
	            <?php Html::Input("Broj", "text", "brojDokumenta", "brojDokumenta") ?> 
	                     
	         </div>	         
     	</div>	
     	<div class="row">
     		<?php include_once 'postupakStr1.php'; ?>
     	</div>	
	</div>
	<div class="content" id="stranica2">
		<div class="row">
     		<?php include_once 'postupakStr2.php'; ?>
     	</div>
	</div>
	<div class="content" id="stranica3">
		<div class="row">
     		<?php include_once 'postupakStr3.php'; ?>
     	</div>
	</div>
	<div class="content" id="stranica4">
		<div class="row">
     		<?php include_once 'postupakStr4.php'; ?>
     	</div>
	</div>
</div>
<?php
include_once '../osnovaDokumentaBottom.php'; 
$footerScript = $footerScript . '<script src="' . $putanjaApp . 'js/skripteStranica/vjencanje/postupak.js"></script>';
include_once '../../masters/masterBottom.php';
?>