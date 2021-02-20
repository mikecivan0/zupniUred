<?php
include_once '../../../config/conf.php';
include_once '../../../kontrole/isAdmin.php';
$title = 'Promjena automatskog unosa';
$bodyClass = 'matrix';
$porukaGreske = null;
include_once '../../../alati/Html.php';
include_once '../../../sql/admin/financije/automatike/dohvatiSvrheZaAutomatike.php';

if($_POST && isset($_POST["primSvrha_id"])&& isset($_POST["autoSvrha_id"])){
	$id = $_POST["id"];
	include_once '../../../kontrole/admin/financije/automatike/promjenaAutomatike.php';
	if($porukaGreske==null){
		include_once '../../../sql/admin/financije/automatike/promjenaAutomatike.php';
	}
}else{
	$id = $_GET["id"];
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
				<legend>Promjena automatskog unosa</legend>
				<div class="row">
					<div class="large-6 columns">
						<?= $selectPrimSvrhe ?>							
					</div>
					<div class="large-6 columns">
						<?= $selectAutoSvrhe ?>							
					</div>
				</div>
				
				<?= Html::Input(null, 'hidden', 'id', 'id',null,null,$id,null,false) ?>
			</fieldset>			
				<?= Html::SpremiOdustani('automatike.php') ?>
		</form>
	</div>
</div>

<?php
	include_once '../../../masters/masterBottom.php';
?>