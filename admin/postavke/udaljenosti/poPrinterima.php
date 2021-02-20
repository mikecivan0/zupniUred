<?php
include_once '../../../config/conf.php';
include_once '../../../kontrole/isAdmin.php';
$title = 'Položaji polja';
$bodyClass = 'matrix';
include_once '../../../masters/masterHead.php';
include_once '../../../alati/Html.php';
include_once '../../../alati/Alati.php';
$footerScript = "<script src=" . $putanjaApp . "js/admin/postavke/udaljenosti/poPrinterima/nadjiPrinter.js></script>";
if(isset($_POST)&&isset($_POST["hfPrinterIdZaSpremanjeUdaljenosti"])){
	include_once '../../../sql/admin/udaljenosti/poPrinterima/nadjiUdaljenosti.php'; //napravi $objUdaljenosti id baze po ID-u printera
	$footerScript .= "<script src=" . $putanjaApp . "js/admin/postavke/udaljenosti/poPrinterima/spremiUdaljenosti.js></script>
					  <script src=" . $putanjaApp . "js/admin/postavke/udaljenosti/poPrinterima/kopirajOdDrugih.js></script>";
	$udaljenostiArray = Alati::strToArray($objUdaljenosti, "udaljenosti" . ucfirst($_GET["q"]));
}


include_once '../../../config/izbornik.php';

?>
<div class="row mt40">				
	<div class="large-12 columns crnaPozadina">
		<form id="forma" method="POST" action="<?= $_SERVER["PHP_SELF"] . "?q=" . $_GET["q"] ?>">
			<fieldset>
				<legend>Odabir printera</legend>
				<div class="large-10 columns">				
					<?= Html::Input('Upišite par slova naziva printera kojeg tražite', 'text', 'printer', 'printer',null,null,null,array('autofocus'=>'autofocus')) ?>					
				</div>
				<div class="large-2 columns">		
					<?= Html::Submit('Odaberi', array('button','round','siroko','spremi','secondary'),array('id'=>'odaberi'),array('display'=>'none')) ?>					
				</div>
					<?= Html::Input(null, 'hidden', 'hfPrinterIdZaSpremanjeUdaljenosti', 'hfPrinterIdZaSpremanjeUdaljenosti',null,null,null,null,false) ?>					
					<?= Html::Input(null, 'hidden', 'vrstaDokumenta', 'vrstaDokumenta',null,null,$_GET["q"],null,false) ?>	
			</fieldset>					
		</form>	
		<fieldset><legend>Udaljenosti u milimetrima</legend>
		<?php 	if(isset($_POST["hfPrinterIdZaSpremanjeUdaljenosti"])):
			echo "<div id='poljaVrijednosti' class='mt40'>";
				//kreiraj inpute iz dobivenog niza iz baze 
						foreach ($udaljenostiArray as $key => $value) {							
							echo "<div class='large-3 column end'>";					
								Html::Input(Alati::labela($key), 'number', $key, $key,null,null,$value,array('step'=>0.1));	
							echo "</div>";	
							echo ($key=="brojLeft"||$key=="vjencateljTopOna"||$key=="zupeStanovanjaTop"||$key=="datumPitanjaLeft"||
								  $key=="pregledaoMjestoIDatumLeft"||$key=="svjedok2Top"||$key=="djecaKrstenaLeft") ? "<hr />" : "";	
						}					
			echo "</div></fieldset>";	
				include_once "../../../masters/udaljenosti/poPrinterima/kopirajOdDrugih.php";	
				Html::Button('Spremi', array('button','secondary','siroko','mt15'),array('onclick'=>'spremiUdaljenosti();'));
		endif;	?>
		
	</div>
</div>

<?php
	include_once '../../../masters/masterBottom.php';
?>