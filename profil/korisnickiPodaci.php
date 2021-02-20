<?php
include_once '../config/conf.php';
include_once '../kontrole/isLogged.php';
include_once '../alati/Html.php';
$title = 'Korisnički račun';
$bodyClass = ($podaci->razina<3) ? "papinskaZastava" : "matrix";
$pozadina = ($podaci->razina<3) ? "polja" : "crnaPozadina";
if(isset($_POST)&&isset($_POST["username"])){
	include_once '../kontrole/profil/spremiPromjeneKorisnickogRacuna.php';
	if(empty($greske)){
		include_once '../sql/profil/spremiPromjeneKorisnickogRacuna.php';
	}
}
include_once '../masters/masterHead.php';
include_once '../config/izbornik.php';
?>
<div class="row mt40">
	<div class="large-12 columns">
		<?php if(strlen($porukaOSpremanju)>0){ ?>
			<div class="large-10 large-centered columns">	
				<div data-alert="" class="alert-box alert round center">
					<?php echo $porukaOSpremanju; ?><a href="" class="close">×</a>
				</div>		
			</div>		
		<?php } ?>
		<form method="POST" action="<?= $_SERVER["PHP_SELF"] ?>" class="mt40">
			<fieldset class="<?= $pozadina ?>">
				<legend>Moji korisnički podaci</legend>		
				<div class="row">
					<div class="large-3 columns end">
						<?= Html::Input('Licenca vrijedi do', 'date', null, null, null, null, $podaci->istekLicence, array('readonly'=>'true')) ?>
					</div>
				</div>
				<?= Html::InputSaGreskom($greske, 'username', 'Korisničko ime', $podaci->username, 'text') ?>
				<span class="napomena">*Ukoliko ne mijenjate lozinku sljedeća polja ostavite prazna</span>
				<?= Html::InputSaGreskom($greske, 'password', 'Lozinka', null, 'password') ?>
				<?= Html::InputSaGreskom($greske, 'passwordAgain', 'Ponovo lozinka', null, 'password') ?>
			</fieldset>
			<div class="row">
				<div class="large-12 columns">
					<?= Html::Submit('Spremi', array('button','round','secondary','siroko')) ?>
				</div>
			</div>
		</form>
	</div>
</div>
<?php
include_once '../masters/masterBottom.php';
?>