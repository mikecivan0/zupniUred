<?php
include_once '../../../config/conf.php';
include_once '../../../kontrole/isAdmin.php';
if(isset($_POST)&&isset($_POST["nazivGrupe"])){
	include_once '../../../kontrole/admin/financije/grupe/novaGrupa.php';
	if(empty($greske)){
		include_once '../../../sql/admin/financije/grupe/novaGrupa.php';
	}
	
}
$title = 'Nova grupa';
$bodyClass = 'matrix';
include_once '../../../alati/Html.php';
include_once '../../../masters/masterHead.php';
include_once '../../../config/izbornik.php';

?>
<div class="row mt40">
	<div class="large-12 columns">
		<form class="crnaPozadina"method="POST" action="<?= $_SERVER["PHP_SELF"] ?>">
			<fieldset>
				<legend><?= $title ?></legend>
				<?= Html::InputSaGreskom($greske, 'nazivGrupe', 'Naziv grupe', null, 'text') ?>				
			</fieldset>
			<?= Html::SpremiOdustani('grupe.php') ?>	
		</form>
	</div>
</div>

<?php
	include_once '../../../masters/masterBottom.php';
?>