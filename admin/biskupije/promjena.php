<?php
include_once '../../config/conf.php';
include_once '../../kontrole/isAdmin.php';
$title = 'Promjena biskupije';
$bodyClass = 'matrix';
$greske = array();
include_once '../../alati/Html.php';
if(isset($_POST) && isset($_POST["biskupija"])){
	include_once '../../kontrole/admin/biskupije/promjena.php';
	if(empty($greske)){
		include_once '../../sql/admin/biskupije/promjenaBiskupije.php';
	}
}else{
	include_once '../../sql/admin/biskupije/detaljiBiskupije.php';
	include_once '../../masters/masterHead.php';
	include_once '../../config/izbornik.php';

?>
<div class="row mt40">
	<div class="large-12 columns">
		<form class="crnaPozadina"method="POST" action="<?= $_SERVER["PHP_SELF"] ?>">
			<fieldset>
				<legend>Promjena podataka biskupije</legend>
				<?= Html::InputSaGreskom($greske, 'biskupija', 'Naziv biskupije', $biskupija->nazivBiskupije, 'text') ?>
				<?= Html::Input(null, 'hidden', 'id', 'id',null,null,$_GET["id"],null,false) ?>
			</fieldset>			
				<?= Html::Submit('Spremi',array('ml10','mb10','secondary','button')) ?>
		</form>
	</div>
</div>

<?php
	include_once '../../masters/masterBottom.php';
}
?>