<?php
include_once '../config/conf.php';
include_once '../kontrole/isLogged.php';
if($_POST){
	include_once '../kontrole/obiteljskiListovi/prebacivanje.php';
	if(empty($greske)){
		include_once '../sql/obiteljskiListovi/prebacivanje.php';
		header('location: promjena.php?id=' . $_POST["hfOlId"]);
	}
}
$clan = ($_POST) ? $_POST["clan"] : null;
$ol = ($_POST) ? $_POST["obiteljskiList"] : null;
$olId = ($_POST) ? $_POST["hfOlId"] : null;
$clanId = ($_POST) ? $_POST["hfClanId"] : null;
include_once '../alati/Html.php';
$title = 'Prebacivanje članova';
$bodyClass = 'papinskaZastava';
$footerScript .= '<script src="' . $putanjaApp . 'js/obiteljskiListovi/prebacivanje.js"></script>';
include_once '../sql/obiteljskiListovi/dohvatiUloge.php';
include_once '../alati/Alati.php';
include_once '../masters/masterHead.php';
include_once '../config/izbornik.php';
?>
<div class="row mt40">
	<div class="large-12 columns polja">
		<div class="row">			
			<div class="large-12 columns">
				<form method="POST" action="<?= $_SERVER["PHP_SELF"] ?>" class="mt40">
					<fieldset class="polja">
						<legend>
							Prebacivanje osobe u drugi obiteljski list ili izmjena statusa osobe
						</legend>
						<div class="row">
							<div class="large-12 columns">
								<?= Html::InputSaGreskom($greske, 'clan', 'Osoba za prebacivanje', $clan, 'text',array('placeholder'=>'Ime osobe i prezime obiteljskog lista u kojem je trenutno')) ?>
							</div>
							<div class="large-12 columns">
								<?= Html::InputSaGreskom($greske, 'obiteljskiList', 'Obiteljski list u koji se prebacuje', $ol, 'text',array('placeholder'=>'Prezime obiteljskog lista u koji prebacujete osobu')) ?>
							</div>
							<div class="large-12 columns">
								<?= $selectUloga ?>
							</div>		
							<div class="large-12 columns mt80">
								<p class="red">*I tražena osoba i obiteljski list moraju već postojati da bi Ste mogli koristiti ovu mogućnost.</p>
								<p class="red">*Primjer: Marko se vodi kao dijete u obiteljskom listu obitelji Marković. Ukoliko Marka želite postaviti kao muža u njegovom novom obiteljskom listu, morate prvo taj obiteljski list i napraviti a zatim Marka prebaciti tamo.</p>
							</div>		
								<?= Html::Input(null, 'hidden', 'hfOlId', 'hfOlId', null, null, $olId, null, false) ?>
								<?= Html::Input(null, 'hidden', 'hfClanId', 'hfClanId', null, null, $clanId, null, false) ?>
						</div>
						<div class="row mb40 mt40">
							<div class="large-12 columns">
								<?= Html::Submit('Spremi', array('siroko', 'secondary', 'spremi', 'round', 'button')) ?>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
include_once '../masters/masterBottom.php';
?>