<?php

if (!isset($_POST["zupa_id"])) {
	exit ;
}

include_once '../../../config/conf.php';
$izraz = $veza -> prepare("insert into filijale(zupa_id,mjesto_id) values(:zupa_id,:mjesto_id);");
$izraz -> execute($_POST);
$novaFilijala_id = $veza->lastInsertId();


$izraz = $veza -> prepare("select m.nazivMjesta,m.pbr,f.id from mjesta m inner join filijale f on f.mjesto_id=m.id where f.id=:id;");
$izraz -> bindParam(":id", $novaFilijala_id);
$izraz -> execute();
$novaFilijala= $izraz -> fetch(PDO::FETCH_OBJ);

echo json_encode($novaFilijala);