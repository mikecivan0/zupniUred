<?php
include_once '../../../config/conf.php';
include_once '../../../kontrole/isAdmin.php';
$title = 'Promjena stavke dnevnika';
$bodyClass = 'matrix';
include_once '../../../alati/Html.php';
include_once '../../../sql/admin/financije/svrhe/dohvatiGrupeZaSvrhe.php';
$greske = array();
if($_POST && isset($_POST["svrha"])){
	$nazivSvrhe = $_POST["svrha"];
	$id = $_POST["id"];
	include_once '../../../kontrole/admin/financije/svrhe/promjenaSvrhe.php';
	if(empty($greske)){
		include_once '../../../sql/admin/financije/svrhe/promjenaSvrhe.php';
	}
}else{
	include_once '../../../sql/admin/financije/svrhe/detaljiSvrhe.php';
	$nazivSvrhe = $svrha->nazivSvrhe;
	$id = $_GET["id"];	
}


include_once '../../../masters/masterHead.php';
include_once '../../../config/izbornik.php';

?>
<div class="row mt40">
	<div class="large-12 columns">
		<form class="crnaPozadina"method="POST" action="<?= $_SERVER["PHP_SELF"] ?>">
			<fieldset>
				<legend>Promjena svrhe</legend>
				<div class="row">
					<div class="large-9 columns">
						<?= Html::InputSaGreskom($greske, 'svrha', 'Naziv stavke dnevnika', $nazivSvrhe, 'text') ?>
					</div>
					<div class="large-3 columns">
						<?= $select ?>							
					</div>
				</div>
				
				<?= Html::Input(null, 'hidden', 'id', 'id',null,null,$id,null,false) ?>
			</fieldset>			
				<?= Html::SpremiOdustani('svrhe.php') ?>
		</form>
	</div>
</div>

<?php
	include_once '../../../masters/masterBottom.php';
?>