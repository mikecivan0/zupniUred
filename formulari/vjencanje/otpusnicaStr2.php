<div class="large-12 columns">
	<div class="row">
		<div class="large-5 large-centered columns mt40 mb40">
			<h4>B. ZAPISINIK O VJENČANJU</h4>
		</div>
		<div class="large-6 columns">
			<?= Html::Input("Ime i prezime zaručnika", "text","zarucnik","zarucnik") ?>
		</div>
		<div class="large-6 columns">
			<?= Html::Input("Ime i prezime zaručnice", "text", "zarucnica", "zarucnica") ?>
		</div>
		<div class="large-4 columns">
			<?= Html::Input("Vjenčali su se dana", "date", "datumVjencanja", "datumVjencanja") ?>
		</div>
		<div class="large-8 columns">
			<?= Html::Input("U crkvi", "text", "crkvaVjencanja", "crkvaVjencanja") ?>
		</div>
		<div class="large-12 columns">
			<?= Html::Input("Župa (točna adresa)", "text", "zupaVjencanja", "zupaVjencanja") ?>
		</div>
		<div class="large-12 columns">
			<?= Html::Input("Preda mnom (ime i prezime vjenčatelja)", "text", "sluzbenik", "sluzbenik") ?>
		</div>
		<div class="large-12 columns">
			<?= Html::Input("Svjedok 1 (ime, prezime, zanimanje i mjesto stanovanja)", "text", "svjedok1", "svjedok1") ?>
		</div>
		<div class="large-12 columns">
			<?= Html::Input("Svjedok 2 (ime, prezime, zanimanje i mjesto stanovanja)", "text", "svjedok2", "svjedok2") ?>
		</div>
	</div>

	<div class="row mt80">
		<div class="large-5 large-centered columns">
			<h4>C. UPISI I OBAVIJESTI</h4>
		</div>
	</div>
	<div class="row">
		<div class="large-5 columns pt25 end">
			<i class="mb40"><b>1. Vjenčanje upisano:</b></i>
		</div>
	</div>
	<div class="row">
		<div class="large-4 columns pt25">
			a) u <i>Maticu vjenčanih</i> ove župe
		</div>
		<div class="large-3 columns">
			<?= Html::Input("svez.", "text", "upisSvez", "upisSvez") ?>
		</div>
		<div class="large-2 columns">
			<?= Html::Input("str.", "text", "upisStr", "upisStr") ?>
		</div>
		<div class="large-3 columns">
			<?= Html::Input("br.", "text", "upisBr", "upisBr") ?>
		</div>
	</div>
	<div class="row">
		<div class="large-4 columns pt25">
			b) u <i>Maticu krštenih</i> ove župe
		</div>
		<div class="large-8 columns">
			<?= Html::Input("Matica", "text", "upisMaticaKrstenih", "upisMaticaKrstenih") ?>
		</div>
	</div>
	<div class="row">
		<div class="large-4 columns pt25">
			c) u knjigu <i>Stanje duša</i>
		</div>
		<div class="large-8 columns">
			<?= Html::Input("Knjiga", "text", "upisKnjiga", "upisKnjiga") ?>
		</div>
	</div>
	<div class="row">
		<div class="large-4 columns pt25">
			d) u <i>Kartoteku župe</i>
		</div>
		<div class="large-8 columns">
			<?= Html::Input("Kartoteka", "text", "upisKartoteka", "upisKartoteka") ?>
		</div>
	</div>

	<div class="row mt40">
		<div class="large-5 columns pt25 end">
			<i class="mb40"><b>2. Obavijest o vjenčanju poslana:</b></i>
		</div>
	</div>
	<div class="row mt15">
		<div class="large-12 columns">
			a) <i>župi krštenja:</i>
		</div>
		<div class="row">
			<div class="large-2 columns pt25">
				- za muža:
			</div>
			<div class="large-3 columns end">
				<?= Html::Input("kada?", "date", "poslanaObavijestOn", "poslanaObavijestOn") ?>
			</div>
		</div>
		<div class="row">
			<div class="large-2 columns pt25">
				- za ženu:
			</div>
			<div class="large-3 columns end">
				<?= Html::Input("kada?", "date", "poslanaObavijestOna", "poslanaObavijestOna") ?>
			</div>
		</div>
	</div>
	
	
	
	<div class="row mt40">
		<div class="large-10 columns end">
			b) <i>Potvrda o ispunjenju pretpostavki za sklapanje braka u vjerskom obliku</i>
		</div>
			<div class="large-3 columns pt25">
				vraćena Matičnom uredu
			</div>
			<div class="large-6 columns">
				<?= Html::Input("Matični ured", "text", "maticniUred", "maticniUred") ?>
			</div>
			<div class="large-3 columns">
				<?= Html::Input("dana", "date", "vracenoUredu", "vracenoUredu") ?>
			</div>
	</div>

	<div class="row mt40">
		<div class="large-5 columns pt25 end">
			<i class="mb40"><b>3. Župa krštenja potvrđuje upis vjenčanja:</b></i>
		</div>
	</div>
	<div class="row">
		<div class="large-2 columns pt25">
			- za muža:
		</div>
		<div class="large-3 columns">
			<?= Html::Input("kada?", "date", "potvrdaUpisaOnKada", "potvrdaUpisaOnKada") ?>
		</div>
		<div class="large-3 columns end">
			<?= Html::Input("br.", "text", "potvrdaUpisaOnBr", "potvrdaUpisaOnBr") ?>
		</div>
	</div>
	<div class="row">
		<div class="large-2 columns pt25">
			- za ženu:
		</div>
		<div class="large-3 columns">
			<?= Html::Input("kada?", "date", "potvrdaUpisaOnaKada", "potvrdaUpisaOnaKada") ?>
		</div>
		<div class="large-3 columns end">
			<?= Html::Input("br.", "text", "potvrdaUpisaOnaBr", "potvrdaUpisaOnaBr") ?>
		</div>
	</div>
</div>
