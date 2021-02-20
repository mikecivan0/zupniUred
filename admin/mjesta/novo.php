<?php
include_once '../../config/conf.php';
include_once '../../kontrole/isAdmin.php';
$greske = array();
if(isset($_POST)&&isset($_POST["nazivMjesta"])){
	include_once '../../kontrole/admin/mjesta/novo.php';
	if(empty($greske)){
		include_once '../../sql/admin/mjesta/novo.php';
	}
	
}
$title = 'Novo mjesto';
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
				<?= Html::InputSaGreskom($greske, 'nazivMjesta', 'Naziv mjesta', null, 'text') ?>	
				<?= Html::InputSaGreskom($greske, 'pbr', 'Poštanski broj', null, 'text') ?>	
			</fieldset>
			<?= Html::SpremiOdustani('index.php') ?>	
		</form>			
	</div>
</div>

<?php
	include_once '../../masters/masterBottom.php';
?>