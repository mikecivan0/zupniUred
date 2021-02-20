<?php
include_once '../../config/conf.php';
include_once '../../kontrole/isAdmin.php';
include_once '../../alati/Html.php';
$footerScript = '<script src="' . $putanjaApp . 'js/admin/logs/nadjiUsera.js"></script>';
$title = 'Logs';
$bodyClass = 'matrix';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
if($_POST||isset($_GET["user"])){
	include_once '../../sql/admin/logs/nadjiLogove.php';	
}else{
	include_once '../../sql/admin/logs/nadjiZadnjeLogove.php';
	
}
include_once '../../alati/Alati.php';
?>
<div class="row mt40">
	<div class="large-12 columns">
		<fieldset class="crnaPozadina">
			<legend>Pretraga prijava</legend>
			<div class="large-10 columns crnaPozadina">				
				<?= Html::Input('Upišite par slova korisničkog imena ili imena osobe koju tražite', 'text', 'target', 'target',null,null,null,array('autofocus'=>'autofocus')) ?>				
			</div>
			<div class="large-2 columns">
				<form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST" class="pt22">
					<?= Html::Input(null, 'hidden', 'hfUserId', 'hfUserId',null,null,null,null,false) ?>			
					<?= Html::Submit('Nadji', null) ?>		
				</form>		
			</div>
		</fieldset>
	</div>
	
	<div class="large-12 columns crnaPozadina">
		<fieldset>
			<?php if($brojStranica>1): ?>
					<ul class="pagination left" role="menubar" aria-label="Pagination">
						<?= Alati::prethodnaStranica() ?>
						<?= Alati::sljedecaStranica($brojStranica) ?>
					</ul>
			<?php endif; ?>
			<ul class="pagination right" role="menubar" aria-label="Pagination">
				<li>Stranica <?= $_GET["stranica"] . " od " . $brojStranica ?></li>
			</ul>
			<legend>Rezultati pretrage</legend>
			<table class="siroko">
				<thead>
					<tr>
						<td class="center">Osoba</td>
						<td class="center">Korisničko ime</td>
						<td class="center">Browser</td>
						<td class="center">Datum</td>
						<td class="center">Vrijeme</td>					
					</tr>
				</thead>
				<tbody>
					<?php
						foreach ($prijave as $prijava) { ?>
							<tr">
								<td class="center <?= ($prijava->tip==0) ? 'red' : 'green' ?>"><?= $prijava->osoba ?></td>
								<td class="center <?= ($prijava->tip==0) ? 'red' : 'green' ?>"><?= $prijava->username ?></td>
								<td class="center <?= ($prijava->tip==0) ? 'red' : 'green' ?>"><?= $prijava->browser ?></td>
								<td class="center <?= ($prijava->tip==0) ? 'red' : 'green' ?>"><?= Alati::datum($prijava->datum) ?></td>
								<td class="center <?= ($prijava->tip==0) ? 'red' : 'green' ?>"><?= $prijava->vrijeme ?></td>
							</tr>
					<?php } ?>
				</tbody>
			</table>			
		</fieldset>
	</div>
</div>

<?php
	include_once '../../masters/masterBottom.php';
?>