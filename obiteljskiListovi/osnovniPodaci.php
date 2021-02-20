<div class="row mt40">
	<div class="large-4 large-centered columns">
		<?= Html::InputSaGreskom($greske, 'prezime', 'Prezime', $prezime, 'text') ?>
	</div>
	<div class="large-6 columns">
		<?= Html::InputSaGreskom($greske, 'adresa', 'Mjesto i adresa', $adresa, 'text') ?>
	</div>
	<div class="large-3 columns">
		<?= Html::Input('Telefon', 'text', 'telefon', 'telefon',null,null,$telefon) ?>
	</div>
	<div class="large-3 columns">
		<?= Html::Input('Došli iz', 'text', 'dosliIz', 'dosliIz',null,null,$dosliIz) ?>
	</div>
</div>