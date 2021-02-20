<?php
include_once '../../../config/conf.php';
include_once '../../../kontrole/isAdmin.php';
$title = 'Stavke dnevnika';
$bodyClass = 'matrix';
$footerScript = '<script src="' . $putanjaApp . 'js/admin/financije/svrhe/brisiSvrhu.js"></script>';
include_once '../../../masters/masterHead.php';
include_once '../../../config/izbornik.php';
include_once '../../../sql/admin/financije/svrhe/nadjiSvrhe.php';
?>

<div class="row">
	<div class="large-1 columns large-centered mt15">	
		<a href="novaSvrha.php"><img src="<?= $putanjaApp ?>img/admin/new.png" alt="nova" /></a>
	</div>
	<div class="large-12 columns mt15">	
		<fieldset class="crnaPozadina">
			<legend>Stavke dnevnika</legend>			
			<table class="sredina">
				<thead>				
					<tr>
						<td>Id</td>
						<td>Stavka dnevnika</td>
						<td>Grupa</td>
						<td>Promijeni</td>
						<td>Briši</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach($svrhe as $svrha): ?>
						<tr>
							<td><?= $svrha->id ?></td>
							<td><?= $svrha->nazivSvrhe ?></td>
							<td><?= $svrha->nazivGrupe ?></td>
							<td class="center">
								<a href="promjenaSvrhe.php?id=<?= $svrha->id ?>"><img src="<?= $putanjaApp ?>img/admin/pen.png"/></a>
							</td>
							<td class="center">
								<a href="#" class="obrisi" id="<?= $svrha->id ?>"><img src="<?= $putanjaApp ?>img/admin/bin.png"/></a>
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