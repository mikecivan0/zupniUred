<div class="row">
	<div class="large-12 columns">
		<fieldset class="crnaPozadina">
			<legend>
				Grupno uređivanje polja
			</legend>
			<div class="row">
				<div class="large-3 columns">
					<?= Html::Input('Sva "top" polja pomjeri za', 'number', 'topGrupa', 'topGrupa', null, null, '0.0', array('step'=>'0.1')) ?>
				</div>
				<div class="large-9 columns">
					<?= Html::Button('Pomjeri "Top" polja', array('button','spremi','siroko'), array('onclick'=>'pomjeriZa(\'top\');')) ?>
				</div>
				<div class="large-3 columns">
					<?= Html::Input('Sva "left" polja pomjeri za', 'number', 'leftGrupa', 'leftGrupa', null, null, '0.0', array('step'=>'0.1')) ?>
				</div>
				<div class="large-9 columns">
					<?= Html::Button('Pomjeri "Left" polja', array('button','spremi','siroko'), array('onclick'=>'pomjeriZa(\'left\');')) ?>
				</div>
			</div>			
		</fieldset>
	</div>
</div>
