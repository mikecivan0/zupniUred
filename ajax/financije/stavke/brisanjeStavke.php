<?php

if (!isset($_POST["id"])) {
	exit ;
}

include_once '../../../config/conf.php';
$izraz = $veza -> prepare("select * from stavke where id=:id and zupa_id in (select zupa_id from zupnici where user_id=:user_id);");
$izraz -> bindParam(':id', $_POST["id"]);
$izraz -> bindParam(':user_id', $podaci -> userId);
$izraz -> execute();
$imaStavka = $izraz -> fetch(PDO::FETCH_OBJ);
if (!empty($imaStavka)) {
	$izraz = $veza -> prepare("select * from kalkulacije where stavka_id=:id and zupa_id in (select zupa_id from zupnici where user_id=:user_id);");
	$izraz -> bindParam(':id', $_POST["id"]);
	$izraz -> bindParam(':user_id', $podaci -> userId);
	$izraz -> execute();
	$imaUKalkulacijama = $izraz -> fetch(PDO::FETCH_OBJ);
	if (empty($imaUKalkulacijama)) {
		$izraz = $veza -> prepare("delete from stavke where id=:id and zupa_id in (select zupa_id from zupnici where user_id=:user_id);");
		$izraz -> bindParam(':id', $_POST["id"]);
		$izraz -> bindParam(':user_id', $podaci -> userId);
		$izraz -> execute();
		echo "Stavka obrisana";
	} else {
		echo "Stavka ne može biti obrisana jer se koristi u kalkulacijama za izvješća!";
	}

} else {
	echo "Ne možete brisati tuđe stavke!";
}
