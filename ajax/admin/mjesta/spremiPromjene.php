<?php

if (!isset($_POST["id"])) {
	exit ;
}

include_once '../../../config/conf.php';

$izraz = $veza -> prepare("update mjesta set nazivMjesta=:nazivMjesta,pbr=:pbr where id=:id;");
$izraz -> execute($_POST);
echo "Podaci spremljeni";
