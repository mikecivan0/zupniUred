<?php
if(!isset($_GET["id"])||!isset($_GET["stavka_id"])){
	header('location: ../../predlosci.php');
}
include_once '../../config/conf.php';
include_once '../../kontrole/isLogged.php';
include_once '../../sql/financije/nadjiZupu.php';

if (empty($zupa)) { //ako se pokuša mijenjati get[id] na župu u kojoj se nije župnik onda ga izbaci van
	session_destroy();
	header("location: ../../auth/prijava.php");
}
$title = 'Promjena stavke izvješća';
$bodyClass = 'papinskaZastava';
include_once '../../masters/masterHead.php';
include_once '../../alati/Html.php';
include_once '../../sql/financije/stavke/dohvatiGrupeZaStavke.php';
include_once '../../sql/financije/stavke/dohvatiIzvjescaZaStavke.php';
$greske = array();
if($_POST && isset($_POST["stavka"])){
	$nazivStavke = $_POST["stavka"];
	$id = $_POST["id"];
	$zupa_id = $_POST["zupa_id"];
	include_once '../../kontrole/financije/stavke/promjenaStavke.php';
	if(empty($greske)){
		include_once '../../sql/financije/stavke/promjenaStavke.php';
	}
}else{
	include_once '../../sql/financije/stavke/detaljiStavke.php';
	$nazivStavke = $stavka->nazivStavke;
	$id = $_GET["stavka_id"];
	$zupa_id = $_GET["id"];	
}
include_once '../../config/izbornik.php';
?>

<div class="row mt40">
	<div class="large-12 columns">
		<form class="polja" method="POST" action="<?= $_SERVER["PHP_SELF"] . "?id=" . $_GET["id"] . "&stavka_id=" . $_GET["stavka_id"] ?>">
			<fieldset>
				<legend><?= $title ?></legend>
				<div class="row">
					<div class="large-5 columns">
						<?= Html::InputSaGreskom($greske, 'stavka', 'Naziv stavke', $nazivStavke, 'text') ?>
					</div>
					<div class="large-4 columns">
						<?= $selectIzvjesca ?>							
					</div>
					<div class="large-3 columns">
						<?= $select ?>							
					</div>
				</div>
				
				<?= Html::Input(null, 'hidden', 'id', 'id',null,null,$id,null,false) ?>
				<?= Html::Input(null, 'hidden', 'zupa_id', 'zupa_id',null,null,$zupa_id,null,false) ?>
			</fieldset>			
				<?= Html::SpremiOdustani('stavke.php?id=' . $_GET["id"]) ?>
		</form>
	</div>
</div>

<?php
	include_once '../../masters/masterBottom.php';
?>