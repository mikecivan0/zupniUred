<div class="row">
	<div class="large-12 columns">
		<fieldset>
			<legend>Kopiranje podataka iz drugih župa</legend>
			<div class="large-10 columns">
			<?= Html::Input('Upišite par slova iz imena župe, mjesta u kojem se župa nalazi ili naziv printera koji župa koristi', 'text', 'kopirajIzZupe', 'kopirajIzZupe') ?>
			<?= Html::Input(null, 'hidden', 'hfPrinterZaKopiranjeId', 'hfPrinterZaKopiranjeId',null,null,null,null,false) ?>
			</div>
			<div class="large-2 columns">
				<?= Html::Button('Kopiraj', array('spremi'),array('onclick'=>'kopirajIzZupe();')) ?>
			</div>
		</fieldset>
	</div>
</div>

