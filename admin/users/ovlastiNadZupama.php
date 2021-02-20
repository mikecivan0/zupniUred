<?php
include_once '../../config/conf.php';
include_once '../../kontrole/isAdmin.php';
if(!isset($_GET["id"])){
	header('location: index.php');
}else{
include_once '../../sql/admin/users/nadjiZupeNadKojimaUserImaOvlasti.php';
$footerScript = '<script src="' . $putanjaApp . 'js/admin/users/ovlastiNadZupama.js"></script>';
$title = 'Ovlasti nad župama';
$bodyClass = 'matrix';
include_once '../../alati/Html.php';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
?>
<div>
<div class="row mt40">
	<div style="height: 64px !important; padding-left: 75px !important;" class="large-3 large-centered columns">
		<img id="loader" style="display: none;" src="<?= $putanjaApp ?>img/loader.svg" alt='loader' />
	</div>
	<div class="large-12 columns">
		<fieldset class="crnaPozadina">
			<legend>Korisnik ima ovlasti nad sljedećim župama: </legend>
			<?= Html::Input(null, 'hidden', 'putanjaApp', 'putanjaApp',null,null,$putanjaApp,null,false) ?>
			<?= Html::Input(null, 'hidden', 'hfZupaId', 'hfZupaId',null,null,null,null,false) ?>
			<?= Html::Input(null, 'hidden', 'hfUserId', 'hfUserId',null,null,$_GET["id"],null,false) ?>
			<table class="siroko">
				<thead>
					<tr>
						<th>Naziv župe</th>
						<th>Naziv mjesta i poštanski broj</th>
						<th>Adresa ureda</th>
						<th class="center">Osnovne kalkulacije</th>
						<th class="center">Obriši</th>
					</tr>
				</thead>
				<tbody id="podaci">
					<?php foreach ($zupe as $zupa) { ?>
						<tr id="<?= $zupa->id ?>">
							<td><?= $zupa->nazivZupe ?></td>
							<td><?= $zupa->nazivMjesta . " " . $zupa->pbr ?></td>
							<td><?= $zupa->adresaUreda ?></td>
							<td class="center"><a class="kalkulacije" onclick="definirajKalkulacije(<?= $zupa->zupa_id ?>)" href="#"><img src="<?= $putanjaApp ?>img/admin/dollar.png" alt='bin' /></a></td>
							<td class="center"><a class="obrisi" onclick="definirajBrisanje(<?= $zupa->id ?>)" href="#"><img src="<?= $putanjaApp ?>img/admin/bin.png" alt='bin' /></a></td>
						</tr>
					<?php } ?>					
				</tbody>
			</table>
			<div class="row mt40">
				<div class="large-9 columns">
					<?= Html::Input('Upišite par slova župe ili mjesta kojeg želite dodati na popis', 'text', 'zupa', 'zupa',null,null,null,array('autofocus'=>'autofocus')) ?>
				</div>
				<div class="large-3 columns">
					<?= Html::Button('Dodaj', array('siroko','secondary','spremi','button','round'),array('onclick'=>'dodaj();')) ?>
				</div>
			</div>
			
		</fieldset>
		<?= Html::Button('Gotovo', array('siroko','secondary'),array('id'=>'zatvori','onclick'=>'window.close();')) ?>
	</div>
</div>
</div>
<?php
	include_once '../../masters/masterBottom.php';
}
?>