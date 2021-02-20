<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

$izraz = $veza -> prepare("select * from izvjesca;");
	$izraz -> execute();
	$izvjesca = $izraz -> fetchAll(PDO::FETCH_OBJ);
	
if(isset($_GET["stavka_id"])){
	$izraz = $veza -> prepare("select izvjesce_id from stavke where id=:id;");
	$izraz -> bindParam(":id", $_GET["stavka_id"]);
	$izraz -> execute();
	$getStavka = $izraz -> fetch(PDO::FETCH_OBJ);
}
	
	$selectIzvjesca = "<label>Izvješće</label><select name='izvjesce_id' id='izvjesce_id'>";
	foreach ($izvjesca as $izvjesce) {
		$selectIzvjesca .= "<option value='" . $izvjesce->id . "'";
		if(!$_POST&&isset($_GET["stavka_id"])){
			$selectIzvjesca .= ($izvjesce->id==$getStavka->izvjesce_id) ? " selected=true" : null;
		}elseif($_POST&&isset($_POST["izvjesce_id"])){
			$selectIzvjesca .= ($_POST["izvjesce_id"]==$izvjesce->id) ? " selected=true" : null;
		}
		$selectIzvjesca .= ">" . $izvjesce->nazivIzvjesca . "</option>";
	}
	$selectIzvjesca .= "</select>";
