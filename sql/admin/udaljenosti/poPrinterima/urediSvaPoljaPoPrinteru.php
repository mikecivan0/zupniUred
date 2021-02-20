<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
	$izraz = $veza -> prepare("select * from printeri where id=:id");
	$izraz -> bindParam(":id", $_POST["hfPrinterIdZaSpremanjeUdaljenosti"]);
	$izraz -> execute();
	$sve = $izraz -> fetch(PDO::FETCH_OBJ);//daj sve redove za određeni printer
	
	foreach ($sve as $key => $value) {
		if($key!='id'&&$key!='nazivPrintera'){//za svaki red osim nazivPrintera i id-a...
			$noviNiz = "";
			parse_str($value,$array);//pretvori GET niz u array
			foreach ($array as $key2 => $value) {
				$vrijednost = (strpos($key2,'Left')>0) ? $_POST["left"] : $_POST["top"];//odredi da li će se dodavati left ili top ovisno o varijabli
				$noviNiz .= $key2 . "=" . $vrijednost . "&";//za svaku vrijednost dopunjavaj niz
			}
			$niz = substr($noviNiz, 0, -1);//oduzmi zadnji '&'
			$sql = "update printeri set " . $key . "=:niz where id=:id;"; //kreiraj sql naredbu za svaki red
			$izraz = $veza -> prepare($sql);
			$izraz -> bindParam(":id", $_POST["hfPrinterIdZaSpremanjeUdaljenosti"]);
			$izraz -> bindParam(":niz", $niz);
			$izraz -> execute();//unesi u bazu
		}		
	}
	
	
	
