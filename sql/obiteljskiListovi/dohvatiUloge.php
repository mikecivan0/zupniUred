<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

$izraz = $veza -> prepare("select * from uloge;");
	$izraz -> bindParam(':id', $_GET["id"]);
	$izraz -> execute();
	$uloge = $izraz -> fetchAll(PDO::FETCH_OBJ);

	
	//slaganje optiona za primSvrhe
	$selectUloga = "<label>Osoba će u odabranom obiteljskom listu biti</label><select name='uloga_id' id='uloga_id'>";
	foreach ($uloge as $uloga) {
		$selectUloga .= "<option value='" . $uloga->id . "'";
		if($_POST){
			$selectUloga .= ($_POST["uloga_id"]==$uloga->id) ? " selected=true" : null;
		}
		$selectUloga .= ">" . $uloga->nazivUloge . "</option>";
	}
	$selectUloga .= "</select>";