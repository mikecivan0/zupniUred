<?php
include_once '../../config/conf.php';
include_once '../../kontrole/dozvola.php';
include_once '../../alati/Html.php';
$title = 'Vjenčani list';
$legend = 'Vjenčani list';
$formId = 'vjencaniList';
$postURL = $putanjaApp . 'printanje/vjencanje/vjencaniList.php?vrstaDokumenta=3';
$bodyClass = 'papinskaZastava';
$zaglavljeDokumenta = 'U Matici vjenčanih rimokatoličke župe';
include_once '../../masters/masterHead.php'; 
include_once '../../config/izbornik.php'; ?>
<div class="row mt40 polja">
	<div class="large-12 columns">
		<?= Html::Input('<b>Učitajte zapis iz matica vjenčanih svih Vaših župa</b> (pretraga po imenu i/ili prezimenu jednog od supružnika)', 'text', 'zapis', 'zapis') ?>
	</div>
</div>
<?php
include_once '../osnovaDokumentaTop.php';
?>
<div class="row">
            <div class="large-3 columns end">
				<?= Html::Input('Datum vjenčanja', 'date', 'datumVjencanja', 'datumVjencanja') ?>
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
				<?= Html::Input('Ime', 'text', 'imeOn', 'imeOn') ?>
			</div>
			<div class="large-6 columns">
				<?= Html::Input('Ime', 'text', 'imeOna', 'imeOna') ?>
			</div>
			<div class="large-6 columns">
				<?= Html::Input('Prezime', 'text', 'prezimeOn', 'prezimeOn') ?>
			</div>
			<div class="large-6 columns">
				<?= Html::Input('Prezime', 'text', 'prezimeOna', 'prezimeOna') ?>
			</div>
            <div class="large-6 columns">
				<?= Html::Input('Mjesto rođenja', 'text', 'mjestoRodjenjaOn', 'mjestoRodjenjaOn') ?>
            </div>
            <div class="large-6 columns">
				<?= Html::Input('Mjesto rođenja', 'text', 'mjestoRodjenjaOna', 'mjestoRodjenjaOna') ?>
            </div>
            <div class="large-6 columns">                 
				<?= Html::Input('Datum rođenja', 'date', 'datumRodjenjaOn', 'datumRodjenjaOn') ?>
            </div>
            <div class="large-6 columns">                 
				<?= Html::Input('Datum rođenja', 'date', 'datumRodjenjaOna', 'datumRodjenjaOna') ?>
            </div>
            <div class="large-6 columns">
				<?= Html::Input('Jedinstveni matični broj građana', 'text', 'jmbgOn', 'jmbgOn') ?>
			</div>
			<div class="large-6 columns">
				<?= Html::Input('Jedinstveni matični broj građana', 'text', 'jmbgOna', 'jmbgOna') ?>
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
			<div class="large-6 columns">
				<?= Html::Input('Vjenčatelj (ime, prezime, služba)', 'text', 'vjencateljOn', 'vjencateljOn',null,null,null,array('onkeyup'=>'dupliraj();')) ?>
			</div>
			<div class="large-6 columns">
				<?= Html::Input('Vjenčatelj (ime, prezime, služba)', 'text', 'vjencateljOna', 'vjencateljOna') ?>
			</div>
			<div class="large-12 columns mb15">
				<?= Html::Textarea("Napomene, upisi i obavijesti", "zabiljeske", "zabiljeske") ?>	
			</div>
			<div class="large-3 columns end">
				<?= Html::Input("Datum", "date", "datum", "datum",null,null,date("Y-m-d")) ?>
			</div>
    </div>
<?php 
include_once '../osnovaDokumentaBottom.php'; 
$footerScript = $footerScript . '<script src="' . $putanjaApp . 'js/skripteStranica/vjencanje/vjencaniList.js"></script>';
include_once '../../masters/masterBottom.php';
?>