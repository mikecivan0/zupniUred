<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}

if (!isset($_GET["godina"]) || !isset($_GET["mjesec"])) {
	$godina = date('Y');
	$mjesec = date('m');
} else {
	$godina = $_GET["godina"];
	$mjesec = $_GET["mjesec"];
}

if($mjesec==1){//ako se gleda siječanj onda dohvati stanja od prošle godine za A i C
	$prosloStanjeB = 0.00;
	$prosloStanjeD = 0.00;
	
}else{//ako nije siječanj onda dohvati stanja od ove godine za A i C ali bez mjeseca koji se gleda
	$izraz = $veza -> prepare("select SUM(t.iznos) from 
						   transakcije t inner join svrhe s on t.svrha_id=s.id
						   where t.zupa_id=:id and s.grupa_id=2 and YEAR(t.datum)=:godina and MONTH(t.datum) < :mjesec;");
	$izraz -> bindParam(':id', $_GET["id"]);
	$izraz -> bindParam(':godina', $godina);
	$izraz -> bindValue(':mjesec', $mjesec);
	$izraz -> execute();
	$prosloStanjeB = $izraz -> fetch(PDO::FETCH_COLUMN);
	
	
	$izraz = $veza -> prepare("select SUM(t.iznos) from 
						   transakcije t inner join svrhe s on t.svrha_id=s.id
						   where t.zupa_id=:id and s.grupa_id=4 and YEAR(t.datum)=:godina and MONTH(t.datum) < :mjesec;");
	$izraz -> bindParam(':id', $_GET["id"]);
	$izraz -> bindParam(':godina', $godina);
	$izraz -> bindValue(':mjesec', $mjesec);
	$izraz -> execute();
	$prosloStanjeD = $izraz -> fetch(PDO::FETCH_COLUMN);	
}


