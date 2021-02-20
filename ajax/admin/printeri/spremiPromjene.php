<?php

if (!isset($_POST["id"])) {
	exit ;
}

include_once '../../../config/conf.php';

$izraz = $veza -> prepare("select nazivPrintera from printeri where nazivPrintera=:nazivPrintera and id!=:id;");
$izraz -> execute($_POST);
$printer = $izraz -> fetch(PDO::FETCH_OBJ);
if(!empty($printer)){
	echo "Printer sa tim imenom već postoji";
}else{
	$izraz = $veza -> prepare("update printeri set nazivPrintera=:nazivPrintera where id=:id;");
	$izraz -> execute($_POST);
	echo "Podaci spremljeni";
}



