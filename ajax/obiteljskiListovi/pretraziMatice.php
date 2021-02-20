<?php

if(!$_GET){
	exit;
}


include_once '../../config/conf.php';

$izraz = $veza->prepare("select o.ime,o.prezime,o.zanimanje,mk.*,mu.datumSmrti,mu.mjestoSmrti.mv1.datumVjencanja
						 from maticaKrstenih mk inner join osobe o on mk.osoba_id=o.id
						 left join maticaVjencanih mv1 on mv1.mkIdOn=mk.id
						 left join maticaVjencanih mv2 on mv2.mkIdOna=mk.id
						 left join maticaUmrlih mu on mu.mk_id=mk.id
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