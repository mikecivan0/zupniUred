<?php

if(!$_GET){
	exit;
}


include_once '../../../config/conf.php';

$izraz = $veza->prepare("select distinct mv.*,z.nazivZupe from maticaVjencanih mv inner join zupe z on mv.zupa_id=z.id
 						 where (concat(imeOn,' ',prezimeOn) like :uvjet or concat(prezimeOn,' ',imeOn) like :uvjet or
 						 concat(imeOna,' ',prezimeOna) like :uvjet or concat(prezimeOna,' ',imeOna) like :uvjet)
 						 and mv.zupa_id in (select zupa_id from zupnici where user_id=:user_id);");
if(isset($_GET["term"])){
	$uv="%" . strtolower($_GET["term"]) . "%";
$izraz->bindParam(':uvjet', $uv);	
}
else {
	$uv="%";
	$izraz->bindParam(':uvjet', $uv);
}
$izraz->bindParam(':user_id', $podaci->userId);
$izraz->execute();
echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ));