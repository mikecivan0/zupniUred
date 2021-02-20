<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

$izraz = $veza -> prepare("select * from grupe");
	$izraz -> execute();
	$grupe = $izraz -> fetchAll(PDO::FETCH_OBJ);

	$select = "<select name='grupa_id' id='grupa_id'>";
	foreach ($grupe as $grupa) {
		$select .= "<option value='" . $grupa->id . "'>" . $grupa->nazivGrupe . "</option>";
	}
	$select .= "</select>";
