<?php 
if(!isset($_GET["term"])){
	exit;
}

include_once '../../../config/conf.php';

$izraz = $veza->prepare('select * from osobe where ime like :uvjet or prezime like :uvjet or concat(ime, " ",prezime) like :uvjet');
if(isset($_GET["term"])){
	$uv="%" . strtolower($_GET["term"]) . "%";
$izraz->bindParam(':uvjet', $uv);	
}
else {
	$uv="%";
	$izraz->bindParam(':uvjet', $uv);
}
$izraz->execute();
echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ));