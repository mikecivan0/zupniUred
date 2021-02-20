<?php
include_once '../../config/conf.php';
include_once '../../kontrole/isLogged.php';
include_once '../../alati/Html.php';
$title = 'Matica krštenih +';
$footerScript .= '<script src="' . $putanjaApp . 'js/matice/maticaKrstenih.js"></script>';
$bodyClass = "papinskaZastava";
$pozadina = "polja";

if(isset($_GET)&&isset($_GET["poruka"])){
	$porukaOSpremanju = "Zapis je uspješno obrisan iz Matice";
}
if (isset($_POST) && isset($_POST["ime"])) {
	include_once '../../kontrole/matice/maticaKrstenih.php';
	if (empty($greske)) {
		include_once '../../sql/matice/maticaKrstenih.php';
	}
}

include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
?>
<div class="row mt40">
	<div class="large-12 columns">
		<?php if(strlen($porukaOSpremanju)>0){
		?>
		<div id="porukaSpremanja" class="large-10 large-centered columns">
			<div data-alert="" class="alert-box alert round center">
				<?php echo $porukaOSpremanju; ?>
				<a href="" class="close">×</a>
			</div>
		</div>
		<?php } ?>
		<form method="POST" action="<?= $_SERVER["PHP_SELF"] ?>" class="mt40">
			<div class="row mb40 polja">
				<div class="large-12 columns">
	        		<?= Html::Input('<b>Pretraga matica krštenih u svim Vašim župama</b> (pretraga po imenu i/ili prezimenu)', 'text', 'osoba', 'osoba') ?>
	       		</div>
			</div>			
			<fieldset class="<?= $pozadina ?>">
				<legend><?= $title ?></legend>
				 <div class="row">
	                 <div class="large-8 columns end">
	                    	<h5><u>Označite župu čiju maticu želite koristiti</u></h5>
	                    	<?php 
							if(!$_POST){
								$footerScript .= '<script src="' . $putanjaApp . 'js/skripteStranica/oznaciPrviRadioButton.js"></script>';   
							}						                    					                	
							include_once '../../sql/formulari/dohvatiZupe.php';
							include_once '../../alati/Alati.php';							
							foreach ($zupe as $zupa): ?>							
								<input type="radio" name="zupa" id="zupa<?= $zupa->id ?>" nazivZupe="<?= $zupa->nazivZupe ?>" value="<?= $zupa->id ?>" <?php if($_POST&&$_POST["zupa"]==$zupa->id){echo "checked='checked'";} ?>><?= $zupa->nazivZupe . ", " . $zupa->nazivMjesta ?><br>   
							<?php endforeach; ?>
	                 </div>	                
            	 </div>
			 <hr />
			 	<?= Html::Input(null, 'hidden', 'hfMkId', 'hfMkId',null,null,null,null,false) ?>
			 	<?= Html::Input(null, 'hidden', 'hfOsobaId', 'hfOsobaId',null,null,null,null,false) ?>
			 	<div class="large-3 columns">
			 		<?= Html::InputSaGreskom($greske, 'svezak', 'Svezak', null,'text') ?>
			 	</div>
			 	<div class="large-3 columns">
					<?= Html::InputSaGreskom($greske, 'zaGodinu', 'Za godinu', null,'text') ?>
			 	</div>
			 	<div class="large-3 columns">
					<?= Html::InputSaGreskom($greske, 'stranica', 'Stranica', null,'text') ?>
			 	</div>
			 	<div class="large-3 columns">
					<?= Html::InputSaGreskom($greske, 'broj', 'Broj', null,'text') ?>
			 	</div>
			 	<hr />
			 	<div class="large-4 large-offset-2 columns">
			 		<?= Html::InputSaGreskom($greske, 'datumKrstenja', 'Datum krštenja', null,'date') ?>
			 	</div>
			 	<div class="large-4 columns end">
					<?= Html::Input('Mjesto krštenja', 'text', 'mjestoKrstenja', 'mjestoKrstenja') ?>
			 	</div>
			 	<hr />
			 	<div class="large-6 columns">
					<?= Html::InputSaGreskom($greske, 'ime', 'Ime', null,'text') ?>
			 	</div>
			 	<div class="large-6 columns">
					<?= Html::InputSaGreskom($greske, 'prezime', 'Prezime', null,'text') ?>
			 	</div>
			 	<hr />
			 	<div class="large-3 columns">
					<?= Html::Select('Spol', 'spol', 'spol', null, array(array('value'=>'1','text'=>'Sin'),array('value'=>'0','text'=>'Kći'))) ?>
			 	</div>
			 	<div class="large-3 columns">
					<?= Html::InputSaGreskom($greske, 'datumRodjenja', 'Datum rođenja', null,'date') ?>
			 	</div>
			 	<div class="large-3 columns">
					<?= Html::InputSaGreskom($greske, 'mjestoRodjenja', 'Mjesto rođenja', null,'text') ?>
			 	</div>
			 	<div class="large-3 columns">
					<?= Html::Input('JMBG', 'text', 'jmbg', 'jmbg') ?>
			 	</div>
			 	<hr />
			 	<div class="large-4 columns">
					<?= Html::Input('Otac', 'text', 'otac', 'otac') ?>
			 	</div>
			 	<div class="large-4 columns">
					<?= Html::Input('Majka', 'text', 'majka', 'majka') ?>
			 	</div>
			 	<div class="large-4 columns">
					<?= Html::Select('Roditelji kanonski vjenčani', 'roditeljiVjencani', 'roditeljiVjencani', null, array(array('value'=>'1','text'=>'Da'),array('value'=>'0','text'=>'Ne'))) ?>
			 	</div>
			 	<hr />
			 	<div class="large-4 columns">
					<?= Html::Input('Mjesto prebivanja', 'text', 'mjestoPrebivanja', 'mjestoPrebivanja') ?>
			 	</div>
			 	<div class="large-4 columns">
					<?= Html::Input('Ulica', 'text', 'ulica', 'ulica') ?>
			 	</div>
			 	<div class="large-4 columns">
					<?= Html::Input('Kućni broj', 'text', 'kucniBroj', 'kucniBroj') ?>
			 	</div>
			 	<hr />
			 	<div class="large-6 columns">
					<?= Html::Input('Kum/kuma', 'text', 'kum', 'kum') ?>
			 	</div>
			 	<div class="large-6 columns">
					<?= Html::Input('Krstitelj', 'text', 'krstitelj', 'krstitelj') ?>
			 	</div>
			 	<hr />
			 	<div class="large-8 large-centered columns pb40">
					<?= Html::Textarea('Naknadne bilješke', 'zabiljeske', 'zabiljeske') ?>
			 	</div>
			 	<div class="large-6 columns">
					<?= Html::Input('Mjesto pričesti', 'text', 'mjestoPricesti', 'mjestoPricesti') ?>
			 	</div>
			 	<div class="large-6 columns">
					<?= Html::Input('Datum pričesti', 'date', 'datumPricesti', 'datumPricesti') ?>
			 	</div>
			 	<hr />
			 	<div class="large-6 columns">
					<?= Html::Input('Mjesto krizme', 'text', 'mjestoKrizme', 'mjestoKrizme') ?>
			 	</div>
			 	<div class="large-6 columns">
					<?= Html::Input('Datum krizme', 'date', 'datumKrizme', 'datumKrizme') ?>
			 	</div>
			 	<hr />
			 	<div class="row mb40 mt40">
					<div class="large-6 columns">
						<?= Html::Submit('Spremi', array('siroko','secondary','spremi','round','button')) ?>
					</div>
					<div id="brisanjeArea" class="large-6 columns" <?php echo (!isset($_POST["hfMkId"])||(isset($_POST["hfMkId"])&&strlen($porukaOSpremanju)==0)) ? "style='display: none;'" : null; ?>>
						<?= Html::Button('Obriši', array('siroko','alert','spremi','round','button'), array('id'=>'obrisi')) ?>
					</div>
				</div>
			</fieldset>			
		</form>
	</div>
</div>
<?php
include_once '../../masters/masterBottom.php';
?>