<?php
include_once '../config/conf.php';
$dozvola = 'da';
include_once '../alati/Html.php';
include_once '../klase/Email.php';
if(isset($_POST["email"])){
	include_once '../kontrole/support/oporavak.php';
	if($error==null){
		include_once '../masters/porukaOporavka.php';
		$oporavak = new Email($from,$message,$_POST["email"]);
		$oporavak->send();
	}
}else{
	$poruka = null;
	$error = null;
}
$title = 'Oporavak';
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
				<?= Html::Input('Upišite email koji je naveden u Vašim osobnim podacima ove aplikacije', 'email', 'email', 'email', array('siroko',$error)) ?>
			</fieldset>
			<p class="objasnjenje">Ukoliko nemate upisan email u svojim osobnim podacima kliknite 				<small class="linkOporavka" onclick="window.open('porukaZaOporavak.php')">ovdje</small>			</p>
			<div class="row mt40">
				<div class="large-6 columns">
					<?= Html::Submit('Pošalji', array('button','round','secondary','siroko')) ?>
				</div>
				<div class="large-6 columns">
					<?= Html::Button('Odustani', array('siroko','button','alert'),array('onclick'=>'window.close();')) ?>
				</div>
			</div>
		</form>
	</div>
</div>

<?php
include_once '../masters/masterBottom.php';
?>