<?php
include_once '../../../config/conf.php';
include_once '../../../kontrole/isAdmin.php';
$title = 'Položaji polja';
$bodyClass = 'matrix';
include_once '../../../masters/masterHead.php';
include_once '../../../alati/Html.php';
include_once '../../../alati/Alati.php';
$footerScript = "<script src=" . $putanjaApp . "js/admin/postavke/udaljenosti/poPrinterima/nadjiPrinterZaUredjivanjeSvihPolja.js></script>";
if(isset($_POST)&&isset($_POST["hfPrinterIdZaSpremanjeUdaljenosti"])){
	include_once '../../../sql/admin/udaljenosti/poPrinterima/urediSvaPoljaPoPrinteru.php'; 
}


include_once '../../../config/izbornik.php';

?>
<div class="row mt40">				
	<div class="large-12 columns crnaPozadina">
		<form id="forma" method="POST" action="<?= $_SERVER["PHP_SELF"] ?>">
			<fieldset>
				<legend>Odabir printera</legend>
				<div class="large-12 columns">				
					<?= Html::Input('Upišite par slova naziva printera kojeg tražite', 'text', 'printer', 'printer',null,null,null,array('autofocus'=>'autofocus')) ?>					
				</div>
					<?= Html::Input(null, 'hidden', 'hfPrinterIdZaSpremanjeUdaljenosti', 'hfPrinterIdZaSpremanjeUdaljenosti',null,null,null,null,false) ?>	
			<div class="large-12 columns" id="potvrda" <?php if(!$_POST): ?>style="display: none;" <?php endif; ?>>
				<?= Html::Input('Top polja', 'number', 'top', 'top') ?>
				<?= Html::Input('Left polja', 'number', 'left', 'left') ?>
				<?= Html::Submit('Spremi', array('button','secondary','siroko','mt15')) ?>			
			</div>
			</fieldset>				
		</form>			
	</div>
</div>

<?php
	include_once '../../../masters/masterBottom.php';
?>