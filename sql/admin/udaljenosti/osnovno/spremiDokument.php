<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

//napravi string $udaljenosti iz POST niza
$udaljenosti = "";
foreach ($_POST as $key => $value) {
	$udaljenosti .= $key . "=" . $value . "&";
}
//oduzmi zadnji '&' iz niza
$udaljenosti = substr($udaljenosti, 0, -1);
//unesi nove vrijednosti
	
	$izraz = $veza -> prepare("update vrsteDokumenata set udaljenosti=:udaljenosti where id=:id");
	$izraz -> bindParam(':udaljenosti', $udaljenosti);
	$izraz->bindParam(':id', $_GET["vrstaDokumenta"] );	
	$izraz -> execute();
	$poruka = "Podaci spremljeni";
	