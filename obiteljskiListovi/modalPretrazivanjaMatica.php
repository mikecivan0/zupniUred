<div id="pretragaMatica" class="reveal-modal medium" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog" data-multiple-opened="true">
	<?= Html::Input(null, "hidden", "odrediste", "odrediste") ?>
	<h2 id="modalTitle">Pretraga matica</h2>	
	<div class="large-12 columns">		
		<div class="large-9 large-centered columns mt40 mb40">			
			<?= Html::Input('Pretraga po imenu i prezimenu', 'text', 'maticaModal', 'maticaModal') ?>
		</div>	
	</div>
	<a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>