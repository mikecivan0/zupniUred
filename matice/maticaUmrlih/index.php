<?php
include_once '../../config/conf.php';
include_once '../../kontrole/isLogged.php';
include_once '../../alati/Html.php';
$title = 'Matica umrlih';
$footerScript .= '<script src="' . $putanjaApp . 'js/matice/maticaUmrlih.js"></script>';
$bodyClass = "papinskaZastava";
$pozadina = "polja";

if(isset($_GET)&&isset($_GET["poruka"])){
	$porukaOSpremanju = "Zapis je uspješno obrisan iz Matice";
}

if (isset($_POST) && isset($_POST["datumSmrti"])) {
	include_once '../../kontrole/matice/maticaUmrlih.php';
	if (empty($greske)) {
		include_once '../../sql/matice/maticaUmrlih.php';
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
	        		<?= Html::Input('<b>Pretraga matica umrlih u svim Vašim župama</b> (pretraga po imenu i/ili prezimenu preminulog)', 'text', 'osoba', 'osoba') ?>
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
			<?= Html::Input(null, 'hidden', 'hfMuId', 'hfMuId',null,null,null,null,false) ?>
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
			 	<div class="large-6 columns">
			 		<?= Html::InputSaGreskom($greske, 'datumSmrti', 'Datum smrti', null,'date') ?>
			 	</div>
			 	<div class="large-6 columns">
			 		<?= Html::InputSaGreskom($greske, 'mjestoSmrti', 'Mjesto smrti', null,'text') ?>
			 	</div>
			 	<div class="large-6 columns">
			 		<?= Html::InputSaGreskom($greske, 'datumPokopa', 'Datum pokopa', null,'date') ?>
			 	</div>
			 	<div class="large-6 columns">
			 		<?= Html::InputSaGreskom($greske, 'mjestoPokopa', 'Mjesto pokopa', null,'text') ?>
			 	</div>
			 	<hr />
			 	<div class="large-6 columns">
					<?= Html::InputSaGreskom($greske, 'ime', 'Ime  <a href="#" data-reveal-id="osobaModal">Dodaj osobu iz matice krštenih</a>', null,'text') ?>
			 	</div>
			 	<div class="large-6 columns">
					<?= Html::InputSaGreskom($greske, 'prezime', 'Prezime', null,'text') ?>
			 	</div>
			 	<hr />
			 	<div class="large-3 columns">
					<?= Html::Select('Spol', 'spol', 'spol', null, array(array('value'=>'1','text'=>'Sin'),array('value'=>'0','text'=>'Kći'))) ?>
			 	</div>
			 	<div class="large-3 columns">
					<?= Html::Input('Datum rođenja', 'date', 'datumRodjenja', 'datumRodjenja') ?>
			 	</div>
			 	<div class="large-3 columns">
					<?= Html::Input('Mjesto rođenja', 'text', 'mjestoRodjenja', 'mjestoRodjenja') ?>
			 	</div>
			 	<div class="large-3 columns">
					<?= Html::Input('JMBG', 'text', 'jmbg', 'jmbg') ?>
			 	</div>
			 	<hr />			 	
			 	<div class="large-4 columns">
					<?= Html::Input('Supružnik/supružnica', 'text', 'supruznik', 'supruznik') ?>
			 	</div>
			 	<div class="large-4 columns">
					<?= Html::Input('Otac', 'text', 'otac', 'otac') ?>
			 	</div>
			 	<div class="large-4 columns">
					<?= Html::Input('Majka', 'text', 'majka', 'majka') ?>
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
					<?= Html::Input('Potvrđen(a) sakramentima', 'text', 'potvrdjenSakramentima', 'potvrdjenSakramentima') ?>
			 	</div>
			 	<div class="large-6 columns">
					<?= Html::Input('Službenik', 'text', 'sluzbenik', 'sluzbenik') ?>
			 	</div>
			 	<hr />
			 	<div class="large-8 large-centered columns">
					<?= Html::Textarea('Naknadne bilješke', 'zabiljeske', 'zabiljeske') ?>
			 	</div>
			<div class="row mb40 mt40">
				<div class="large-6 columns">
					<?= Html::Submit('Spremi', array('siroko','secondary','spremi','round','button')) ?>
				</div>
				<div id="brisanjeArea" class="large-6 columns" <?php echo (!isset($_POST["hfMuId"])||(isset($_POST["hfMuId"])&&strlen($porukaOSpremanju)==0)) ? "style='display: none;'" : null; ?>>
					<?= Html::Button('Obriši', array('siroko','alert','spremi','round','button'), array('id'=>'obrisi')) ?>
				</div>
			</div>
			</fieldset>			
		</form>
	</div>
</div>

<div id="osobaModal" class="reveal-modal medium" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
  <h2 id="modalTitle">Pretraga matice krštenih</h2>
  <div class="large-12 columns">
	<?php Html::Input("Dodaj osobu iz matice krštenih (pretraga po imenu i/ili prezimenu)", "text", "osobaMk", "osobaMk") ?>
  </div>
  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>
<?php
include_once '../../masters/masterBottom.php';
?>