<?php

if (!isset($_POST["user_id"])) {
	exit ;
}

include_once '../../../config/conf.php';
$izraz = $veza -> prepare("insert into zupnici(user_id,zupa_id) values(:user_id,:zupa_id);");
$izraz -> execute($_POST);
$ovlast_id = $veza->lastInsertId();


unset($_POST["user_id"]);
$izraz = $veza -> prepare("select z.id,z.nazivZupe,z.adresaUreda,m.nazivMjesta,m.pbr from zupe z inner join mjesta m on z.mjesto_id=m.id where z.id=:zupa_id");
$izraz -> execute($_POST);

$novaOvlast = $izraz -> fetch(PDO::FETCH_OBJ);
$novaOvlast -> ovlast_id = $ovlast_id;

echo json_encode($novaOvlast);