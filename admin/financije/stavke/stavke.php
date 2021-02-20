<?php
include_once '../../../config/conf.php';
include_once '../../../kontrole/isAdmin.php';
$title = 'Stavke izvješća';
$bodyClass = 'matrix';
$footerScript = '<script src="' . $putanjaApp . 'js/admin/financije/stavke/brisiStavku.js"></script>';
include_once '../../../masters/masterHead.php';
include_once '../../../config/izbornik.php';
include_once '../../../sql/admin/financije/stavke/nadjiStavke.php';
?>

<div class="row">
	<div class="large-1 columns large-centered mt15">	
		<a href="novaStavka.php"><img src="<?= $putanjaApp ?>img/admin/new.png" alt="nova" /></a>
	</div>
	<div class="large-12 columns mt15">	
		<fieldset class="crnaPozadina">
			<legend>Stavke izvješća</legend>			
			<table class="sredina">
				<thead>				
					<tr>
						<td style="max-width: 500px !important;">Naziv stavke</td>
						<td>Izvješće</td>
						<td>Grupa</td>
						<td>Promijeni</td>
						<td>Briši</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach($stavke as $stavka): ?>
						<tr>
							<td style="max-width: 500px !important;"><?= $stavka->nazivStavke ?></td>
							<td><?= $stavka->nazivIzvjesca ?></td>
							<td><?= $stavka->nazivGrupe ?></td>
							<td class="center">
								<a href="promjenaStavke.php?id=<?= $stavka->id ?>"><img src="<?= $putanjaApp ?>img/admin/pen.png"/></a>
							</td>
							<td class="center">
								<a href="#" class="obrisi" id="<?= $stavka->id ?>"><img src="<?= $putanjaApp ?>img/admin/bin.png"/></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>	
		</fieldset>	
	</div>
</div>

<?php
	include_once '../../../masters/masterBottom.php';
?>