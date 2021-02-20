<?php
include_once '../config/conf.php';
include_once '../kontrole/isLogged.php';
include_once '../alati/Html.php';
require_once '../klase/SQL.php';
require_once '../klase/Poruka.php';
$footerScript = '<script src="' . $putanjaApp . 'js/poruke/nadjiPrimatelja.js"></script>';
$greske = array();
$error = null;
if(isset($_POST["poruka"])){
	include_once '../kontrole/poruke/nova.php';
	if(empty($greske)&&$error==null){
		$poruka = new Poruka($podaci->userId,$_POST["hfPrimatelj"],$_POST["poruka"]);
		$poruka->posalji();
	}
}

$title = 'Nova poruka';
if($podaci -> razina < 3){
	$bodyClass = "papinskaZastava";
	$pozadina = "polja";
	$backIkona = "pe-7s-back";	
}else{
	$bodyClass = "matrix";
	$backIkona = "pe-7s-back-white";
	$pozadina = "crnaPozadina";
}
include_once '../masters/masterHead.php';
include_once '../config/izbornik.php';
?>
<div class="row mt40">
	<?php if($error!=null){ ?>	
		<div class="large-10 large-centered columns">	
			<div data-alert="" class="alert-box alert round">
				Upišite poruku<a href="" class="close">×</a>
			</div>		
		</div>										
	<?php } ?>
	<div class="large-1 columns">
		<a class="<?= $backIkona ?>" href="<?= $_SERVER['HTTP_REFERER'] ?>"></a>
	</div>
	<div class="large-12 columns">
		<form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">
			<fieldset class="<?= $pozadina ?>">
				<legend><?= $title ?></legend>		
				<?= Html::Input(null, 'hidden', 'hfPrimatelj', 'hfPrimatelj') ?>
				<?= Html::Input(null, 'hidden', 'hfPosiljatelj', 'hfPosiljatelj',null,null,$podaci->userId) ?>
				<?= Html::InputSaGreskom($greske, 'primatelj', 'Primatelj', null, 'text') ?>
				<?= Html::Textarea('Poruka*', 'poruka', 'poruka', array('siroko',$error), array('height'=>'130px !important')) ?>
			</fieldset>
			<?= Html::Submit('Pošalji', array('button','round','secondary','siroko','mt40')) ?>
		</form>
	</div>
</div>

<?php
include_once '../masters/masterBottom.php';
?>