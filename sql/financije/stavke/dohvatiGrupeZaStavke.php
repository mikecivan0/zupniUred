<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

$izraz = $veza -> prepare("select * from grupe");
	$izraz -> execute();
	$grupe = $izraz -> fetchAll(PDO::FETCH_OBJ);
	
if(isset($_GET["stavka_id"])){
	$izraz = $veza -> prepare("select grupa_id from stavke where id=:id");
	$izraz -> bindParam(":id", $_GET["stavka_id"]);
	$izraz -> execute();
	$getStavka= $izraz -> fetch(PDO::FETCH_OBJ);
}
	
	$select = "<label>Grupa</label><select name='grupa_id' id='grupa_id'>";
	foreach ($grupe as $grupa) {
		$select .= "<option value='" . $grupa->id . "'";
		if(!$_POST&&isset($_GET["stavka_id"])){
			$select .= ($grupa->id==$getStavka->grupa_id) ? " selected=true" : null;
		}elseif($_POST&&isset($_POST["grupa_id"])){
			$select .= ($_POST["grupa_id"]==$grupa->id) ? " selected=true" : null;
		}
		$select .= ">" . $grupa->nazivGrupe . "</option>";
	}
	$select .= "</select>";
