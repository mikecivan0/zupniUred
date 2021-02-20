<?php
include_once '../../../config/conf.php';
include_once '../../../kontrole/isAdmin.php';
if(isset($_POST)&&isset($_POST["nazivIzvjesca"])){
	include_once '../../../kontrole/admin/financije/izvjesca/novoIzvjesce.php';
	if(empty($greske)){
		include_once '../../../sql/admin/financije/izvjesca/novoIzvjesce.php';
	}
	
}
$title = 'Novo izvješće';
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
				<?= Html::InputSaGreskom($greske, 'nazivIzvjesca', 'Naziv izvješća', null, 'text') ?>				
			</fieldset>
			<?= Html::SpremiOdustani('izvjesca.php') ?>	
		</form>
	</div>
</div>

<?php
	include_once '../../../masters/masterBottom.php';
?>