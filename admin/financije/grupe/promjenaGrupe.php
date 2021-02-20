<?php
include_once '../../../config/conf.php';
include_once '../../../kontrole/isAdmin.php';
$title = 'Promjena grupe';
$bodyClass = 'matrix';
$greske = array();
include_once '../../../alati/Html.php';
if(isset($_POST) && isset($_POST["grupa"])){
	$nazivGrupe = $_POST["grupa"];
	$id = $_POST["id"];
	include_once '../../../kontrole/admin/financije/grupe/promjenaGrupe.php';
	if(empty($greske)){
		include_once '../../../sql/admin/financije/grupe/promjenaGrupe.php';
	}
}else{
	include_once '../../../sql/admin/financije/grupe/detaljiGrupe.php';	
	$nazivGrupe = $grupa->nazivGrupe;
	$id = $_GET["id"];	
}
include_once '../../../masters/masterHead.php';
include_once '../../../config/izbornik.php';
?>
<div class="row mt40">
	<div class="large-12 columns">
		<form class="crnaPozadina"method="POST" action="<?= $_SERVER["PHP_SELF"] ?>">
			<fieldset>
				<legend>Promjena naziva grupe</legend>
				<?= Html::InputSaGreskom($greske, 'grupa', 'Naziv grupe', $nazivGrupe, 'text') ?>
				<?= Html::Input(null, 'hidden', 'id', 'id',null,null,$id,null,false) ?>
			</fieldset>			
				<?= Html::SpremiOdustani('grupe.php') ?>
		</form>
	</div>
</div>

<?php
	include_once '../../../masters/masterBottom.php';

?>