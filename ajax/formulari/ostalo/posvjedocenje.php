<?php

if(!$_GET){
	exit;
}


include_once '../../../config/conf.php';

$izraz = $veza->prepare("select distinct concat(o.ime,' ',o.prezime) as imeIPrezime,o.spol,o.jmbg,mk.datumKrizme as datumPotvrde,
						 mk.mjestoKrstenja,mk.datumKrstenja,mk.datumRodjenja,mk.mjestoRodjenja,mk.id as mkId,z.nazivZupe from osobe o
						 inner join maticaKrstenih mk on mk.osoba_id=o.id 
						 inner join zupe z on mk.zupa_id=z.id
						 where (concat(o.ime, ' ',o.prezime) like :uvjet or concat(o.prezime, ' ',o.ime) like :uvjet)
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
$osobe = $izraz->fetchAll(PDO::FETCH_OBJ);
foreach ($osobe as $osoba) {
	$izraz = $veza->prepare("select datumVjencanja from maticaVjencanih where mkIdOn=:mkId or mkIdOna=:mkId;");
	$izraz->bindParam(':mkId', $osoba->mkId);
	$izraz->execute();
	$datumVjencanja = $izraz->fetch(PDO::FETCH_COLUMN);					 
	
	$osoba->datumPotvrde = ($osoba->datumPotvrde!=null&&$osoba->datumPotvrde!='0000-00-00') ? explode("-",$osoba->datumPotvrde)[2] . "." . explode("-",$osoba->datumPotvrde)[1] . ".". explode("-",$osoba->datumPotvrde)[0] . "." : null;
	$osoba->datumVjencanja = ($datumVjencanja!=null&&$datumVjencanja!='0000-00-00') ?  explode("-",$datumVjencanja)[2] . "." . explode("-",$datumVjencanja)[1] . ".". explode("-",$datumVjencanja)[0] . "." : null;
	$osoba->datumKrstenja = ($osoba->datumKrstenja!=null&&$osoba->datumKrstenja!='0000-00-00') ?  explode("-",$osoba->datumKrstenja)[2] . "." . explode("-",$osoba->datumKrstenja)[1] . ".". explode("-",$osoba->datumKrstenja)[0] . "." : null;
	$osoba->datumRodjenja = ($osoba->datumRodjenja!=null&&$osoba->datumRodjenja!='0000-00-00') ?  explode("-",$osoba->datumRodjenja)[2] . "." . explode("-",$osoba->datumRodjenja)[1] . ".". explode("-",$osoba->datumRodjenja)[0] . "." : null;
}
echo json_encode($osobe);