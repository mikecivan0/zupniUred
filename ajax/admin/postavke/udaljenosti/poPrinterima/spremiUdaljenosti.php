<?php
if(!isset($_GET["id"])){
	exit;
}


include_once '../../../../../config/conf.php';



//napravi string $udaljenosti iz POST niza
$udaljenosti = "";
foreach ($_POST as $key => $value) {
	$udaljenosti .= $key . "=" . $value . "&";
}
//oduzmi zadnji '&' iz niza
$udaljenosti = substr($udaljenosti, 0, -1);
//unesi nove vrijednosti

	$sql = "update printeri set udaljenosti" . ucfirst($_GET["q"]) . "='" . $udaljenosti . "' where id=:id";
	$izraz = $veza -> prepare($sql);
	$izraz -> bindParam(':id', $_GET["id"]);
	$izraz -> execute();

	echo "Podaci su uspješno spremljeni";
