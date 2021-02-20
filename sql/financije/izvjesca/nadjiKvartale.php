<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}

$izraz = $veza -> prepare("select distinct YEAR(t.datum) as godina from 
						   transakcije t inner join svrhe s on t.svrha_id=s.id 
						   where t.zupa_id=:id and s.grupa_id in (2,4) order by godina;");
$izraz -> bindParam(':id', $_GET["id"]);
$izraz -> execute();
$godine = $izraz -> fetchAll(PDO::FETCH_OBJ);
$select = "<select id='godinaIKvartal' name='godinaIKvartal'>";
foreach ($godine as $godina) {
	$izraz = $veza -> prepare("select distinct QUARTER(t.datum) as kvartal from 
							   transakcije t inner join svrhe s on t.svrha_id=s.id 
							   where t.zupa_id=:id and s.grupa_id in (2,4) and YEAR(t.datum)=:godina order by kvartal;");
	$izraz -> bindParam(':id', $_GET["id"]);
	$izraz -> bindParam(':godina', $godina->godina);
	$izraz -> execute();
	$kvartali = $izraz -> fetchAll(PDO::FETCH_OBJ);
	
	foreach ($kvartali as $kvartal) {
		$izraz = $veza -> prepare("select t.id from transakcije t 
								   inner join svrhe s on t.svrha_id=s.id 
								   where s.grupa_id in (2,4) and
								   YEAR(t.datum)=:godina and QUARTER(t.datum)=:kvartal
								   and t.zupa_id=:id limit 1;");
		$izraz -> bindParam(':id', $_GET["id"]);
		$izraz -> bindParam(':godina', $godina->godina);
		$izraz -> bindParam(':kvartal', $kvartal->kvartal);
		$izraz -> execute();
		$option_id = $izraz -> fetch(PDO::FETCH_COLUMN);
		
		$select .= "<option value='" . $option_id . "'>" . $godina->godina . " godina - " . $kvartal->kvartal . " kvartal</option>";		
	}
}
$select .= "</select>";
