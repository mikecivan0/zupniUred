<?php
if(!isset($_GET["id"])){
	exit;
}
include_once '../config/conf.php';
include_once '../kontrole/isLogged.php';
include_once '../alati/Html.php';
if($_POST){
	include_once '../kontrole/profil/spremanjeZupe.php';
	if(empty($greske)){
		include_once '../sql/profil/spremiPodatkeZupe.php';	
	}	
}
include_once '../sql/profil/nadjiZupu.php';
$title = 'Podaci župe';
$bodyClass = "papinskaZastava";
$footerScript = '<script src="' . $putanjaApp . 'js/profil/printeri/nadjiPrinter.js"></script>
			     <script src="' . $putanjaApp . 'js/profil/nadjiMjesto.js"></script>
			     <script src="' . $putanjaApp . 'js/skripteStranica/resetirajPolje.js"></script>';
include_once '../masters/masterHead.php';
include_once '../config/izbornik.php';
?>
<div class="row mt40">
	<div class="large-12 columns">
		<form action="<?php echo $_SERVER["PHP_SELF"]  . "?id=" . $_GET["id"]; ?>" method="POST">
			<fieldset class="polja">
				<legend><?= $title . " " . $zupa->nazivZupe ?></legend>
				<?= Html::Input(null, 'hidden', 'hfMjestoId', 'hfMjestoId',null,null,$zupa->mjesto_id,null,false) ?>
				<?= Html::Input(null, 'hidden', 'hfPrinterId', 'hfPrinterId',null,null,$zupa->printer_id,null,false) ?>
				<?= Html::InputSaGreskom($greske, 'nazivZupe', 'Naziv župe', $zupa->nazivZupe, 'text') ?>
				<?= Html::Input('Adresa ureda', 'text', 'adresaUreda', 'adresaUreda',null,null,$zupa->adresaUreda) ?>
				<?= Html::Input('Mjesto', 'text', 'mjesto', 'mjesto',null,null,$zupa->pbr . " " . $zupa->nazivMjesta,array('onfocusout'=>'resetirajPolje(\'mjesto\')')) ?> 
				<?= Html::Input('Telefon', 'text', 'telefon', 'telefon',null,null,$zupa->telefon) ?>
				<?= Html::Input('Printer', 'text', 'printer', 'printer',null,null,$zupa->nazivPrintera,array('onfocusout'=>'resetirajPolje(\'printer\')')) ?>
			</fieldset>
			<?= Html::Submit('Spremi', array('button','round','secondary','siroko')) ?>
		</form>
	</div>
</div>

<?php
include_once '../masters/masterBottom.php';
?>