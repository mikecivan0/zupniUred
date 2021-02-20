<?php 
if(!isset($_GET["term"])){
	exit;
}

include_once '../../../config/conf.php';

$sql = "select ";

if(isset($_GET["distinct"])&&$_GET["distinct"]=="true"){
	$sql .= "distinct ";
}
	
$sql .= "nazivMjesta, pbr, id from mjesta where nazivMjesta like :uvjet or pbr like :uvjet 
		 or concat(nazivMjesta,' ',pbr) like :uvjet or concat(pbr,' ',nazivMjesta) like :uvjet;";

$izraz = $veza->prepare($sql);	

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