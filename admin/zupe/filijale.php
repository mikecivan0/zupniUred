<?php
include_once '../../config/conf.php';
include_once '../../kontrole/isAdmin.php';
if(!isset($_GET["id"])){
	header('location: index.php');
}else{
include_once '../../sql/admin/filijale/nadjiFilijale.php';
$footerScript = '<script src="' . $putanjaApp . 'js/admin/filijale/nadjiFilijalu.js"></script>
				 <script src="' . $putanjaApp . 'js/admin/filijale/dodajBrisiFilijalu.js"></script>';
$title = 'Filijale';
$bodyClass = 'matrix';
include_once '../../alati/Html.php';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
?>
<div class="row mt40">
	<div class="large-12 columns">
		<fieldset class="crnaPozadina">
			<legend>Župi pripadaju filijale: </legend>
			<?= Html::Input(null, 'hidden', 'putanjaApp', 'putanjaApp',null,null,$putanjaApp,null,false) ?>
			<?= Html::Input(null, 'hidden', 'hfZupaId', 'hfZupaId',null,null,$_GET["id"],null,false) ?>
			<?= Html::Input(null, 'hidden', 'hfNovaFilijalaId', 'hfNovaFilijalaId',null,null,null,null,false) ?>
			<table class="siroko">
				<thead>
					<tr>
						<th>Naziv mjesta</th>
						<th>Poštanski broj</th>
						<th class="center">Obriši</th>
					</tr>
				</thead>
				<tbody id="podaci">
					<?php
							foreach ($filijale as $filijala) { ?>
								<tr id="<?= $filijala->id ?>">
									<td><?= $filijala->nazivMjesta ?></td>
									<td><?= $filijala->pbr ?></td>
									<td class="center"><a class="obrisi" onclick="definirajBrisanje(<?= $filijala->id ?>)" href="#"><img src="<?= $putanjaApp ?>img/admin/bin.png" alt='bin' /></a></td>
								</tr>
							<?php } ?>					
				</tbody>
			</table>
			<hr class="mt40" />
			<div class="row mt40">
				<div class="large-9 columns">
				    <?= Html::Input('Upišite par slova mjesta kojeg želite dodati na popis', 'text', 'filijala', 'filijala',null,null,null,array('autofocus'=>'autofocus')) ?>
				</div>
				<div class="large-3 columns">
					<?= Html::Button('Dodaj', array('siroko','secondary','spremi','button','round'),array('onclick'=>'dodaj();')) ?>
				</div>
			</div>
			
		</fieldset>
		<?= Html::Button('Gotovo', array('siroko','secondary'),array('onclick'=>'window.close();','id'=>'zatvori')) ?>
	</div>
</div>

<?php
	include_once '../../masters/masterBottom.php';
}
?>