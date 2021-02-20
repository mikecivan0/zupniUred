<?php
include_once '../../config/conf.php';
include_once '../../kontrole/isAdmin.php';
$footerScript = '<script src="' . $putanjaApp . 'js/admin/printeri/nadjiPrinter.js"></script>
				 <script src="' . $putanjaApp . 'js/admin/biskupije/nadjiBiskupiju.js"></script>
				 <script src="' . $putanjaApp . 'js/admin/mjesta/nadjiMjesto.js"></script>
				 <script src="' . $putanjaApp . 'js/skripteStranica/resetirajPolje.js"></script>';
$greske = array();

if(isset($_POST)&&isset($_POST["nazivZupe"])){
	include_once '../../kontrole/admin/zupe/nova.php';
	if(empty($greske)){
		include_once '../../sql/admin/zupe/nova.php';
	}
	
}
$title = 'Nova župa';
$bodyClass = 'matrix';
include_once '../../alati/Html.php';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
?>
<div class="row mt40">
	<div class="large-12 columns">
		<form class="crnaPozadina"method="POST" action="<?= $_SERVER["PHP_SELF"] ?>">
			<fieldset>
				<legend><?= $title ?></legend>
				<?= Html::Input(null, 'hidden', 'hfMjestoId', 'hfMjestoId',null,null,null,null,false) ?>
				<?= Html::Input(null, 'hidden', 'hfBiskupijaId', 'hfBiskupijaId',null,null,null,null,false) ?>
				<?= Html::Input(null, 'hidden', 'hfPrinterId', 'hfPrinterId',null,null,null,null,false) ?>
				<?= Html::InputSaGreskom($greske, 'nazivZupe', 'Naziv župe', null, 'text') ?>
				<?= Html::InputSaGreskom($greske, 'adresaUreda', 'Adresa ureda', null, 'text') ?>
				<?= Html::InputSaGreskom($greske, 'telefon', 'Telefon', null, 'text') ?>
				<?= Html::InputSaGreskom($greske, 'mjesto', 'Mjesto', null, 'text', array('onfocusout'=>'resetirajPolje(\'mjesto\')')) ?>
				<?= Html::InputSaGreskom($greske, 'printer', 'Printer', null, 'text', array('onfocusout'=>'resetirajPolje(\'printer\')')) ?>
				<?= Html::InputSaGreskom($greske, 'biskupija', 'Biskupija', null, 'text', array('onfocusout'=>'resetirajPolje(\'biskupija\')')) ?>
			</fieldset>
			<?= Html::SpremiOdustani('index.php') ?>	
		</form>			
	</div>
</div>

<?php
	include_once '../../masters/masterBottom.php';
?>