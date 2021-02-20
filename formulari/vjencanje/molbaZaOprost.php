<?php
include_once '../../config/conf.php';
include_once '../../kontrole/dozvola.php';
include_once '../../alati/Html.php';
$title = 'Molba za oprost od zapreke različitosti vjere';
$legend = 'Molba za oprost od zapreke različitosti vjere';
$formId = 'molbaZaOprost';
$postURL = $putanjaApp . 'printanje/vjencanje/molbaZaOprost.php?vrstaDokumenta=9';
$bodyClass = 'papinskaZastava';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
include_once '../osnovaDokumentaTop.php';
include_once '../../sql/formulari/dohvatiOrdinarijat.php';
if($_POST&&isset($_GET["katolik"])){
	include_once '../../klase/formulari/molbaZaOprost.php';
	MolbaZaOprost::ConvertPost($_GET["katolik"]);
}
?>
<div class="row mb40">
	<div class="large-2 end columns">
		<?php Html::Input("Broj", "text", "brojDokumenta", "brojDokumenta") ?>
		
	</div>
</div>

<div class="row">
	<div class="large-8 large-centered columns pb40">
		<?php Html::Input('Nad/Biskupskom ordinarijatu', 'text', 'ordinarijat', 'ordinarijat',null,null,$ordinarijat)
		?>
	</div>
	<div class="large-7 columns end">
		<?php Html::Input('Ime i prezime katoličke osobe', 'text', 'imeIPrezimeKatolik', 'imeIPrezimeKatolik')
		?>
	</div>
	<div class="large-7 columns">
		<?php Html::Input('Ime i prezime nekrštene osobe', 'text', 'imeIPrezimeNekatolik', 'imeIPrezimeNekatolik')
		?>
	</div>
	<div class="large-12 columns pt40">
		<?php Html::Textarea('Razlog', 'razlog', 'razlog',null,array('width'=>'540px','height'=>'85px !important'),null,null)
		?>
	</div>
	<div class="large-3 columns end pt60">
		<?php Html::Input("Datum", "date", "datum", "datum",null,null,date("Y-m-d")) 
		?>
	</div>
</div>
<?php
include_once '../osnovaDokumentaBottom.php';
$footerScript = $footerScript . '<script src="' . $putanjaApp . 'js/skripteStranica/vjencanje/molbaZaOprost.js"></script>';
include_once '../../masters/masterBottom.php';
?>