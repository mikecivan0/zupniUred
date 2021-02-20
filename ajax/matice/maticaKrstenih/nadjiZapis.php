<?php

if(!$_GET){
	exit;
}


include_once '../../../config/conf.php';

$izraz = $veza->prepare("select mk.*,o.ime,o.prezime,o.mjestoPrebivanja,o.jmbg,o.ulica,o.kucniBroj,o.spol,z.nazivZupe
						 from maticaKrstenih mk inner join osobe o on mk.osoba_id=o.id
						 inner join zupe z on mk.zupa_id=z.id
						 where (concat(o.ime, ' ', o.prezime) like :uvjet or concat(o.prezime, ' ', o.ime) like :uvjet) 
						 and mk.zupa_id in(select zupa_id from zupnici where user_id=:id);");
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