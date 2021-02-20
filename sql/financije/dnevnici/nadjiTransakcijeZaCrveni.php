<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}

if (!isset($_GET["godina"]) || !isset($_GET["mjesec"])) {
	$_GET["godina"] = $godinaTransakcije = date('Y');
	$_GET["mjesec"] = $mjesecTransakcije = date('n');
	
} else {
	$godinaTransakcije = $_GET["godina"];
	$mjesecTransakcije = $_GET["mjesec"];
}

$izraz = $veza -> prepare("select t.*,s.nazivSvrhe,s.markSvrhe,g.id as grupa_id from 
						   transakcije t inner join svrhe s on t.svrha_id=s.id 
						   inner join grupe g on s.grupa_id=g.id
						   where t.zupa_id=:id and g.id in (1,3) and YEAR(t.datum)=:godina and MONTH(t.datum)=:mjesec
						   order by t.datum,t.id;");
$izraz -> bindParam(':id', $_GET["id"]);
$izraz -> bindParam(':godina', $godinaTransakcije);
$izraz -> bindParam(':mjesec', $mjesecTransakcije);
$izraz -> execute();
$transakcije = $izraz -> fetchAll(PDO::FETCH_OBJ);
