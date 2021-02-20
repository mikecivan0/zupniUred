<?php
if(!isset($_GET["id"])){
	header('location: ../../predlosci.php');
}
include_once '../../config/conf.php';
include_once '../../kontrole/isLogged.php';
include_once '../../sql/financije/nadjiZupu.php';

if (empty($zupa)) { //ako se pokuša mijenjati get[id] na župu u kojoj se nije župnik onda ga izbaci van
	session_destroy();
	header("location: ../../auth/prijava.php");
}
include_once '../../sql/financije/izvjesca/nadjiGodine.php';
include_once '../../alati/Html.php';
$bodyClass = "papinskaZastava";
$title = 'Godišnje izvješće';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
?>

<div class="row">
	<div class="large-12 columns mt15">
		<fieldset class="polja">
			<legend>Godišnja izvješća župe <?= $zupa->nazivZupe ?></legend>	
				<form target="_blank" id="forma" method="POST" action="izradaGodisnjegIzvjesca.php?id=<?= $_GET["id"] ?>">
					<div class="row">
						<div class="large-4 columns">
							<label for="godina">Izbor godine za koju se želi izvješće</label>
							<select id="godina" name="godina">
								<?php foreach ($godine as $godina) { 
									echo "<option value='" . $godina->godina . "'>" . $godina->godina . "</option>";
								}  ?>
							</select>
						</div>
						<div class="large-2 columns">
							<?= Html::Input('Broj', 'text', 'broj', 'broj',null,null,null,array('placeholder'=>'123')) ?>
						</div>
						<div class="large-2 columns">
							<?= Html::Input('Podbroj (GG)', 'text', 'podbroj', 'podbroj',null,null,null,
							    array('placeholder'=>date('y')
							    )) ?>
						</div>
						<div class="large-4 columns">
							<?= Html::Input('Gotovina u župnoj blagajni', 'number', 'gotovina', 'gotovina', null, null, null, array('step'=>'0.01')) ?>
						</div>	
					</div>
					<div class="row">
						<div class="large-4 large-offset-2 columns">
							<?= Html::Input('Od ukupnog stanja insvesticijska sredstva', 'number', 'investicije', 'investicije', null, null, null, array('step'=>'0.01')) ?>
						</div>			
						<div class="large-4 columns end">
							<?= Html::Input('Od ukupnog stanja sredstva redovitog života', 'number', 'redovitiZivot', 'redovitiZivot', null, null, null, array('step'=>'0.01')) ?>
						</div>	
					</div>	
					<div class="row">										
						<div class="large-7 columns large-centered">
							<?= Html::Textarea('Napomena župnika:', 'napomena', 'napomena', null, array('height'=>'90px !important','width'=>'520px;')) ?>
						</div>
						<div class="large-6 columns">
							<?= Html::Input('U (mjesto)', 'text', 'mjesto', 'mjesto') ?>
						</div>
						<div class="large-3 columns end">
							<?= Html::Input('Datum', 'date', 'datum', 'datum') ?>
						</div>
					</div>					
					<?= Html::Input(null, 'hidden', 'hfZupaId', 'hfZupaId', null, null, $_GET["id"]) ?>
				</form>	
				<p class="red mt40">*pod "Gotovina u župnoj blagajni" misli se na iznos koji se nalazi u župnoj blagajni ali još nije uplaćen na račun</p>		
				<p class="red">*stanje bankovnog računa će se automatski izračunati po principu "ukupni primici minus ukupni izdaci"</p>							
		</fieldset>
	</div>
</div>
<div class="row pt60">	
	<div class="large-2 columns">
		<img id="previewImg" class="ml15" src="<?= $putanjaApp ?>img/print-preview.ico" alt="Pregled" />
	</div>
	<div class="large-2 columns end">
		<img id="printImg" class="ml35" id="print" src="<?= $putanjaApp ?>img/print.ico" alt="Ispis" />
	</div>
</div>

<?php
	$footerScript .= '<script src="' . $putanjaApp . 'js/financije/izvjesca/ispis/godisnjeIzvjesce.js"></script>';
	include_once '../../masters/masterBottom.php';
?>