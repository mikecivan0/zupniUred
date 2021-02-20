<?php
if(!isset($_GET["zupa_id"])){
	header('location: ../../predlosci.php');
}
include_once '../../config/conf.php';
include_once '../../kontrole/isLogged.php';
$title = 'Promjena stavke dnevnika';
$bodyClass = 'papinskaZastava';
include_once '../../alati/Html.php';
include_once '../../sql/financije/svrhe/dohvatiGrupeZaSvrhe.php';
$greske = array();
if($_POST && isset($_POST["svrha"])){
	$nazivSvrhe = $_POST["svrha"];
	include_once '../../kontrole/financije/svrhe/promjenaSvrhe.php';
	if(empty($greske)){
		include_once '../../sql/financije/svrhe/promjenaSvrhe.php';
	}
}else{
	include_once '../../sql/financije/svrhe/detaljiSvrhe.php';
	if(empty($svrha)){//ukoliko se mijenjao GET["id"] radi hakiranja ne radi ništa
		header('location: svrhe.php?id=' . $_GET["zupa_id"]);		
	}else{
		$nazivSvrhe = $svrha->nazivSvrhe;
	}
}



include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';

?>
<div class="row mt40">
	<div class="large-12 columns">
		<form class="polja" method="POST" action="<?= $_SERVER["PHP_SELF"] . "?id=" . $_GET["id"] . "&zupa_id=" . $_GET["zupa_id"]?>">
			<fieldset>
				<legend><?= $title ?></legend>
				<div class="row">
					<div class="large-9 columns">
						<?= Html::InputSaGreskom($greske, 'svrha', 'Naziv stavke dnevnika', $nazivSvrhe, 'text') ?>
					</div>
					<div class="large-3 columns">
						<?= $select ?>							
					</div>
				</div>
			</fieldset>		
				<?= Html::SpremiOdustani('svrhe.php?id=' . $_GET["zupa_id"]) ?>	
		</form>
	</div>
</div>

<?php
	include_once '../../masters/masterBottom.php';
?>