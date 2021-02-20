<?php

if(!isset($_GET["id"])){
	header('location: ../../predlosci.php');
}
include_once '../../config/conf.php';
include_once '../../kontrole/isLogged.php';
include_once '../../sql/financije/nadjiZupu.php';

if (empty($zupa)) { //ako se pokuša mijenjati get[id] na župu u kojoj se nije župnik onda ga izbaci van
	session_destroy();
	header("location: ../../auth/prijava.php");
}
$title = 'Nova stavka izvješća';
$bodyClass = 'papinskaZastava';
include_once '../../alati/Html.php';
include_once '../../sql/financije/stavke/dohvatiGrupeZaStavke.php';
include_once '../../sql/financije/stavke/dohvatiIzvjescaZaStavke.php';
$greske = array();
if(isset($_POST) && isset($_POST["stavka"]) && !empty($zupa)){
	include_once '../../kontrole/financije/stavke/novaStavka.php';
	if(empty($greske)){
		include_once '../../sql/financije/stavke/novaStavka.php';
	}
}


include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';

?>
<div class="row mt40">
	<div class="large-12 columns">
		<form class="polja" method="POST" action="<?= $_SERVER["PHP_SELF"] . "?id=" . $_GET["id"] ?>">
			<fieldset>
				<legend><?= $title ?></legend>
				<div class="row">
					<div class="large-5 columns">
						<?= Html::InputSaGreskom($greske, 'stavka', 'Naziv stavke', null, 'text') ?>
					</div>
					<div class="large-4 columns">
						<?= $selectIzvjesca ?>							
					</div>
					<div class="large-3 columns">
						<?= $select ?>							
					</div>
				</div>
			</fieldset>		
				<?= Html::SpremiOdustani('stavke.php?id=' . $_GET["id"]) ?>			
		</form>
	</div>
</div>

<?php
	include_once '../../masters/masterBottom.php';
?>