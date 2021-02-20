<?php 
if(!isset($_GET["term"])){
	exit;
}

include_once '../../../config/conf.php';
$izraz = $veza->prepare("select * from biskupije where nazivBiskupije like :uvjet limit 5;");
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