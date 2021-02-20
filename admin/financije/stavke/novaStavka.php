<?php
include_once '../../../config/conf.php';
include_once '../../../kontrole/isAdmin.php';
$title = 'Nova stavka';
$bodyClass = 'matrix';
include_once '../../../alati/Html.php';
include_once '../../../sql/admin/financije/stavke/dohvatiGrupeZaStavke.php';
include_once '../../../sql/admin/financije/stavke/dohvatiIzvjescaZaStavke.php';
$greske = array();
if(isset($_POST) && isset($_POST["stavka"])){
	include_once '../../../kontrole/admin/financije/stavke/novaStavka.php';
	if(empty($greske)){
		include_once '../../../sql/admin/financije/stavke/novaStavka.php';
	}
}


include_once '../../../masters/masterHead.php';
include_once '../../../config/izbornik.php';

?>
<div class="row mt40">
	<div class="large-12 columns">
		<form class="crnaPozadina"method="POST" action="<?= $_SERVER["PHP_SELF"] ?>">
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
				<?= Html::SpremiOdustani('stavke.php') ?>	
		</form>
	</div>
</div>

<?php
	include_once '../../../masters/masterBottom.php';
?>