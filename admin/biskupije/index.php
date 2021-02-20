<?php
include_once '../../config/conf.php';
include_once '../../kontrole/isAdmin.php';
$title = 'Biskupije';
$bodyClass = 'matrix';
$footerScript = '<script src="' . $putanjaApp . 'js/admin/biskupije/brisiBiskupiju.js"></script>';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
include_once '../../sql/admin/biskupije/nadjiBiskupije.php';
?>

<div class="row">
	<div class="large-1 columns large-centered mt15">	
		<a href="nova.php"><img src="<?= $putanjaApp ?>img/admin/new.png" alt="nova" /></a>
	</div>
	<div class="large-8 large-centered columns mt15">					<fieldset class="crnaPozadina">			<legend>Biskupije</legend>
				<table class=" sredina">		
					<thead>						
						<tr>		
							<td>Id</td>		
							<td>Naziv (nad)biskupije</td>		
							<td>Promijeni</td>		
							<td>Briši</td>		
						</tr>		
					</thead>		
					<tbody>		
						<?php foreach($biskupije as $biskupija): ?>		
							<tr>		
								<td><?= $biskupija->id ?></td>		
								<td><?= $biskupija->nazivBiskupije ?></td>		
								<td class="center">		
									<a href="promjena.php?id=<?= $biskupija->id ?>"><img src="<?= $putanjaApp ?>img/admin/pen.png"/></a>		
								</td>		
								<td class="center">		
									<a href="#" class="obrisi" id="<?= $biskupija->id ?>"><img src="<?= $putanjaApp ?>img/admin/bin.png"/></a>		
								</td>		
							</tr>		
						<?php endforeach; ?>		
					</tbody>		
				</table>		</fieldset>		
	</div>
</div>

<?php
	include_once '../../masters/masterBottom.php';
?>