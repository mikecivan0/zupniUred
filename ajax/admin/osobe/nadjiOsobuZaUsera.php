<?php 
if(!isset($_GET["term"])){
	exit;
}

include_once '../../../config/conf.php';
$izraz = $veza->prepare("select o.id as id,o.ime,o.prezime,o.mjestoPrebivanja as mjestoPrebivanja,o.oib
from osobe o left join users u on u.osoba_id=o.id
where (o.ime like :uvjet or o.prezime like :uvjet) and o.id not in(select osoba_id from users) limit 20;");
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