<?php
include_once '../../../config/conf.php';
include_once '../../../kontrole/isAdmin.php';
include_once '../../../alati/Html.php';
$title = 'Promjena stavki izvješća';
$bodyClass = 'matrix';
include_once '../../../masters/masterHead.php';
include_once '../../../sql/admin/financije/stavke/dohvatiGrupeZaStavke.php';
include_once '../../../sql/admin/financije/stavke/dohvatiIzvjescaZaStavke.php';
$greske = array();
if($_POST && isset($_POST["stavka"])){
	$nazivStavke = $_POST["stavka"];
	$id = $_POST["id"];
	include_once '../../../kontrole/admin/financije/stavke/promjenaStavke.php';
	if(empty($greske)){
		include_once '../../../sql/admin/financije/stavke/promjenaStavke.php';
	}
}else{
	include_once '../../../sql/admin/financije/stavke/detaljiStavke.php';
	$nazivStavke = $stavka->nazivStavke;
	$id = $_GET["id"];	
}
include_once '../../../config/izbornik.php';
?>

<div class="row mt40">
	<div class="large-12 columns">
		<form class="crnaPozadina"method="POST" action="<?= $_SERVER["PHP_SELF"] ?>">
			<fieldset>
				<legend>Promjena stavke</legend>
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
			</fieldset>			
				<?= Html::SpremiOdustani('stavke.php') ?>
		</form>
	</div>
</div>

<?php
	include_once '../../../masters/masterBottom.php';
?>