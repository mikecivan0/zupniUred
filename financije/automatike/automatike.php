<?php

if(!isset($_GET["id"])){
	header('location: ../../predlosci.php');
}
include_once '../../config/conf.php';
include_once '../../kontrole/isLogged.php';
include_once '../../sql/financije/nadjiZupu.php';

if (empty($zupa)) { //ako se pokuša mijenjati get[id] na župu u kojoj se nije župnik onda ga izbaci van
	session_destroy();
	header("location: ../../auth/prijava.php");
}

$bodyClass = "papinskaZastava";
$title = 'Automatski unosi';

$footerScript = '<script src="' . $putanjaApp . 'js/financije/automatike/brisiAutomatiku.js"></script>';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
include_once '../../sql/financije/automatike/nadjiAutomatike.php';
?>

<div class="row">
	<div class="large-1 columns large-centered mt15">	
		<a href="novaAutomatika.php?id=<?= $_GET["id"] ?>"><img src="<?= $putanjaApp ?>img/admin/new.png" alt="nova" /></a>
	</div>	
	<div class="large-12 columns mt15">
		<fieldset class="polja">
			<legend>Automatski unosi župe <?= $zupa->nazivZupe ?></legend>	
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
								<a href="promjenaAutomatike.php?id=<?= $_GET["id"] ?>&automatika_id=<?= $automatika->id ?>"><img src="<?= $putanjaApp ?>img/admin/pen.png"/></a>
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
	include_once '../../masters/masterBottom.php';
?>