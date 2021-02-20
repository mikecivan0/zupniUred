<?php
include_once '../config/conf.php';
include_once '../kontrole/isLogged.php';
include_once '../alati/Html.php';
include_once '../klase/Email.php';
if(isset($_POST["poruka"])){
	include_once '../kontrole/support/porukaAdminu.php';
	if(empty($error)){
		$from = (empty($podaci->email)) ? $podaci -> username : $podaci -> email;
		$email = new Email($from,$_POST["poruka"]);
		$email->send();
		$poruka = true;
	}
}else{
	$error = null;
	$poruka = null;
}
$title = 'Poruka administratoru';
$bodyClass = "papinskaZastava";
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
	<?php }elseif($poruka!=null){ ?>	
		<div class="large-10 large-centered columns">	
			<div data-alert="" class="alert-box alert round">
				Vaša poruka je poslana administratoru<a href="" class="close">×</a>
			</div>		
		</div>										
	<?php } ?>
	<div class="large-12 columns">
		<form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">
			<fieldset class="polja">
				<legend><?= $title ?></legend>		
				<?= Html::Textarea('Poruka*', 'poruka', 'poruka', array('siroko',$error), array('height'=>'130px !important')) ?>
			</fieldset>
			<p class="objasnjenje">*Kontaktirajte administratora u vezi pomoći oko aplikacije ili prijedloga za njeno poboljšanje,<br/>
									   pohvala, kritika ili izmjene podataka vezanih uz Vaše župe ili korisnički račun</p>
			<?= Html::Submit('Pošalji', array('button','round','secondary','siroko','mt40')) ?>
		</form>
	</div>
</div>

<?php
include_once '../masters/masterBottom.php';
?>