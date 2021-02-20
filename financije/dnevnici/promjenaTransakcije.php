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

include_once '../../alati/Html.php';
$title = 'Promjena transakcije';
$bodyClass = "papinskaZastava";


if($_POST&&!empty($zupa)){
	$greske = array();
	include_once '../../kontrole/financije/dnevnici/promjenaTransakcije.php';
	if(empty($greske)){
		include_once '../../sql/financije/dnevnici/promjenaTransakcije.php';
	}	
	$id = $_POST["hfId"];
	$datum = $_POST["datum"];
	$iznos = $_POST["iznos"];
	$svrha_id = $_POST["svrha_id"];
	$zupa_id = $_POST["zupa_id"];
	$grupa_id = $_POST["hfGrupaId"];
	$napomena = $_POST["napomena"];
}else{
	include_once '../../sql/financije/dnevnici/detaljiTransakcije.php';	
	$id = $transakcija->id;
	$datum = $transakcija->datum;
	$iznos = $transakcija->iznos;
	$svrha_id = $transakcija->svrha_id;
	$zupa_id = $transakcija->zupa_id;
	$grupa_id = $transakcija->grupa_id;
	$napomena = $transakcija->napomena;
}
if($grupa_id==1||$grupa_id==3){
	include_once '../../sql/financije/dnevnici/dohvatiSvrheZaCrveni.php';	
}else{
	include_once '../../sql/financije/dnevnici/dohvatiSvrheZaPlavi.php';	
}
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php'; 
?>
<div class="row mt40">
	<div class="large-12 columns">
		<form class="polja" method="POST" action="<?= $_SERVER["PHP_SELF"] . "?id=" . $_GET["id"] . "&transakcija_id=" . $_GET["transakcija_id"] . "&godina=" . $_GET["godina"] . "&mjesec=" . $_GET["mjesec"] ?>">
			<fieldset>
				<legend>Promjena podataka transakcije</legend>
				 <div class="row">
				 		    <?= HTML::Input(null, 'hidden', 'hfGrupaId', 'hfGrupaId',null,null,$grupa_id,null,false) ?>
				 		    <?= HTML::Input(null, 'hidden', 'hfId', 'hfId',null,null,$id,null,false) ?>
				 		    <?= HTML::Input(null, 'hidden', 'zupa_id', 'zupa_id',null,null,$zupa_id,null,false) ?>						
						<div class="large-4 columns">
							<?= $select ?>							
						</div>
						<div class="large-3 columns">
							<?= Html::Input('Datum', 'date', 'datum', 'datum',null,null,$datum) ?>						
						</div>
						<div class="large-2 columns">
							<?= Html::InputSaGreskom($greske, 'iznos', 'Iznos',$iznos, 'number',array('step'=>'0.01')) ?>
						</div>
						<div class="large-3 columns">
							<?= Html::Input('Napomena', 'text', 'napomena', 'napomena',null,null,$napomena) ?>						
						</div>
				</div>
			</div>	
			</fieldset>			
				<?= Html::Submit('Spremi',array('siroko', 'secondary','button')) ?>
		</form>
	</div>
</div>

<?php
	include_once '../../masters/masterBottom.php';
?>