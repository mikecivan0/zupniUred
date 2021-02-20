<?php

if (!isset($_POST["id"])) {
	exit ;
}

include_once '../../../config/conf.php';
$izraz = $veza -> prepare("delete from filijale where id=:id;");
$izraz -> execute($_POST);

echo "OK";
