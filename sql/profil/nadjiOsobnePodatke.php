<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}

$izraz = $veza -> prepare("select * from osobe where id=:id");
$izraz -> bindParam('id', $podaci->osoba_id);
$izraz -> execute();
$osoba = $izraz -> fetch(PDO::FETCH_OBJ);
