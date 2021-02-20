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
$title = 'Lista kalkulacija';

$footerScript = '<script src="' . $putanjaApp . 'js/financije/kalkulacije/brisiKalkualciju.js"></script>';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
include_once '../../sql/financije/kalkulacije/nadjiKalkulacije.php';
?>

<div class="row">
	<div class="large-1 columns large-centered mt15">	
		<a href="novaKalkulacija.php?id=<?= $_GET["id"] ?>"><img src="<?= $putanjaApp ?>img/admin/new.png" alt="nova" /></a>
	</div>	
	<div class="large-12 columns mt15">
		<fieldset class="polja">
			<legend>Lista kalkulacija župe <?= $zupa->nazivZupe ?></legend>	
				<table class="sredina">
					<thead>				
						<tr>
							<td style="max-width: 400px !important;">Stavka izvješća</td>
							<td>Stavka dnevnika</td>
							<td>Promijeni</td>
							<td>Briši</td>
						</tr>
					</thead>
					<tbody>
						<?php foreach($kalkulacije as $kalkulacija): ?>
							<tr>
								<td style="max-width: 400px !important;"><?= $kalkulacija->nazivIzvjesca . " - " . $kalkulacija->nazivGrupeStavke . " - " . $kalkulacija->nazivStavke ?></td>
								<td><?= $kalkulacija->nazivSvrhe . " - " . $kalkulacija->nazivGrupeSvrhe ?></td>
								<td class="center">
									<a href="promjenaKalkulacije.php?id=<?= $_GET["id"] ?>&kalkulacija_id=<?= $kalkulacija->id ?>"><img src="<?= $putanjaApp ?>img/admin/pen.png"/></a>
								</td>
								<td class="center">
									<a href="#" class="obrisi" id="<?= $kalkulacija->id ?>"><img src="<?= $putanjaApp ?>img/admin/bin.png"/></a>
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