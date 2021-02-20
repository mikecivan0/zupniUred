<?php
include_once '../../../config/conf.php';
include_once '../../../kontrole/isAdmin.php';
$title = 'Izvješća';
$bodyClass = 'matrix';
$footerScript = '<script src="' . $putanjaApp . 'js/admin/financije/izvjesca/brisiIzvjesce.js"></script>';
include_once '../../../masters/masterHead.php';
include_once '../../../config/izbornik.php';
include_once '../../../sql/admin/financije/izvjesca/nadjiIzvjesca.php';
?>

<div class="row">
	<div class="large-1 columns large-centered mt15">	
		<a href="novoIzvjesce.php"><img src="<?= $putanjaApp ?>img/admin/new.png" alt="nova" /></a>
	</div>
	<div class="large-12 columns mt15">	
		<fieldset class="crnaPozadina">
			<legend>Izvješća</legend>			
			<table class=" sredina">
				<thead>				
					<tr>
						<td>Id</td>
						<td>Naziv izvješća</td>
						<td>Promijeni</td>
						<td>Briši</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach($izvjesca as $izvjesce): ?>
						<tr>
							<td><?= $izvjesce->id ?></td>
							<td><?= $izvjesce->nazivIzvjesca ?></td>
							<td class="center">
								<a href="promjenaIzvjesca.php?id=<?= $izvjesce->id ?>"><img src="<?= $putanjaApp ?>img/admin/pen.png"/></a>
							</td>
							<td class="center">
								<a href="#" class="obrisi" id="<?= $izvjesce->id ?>"><img src="<?= $putanjaApp ?>img/admin/bin.png"/></a>
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