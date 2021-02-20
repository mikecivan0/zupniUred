<?php
include_once '../../../config/conf.php';
include_once '../../../kontrole/isAdmin.php';
$title = 'Automatski unosi';
$bodyClass = 'matrix';
$footerScript = '<script src="' . $putanjaApp . 'js/admin/financije/automatike/brisiAutomatiku.js"></script>';
include_once '../../../masters/masterHead.php';
include_once '../../../config/izbornik.php';
include_once '../../../sql/admin/financije/automatike/nadjiAutomatike.php';
?>

<div class="row">
	<div class="large-1 columns large-centered mt15">	
		<a href="novaAutomatika.php"><img src="<?= $putanjaApp ?>img/admin/new.png" alt="nova" /></a>
	</div>
	<div class="large-12 columns mt15">		
		<fieldset class="crnaPozadina">
			<legend>Automatski unosi</legend>	
			<table class="siroko">
				<thead>				
					<tr>
						<td>Ručnim unosom ove stavke</td>
						<td>ova stavka će se automatski unijeti</td>
						<td>Promijeni</td>
						<td>Briši</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach($automatike as $automatika): ?>
						<tr>
							<td><?= $automatika->primSvrhaNaziv . " - " . $automatika->primGrupaNaziv ?></td>
							<td><?= $automatika->autoSvrhaNaziv . " - " . $automatika->autoGrupaNaziv ?></td>			
							<td class="center">
								<a href="promjenaAutomatike.php?id=<?= $automatika->id ?>"><img src="<?= $putanjaApp ?>img/admin/pen.png"/></a>
							</td>
							<td class="center">
								<a href="#" class="obrisi" id="<?= $automatika->id ?>"><img src="<?= $putanjaApp ?>img/admin/bin.png"/></a>
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