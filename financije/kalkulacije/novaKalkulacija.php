<?php

if(!isset($_GET["id"])){
	header('location: ../../predlosci.php');
}
include_once '../../config/conf.php';
include_once '../../kontrole/isLogged.php';
include_once '../../sql/financije/nadjiZupu.php';

if (empty($zupa)) { //ako se pokuša mijenjati get[id] na župu u kojoj se nije župnik onda ga izbaci van
	session_destroy();
	header("location: ../../auth/prijava.php");
}

include_once '../../alati/Html.php';
$bodyClass = "papinskaZastava";
$title = 'Nova kalkulacija';

$porukaGreske = null;
include_once '../../alati/Html.php';
include_once '../../sql/financije/kalkulacije/dohvatiStavkeZaKalkulacije.php';
include_once '../../sql/financije/kalkulacije/dohvatiSvrheZaKalkulacije.php';
if($_POST && isset($_POST["svrha_id"])&& isset($_POST["stavka_id"]) && !empty($zupa)){
	include_once '../../kontrole/financije/kalkulacije/novaKalkulacija.php';
	if($porukaGreske==null){
		include_once '../../sql/financije/kalkulacije/novaKalkulacija.php';
	}
}

include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';

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
		<form class="polja"method="POST" action="<?= $_SERVER["PHP_SELF"] . "?id=" . $_GET["id"] ?>">
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
				<?= Html::SpremiOdustani('kalkulacije.php?id=' . $_GET["id"]) ?>			
		</form>
	</div>
</div>

<?php
	include_once '../../masters/masterBottom.php';
?>