<?php 
if(!isset($_GET["term"])){
	exit;
}

include_once '../../../config/conf.php';

if(isset($_GET["distinct"])){
	$izraz = $veza->prepare("select distinct nazivZupe from zupe where nazivZupe like :uvjet limit 20;");	
}else{
	$sql = "select m.nazivMjesta,m.pbr,z.nazivZupe,z.telefon,b.nazivBiskupije,z.biskupija_id,z.mjesto_id,z.id,z.adresaUreda,p.nazivPrintera,z.printer_id
	from mjesta m inner join zupe z on z.mjesto_id=m.id
	inner join biskupije b on z.biskupija_id=b.id
	inner join printeri p on z.printer_id=p.id
	where (m.nazivMjesta like :uvjet or z.nazivZupe like :uvjet";
	
	
	if(isset($_GET["id"])){
		$sql .= " or p.nazivPrintera like :uvjet)and z.printer_id!=:id";
	}else{
		$sql .= ")";	
	}
	
	//dio kod dodavanja ovlasti nad župama nad kojima još nema ovlasti
	if(isset($_GET["ovlasti"])){
		$sql .= " and z.id not in(select zupa_id from zupnici)";
	}
	
	$sql .= " limit 20";
	$izraz = $veza->prepare($sql);

}

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