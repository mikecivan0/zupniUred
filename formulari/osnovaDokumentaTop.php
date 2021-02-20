<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}



//obrada dokumenata ako se traži po id-u ili ako se sprema ili radi update ako je post došao sa iste stranice, 
//također se vraća $_GET["poruka"] ako je spremanje dokumenta
if (isset($_GET["docId"]) || ($_POST && strpos($_SERVER["HTTP_REFERER"], $_SERVER["PHP_SELF"]) > 1)) {
	include_once '../../klase/SQL.php';
	include_once '../../klase/Dokument.php';
	$dokument = new Dokument($ida, $title);
	$dokument -> parseDoc();
}

if(isset($_GET)&&isset($_GET["poruka"])){
	$porukaOSpremanju = ($_GET["poruka"]=="obrisano") ? "Dokument je uspješno obrisan" : $_GET["poruka"];
}
?>
<div class="row mt20">
	<div class="large-12 columns">
		<?php if(strlen($porukaOSpremanju)>0){
		?>
		<div id="porukaSpremanja" class="large-10 large-centered columns">
			<div data-alert="" class="alert-box alert round center">
				<?php echo $porukaOSpremanju; ?>
				<a href="" class="close">×</a>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
<div class="row mr15">
<?php

//ako ima spremljenih dokumenata napravi select sa njima
include_once '../../sql/formulari/dohvatiSpremljeneDokumente.php';
if (!empty($dokumenti)) {
	$arrayDokumenata = array( array('text' => 'Izaberite dokument', 'value' => ' '));
	foreach ($dokumenti as $dokument) {
		$arrayDoc = array('text' => $dokument -> naziv, 'value' => $dokument -> putanja . "?docId=" . $dokument -> id);
		array_push($arrayDokumenata, $arrayDoc);
	}
	echo "<div class='large-5 columns mt40'>";
	Html::Select('Vaši spremljeni dokumenti', 'spremljeniDokumenti', 'spremljeniDokumenti', null, $arrayDokumenata, null, array('onchange' => 'location = this.value;'));
	echo "</div>";
}
?>
<div class="large-12 columns">
<form id="<?= $formId ?>" method="POST" action="<?= $postURL ?>" accept-charset="UTF-8" target="_blank">
<fieldset class="polja">
<legend><?= $legend ?></legend>
<div class="row">
<div class="large-8 columns end">
<!-- ako je prijavljen korisnik onda kreiraj select option
inače stavi input da se izabere župa-->

<?php if(isset($podaci)){ ?>
<h5><u>Označite župu čije podatke želite koristiti</u></h5>
<?php
$footerScript .= '<script src="' . $putanjaApp . 'js/skripteStranica/popuniPoljaNakonOdabiraRadioButtona.js"></script>';
if(!$_POST){
$footerScript .= '<script src="' . $putanjaApp . 'js/skripteStranica/oznaciPrviRadioButton.js"></script>';
}

include_once '../../sql/formulari/dohvatiZupe.php';
include_once '../../alati/Alati.php';

foreach ($zupe as $zupa): ?>
<input type="radio" name="zupa" id="zupa<?= $zupa -> id ?>" nazivZupe="<?= $zupa -> nazivZupe ?>" value="<?= $zupa -> id ?>" <?php
if ($_POST && $_POST["zupa"] == $zupa -> id) {echo "checked='checked'";
}
?>><?= $zupa -> nazivZupe . ", " . $zupa -> nazivMjesta ?><br>
<?php endforeach;
	}else{
	$footerScript .= '<script src="' . $putanjaApp . 'js/skripteStranica/traziZupuAjax.js"></script>';

	Html::Input("Upišite par slova iz naziva Vaše župe ili mjesta u kojem se župa nalazi", "text", "trazenaZupa", "trazenaZupa",null,null,null,array('autofocus'=>'autofocus'));

	}

	include_once '../../masters/formulari/drugiPrinter.php';
?>
</div>
</div>
<?php
Html::Input(null, "hidden", "hfZupaId", "hfZupaId", null, null, null, null, false);
//kreiranje hidden polja koja će služiti kao trigger za new ili update dokumenata
if (isset($_GET["docId"])) {
	Html::Input(null, "hidden", "hfDocId", "hfDocId", null, null, $_GET["docId"], null, false);
}

if (isset($_POST["hfDocId"]) && strpos($_SERVER["HTTP_REFERER"], $_SERVER["PHP_SELF"]) > 1) {
	Html::Input(null, "hidden", "hfDocId", "hfDocId", null, null, $_POST["hfDocId"], null, false);
}
?>
<hr />

<?php if(isset($zaglavljeDokumenta)){ ?>
<div class="row">
<div class="large-2 end columns">
<?php Html::Input("Broj", "text", "brojDokumenta", "brojDokumenta") ?>

</div>
</div>
<?php
include_once '../zaglavljeDokumenta.php';
}
?>