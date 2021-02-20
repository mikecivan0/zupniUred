<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}

$izraz = $veza -> prepare("select distinct YEAR(datum) as godina from 
						   transakcije t inner join svrhe s on t.svrha_id=s.id 
						   where t.zupa_id=:id and s.grupa_id in (2,4) order by godina;");
		$izraz -> bindParam(':id', $_GET["id"]);
		$izraz -> execute();
		$godine = $izraz -> fetchAll(PDO::FETCH_OBJ);
		