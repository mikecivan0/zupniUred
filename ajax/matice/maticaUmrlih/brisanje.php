<?php

if (!$_POST) {
	exit ;
}

include_once '../../../config/conf.php';

if (isset($_POST["muId"])) {
	$izraz = $veza -> prepare("select * from maticaUmrlih where id=:id 
							 and zupa_id in(select zupa_id from zupnici where user_id=:user_id);");
	$izraz -> bindValue(":id", $_POST["muId"]);
	$izraz -> bindValue(":user_id", $podaci -> userId);
	$izraz -> execute();
	$imaMaticaUmlih = $izraz -> fetch(PDO::FETCH_OBJ);

	if (!empty($imaMaticaUmlih)) {
		$izraz = $veza -> prepare("delete from maticaUmrlih where id=:id and zupa_id in(select zupa_id from zupnici where user_id=:user_id);");
		$izraz -> bindValue(":id", $_POST["muId"]);
		$izraz -> bindValue(":user_id", $podaci -> userId);
		$izraz -> execute();

		echo "Unos obrisan";
	} else {
		echo "Ne možete brisati zapise matica drugih župa!";
	}
} else {
	echo "Nešto ne valja!";
}
