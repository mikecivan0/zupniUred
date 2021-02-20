<?php
if(!isset($_POST["printerUKojiSeKopira"])){
	exit;
}


include_once '../../../../../config/conf.php';

$q =  "udaljenosti" . ucfirst($_POST["q"]);

$sql = "select " . $q . " from printeri where id=:printerIzKojegSeKopira";
$izraz = $veza -> prepare($sql);
	$izraz -> bindParam(':printerIzKojegSeKopira', $_POST["printerIzKojegSeKopira"]);
	$izraz -> execute();
	$niz = $izraz->fetch(PDO::FETCH_OBJ);

	$niz = $niz->$q;
	
	
	$sql2 = "update printeri set " . $q . "='" . $niz . "' where id=:printerUKojiSeKopira";
	$izraz = $veza -> prepare($sql2);
	$izraz -> bindParam(':printerUKojiSeKopira', $_POST["printerUKojiSeKopira"]);
	$izraz -> execute();
