<?php
include_once '../../config/conf.php';
include_once '../../kontrole/isAdmin.php';
$greske = array();
if(isset($_POST)&&isset($_POST["nazivPrintera"])){
	include_once '../../kontrole/admin/printeri/novi.php';
	if(empty($greske)){
		include_once '../../sql/admin/printeri/novi.php';
	}
	
}
$title = 'Novi printer';
$bodyClass = 'matrix';
include_once '../../alati/Html.php';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
?>
<div class="row mt40">
	<div class="large-12 columns">
		<form class="crnaPozadina"method="POST" action="<?= $_SERVER["PHP_SELF"] ?>">
			<fieldset>
				<legend><?= $title ?></legend>
				<?= Html::InputSaGreskom($greske, 'nazivPrintera', 'Naziv printera', null, 'text',array('autofocus'=>true)) ?>
			</fieldset>
			<?= Html::SpremiOdustani('index.php') ?>	
		</form>			
	</div>
</div>

<?php
	include_once '../../masters/masterBottom.php';
?>