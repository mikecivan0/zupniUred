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
$title = 'Stavke dnevnika';
$footerScript = '<script src="' . $putanjaApp . 'js/financije/svrhe/brisiSvrhu.js"></script>';
include_once '../../alati/Html.php';
include_once '../../sql/financije/svrhe/dohvatiSvrhe.php';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';

?>
<div class="row">
	<div class="large-1 columns large-centered mt15">	
		<a href="novaSvrha.php?zupa_id=<?= $_GET["id"] ?>"><img src="<?= $putanjaApp ?>img/admin/new.png" alt="nova" /></a>
	</div>
	<div class="large-12 columns mt15">
		<fieldset class="polja">
			<legend>Stavke dnevnika župe <?= $zupa->nazivZupe ?></legend>
			<table class="sredina siroko">
				<thead>				
					<tr>
						<td>Grupa</td>
						<td>Naziv stavke dnevnika</td>
						<td>Promijeni</td>
						<td>Briši</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach($svrhe as $svrha): ?>
						<tr>
							<td><?= $svrha->nazivGrupe ?></td>
							<td><?= $svrha->nazivSvrhe ?></td>
							<td class="center">
								<a href="promjenaSvrhe.php?id=<?= $svrha->id . '&zupa_id=' . $_GET['id'] ?>"><img src="<?= $putanjaApp ?>img/admin/pen.png"/></a>
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
	include_once '../../masters/masterBottom.php';
?>