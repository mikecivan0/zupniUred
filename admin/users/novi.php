<?php
include_once '../../config/conf.php';
include_once '../../kontrole/isAdmin.php';
$greske = array();
if(isset($_POST)&&isset($_POST["username"])){
	include_once '../../kontrole/admin/users/novi.php';
	if(empty($greske)){
		include_once '../../sql/admin/users/novi.php';
	}
	
}
$istekLicence = date("Y-m-d", strtotime(date("Y-m-d") . " + 1 year"));
$footerScript = '<script src="' . $putanjaApp . 'js/admin/osobe/nadjiOsobuZaUsera.js"></script>';
$title = 'Novi korisnik';
$bodyClass = 'matrix';
include_once '../../alati/Html.php';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
?>
<div class="row mt40">
	<div class="large-12 columns">
		<fieldset class="crnaPozadina">
			<legend>Odabir osobe kojoj se želi dati status korisnika</legend>
			<?= Html::Input('Upišite par slova imena ili prezimena osobe koju tražite', 'text', 'osoba', 'osoba',null,null,null,array('autofocus'=>'autofocus')) ?>
		</fieldset>
		<form class="crnaPozadina" method="POST" action="<?= $_SERVER["PHP_SELF"] ?>">
			<fieldset>
				<legend>Podatci novog korisnika</legend>
				<?= Html::Input(null, 'hidden', 'osoba_id', 'osoba_id',null,null,null,null,false) ?>
				<?= Html::InputSaGreskom($greske, 'username', 'Korisničko ime', null, 'text') ?>
				<?= Html::Input('Istek licence', 'date', 'istekLicence', 'istekLicence',null,array('width'=>'150px'),$istekLicence) ?>
				<?= Html::Select('Razina', 'razina', 'razina', null, array(
																		array('text'=>'0 - župnik','id'=>'razina0','value'=>'0'),
																		array('text'=>'1','id'=>'razina1','value'=>'1'),
																		array('text'=>'2','id'=>'razina2','value'=>'2'),
																		array('text'=>'3 - administrator','id'=>'razina3','value'=>'3')
																		),
									array('width'=>'140px')) ?>
			<?= Html::InputSaGreskom($greske, 'password', 'Lozinka', null, 'password') ?>
			<?= Html::InputSaGreskom($greske, 'passwordAgain', 'Ponovo lozinka', null, 'password') ?>
			</fieldset>
			<?= Html::SpremiOdustani('index.php') ?>	
		</form>			
	</div>
</div>

<?php
	include_once '../../masters/masterBottom.php';
?>