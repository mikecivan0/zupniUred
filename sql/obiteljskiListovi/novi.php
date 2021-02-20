<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}

$izraz = $veza -> prepare("select zupa_id from zupnici where zupa_id=:zupa and user_id=:user;");
$izraz -> bindParam(':zupa', $_POST["zupa"]);
$izraz -> bindParam(':user', $podaci->userId);
$izraz -> execute();
$zupaPostoji = $izraz -> fetch(PDO::FETCH_OBJ);

if(!empty($zupaPostoji)){
	$izraz = $veza -> prepare("insert into obiteljskiListovi(zupa_id,prezime,adresa,telefon,dosliIz)
													values(:zupa_id,:prezime,:adresa,:telefon,:dosliIz);");
	$izraz -> bindParam(':zupa_id', $_POST["zupa"]);
	$izraz -> bindParam(':prezime', $_POST["prezime"]);
	$izraz -> bindParam(':adresa', $_POST["adresa"]);
	$izraz -> bindParam(':telefon', $_POST["telefon"]);
	$izraz -> bindParam(':dosliIz', $_POST["dosliIz"]);
	$izraz -> execute();
	
	$noviOLId = $veza->lastInsertId();
}