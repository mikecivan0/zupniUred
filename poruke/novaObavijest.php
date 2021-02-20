<?php
include_once '../config/conf.php';
include_once '../kontrole/isAdmin.php';
include_once '../alati/Html.php';
require_once '../klase/SQL.php';
require_once '../klase/Obavijest.php';
$error = null;
if(isset($_POST["obavijest"])){
	include_once '../kontrole/poruke/novaObavijest.php';
	if($error==null){
		$obavijest = new Obavijest($_POST["obavijest"],$podaci->userId);
		$obavijest->posalji();
	}
}

$title = 'Nova obavijest';
$bodyClass = "matrix";
$backIkona = "pe-7s-back-white";
$pozadina = "crnaPozadina";

include_once '../masters/masterHead.php';
include_once '../config/izbornik.php';
?>
<div class="row mt40">
	<?php if($error!=null){ ?>	
		<div class="large-10 large-centered columns">	
			<div data-alert="" class="alert-box alert round">
				Upišite obavijest<a href="" class="close">×</a>
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
				<?= Html::Textarea('Obavijest*', 'obavijest', 'obavijest', array('siroko',$error), array('height'=>'130px !important')) ?>
			</fieldset>
			<?= Html::Submit('Pošalji', array('button','round','secondary','siroko','mt40')) ?>
		</form>
	</div>
</div>

<?php
include_once '../masters/masterBottom.php';
?>