<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}
$footerScript .= '<script src="' . $putanjaApp . 'js/skripteStranica/caption.js"></script>';
?>
<div class="row pt60">
	<div class="large-2 columns">
		<p id="printP" class="caption">
			<img id="printImg" class="ml35" id="print" src="<?= $putanjaApp ?>img/print.ico" alt="Ispis" />
			<span id="printSpan" class="ml35">Ispis</span>
		</p>
	</div>
	<div class="large-2 columns">
		<p id="previewP" class="caption">
			<img id="previewImg" class="ml15" src="<?= $putanjaApp ?>img/print-preview.ico" alt="Pregled" />
			<span id="previewSpan" class="ml15">Pregled</span>
		</p>
	</div>
	<?php //ako je učitan spremljeni dokument onda daj mogućnost da se on i obriše
		if(isset($_GET["docId"])&&$_POST||isset($_POST["hfDocId"])){ ?>
			<div class="large-2 columns">
				<p id="deleteP" class="caption">
					<img id="deleteImg" src="<?= $putanjaApp ?>img/delete.png" alt="Obriši" />
					<span style="padding-left: 2px;" id="deleteSpan">Obriši</span>
				</p>
			</div>	
	<?php
		$footerScript .= '<script src="' . $putanjaApp . 'js/skripteStranica/brisanjeDokumenta.js"></script>';
	 } ?>
	<div class="large-2 columns end">
		<p id="saveP" class="caption">
			<img id="saveImg" src="<?= $putanjaApp ?>img/save.ico" alt="Spremi" />
			<span id="saveSpan">Spremi</span>
		</p>
	</div>
</div>
</fieldset>
</form>
</div>
</div>
