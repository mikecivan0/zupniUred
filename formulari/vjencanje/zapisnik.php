<?php
include_once '../../config/conf.php';
include_once '../../kontrole/dozvola.php';
include_once '../../alati/Html.php';
$title = 'Zapisnik o prijašnjoj ženidbenoj vezi ili izvanbračnoj zajednici';
$legend = 'Zapisnik o prijašnjoj ženidbenoj vezi ili izvanbračnoj zajednici';
$formId = 'zapisnik';
$postURL = $putanjaApp . 'printanje/vjencanje/zapisnik.php?vrstaDokumenta=10&stranica=1';
$bodyClass = 'papinskaZastava';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
?>
<div class="row mt15">
	<div class="large-4 large-centered columns center">
		<ul class="tabs" data-tab>
			<li class="tab-title active">
				<a id="1" href="#stranica1">Stranica 1</a>
			</li>
			<li class="tab-title">
				<a class="pl55" id="2" href="#stranica2">Stranica 2</a>
			</li>
		</ul>
	</div>
</div>
<?php include_once '../osnovaDokumentaTop.php'; 
	  Html::Input('hfStranica', 'hidden', 'hfStranica', 'hfStranica','','',1,'',false);
?>
<div class="tabs-content">
	<div class="content active" id="stranica1">
		<div class="row">
	         <div class="large-2 end columns">
	            <?php Html::Input("Broj", "text", "brojDokumenta", "brojDokumenta") ?> 
	                     
	         </div>	         
     	</div>	
     	<div class="row">
     		<?php include_once 'zapisnikStr1.php'; ?>
     	</div>	
	</div>
	<div class="content" id="stranica2">
		<div class="row">
     		<?php include_once 'zapisnikStr2.php'; ?>
     	</div>
	</div>
</div>
<?php
include_once '../osnovaDokumentaBottom.php';
$footerScript = $footerScript . '<script src="' . $putanjaApp . 'js/skripteStranica/vjencanje/zapisnik.js"></script>';
include_once '../../masters/masterBottom.php';
?>