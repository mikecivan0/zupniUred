<?php
include_once '../../../config/conf.php';
include_once '../../../kontrole/isAdmin.php';
$title = 'Promjena izvvješća';
$bodyClass = 'matrix';
$greske = array();
include_once '../../../alati/Html.php';
if(isset($_POST) && isset($_POST["izvjesce"])){
	$nazivIzvjesca = $_POST["izvjesce"];
	$id = $_POST["id"];
	include_once '../../../kontrole/admin/financije/izvjesca/promjenaIzvjesca.php';
	if(empty($greske)){
		include_once '../../../sql/admin/financije/izvjesca/promjenaIzvjesca.php';
	}
}else{
	include_once '../../../sql/admin/financije/izvjesca/detaljiIzvjesca.php';	
	$nazivIzvjesca = $izvjesce->nazivIzvjesca;
	$id = $_GET["id"];	
}
include_once '../../../masters/masterHead.php';
include_once '../../../config/izbornik.php';
?>
<div class="row mt40">
	<div class="large-12 columns">
		<form class="crnaPozadina"method="POST" action="<?= $_SERVER["PHP_SELF"] ?>">
			<fieldset>
				<legend>Promjena naziva izvješća</legend>
				<?= Html::InputSaGreskom($greske, 'izvjesce', 'Naziv izvješća', $nazivIzvjesca, 'text') ?>
				<?= Html::Input(null, 'hidden', 'id', 'id',null,null,$id,null,false) ?>
			</fieldset>			
				<?= Html::SpremiOdustani('izvjesca.php') ?>
		</form>
	</div>
</div>

<?php
	include_once '../../../masters/masterBottom.php';

?>