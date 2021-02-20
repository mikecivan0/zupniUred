<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}

if ($title == 'Promjena svrhe') {
	$izraz = $veza -> prepare("select grupa_id from svrhe where id=:id and zupa_id=:zupa_id");
	$izraz -> bindParam(":id", $_GET["id"]);
	$izraz -> bindParam(":zupa_id", $_GET["zupa_id"]);
	$izraz -> execute();
	$getSvrha = $izraz -> fetch(PDO::FETCH_OBJ);

	if (empty($getSvrha)) {//ukoliko se mijenjao GET["id"] radi hakiranja ne radi ništa
		$select = "";
		header('location: svrhe.php?id=' . $_GET["zupa_id"]);
	}

}
	$izraz = $veza -> prepare("select * from grupe;");
	$izraz -> execute();
	$grupe = $izraz -> fetchAll(PDO::FETCH_OBJ);


	$select = "<label>Grupa</label><select name='grupa_id' id='grupa_id'>";
	foreach ($grupe as $grupa) {
		$select .= "<option value='" . $grupa -> id . "'";
		if (!$_POST&&$title == 'Promjena stavke') {
			$select .= ($grupa -> id == $getSvrha -> grupa_id) ? " selected=true" : null;
		} elseif ($_POST) {
			$select .= ($_POST["grupa_id"] == $grupa -> id) ? " selected=true" : null;
		} else {
			null;
		}
		$select .= ">" . $grupa -> nazivGrupe . "</option>";
	}
	$select .= "</select>";

