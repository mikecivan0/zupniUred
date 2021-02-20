<?php

if (!$_POST) {
	exit ;
}

include_once '../../config/conf.php';

$izraz = $veza -> prepare("select * from dokumenti where id=:id and user_id=:user_id;");
$izraz -> bindValue(":id", $_POST["id"]);
$izraz -> bindValue(":user_id", $podaci -> userId);
$izraz -> execute();
$imaDokument = $izraz -> fetch(PDO::FETCH_COLUMN);

if (!empty($imaDokument)) {
	$izraz = $veza -> prepare("delete from dokumenti where id=:id and user_id=:user_id;");
	$izraz -> bindParam(':id', $_POST["id"]);
	$izraz -> bindParam(':user_id', $podaci -> userId);
	$izraz -> execute();
	echo "OK";
} else {
	echo "Ne možete brisati tuđe dokumente!";
}
