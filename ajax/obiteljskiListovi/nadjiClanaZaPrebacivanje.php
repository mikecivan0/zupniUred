<?php

if (!$_GET["term"]) {
	exit ;
}

include_once '../../config/conf.php';

$izraz = $veza->prepare("select c.id,c.ime,ol.adresa,ol.prezime from 
						 clanovi c inner join obiteljskiListovi ol on c.ol_id=ol.id 
						 where (concat(ol.prezime,' ',c.ime) like :uvjet
						 or concat(c.ime,' ',ol.prezime) like :uvjet
						 or c.ime like :uvjet or ol.prezime like :uvjet)
						 and ol.zupa_id in(select zupa_id from zupnici where user_id=:id);");

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
