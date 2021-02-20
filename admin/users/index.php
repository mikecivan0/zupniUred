<?php
include_once '../../config/conf.php';
include_once '../../kontrole/isAdmin.php';
include_once '../../alati/Html.php';
$title = 'Korisnici';
$bodyClass = 'matrix';
$footerScript = '<script src="' . $putanjaApp . 'js/admin/users/nadjiUsera.js"></script>
				 <script src="' . $putanjaApp . 'js/admin/users/spremiPromjene.js"></script>
				 <script src="' . $putanjaApp . 'js/admin/users/pokaziSakrijOvlastiNadZupama.js"></script>';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
?>
<div class="row">
	<div class="large-1 columns large-centered mt15 mb15">	
		<a href="novi.php"><img src="<?= $putanjaApp ?>img/admin/new.png" alt="novo" /></a>
	</div>
	<div class="large-12 columns crnaPozadina">
		<fieldset>
			<legend>Pretraga korisnika</legend>
			<?= Html::Input('Upišite par slova imena, prezimena ili korisničkog imena osobe koju tražite', 'text', 'user', 'user',null,null,null,array('autofocus'=>true)) ?>
		</fieldset>
	</div>
	<div class="large-12 columns crnaPozadina end">
		<fieldset class="podaci" style="display: none;">
			<legend>Rezultat pretrage</legend>
			<?= Html::Input(null, 'hidden', 'hfUserId', 'hfUserId',null,null,null,null,false) ?>
			<?= Html::InputSaGreskom($greske, 'username', 'Korisničko ime', null, 'text') ?>
			<div class="row">
				<div class="large-4 columns end">
					<?= Html::Input('Istek licence', 'date', 'istekLicence', 'istekLicence') ?>
				</div>
			</div>	
			<div class="row">
				<div class="large-4 columns end">
					<?= Html::Select('Aktivan', 'aktivan', 'aktivan', null,array(
																			array('text'=>'Aktivan','id'=>'aktivan1','value'=>'1'),
																			array('text'=>'Neaktivan','id'=>'aktivan0','value'=>'0')
																			)
									) ?>
				</div>
			</div>
			<div class="row">
				<div class="large-4 columns">	
					<?= Html::Select('Razina', 'razina', 'razina',null,array(
																		array('text'=>'0 - župnik','id'=>'razina0','value'=>'0'),
																		array('text'=>'1','id'=>'razina1','value'=>'1'),
																		array('text'=>'2','id'=>'razina2','value'=>'2'),
																		array('text'=>'3 - administrator','id'=>'razina3','value'=>'3')
																		),
									null,array('onchange'=>'func(this);')
									) ?>
				</div>
				<div class="large-8 columns" id="ovlastiNadZupama" style="display: none;"> 
					<a id="linkOvlasti" href="#" target="_blank"><input type="button" class="button round alert siroko promjenaOvlasti" value="Uredi ovlasti nad župama"/></a>					
				</div>
			</div>		
			<?= Html::InputSaGreskom($greske, 'password', 'Lozinka', null, 'password') ?>
			<?= Html::InputSaGreskom($greske, 'passwordAgain', 'Ponovo lozinka', null, 'password') ?>
		</fieldset>
		<div class="row">
				<div class="large-10 columns">
					<?= Html::Button('Spremi', array('siroko','secondary','spremi'),array('onclick'=>'spremi();'),array('display'=>'none')) ?>
				</div>
				<div class="large-2 columns">
					<a id="brisanje"><img  class="right spremi pt0" style="display: none;" src="../../img/admin/bin.png" /></a>
				</div>
			</div>
	</div>
</div>

<?php
	include_once '../../masters/masterBottom.php';
?> 

