<?php

if (!isset($_POST["id"])) {
	exit ;
}

include_once '../../../config/conf.php';

$izraz = $veza -> prepare("select * from automatskiUnosi 
					       where id=:id and zupa_id in(select zupa_id from zupnici where user_id=:user_id);");
$izraz -> bindValue(":id", $_POST["id"]);
$izraz -> bindValue(":user_id", $podaci -> userId);
$izraz -> execute();
$imaAutomatike = $izraz -> fetch(PDO::FETCH_COLUMN);

if (!empty($imaAutomatike)) {
	$izraz = $veza -> prepare("delete from automatskiUnosi where id=:id and zupa_id in (select zupa_id from zupnici where user_id=:user_id);");
	$izraz -> bindParam(':id', $_POST["id"]);
	$izraz -> bindParam(':user_id', $podaci -> userId);
	$izraz -> execute();
	echo "Automatski unos obrisan";
} else {
	echo "Ne možete brisati tuđe automatske unose!";
}
