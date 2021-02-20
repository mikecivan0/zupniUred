<?php

if (!$_GET["term"]) {
	exit ;
}

include_once '../../config/conf.php';

$izraz = $veza->prepare("select * from obiteljskiListovi
						 where prezime like :uvjet
						 and zupa_id in(select zupa_id from zupnici where user_id=:id);");
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