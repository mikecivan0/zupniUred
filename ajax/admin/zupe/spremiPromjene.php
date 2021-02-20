<?php

if (!isset($_POST["id"])) {
	exit ;
}

include_once '../../../config/conf.php';

$izraz = $veza -> prepare("update zupe set 
						   nazivZupe=:nazivZupe,adresaUreda=:adresaUreda,telefon=:telefon,mjesto_id=:mjesto_id,biskupija_id=:biskupija_id,printer_id=:printer_id
						   where id=:id;");
$izraz -> execute($_POST);
echo "Podaci spremljeni";
