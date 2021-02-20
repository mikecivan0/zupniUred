<?php

if(!$_GET){
	exit;
}


include_once '../../../config/conf.php';

$izraz = $veza->prepare("select mu.*,z.nazivZupe from maticaUmrlih mu inner join zupe z on mu.zupa_id=z.id
						 where (concat(mu.ime, ' ',mu.prezime) like :uvjet or concat(mu.prezime, ' ',mu.ime) like :uvjet)
						 and mu.zupa_id in(select zupa_id from zupnici where user_id=:id);");
if(isset($_GET["term"])){
	$uv="%" . strtolower($_GET["term"]) . "%";
$izraz->bindParam(':uvjet', $uv);	
}
else {
	$uv="%";
	$izraz->bindParam(':uvjet', $uv);
}
$izraz->bindParam(':id', $podaci->userId);
$izraz->execute();
echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ));