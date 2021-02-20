<?php
include_once '../config/conf.php';
include_once '../kontrole/isLogged.php';
include_once '../alati/Html.php';
$title = 'Postavke ispisa';
$bodyClass = ($podaci->razina<3) ? "papinskaZastava" : "matrix";
$pozadina = ($podaci->razina<3) ? "polja" : "crnaPozadina";
if(isset($_POST)&&isset($_POST["rukopis"])){
	include_once '../sql/profil/spremiPostavkeIspisa.php';
}else{
	$_POST["rukopis"]=$podaci->rukopis;
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
				<legend>Koristi font rukopisa pri ispisu financija</legend>		
				<?= Html::Radio('rukopis', array(
												 array('id'=>'da','value'=>'1','labela'=>'Koristi'),
												 array('id'=>'ne','value'=>'0','labela'=>'Ne koristi'),
												 )
								) ?>
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