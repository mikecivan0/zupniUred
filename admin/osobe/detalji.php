<?php
include_once '../../config/conf.php';
include_once '../../kontrole/isAdmin.php';
include_once '../../alati/Alati.php';
if(isset($_GET)&&isset($_GET["id"])){
	include_once '../../sql/admin/osobe/detalji.php';
}else{
	header('location: index.php');
}
$title = 'Detalji osobe';
$bodyClass = 'matrix';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
?>
<div class="row mt40">
	<div class="large-12 columns">
		<fieldset class="crnaPozadina mb40">
			<legend>Detalji osobe ***** <?= $osoba->ime . ' ' . $osoba->prezime ?> *****</legend>
			<?php 
				echo "Ime i prezime: " . $osoba->ime . " " . $osoba->prezime . "<br />" . 
					 "Adresa: " . $osoba->mjestoPrebivanja . ", " . $osoba->ulica . " " . $osoba->kucniBroj . "<br />" . 
					 "Spol: " . $osoba->spol . "<br />" . 
					 "OIB: " . $osoba->oib . "<br />" . 
					 "JMBG: " . $osoba->jmbg . "<br />";
			?>
		</fieldset>	
		<div class="row">
			<div class="large-6 columns">
				<a href="nova.php"><input class="button siroko" type="button" value="Nova osoba" /></a>
			</div>
			<div class="large-6 columns">
				<a href="index.php"><input class="button siroko secondary" type="button" value="Pretraga i promjena osoba" /></a>
			</div>
		</div>
		
	</div>
</div>

<?php
	include_once '../../masters/masterBottom.php';
?>