<div class="row">
	<div class="large-12 columns mt40">
		<div class="large-6 columns center mb40">
			<h3>Muž</h3>
		</div>
		<div class="large-6 columns center mb40">
			<h3>Žena</h3>
		</div>
	</div>
		<?= Html::Input(null, 'hidden', 'muzClanId', 'muzClanId',null,null,$muz->id,null,false) ?>
		<?= Html::Input(null, 'hidden', 'zenaClanId', 'zenaClanId',null,null,$zena->id,null,false) ?>
	<div class="large-3 columns mb15">
		<?= Html::Input('Ime  <a href="#" data-reveal-id="pretragaMatica" onclick="odrediste(1);">Učitajte podatke iz matica</a>', 'text', 'muzIme', 'muzIme',null,null,$muz->ime) ?>
	</div>
	<div style="border-right: 1px black solid;" class="large-3 columns mb15">
		<?= Html::Input('Zanimanje', 'text', 'muzZanimanje', 'muzZanimanje',null,null,$muz->zanimanje) ?>
	</div>
	<div class="large-3 columns mb15">
		<?= Html::Input('Ime  <a href="#" data-reveal-id="pretragaMatica" onclick="odrediste(2);">Učitajte podatke iz matica</a>', 'text', 'zenaIme', 'zenaIme',null,null,$zena->ime) ?>
	</div>
	<div class="large-3 columns mb15">
		<?= Html::Input('Zanimanje', 'text', 'zenaZanimanje', 'zenaZanimanje',null,null,$zena->zanimanje) ?>
	</div>
	<hr />
	<div class="large-12 columns center pt25">
		<h5>Rođenje</h5>
	</div>
	<div style="border-right: 1px black solid;" class="large-6 columns">
		<?= Html::Input('Datum rođenja', 'date', 'muzDatumRodjenja', 'muzDatumRodjenja',null,null,$muz->datumRodjenja) ?>
	</div>
	<div class="large-6 columns">
		<?= Html::Input('Datum rođenja', 'date', 'zenaDatumRodjenja', 'zenaDatumRodjenja',null,null,$zena->datumRodjenja) ?>
	</div>
	<div style="border-right: 1px black solid;" class="large-6 columns mb15">
		<?= Html::Input('Mjesto rođenja', 'text', 'muzMjestoRodjenja', 'muzMjestoRodjenja',null,null,$muz->mjestoRodjenja) ?>
	</div>
	<div class="large-6 columns mb15">
		<?= Html::Input('Mjesto rođenja', 'text', 'zenaMjestoRodjenja', 'zenaMjestoRodjenja',null,null,$zena->mjestoRodjenja) ?>
	</div>
	<hr />
	<div class="large-12 columns center pt25">
		<h5>Krštenje</h5>
	</div>
	<div style="border-right: 1px black solid;" class="large-6 columns">
		<?= Html::Input('Datum krštenja', 'date', 'muzDatumKrstenja', 'muzDatumKrstenja',null,null,$muz->datumKrstenja) ?>
	</div>
	<div class="large-6 columns">
		<?= Html::Input('Datum krštenja', 'date', 'zenaDatumKrstenja', 'zenaDatumKrstenja',null,null,$zena->datumKrstenja) ?>
	</div>
	<div style="border-right: 1px black solid;" class="large-6 columns mb15">
		<?= Html::Input('Mjesto krštenja', 'text', 'muzMjestoKrstenja', 'muzMjestoKrstenja',null,null,$muz->datumKrstenja) ?>
	</div>
	<div class="large-6 columns mb15">
		<?= Html::Input('Mjesto krštenja', 'text', 'zenaMjestoKrstenja', 'zenaMjestoKrstenja',null,null,$zena->datumKrstenja) ?>
	</div>
	<hr />
	<div class="large-12 columns center pt25">
		<h5>Prva pričest</h5>
	</div>
	<div style="border-right: 1px black solid;" class="large-6 columns">
		<?= Html::Input('Datum prve pričesti', 'date', 'muzDatumPricesti', 'muzDatumPricesti',null,null,$muz->datumPricesti) ?>
	</div>
	<div class="large-6 columns">
		<?= Html::Input('Datum prve pričesti', 'date', 'zenaDatumPricesti', 'zenaDatumPricesti',null,null,$zena->datumPricesti) ?>
	</div>
	<div style="border-right: 1px black solid;" class="large-6 columns mb15">
		<?= Html::Input('Mjesto prve pričesti', 'text', 'muzMjestoPricesti', 'muzMjestoPricesti',null,null,$muz->mjestoPricesti) ?>
	</div>
	<div class="large-6 columns mb15">
		<?= Html::Input('Mjesto prve pričesti', 'text', 'zenaMjestoPricesti', 'zenaMjestoPricesti',null,null,$zena->mjestoPricesti) ?>
	</div>
	<hr />
	<div class="large-12 columns center pt25">
		<h5>Potvrda</h5>
	</div>
	<div style="border-right: 1px black solid;" class="large-6 columns">
		<?= Html::Input('Datum potvrde', 'date', 'muzDatumPotvrde', 'muzDatumPotvrde',null,null,$muz->datumPotvrde) ?>
	</div>
	<div class="large-6 columns">
		<?= Html::Input('Datum potvrde', 'date', 'zenaDatumPotvrde', 'zenaDatumPotvrde',null,null,$zena->datumPotvrde) ?>
	</div>
	<div style="border-right: 1px black solid;" class="large-6 columns mb40">
		<?= Html::Input('Mjesto potvrde', 'text', 'muzMjestoPotvrde', 'muzMjestoPotvrde',null,null,$muz->mjestoPotvrde) ?>
	</div>
	<div class="large-6 columns mb40">
		<?= Html::Input('Mjesto potvrde', 'text', 'zenaMjestoPotvrde', 'zenaMjestoPotvrde',null,null,$zena->mjestoPotvrde) ?>
	</div>
	<div class="large-12 columns center pt25">
		<h5>Smrt</h5>
	</div>
	<div style="border-right: 1px black solid;" class="large-6 columns">
		<?= Html::Input('Datum smrti', 'date', 'muzDatumSmrti', 'muzDatumSmrti',null,null,$muz->datumSmrti) ?>
	</div>
	<div class="large-6 columns">
		<?= Html::Input('Datum smrti', 'date', 'zenaDatumSmrti', 'zenaDatumSmrti',null,null,$zena->datumSmrti) ?>
	</div>
	<div style="border-right: 1px black solid;" class="large-6 columns mb40">
		<?= Html::Input('Mjesto smrti', 'text', 'muzMjestoSmrti', 'muzMjestoSmrti',null,null,$muz->mjestoSmrti) ?>
	</div>
	<div class="large-6 columns mb40">
		<?= Html::Input('Mjesto smrti', 'text', 'zenaMjestoSmrti', 'zenaMjestoSmrti',null,null,$zena->mjestoSmrti) ?>
	</div>
	<div class="large-6 columns mb15">		
		<?= Html::Button('Obriši podatke muža', array('siroko','alert'),array('id'=>'obrisiMuza'),$muzDisplay) ?>
	</div>
	<div class="large-6 columns mb15">
		<?= Html::Button('Obriši podatke žene', array('siroko','alert'),array('id'=>'obrisiZenu'),$zenaDisplay) ?>
	</div>
	<hr />
	<div class="large-12 columns center pt25">
		<h5>Vjenčanje</h5>
	</div>
	<div class="large-6 columns">
		<?= Html::Input('Datum crkvenog vjenčanja', 'date', 'crkvenoKada', 'crkvenoKada',null,null,$crkvenoKada) ?>
	</div>
	<div class="large-6 columns">
		<?= Html::Input('Datum civilnog vjenčanja', 'date', 'civilnoKada', 'civilnoKada',null,null,$civilnoKada) ?>
	</div>
	<div class="large-6 columns">
		<?= Html::Input('Mjesto crkvenog vjenčanja', 'text', 'crkvenoGdje', 'crkvenoGdje',null,null,$crkvenoGdje) ?>
	</div>	
	<div class="large-6 columns">
		<?= Html::Input('Mjesto civilnog vjenčanja', 'text', 'civilnoGdje', 'civilnoGdje',null,null,$civilnoGdje) ?>
	</div>
	<hr />
	<div class="large-12 columns center pt25">
		<h5>Opaske</h5>
	</div>
	<div class="large-12 columns">
		<?= Html::Textarea('Opaske', 'opaske', 'opaske',null,null,$opaske) ?>
	</div>
</div>