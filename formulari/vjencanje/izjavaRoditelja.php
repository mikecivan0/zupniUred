<?php
include_once '../../config/conf.php';
include_once '../../kontrole/dozvola.php';
include_once '../../alati/Html.php';
$title = 'Izjava roditelja uz ženidbu njihova maloljetnika';
$legend = 'Izjava roditelja uz ženidbu njihova maloljetnika';
$formId = 'izjavaRoditelja';
$postURL = $putanjaApp . 'printanje/vjencanje/izjavaRoditelja.php?vrstaDokumenta=11';
$bodyClass = 'papinskaZastava';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
include_once '../osnovaDokumentaTop.php';
if($_POST&&isset($_GET["maloljetnik"])){
	include_once '../../klase/formulari/izjavaRoditelja.php';
	IzjavaRoditelja::ConvertPost($_GET["maloljetnik"]);
}
?>
<div class="row mb40">
	<div class="large-2 end columns">
		<?php Html::Input("Broj", "text", "brojDokumenta", "brojDokumenta") ?>
		
	</div>
</div>

<div class="row">
	<div class="large-12 columns">
		<?php Html::Input('Ime i prezime oca', 'text', 'otac', 'otac')
		?>
	</div>
	<div class="large-12 columns">
		<?php Html::Input('Ime i prezime majke', 'text', 'majka', 'majka')
		?>
	</div>
	<div class="large-12 columns">
		<?php Html::Input('Adresa stanovanja', 'text', 'adresa', 'adresa')
		?>
	</div>
	<div class="large-3 columns">
		<?php Html::Select('Izjavljujem da znam za namjeru', 'spol', 'spol', null,array(array('id'=>1,'value'=>1,'text'=>'svog sina'),array('id'=>0,'value'=>0,'text'=>'svoje kćeri')))
		?>
	</div>
	<div class="large-9 columns">
		<?php Html::Input('Ime i prezime sina/kćeri', 'text', 'dijete', 'dijete')
		?>
	</div>
	<div class="large-12 columns">
		<?php Html::Input('Ime i prezime zaručnika/zaručnice', 'text', 'zarucnik', 'zarucnik')
		?>
	</div>
	<div class="large-12 columns">
		<?php Html::Input('Nastanjenim/nastanjenoj u', 'text', 'nastanjenMjesto', 'nastanjenMjesto')
		?>
	</div>
	<div class="large-10 columns">
		<?php Html::Input('Ulica', 'text', 'ulica', 'ulica')
		?>
	</div>
	<div class="large-2 columns">
		<?php Html::Input('Broj', 'text', 'broj', 'broj')
		?>
	</div>
	<div class="large-12 columns pt40">
		<?php Html::Textarea('Ne odobravam tu ženidbu zbog sljedećih razloga:', 'odobravanje', 'odobravanje',null,array('width'=>'562px','height'=>'85px !important'),null,null)
		?>
	</div>
	<div class="large-9 columns end pt60">
		<?php Html::Input('Mjesto', 'text', 'mjesto', 'mjesto')
		?>
	</div>
	<div class="large-3 columns end pt60">
		<?php Html::Input("Datum", "date", "datum", "datum",null,null,date("Y-m-d")) 
		?>
	</div>
</div>
<?php
include_once '../osnovaDokumentaBottom.php';
$footerScript = $footerScript . '<script src="' . $putanjaApp . 'js/skripteStranica/vjencanje/izjavaRoditelja.js"></script>';
include_once '../../masters/masterBottom.php';
?>