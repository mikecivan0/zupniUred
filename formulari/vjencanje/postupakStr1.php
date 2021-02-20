<div class="large-3 large-centered columns mt40">
	<h4>I. OSOBNI PODACI</h4>
</div>
<div class="large-7 large-centered columns mt40">
	<?= Html::Input('Prezime zaručnika i zaručnice', 'text', 'prezimena', 'prezimena',array('center')) ?>
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
	<?= Html::Input('Ime i prezime', 'text', 'imeIPrezimeOn', 'imeIPrezimeOn') ?>
</div>
<div class="large-6 columns">
	<?= Html::Input('Ime i prezime', 'text', 'imeIPrezimeOna', 'imeIPrezimeOna') ?>
</div>
<div class="large-6 columns">
	<?= Html::Input('Jedinstveni matični broj građana', 'number', 'jmbgOn', 'jmbgOn') ?>
</div>
<div class="large-6 columns">
	<?= Html::Input('Jedinstveni matični broj građana', 'number', 'jmbgOna', 'jmbgOna') ?>
</div>
<div class="large-3 columns">
	<?= Html::Input('Mjesto rođenja', 'text', 'mjestoRodjenjaOn', 'mjestoRodjenjaOn') ?>
</div>
<div class="large-3 columns">
	<?= Html::Input('Datum rođenja <a href="#" id="maloljetan" style="display: none;">Izjava roditelja</a>', 'date', 'datumRodjenjaOn', 'datumRodjenjaOn') ?>
</div>
<div class="large-3 columns">
	<?= Html::Input('Mjesto rođenja', 'text', 'mjestoRodjenjaOna', 'mjestoRodjenjaOna') ?>
</div>
<div class="large-3 columns">
	<?= Html::Input('Datum rođenja <a href="#" id="maloljetna" style="display: none;">Izjava roditelja</a>', 'date', 'datumRodjenjaOna', 'datumRodjenjaOna') ?>
</div>
<div class="large-6 columns">
	<?= Html::Input('Ime i prezime oca', 'text', 'otacOn', 'otacOn') ?>
</div>
<div class="large-6 columns">
	<?= Html::Input('Ime i prezime oca', 'text', 'otacOna', 'otacOna') ?>
</div>
<div class="large-6 columns">
	<?= Html::Input('Ime i prezime majke', 'text', 'majkaOn', 'majkaOn') ?>
</div>
<div class="large-6 columns">
	<?= Html::Input('Ime i prezime majke', 'text', 'majkaOna', 'majkaOna') ?>
</div>
<div class="large-6 columns">
	<?= Html::Input('Zanimanje', 'text', 'zanimanjeOn', 'zanimanjeOn') ?>
</div>
<div class="large-6 columns">
	<?= Html::Input('Zanimanje', 'text', 'zanimanjeOna', 'zanimanjeOna') ?>
</div>
<div class="large-3 columns">
	<?= Html::Input('Mjesto stanovanja', 'text', 'mjestoOn', 'mjestoOn') ?>
</div>
<div class="large-2 columns">
	<?= Html::Input('Ulica', 'text', 'ulicaOn', 'ulicaOn') ?>
</div>
<div class="large-1 columns">
	<?= Html::Input('K. br.', 'text', 'kBrOn', 'kBrOn') ?>
</div>
<div class="large-3 columns">
	<?= Html::Input('Mjesto stanovanja', 'text', 'mjestoOna', 'mjestoOna') ?>
</div>
<div class="large-2 columns">
	<?= Html::Input('Ulica', 'text', 'ulicaOna', 'ulicaOna') ?>
</div>
<div class="large-1 columns">
	<?= Html::Input('K. br.', 'text', 'kBrOna', 'kBrOna') ?>
</div>
<div class="large-6 columns">
	<?= Html::Input('Župa stanovanja', 'text', 'zupaStanovanjaOn', 'zupaStanovanjaOn') ?>
</div>
<div class="large-6 columns">
	<?= Html::Input('Župa stanovanja', 'text', 'zupaStanovanjaOna', 'zupaStanovanjaOna') ?>
</div>
<div class="large-6 columns" style="height: 70px !important;">
	<div id="onKatolik" style="display: none;">
		<a href="#" id="onKatolikIzjava" >Izjave i obećanja prigodom mješovite ženidbe</a><br />
		<a href="#" id="onKatolikMolbaZaOprost">Molba za oprost od zapreke različitosti vjere</a><br />
		<a href="#" id="onKatolikMolbaZaDopustenje">Molba za dopuštenje mješovite ženidbe</a>
	</div>
