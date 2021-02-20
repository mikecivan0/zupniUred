<?php
include_once '../config/conf.php';
include_once '../kontrole/support/lozinka.php';	
$greske = array();
$userId = (isset($_GET["ver"])) ? $_GET["ver"] : $_POST["hfUserId"];
$hfEmail = (isset($_GET["email"])) ? $_GET["email"] : $_POST["hfEmail"];
include_once '../alati/Html.php';
include_once '../klase/Email.php';
if(isset($_POST["hfEmail"])){
	include_once '../kontrole/support/promjenaLozinke.php';
	if(empty($greske)){
		include_once '../sql/support/promjenaLozinke.php';
		$novaLozinka = new Email($from,$message,$_POST["hfEmail"]);
		$novaLozinka->send();
	}
}else{
	$poruka = null;
	$error = null;
}
$title = 'Nova lozinka';
$bodyClass = "papinskaZastava";
include_once '../masters/masterHead.php';
?>
<div class="row mt40">
	<?php if($poruka!=null){ ?>	
		<div class="large-10 large-centered columns">	
			<div data-alert="" class="alert-box alert round">
				<?= $poruka ?><a href="" class="close">×</a>
			</div>		
		</div>										
	<?php } ?>
	<div class="large-12 columns">
		<form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">
			<fieldset class="polja">
				<legend><?= $title ?></legend>		
				<?= Html::Input(null, 'hidden', 'hfUserId', 'hfUserId', null, null, $userId, null, false) ?>
				<?= Html::Input(null, 'hidden', 'hfEmail', 'hfEmail', null, null, $_GET["email"], null, false) ?>
				<?= Html::InputSaGreskom($greske, 'password', 'Nova lozinka', null, 'password') ?>
			</fieldset>
				<?= Html::Submit('Spremi', array('button','round','secondary','siroko')) ?>
		</form>
	</div>
</div>

<?php
include_once '../masters/masterBottom.php';
?>