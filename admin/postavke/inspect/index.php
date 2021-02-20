<?php
include_once '../../../config/conf.php';
include_once '../../../kontrole/isAdmin.php';
include_once '../../../alati/Html.php';
$title = 'Inspect element';
$bodyClass = 'matrix';
include_once '../../../masters/masterHead.php';

if(isset($_POST)&&isset($_POST["inspect"])){
	include_once '../../../sql/admin/inspect/spremiPostavke.php'; 
}else{
	$_POST["inspect"] = $postavke -> inspect;
}

include_once '../../../config/izbornik.php';
?>
<div class="row">	
	<div class="large-12 column">		
		<form method="POST" action="<?= $_SERVER["PHP_SELF"] ?>">
			<fieldset class="crnaPozadina">
				<legend>Dozvola korištenja funkcije inspect element <small>(potrebna ponovna prijava u sustav)</small></legend>
				<?= Html::Radio("inspect", array(array('value'=>1,'id'=>1,'labela'=>'Da'),array('value'=>0,'id'=>0,'labela'=>'Ne')),true) ?>
			</fieldset>
			<?= Html::Submit("Spremi", array("button", "secondary", "siroko")) ?>
		</form>
	</div>
</div>

<?php
	include_once '../../../masters/masterBottom.php';		
?>