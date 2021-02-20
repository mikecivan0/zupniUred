<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}

$izraz = $veza -> prepare("select * from stavke where izvjesce_id=1 and zupa_id=:zupa_id;");
		$izraz -> bindParam(':zupa_id', $_POST["hfZupaId"]);
		$izraz -> execute();
		$stavke = $izraz -> fetchAll(PDO::FETCH_OBJ);
		