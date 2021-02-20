<?php
include_once '../config/conf.php';
$dozvola = 'da';
$greske = array();
include_once '../alati/Html.php';
include_once '../klase/Email.php';
if(isset($_POST["poruka"])){
	include_once '../kontrole/support/porukaOporavka.php';
	if(empty($error)&&empty($greske)){
		$from = $_POST["kontakt"];
		$oporavak = new Email($from,$_POST["poruka"]);
		$oporavak->send();
		$poruka = true;
	}
}else{
	$error = null;
	$poruka = null;
}
$title = 'Poruka oporavka administratoru';
$bodyClass = "papinskaZastava";
include_once '../masters/masterHead.php';
?>
<div class="row mt40">
	<?php if($error!=null){ ?>	
		<div class="large-10 large-centered columns">	
			<div data-alert="" class="alert-box alert round">
				Upišite poruku<a href="" class="close">×</a>
			</div>		
		</div>										
	<?php }elseif($poruka!=null){ ?>	
		<div class="large-10 large-centered columns">	
			<div data-alert="" class="alert-box alert round">
				Vaša poruka je poslana. Kontaktirat ćemo Vas u najkraćem mogućem roku. Hvala<a href="" class="close">×</a>
			</div>		
		</div>										
	<?php } ?>
	<div class="large-12 columns">
		<form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">
			<fieldset class="polja">
				<legend><?= $title ?></legend>	
				<?= Html::InputSaGreskom($greske, 'kontakt', 'Kontakt(email ili broj telefona na koji ćemo Vas kontaktirati)', null, 'text') ?>	
				<?= Html::Textarea('Ime, prezime i opis problema', 'poruka', 'poruka', array('siroko',$error), array('height'=>'130px !important')) ?>
			</fieldset>
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