</div>
<div class="large-6 columns" style="height: 70px !important;">
	<div id="onaKatolik" style="display: none;">
		<a href="#" id="onaKatolikIzjava" >Izjave i obećanja prigodom mješovite ženidbe</a><br />
		<a href="#" id="onaKatolikMolbaZaOprost">Molba za oprost od zapreke različitosti vjere</a><br />
		<a href="#" id="onaKatolikMolbaZaDopustenje">Molba za dopuštenje mješovite ženidbe</a>
	</div>	
</div>

<div class="large-3 columns">
	<label>Vjera</label>
	<?= Html::Radio('vjeraOn', array(
									array('id'=>'katolikOn','value'=>'katolik','labela'=>'Rimokatolik'),
									array('id'=>'drugoOn','value'=>'drugo','labela'=>'Drugo')
								)) ?>
</div>	
<div class="large-3 columns">
	<?= Html::Input(null, 'text', 'vjeraOstaloOn', 'vjeraOstaloOn',array('mt15 mb0'),null,null,array('readonly'=>true),false) ?>
</div>
<div class="large-3 columns">
	<label>Vjera</label>		
	<?= Html::Radio('vjeraOna', array(
									array('id'=>'katolikOna','value'=>'katolik','labela'=>'Rimokatolik'),
									array('id'=>'drugoOna','value'=>'drugo','labela'=>'Drugo')
								)) ?>
		
</div>
<div class="large-3 columns">
	<?= Html::Input(null, 'text', 'vjeraOstaloOna', 'vjeraOstaloOna',array('mt15 mb0'),null,null,array('readonly'=>true),false) ?>
</div>
<div class="large-6 columns pt25">
	<?= Html::Input('Mjesto krštenja', 'text', 'mjestoKrstenjaOn', 'mjestoKrstenjaOn') ?>
</div>
<div class="large-6 columns pt25">
	<?= Html::Input('Mjesto krštenja', 'text', 'mjestoKrstenjaOna', 'mjestoKrstenjaOna') ?>
</div>
<div class="large-6 columns">
	<?= Html::Input('Župa krštenja', 'text', 'zupaKrstenjaOn', 'zupaKrstenjaOn') ?>
</div>
<div class="large-6 columns">
	<?= Html::Input('Župa krštenja', 'text', 'zupaKrstenjaOna', 'zupaKrstenjaOna') ?>
</div>
<div class="large-6 columns">
	<?= Html::Input('Datum krštenja', 'date', 'datumKrstenjaOn', 'datumKrstenjaOn') ?>
</div>
<div class="large-6 columns">
	<?= Html::Input('Datum krštenja', 'date', 'datumKrstenjaOna', 'datumKrstenjaOna') ?>
</div>
<div class="large-6 columns">
	<div class="large-4 columns pt25">
		Matica krštenih
	</div>
	<div class="large-3 columns">
		<?= Html::Input('svez.', 'text', 'svezOn', 'svezOn') ?>
	</div>
	<div class="large-2 columns">
		<?= Html::Input('str.', 'text', 'strOn', 'strOn') ?>
	</div>
	<div class="large-3 columns">
		<?= Html::Input('br.', 'text', 'brOn', 'brOn') ?>
	</div>
</div>
<div class="large-6 columns">
	<div class="large-4 columns pt25">
		Matica krštenih
	</div>
	<div class="large-3 columns">
		<?= Html::Input('svez.', 'text', 'svezOna', 'svezOna') ?>
	</div>
	<div class="large-2 columns">
		<?= Html::Input('str.', 'text', 'strOna', 'strOna') ?>
	</div>
	<div class="large-3 columns">
		<?= Html::Input('br.', 'text', 'brOna', 'brOna') ?>
	</div>
</div>
<div class="large-6 columns">
	<?= Html::Input('Župa potvrde', 'text', 'zupaPotvrdeOn', 'zupaPotvrdeOn') ?>
</div>
<div class="large-6 columns">
	<?= Html::Input('Župa potvrde', 'text', 'zupaPotvrdeOna', 'zupaPotvrdeOna') ?>
</div>
<div class="large-6 columns">
	<?= Html::Input('Datum potvrde', 'date', 'datumPotvrdeOn', 'datumPotvrdeOn') ?>
</div>
<div class="large-6 columns">
	<?= Html::Input('Datum potvrde', 'date', 'datumPotvrdeOna', 'datumPotvrdeOna') ?>
</div>
<div class="large-6 columns">
	<?= Html::Input('Župe u kojima se stanovalo duže od 3 mjeseca nakon navršene 16. godine života (naziv župe, naziv župe...)', 'text', 'zupeStanovanjaOn', 'zupeStanovanjaOn') ?>
</div>
<div class="large-6 columns">
	<?= Html::Input('Župe u kojima se stanovalo duže od 3 mjeseca nakon navršene 14. godine života (naziv župe, naziv župe...)', 'text', 'zupeStanovanjaOna', 'zupeStanovanjaOna') ?>
</div>