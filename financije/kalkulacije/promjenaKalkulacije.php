<?php
if(!isset($_GET["id"])||!isset($_GET["kalkulacija_id"])){
	header('location: ../../predlosci.php');
}
include_once '../../config/conf.php';
include_once '../../kontrole/isLogged.php';
include_once '../../sql/financije/nadjiZupu.php';

if (empty($zupa)) { //ako se pokuša mijenjati get[id] na župu u kojoj se nije župnik onda ga izbaci van
	session_destroy();
	header("location: ../../auth/prijava.php");
}

$bodyClass = 'papinskaZastava';
$porukaGreske = null;
$title = 'Promjena kalkulacije';
include_once '../../alati/Html.php';
include_once '../../sql/financije/kalkulacije/dohvatiStavkeZaKalkulacije.php';
include_once '../../sql/financije/kalkulacije/dohvatiSvrheZaKalkulacije.php';
if($_POST && isset($_POST["svrha_id"])&& isset($_POST["stavka_id"])&& !empty($zupa)){
	$id = $_POST["id"];
	$zupa_id = $_POST["zupa_id"];
	include_once '../../kontrole/financije/kalkulacije/promjenaKalkulacije.php';
	if($porukaGreske==null){
		include_once '../../sql/financije/kalkulacije/promjenaKalkulacije.php';
	}
}else{
	$id = $_GET["kalkulacija_id"];
	$zupa_id = $_GET["id"];	
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
		<form class="polja" method="POST" action="<?= $_SERVER["PHP_SELF"]  . "?id=" . $_GET["id"] . "&kalkulacija_id=" . $_GET["kalkulacija_id"]?>">
			<fieldset>
				<legend>Promjena kalkulacije</legend>
				<div class="row">
					<div class="large-6 columns">
						<?= $selectStavke ?>							
					</div>
					<div class="large-6 columns">
						<?= $selectSvrhe ?>							
					</div>
				</div>
				
				<?= Html::Input(null, 'hidden', 'id', 'id',null,null,$id,null,false) ?>
				<?= Html::Input(null, 'hidden', 'zupa_id', 'id',null,null,$zupa_id,null,false) ?>
			</fieldset>			
				<?= Html::SpremiOdustani('kalkulacije.php?id=' . $_GET["id"]) ?>
		</form>
	</div>
</div>

<?php
	include_once '../../masters/masterBottom.php';
?>