<?php 
if(!isset($_GET["term"])){
	exit;
}

include_once '../../../config/conf.php';


if(isset($_GET["drugi"])){
	$sql = "select p.nazivPrintera,p.id,z.nazivZupe,z.adresaUreda,m.nazivMjesta,m.pbr,b.nazivBiskupije
			 from printeri p left join zupe z on z.printer_id=p.id 
			 left join mjesta m on z.mjesto_id=m.id 
			 left join biskupije b on z.biskupija_id=b.id
			 where p.nazivPrintera like :uvjet or m.nazivMjesta like :uvjet or z.nazivZupe like :uvjet;";
}else{
	$sql = "select * from printeri where nazivPrintera like :uvjet";	
}

$izraz = $veza->prepare($sql);
if(isset($_GET["term"])){
	$uv="%" . strtolower($_GET["term"]) . "%";
$izraz->bindParam(':uvjet', $uv);	
}else {
	$uv="%";
	$izraz->bindParam(':uvjet', $uv);
}

if(isset($_GET["id"])){
	$izraz->bindParam(':id', $_GET["id"]);
}

$izraz->execute();
echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ));