<?php
include_once '../../../config/conf.php';
include_once '../../../kontrole/isAdmin.php';
$title = 'Nova kalkulacija';
$bodyClass = 'matrix';
$porukaGreske = null;
include_once '../../../alati/Html.php';
include_once '../../../sql/admin/financije/kalkulacije/dohvatiStavkeZaKalkulacije.php';
include_once '../../../sql/admin/financije/kalkulacije/dohvatiSvrheZaKalkulacije.php';
if($_POST && isset($_POST["svrha_id"])&& isset($_POST["stavka_id"])){
	include_once '../../../kontrole/admin/financije/kalkulacije/novaKalkulacija.php';
	if($porukaGreske==null){
		include_once '../../../sql/admin/financije/kalkulacije/novaKalkulacija.php';
	}
}

include_once '../../../masters/masterHead.php';
include_once '../../../config/izbornik.php';

?>
<div class="row mt40">
	<?php if(strlen($porukaGreske)!=null){
		?>
		<div id="porukaSpremanja" class="large-10 large-centered columns">
			<div data-alert="" class="alert-box alert round center">
				<?php echo $porukaGreske; ?>
				<a href="" class="close">×</a>
			</div>
		</div>
		<?php } ?>
	<div class="large-12 columns">
		<form class="crnaPozadina"method="POST" action="<?= $_SERVER["PHP_SELF"] ?>">
			<fieldset>
				<legend>Nova kalkulacija</legend>
				<div class="row">
					<div class="large-6 columns">
						<?= $selectStavke ?>							
					</div>
					<div class="large-6 columns">
						<?= $selectSvrhe ?>							
					</div>
				</div>
			</fieldset>			
				<?= Html::SpremiOdustani('kalkulacije.php') ?>
		</form>
	</div>
</div>

<?php
	include_once '../../../masters/masterBottom.php';
?>