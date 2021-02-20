<?php 
if(!isset($_GET["term"])){
	exit;
}

include_once '../../../config/conf.php';

$sql = 
$izraz = $veza->prepare("select * from mjesta where nazivMjesta like :uvjet and id not in(select mjesto_id from filijale) and id not in(select mjesto_id from zupe)");
if(isset($_GET["term"])){
	$uv="%" . strtolower($_GET["term"]) . "%";
$izraz->bindParam(':uvjet', $uv);	
}else {
	$uv="%";
	$izraz->bindParam(':uvjet', $uv);
}
$izraz->execute();
echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ));