<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}

$_POST["hfMkIdOn"] = (empty($_POST["hfMkIdOn"])) ? null : $_POST["hfMkIdOn"];
$_POST["hfMkIdOna"] = (empty($_POST["hfMkIdOna"])) ? null : $_POST["hfMkIdOna"];
if(empty($_POST["hfMvId"])){
	$izraz = $veza -> prepare("insert into maticaVjencanih(zupa_id,svezak,zaGodinu,stranica,broj,datumVjencanja,mkIdOn,mkIdOna,imeOn,imeOna,prezimeOn,prezimeOna,
										mjestoRodjenjaOn,mjestoRodjenjaOna,datumRodjenjaOn,datumRodjenjaOna,jmbgOn,jmbgOna,vjeraOn,vjeraOna,datumKrstenjaOn,datumKrstenjaOna,
										zupaKrstenjaOn,zupaKrstenjaOna,otacOn,otacOna,majkaOn,majkaOna,svjedokOn,svjedokOna,vjencatelj,zabiljeske) 
										
										values(:zupa_id,:svezak,:zaGodinu,:stranica,:broj,:datumVjencanja,:mkIdOn,:mkIdOna,:imeOn,:imeOna,:prezimeOn,:prezimeOna,
									   	:mjestoRodjenjaOn,:mjestoRodjenjaOna,:datumRodjenjaOn,:datumRodjenjaOna,:jmbgOn,:jmbgOna,:vjeraOn,:vjeraOna,:datumKrstenjaOn,:datumKrstenjaOna,
										:zupaKrstenjaOn,:zupaKrstenjaOna,:otacOn,:otacOna,:majkaOn,:majkaOna,:svjedokOn,:svjedokOna,:vjencatelj,:zabiljeske);");
		$izraz -> bindParam(':zupa_id', $_POST["zupa"]);
		$izraz -> bindParam(':svezak', $_POST["svezak"]);
		$izraz -> bindParam(':zaGodinu', $_POST["zaGodinu"]);
		$izraz -> bindParam(':stranica', $_POST["stranica"]);
		$izraz -> bindParam(':broj', $_POST["broj"]);
		$izraz -> bindParam(':datumVjencanja', $_POST["datumVjencanja"]);
		$izraz -> bindParam(':mkIdOn', $_POST["hfMkIdOn"]);
		$izraz -> bindParam(':mkIdOna', $_POST["hfMkIdOna"]);
		$izraz -> bindParam(':imeOn', $_POST["imeOn"]);
		$izraz -> bindParam(':imeOna', $_POST["imeOna"]);
		$izraz -> bindParam(':prezimeOn', $_POST["prezimeOn"]);
		$izraz -> bindParam(':prezimeOna', $_POST["prezimeOna"]);
		$izraz -> bindParam(':mjestoRodjenjaOn', $_POST["mjestoRodjenjaOn"]);
		$izraz -> bindParam(':mjestoRodjenjaOna', $_POST["mjestoRodjenjaOna"]);
		$izraz -> bindParam(':datumRodjenjaOn', $_POST["datumRodjenjaOn"]);
		$izraz -> bindParam(':datumRodjenjaOna', $_POST["datumRodjenjaOna"]);
		$izraz -> bindParam(':jmbgOn', $_POST["jmbgOn"]);
		$izraz -> bindParam(':jmbgOna', $_POST["jmbgOna"]);
		$izraz -> bindParam(':vjeraOn', $_POST["vjeraOn"]);
		$izraz -> bindParam(':vjeraOna', $_POST["vjeraOna"]);
		$izraz -> bindParam(':datumKrstenjaOn', $_POST["datumKrstenjaOn"]);
		$izraz -> bindParam(':datumKrstenjaOna', $_POST["datumKrstenjaOna"]);
		$izraz -> bindParam(':zupaKrstenjaOn', $_POST["zupaKrstenjaOn"]);
		$izraz -> bindParam(':zupaKrstenjaOna', $_POST["zupaKrstenjaOna"]);
		$izraz -> bindParam(':otacOn', $_POST["otacOn"]);
		$izraz -> bindParam(':otacOna', $_POST["otacOna"]);
		$izraz -> bindParam(':majkaOn', $_POST["majkaOn"]);
		$izraz -> bindParam(':majkaOna', $_POST["majkaOna"]);
		$izraz -> bindParam(':svjedokOn', $_POST["svjedokOn"]);
		$izraz -> bindParam(':svjedokOna', $_POST["svjedokOna"]);
		$izraz -> bindParam(':vjencatelj', $_POST["vjencatelj"]);
		$izraz -> bindParam(':zabiljeske', $_POST["zabiljeske"]);
		$izraz -> execute();
		
		$mk_id = $veza -> lastInsertId();
		$_POST["hfMvId"] = $mk_id;
		$porukaOSpremanju = "Zapis uspješno unešen. <a class='pl55' href=" . $_SERVER["PHP_SELF"] . ">Unos novog zapisa</a>";
}else{
	$izraz = $veza -> prepare("update maticaVjencanih set zupa_id=:zupa_id,svezak=:svezak,zaGodinu=:zaGodinu,stranica=:stranica,broj=:broj,datumVjencanja=:datumVjencanja,
										mkIdOn=:mkIdOn,mkIdOna=:mkIdOna,imeOn=:imeOn,imeOna=:imeOna,prezimeOn=:prezimeOn,prezimeOna=:prezimeOna,
										mjestoRodjenjaOn=:mjestoRodjenjaOn,mjestoRodjenjaOna=:mjestoRodjenjaOna,datumRodjenjaOn=:datumRodjenjaOn,datumRodjenjaOna=:datumRodjenjaOna,
										jmbgOn=:jmbgOn,jmbgOna=:jmbgOna,vjeraOn=:vjeraOn,vjeraOna=:vjeraOna,datumKrstenjaOn=:datumKrstenjaOn,datumKrstenjaOna=:datumKrstenjaOna,
										zupaKrstenjaOn=:zupaKrstenjaOn,zupaKrstenjaOna=:zupaKrstenjaOna,otacOn=:otacOn,otacOna=:otacOna,
										majkaOn=:majkaOn,majkaOna=:majkaOna,svjedokOn=:svjedokOn,svjedokOna=:svjedokOna,vjencatelj=:vjencatelj,zabiljeske=:zabiljeske
										where id=:id;");
		$izraz -> bindParam(':zupa_id', $_POST["zupa"]);
		$izraz -> bindParam(':svezak', $_POST["svezak"]);
		$izraz -> bindParam(':zaGodinu', $_POST["zaGodinu"]);
		$izraz -> bindParam(':stranica', $_POST["stranica"]);
		$izraz -> bindParam(':broj', $_POST["broj"]);
		$izraz -> bindParam(':datumVjencanja', $_POST["datumVjencanja"]);
		$izraz -> bindParam(':mkIdOn', $_POST["hfMkIdOn"]);
		$izraz -> bindParam(':mkIdOna', $_POST["hfMkIdOna"]);
		$izraz -> bindParam(':imeOn', $_POST["imeOn"]);
		$izraz -> bindParam(':imeOna', $_POST["imeOna"]);
		$izraz -> bindParam(':prezimeOn', $_POST["prezimeOn"]);
		$izraz -> bindParam(':prezimeOna', $_POST["prezimeOna"]);
		$izraz -> bindParam(':mjestoRodjenjaOn', $_POST["mjestoRodjenjaOn"]);
		$izraz -> bindParam(':mjestoRodjenjaOna', $_POST["mjestoRodjenjaOna"]);
		$izraz -> bindParam(':datumRodjenjaOn', $_POST["datumRodjenjaOn"]);
		$izraz -> bindParam(':datumRodjenjaOna', $_POST["datumRodjenjaOna"]);
		$izraz -> bindParam(':jmbgOn', $_POST["jmbgOn"]);
		$izraz -> bindParam(':jmbgOna', $_POST["jmbgOna"]);
		$izraz -> bindParam(':vjeraOn', $_POST["vjeraOn"]);
		$izraz -> bindParam(':vjeraOna', $_POST["vjeraOna"]);
		$izraz -> bindParam(':datumKrstenjaOn', $_POST["datumKrstenjaOn"]);
		$izraz -> bindParam(':datumKrstenjaOna', $_POST["datumKrstenjaOna"]);
		$izraz -> bindParam(':zupaKrstenjaOn', $_POST["zupaKrstenjaOn"]);
		$izraz -> bindParam(':zupaKrstenjaOna', $_POST["zupaKrstenjaOna"]);
		$izraz -> bindParam(':otacOn', $_POST["otacOn"]);
		$izraz -> bindParam(':otacOna', $_POST["otacOna"]);
		$izraz -> bindParam(':majkaOn', $_POST["majkaOn"]);
		$izraz -> bindParam(':majkaOna', $_POST["majkaOna"]);
		$izraz -> bindParam(':svjedokOn', $_POST["svjedokOn"]);
		$izraz -> bindParam(':svjedokOna', $_POST["svjedokOna"]);
		$izraz -> bindParam(':vjencatelj', $_POST["vjencatelj"]);
		$izraz -> bindParam(':zabiljeske', $_POST["zabiljeske"]);
		$izraz -> bindParam(':id', $_POST["hfMvId"]);
		$izraz -> execute();
		
		
		$porukaOSpremanju = "Podaci uspješno izmjenjeni <a class='pl55' href=" . $_SERVER["PHP_SELF"] . ">Unos novog zapisa</a>";
}
