<?php
include_once '../../../config/conf.php';
include_once '../../../kontrole/isAdmin.php';
$title = 'Grupe svrha';
$bodyClass = 'matrix';
$footerScript = '<script src="' . $putanjaApp . 'js/admin/financije/grupe/brisiGrupu.js"></script>';
include_once '../../../masters/masterHead.php';
include_once '../../../config/izbornik.php';
include_once '../../../sql/admin/financije/grupe/nadjiGrupe.php';
?>

<div class="row">
	<div class="large-1 columns large-centered mt15">	
		<a href="novaGrupa.php"><img src="<?= $putanjaApp ?>img/admin/new.png" alt="nova" /></a>
	</div>
	<fieldset class="crnaPozadina">
		<legend>Grupe</legend>	
			<div class="large-12 columns mt15">			
				<table class="sredina">
					<thead>				
						<tr>
							<td>Id</td>
							<td>Naziv grupe svrha</td>
							<td>Promijeni</td>
							<td>Briši</td>
						</tr>
					</thead>
					<tbody>
						<?php foreach($grupe as $grupa): ?>
							<tr>
								<td><?= $grupa->id ?></td>
								<td><?= $grupa->nazivGrupe ?></td>
								<td class="center">
									<a href="promjenaGrupe.php?id=<?= $grupa->id ?>"><img src="<?= $putanjaApp ?>img/admin/pen.png"/></a>
								</td>
								<td class="center">
									<a href="#" class="obrisi" id="<?= $grupa->id ?>"><img src="<?= $putanjaApp ?>img/admin/bin.png"/></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>		
			</div>
	</fieldset>
</div>

<?php
	include_once '../../../masters/masterBottom.php';
?>