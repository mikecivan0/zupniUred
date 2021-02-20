<div id="noviClan" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
	<?= Html::Input(null, "hidden", "akcija", "akcija") ?>
	<h2 id="modalTitle">Novi član</h2>	
	<div class="large-12 columns">		
		<?= Html::Input(null, "hidden", "modalClanId", "modalClanId") ?>
		<div class="large-9 large-centered columns mt40">			
			<?= Html::Input('<b>Učitaj podatke iz matica</b> (pretraga matica po imenu i prezimenu)', 'text', 'maticaModalOstali', 'maticaModalOstali') ?>
		</div>	
		<div class="large-6 large-centered columns mb15 mt80">			
			<?= Html::Input('Ime', 'text', 'ime', 'ime') ?>
		</div>
		<div class="large-6 columns center pt25">
			<h5>Rođenje</h5>
		</div>
		<div class="large-6 columns center pt25">
			<h5>Krštenje</h5>
		</div>
		<div class="large-3 columns">
			<?= Html::Input('Datum rođenja', 'date', 'datumRodjenja', 'datumRodjenja') ?>
		</div>
		<div class="large-3 columns">
			<?= Html::Input('Mjesto rođenja', 'text', 'mjestoRodjenja', 'mjestoRodjenja') ?>
		</div>
		<div class="large-3 columns">
			<?= Html::Input('Datum krštenja', 'date', 'datumKrstenja', 'datumKrstenja') ?>
		</div>
		<div class="large-3 columns">
			<?= Html::Input('Mjesto krštenja', 'text', 'mjestoKrstenja', 'mjestoKrstenja') ?>
		</div>
		<div class="large-6 columns center pt25">
			<h5>Pričest</h5>
		</div>
		<div class="large-6 columns center pt25">
			<h5>Potvrda</h5>
		</div>
		<div class="large-3 columns">
			<?= Html::Input('Datum pričesti', 'date', 'datumPricesti', 'datumPricesti') ?>
		</div>
		<div class="large-3 columns">
			<?= Html::Input('Mjesto pričesti', 'text', 'mjestoPricesti', 'mjestoPricesti') ?>
		</div>
		<div class="large-3 columns">
			<?= Html::Input('Datum potvrde', 'date', 'datumPotvrde', 'datumPotvrde') ?>
		</div>
		<div class="large-3 columns">
			<?= Html::Input('Mjesto potvrde', 'text', 'mjestoPotvrde', 'mjestoPotvrde') ?>
		</div>
		<div class="large-6 columns center pt25">
			<h5>Vjenčanje</h5>
		</div>
		<div class="large-6 columns center pt25">
			<h5>Smrt</h5>
		</div>
		<div class="large-3 columns">
			<?= Html::Input('Datum vjenčanja', 'date', 'datumVjencanja', 'datumVjencanja') ?>
		</div>
		<div class="large-3 columns">
			<?= Html::Input('Mjesto vjenčanja', 'text', 'mjestoVjencanja', 'mjestoVjencanja') ?>
		</div>
		<div class="large-3 columns">
			<?= Html::Input('Datum smrti', 'date', 'datumSmrti', 'datumSmrti') ?>
		</div>
		<div class="large-3 columns">
			<?= Html::Input('Mjesto smrti', 'text', 'mjestoSmrti', 'mjestoSmrti') ?>
		</div>
		<div class="large-12 columns">
			<?= Html::Button("Unesi", array("close-reveal-modal","siroko","mt40"),
									  array("id"=>"gumbModalaClana"),
									  array("font-size"=>"1.2rem","position"=>"relative","color"=>"white","right"=>"0","top"=>"1rem")) 
			?>
		</div>
	</div>
	<a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>