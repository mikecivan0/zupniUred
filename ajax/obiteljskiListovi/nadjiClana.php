<?php

if (!$_POST["id"]) {
	exit ;
}

include_once '../../config/conf.php';

$izraz = $veza->prepare("select * from clanovi where id=:id
						 and zupa_id in(select zupa_id from zupnici where user_id=:user_id);");

$izraz->bindParam(':id', $_POST["id"]);
$izraz->bindParam(':user_id', $podaci->userId);
$izraz->execute();
$clan = $izraz->fetch(PDO::FETCH_OBJ);

if(!empty($clan)){
	echo json_encode($clan);
}else{
	echo "Error";
}



