<?php

if (!$_POST) {
	exit ;
}

include_once '../../../config/conf.php';

$izraz = $veza -> prepare("select markTransakcije from transakcije 
					       where id=:id and zupa_id in(select zupa_id from zupnici where user_id=:user_id);");
$izraz -> bindValue(":id", $_POST["id"]);
$izraz -> bindValue(":user_id", $podaci -> userId);
$izraz -> execute();
$markTransakcije = $izraz -> fetch(PDO::FETCH_COLUMN);

if (!empty($markTransakcije)) {
	$izraz = $veza -> prepare("delete from transakcije where
						   markTransakcije=:markTransakcije
						   and zupa_id in(select zupa_id from zupnici where user_id=:user_id);");
	$izraz -> bindValue(":user_id", $podaci -> userId);
	$izraz -> bindValue(":markTransakcije", $markTransakcije);
	$izraz -> execute();
	echo 'Unos obrisan';
} else {
	echo 'Ne možete brisati tuđe unose!';
}
