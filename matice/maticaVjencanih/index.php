<?php
include_once '../../config/conf.php';
include_once '../../kontrole/isLogged.php';
include_once '../../alati/Html.php';
$title = 'Matica vjenčanih';
$footerScript .= '<script src="' . $putanjaApp . 'js/matice/maticaVjencanih.js"></script>';
$bodyClass = "papinskaZastava";
$pozadina = "polja";

if(isset($_GET)&&isset($_GET["poruka"])){
	$porukaOSpremanju = "Zapis je uspješno obrisan iz Matice";
}

if (isset($_POST) && isset($_POST["datumVjencanja"])) {
	include_once '../../kontrole/matice/maticaVjencanih.php';
	if (empty($greske)) {
		include_once '../../sql/matice/maticaVjencanih.php';
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
	        		<?= Html::Input('<b>Pretraga matica vjenčanih u svim Vašim župama</b> (pretraga po imenu i/ili prezimenu jednog od supružnika)', 'text', 'osoba', 'osoba') ?>
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
			 <?= Html::Input(null, 'hidden', 'hfMvId', 'hfMvId',null,null,null,null,false) ?>
			 <?= Html::Input(null, 'hidden', 'hfMkIdOn', 'hfMkIdOn',null,null,null,null,false) ?>
			 <?= Html::Input(null, 'hidden', 'hfMkIdOna', 'hfMkIdOna',null,null,null,null,false) ?>
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
			<div class="large-4 columns large-centered">
			 	<?= Html::InputSaGreskom($greske, 'datumVjencanja', 'Datum vjenčanja', null,'date') ?>
            </div>
            <div class="large-12 columns mt40">
                <div class="large-6 columns center">
                    <h3>Zaručnik</h3>
                </div>
                <div class="large-6 columns center">
                    <h3>Zaručnica</h3>
                </div>
            </div>
          	<div class="large-6 columns">
			 	<?= Html::InputSaGreskom($greske, 'imeOn', 'Ime <a href="#" data-reveal-id="osobaModal">Dodaj osobu iz matice krštenih</a>', null,'text') ?>
			</div>
			<div class="large-6 columns">
			 	<?= Html::InputSaGreskom($greske, 'imeOna', 'Ime <a href="#" data-reveal-id="osobaModal">Dodaj osobu iz matice krštenih</a>', null,'text') ?>
			</div>
			<div class="large-6 columns">
			 	<?= Html::InputSaGreskom($greske, 'prezimeOn', 'Prezme', null,'text') ?>
			</div>
			<div class="large-6 columns">
			 	<?= Html::InputSaGreskom($greske, 'prezimeOna', 'Prezme', null,'text') ?>
			</div>
            <div class="large-6 columns">
			 	<?= Html::InputSaGreskom($greske, 'mjestoRodjenjaOn', 'Mjesto rođenja', null,'text') ?>
            </div>
            <div class="large-6 columns">
			 	<?= Html::InputSaGreskom($greske, 'mjestoRodjenjaOna', 'Mjesto rođenja', null,'text') ?>
            </div>
            <div class="large-6 columns">                 
			 	<?= Html::InputSaGreskom($greske, 'datumRodjenjaOn', 'Datum rođenja', null,'date') ?>
            </div>
            <div class="large-6 columns">                 
			 	<?= Html::InputSaGreskom($greske, 'datumRodjenjaOna', 'Datum rođenja', null,'date') ?>
            </div>
            <div class="large-6 columns">
				<?= Html::Input('JMBG', 'text', 'jmbgOn', 'jmbgOn') ?>
			</div>
			<div class="large-6 columns">
				<?= Html::Input('JMBG', 'text', 'jmbgOna', 'jmbgOna') ?>
			</div>
            <div class="large-6 columns">
				<?= Html::Input('Vjera', 'text', 'vjeraOn', 'vjeraOn') ?>
			</div>
			<div class="large-6 columns">
				<?= Html::Input('Vjera', 'text', 'vjeraOna', 'vjeraOna') ?>
			</div>
			<div class="large-6 columns">
				<?= Html::Input('Datum krštenja', 'date', 'datumKrstenjaOn', 'datumKrstenjaOn') ?>
			</div>
			<div class="large-6 columns">
				<?= Html::Input('Datum krštenja', 'date', 'datumKrstenjaOna', 'datumKrstenjaOna') ?>
			</div>
            <div class="large-6 columns">
				<?= Html::Input('Župa krštenja', 'text', 'zupaKrstenjaOn', 'zupaKrstenjaOn') ?>
			</div>
			<div class="large-6 columns">
				<?= Html::Input('Župa krštenja', 'text', 'zupaKrstenjaOna', 'zupaKrstenjaOna') ?>
			</div>
			<div class="large-6 columns">
				<?= Html::Input('Otac (ime, prezime)', 'text', 'otacOn', 'otacOn') ?>
			</div>
			<div class="large-6 columns">
				<?= Html::Input('Otac (ime, prezime)', 'text', 'otacOna', 'otacOna') ?>
			</div>
			<div class="large-6 columns">
				<?= Html::Input('Majka (ime, djev. prezime)', 'text', 'majkaOn', 'majkaOn') ?>
			</div>
			<div class="large-6 columns">
				<?= Html::Input('Majka (ime, djev. prezime)', 'text', 'majkaOna', 'majkaOna') ?>
			</div>
			<div class="large-6 columns">
				<?= Html::Input('Svjedoci (ime, prezime)', 'text', 'svjedokOn', 'svjedokOn') ?>
			</div>
			<div class="large-6 columns">
				<?= Html::Input('Svjedoci (ime, prezime)', 'text', 'svjedokOna', 'svjedokOna') ?>
			</div>
			<div class="large-6 columns end">
				<?= Html::Input('Vjenčatelj (ime, prezime, služba)', 'text', 'vjencatelj', 'vjencatelj') ?>
			</div>
			<div class="large-12 columns mb15">
				<?= Html::Textarea("Napomene, upisi i obavijesti", "zabiljeske", "zabiljeske") ?>	
			</div>
			<div class="row mb40 mt40">
				<div class="large-6 columns">
					<?= Html::Submit('Spremi', array('siroko','secondary','spremi','round','button')) ?>
				</div>
				<div id="brisanjeArea" class="large-6 columns" <?php echo (!isset($_POST["hfMvId"])||(isset($_POST["hfMvId"])&&strlen($porukaOSpremanju)==0)) ? "style='display: none;'" : null; ?>>
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
	<?php Html::Input("Dodaj osobu iz matice krštenih (pretraga po imenu i/ili ili prezimenu)", "text", "osobaMk", "osobaMk") ?>
  </div>
  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>
<?php
include_once '../../masters/masterBottom.php';
?>