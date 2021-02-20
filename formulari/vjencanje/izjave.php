<?php
include_once '../../config/conf.php';
include_once '../../kontrole/dozvola.php';
include_once '../../alati/Html.php';
$title = 'Izjave i obećanja prigodom mješovite ženidbe';
$legend = 'Izjave i obećanja prigodom mješovite ženidbe';
$formId = 'izjave';
$postURL = $putanjaApp . 'printanje/vjencanje/izjave.php?vrstaDokumenta=7';
$bodyClass = 'papinskaZastava';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
include_once '../osnovaDokumentaTop.php';
if($_POST&&isset($_GET["katolik"])){
	include_once '../../klase/formulari/izjave.php';
	Izjave::ConvertPost($_GET["katolik"]);
}
?>
<div class="row mb40">
	<div class="large-2 end columns">
		<?php Html::Input("Broj", "text", "brojDokumenta", "brojDokumenta") ?>
		
	</div>
</div>

<div class="row">

	<h5 class="siroko center"><i>Katolička stranka</i></h5>

	<div class="large-12 columns">
		<?php Html::Input('Ime i prezime katoličke stranke', 'text', 'imeIPrezime1', 'imeIPrezime1')
		?>
	</div>
	<div class="large-8 columns">
		<?php Html::Input('Ime i prezime ne katoličke stranke', 'text', 'imeIPrezime2', 'imeIPrezime2')
		?>
	</div>
	<div class="large-4 columns">
		<?php Html::Input('Vjera ne katoličke stranke', 'text', 'vjera', 'vjera')
		?>
	</div>
	<div class="large-6 columns">
		<?php Html::Input('Mjesto', 'text', 'mjesto1', 'mjesto1')
		?>
	</div>
	<div class="large-6 columns">
		<?php Html::Input('Datum', 'date', 'datum1', 'datum1',null,null,date("Y-m-d"))
		?>
	</div>

	<hr />
	<h5 class="siroko center mt40"><i>Svejdočanstvo župnika</i></h5>

	<div class="large-6 columns">
		<?php Html::Input('Mjesto', 'text', 'mjesto2', 'mjesto2')
		?>
	</div>
	<div class="large-6 columns">
		<?php Html::Input('Datum', 'date', 'datum2', 'datum2')
		?>
	</div>
</div>
<?php
include_once '../osnovaDokumentaBottom.php';
$footerScript = $footerScript . '<script src="' . $putanjaApp . 'js/skripteStranica/vjencanje/izjave.js"></script>';
include_once '../../masters/masterBottom.php';
?>