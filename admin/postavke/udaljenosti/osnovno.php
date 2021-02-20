<?php
include_once '../../../config/conf.php';
include_once '../../../kontrole/isAdmin.php';
$title = 'Položaji polja';
$bodyClass = 'matrix';
include_once '../../../masters/masterHead.php';
include_once '../../../alati/Html.php';
include_once '../../../alati/Alati.php';
include_once '../../../config/izbornik.php';
include_once '../../../sql/admin/udaljenosti/osnovno/nadjiUdaljenosti.php'; //krairaj $objKrsniList sa podacima udaljenosti
$footerScript .= "<script src=" . $putanjaApp . "js/cookie.js></script>
				 <script src=" . $putanjaApp . "js/skripteStranica/potvrdiFormuIScroll.js></script>
				 <script src=" . $putanjaApp . "js/admin/postavke/udaljenosti/grupnoUredjivanjePolja.js></script>";
if($_POST){
	include_once '../../../sql/admin/udaljenosti/osnovno/spremiDokument.php'; 
	$dokument = $_POST; //pretoči $_POST u $dokument da se ne mora raditi if ili switch u automatskom kreiranju inputa
}else{
	$dokument = Alati::strToArray($objDokument,"udaljenosti"); //kreiraj $krsniListArray za automatsko kreiranje inputa
}

?>
<div class="row">	
			<?php if(isset($poruka)){	?>	
					<div class="large-10 large-centered columns mt15">	
					<div data-alert="" class="alert-box alert radius">
						<?php echo $poruka; ?><a href="" class="close">×</a>
					</div>		
					</div>										
			<?php } ?>
	<div class="large-12 columns">	
		<?= Html::Input(null, 'hidden', 'hfScroll', 'hfScroll',null,null,null,null,false) ?>	
		<form method="POST" action="<?= $_SERVER["PHP_SELF"] . "?vrstaDokumenta=" . $_GET["vrstaDokumenta"] ?>">			
			<fieldset class="crnaPozadina">
				<legend><?= $objDokument -> nazivDokumenta ?></legend>
				<?php //kreiraj inpute iz dobivenog niza iz baze ili $_POST-a
				foreach ($dokument as $key => $value) {
							echo "<div class='large-3 column end'>";					
								Html::Input(Alati::labela($key), 'number', $key, $key,null,null,$value,array('step'=>0.1));	
							echo "</div>";	
							echo ($key=="brojLeft"||$key=="vjencateljTopOna"||$key=="zupeStanovanjaTop"||$key=="datumPitanjaLeft"||
								  $key=="pregledaoMjestoIDatumLeft"||$key=="svjedok2Top"||$key=="djecaKrstenaLeft") ? "<hr />" : "";					
				}			
  				?>
			</fieldset>			
		</form>
		<?php include_once '../../../masters/udaljenosti/pomjeriSve.php'; ?>
			<div id="obavijest" class="large-10 large-centered columns mt15" style="display: none;">	
				<div data-alert="" class="alert-box alert radius">
					Za spremanje vrijednosti pritisnite donju tipku "Spremi"<a href="" class="close">×</a>
				</div>		
			</div>		
		<?= Html::Submit("Spremi", array("button", "secondary", "siroko"),array("onclick"=>"potvrdiFormu();")) ?>			
	</div>
	
</div>

<?php
	include_once '../../../masters/masterBottom.php';
?>