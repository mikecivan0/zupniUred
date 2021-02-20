<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}

$_POST["hfMkId"] = (empty($_POST["hfMkId"])) ? null : $_POST["hfMkId"];
if(empty($_POST["hfMuId"])){
	$izraz = $veza -> prepare("insert into maticaUmrlih(zupa_id,mk_id,svezak,zaGodinu,stranica,broj,datumSmrti,mjestoSmrti,datumPokopa,mjestoPokopa,ime,prezime,
										spol,mjestoRodjenja,datumRodjenja,jmbg,supruznik,otac,majka,mjestoPrebivanja,ulica,kucniBroj,potvrdjenSakramentima,sluzbenik,zabiljeske) 
										
										values(:zupa_id,:mk_id,:svezak,:zaGodinu,:stranica,:broj,:datumSmrti,:mjestoSmrti,:datumPokopa,:mjestoPokopa,:ime,:prezime,
										:spol,:mjestoRodjenja,:datumRodjenja,:jmbg,:supruznik,:otac,:majka,:mjestoPrebivanja,:ulica,:kucniBroj,:potvrdjenSakramentima,:sluzbenik,:zabiljeske);");
		$izraz -> bindParam(':zupa_id', $_POST["zupa"]);
		$izraz -> bindParam(':mk_id', $_POST["hfMkId"]);		
		$izraz -> bindParam(':svezak', $_POST["svezak"]);
		$izraz -> bindParam(':zaGodinu', $_POST["zaGodinu"]);
		$izraz -> bindParam(':stranica', $_POST["stranica"]);
		$izraz -> bindParam(':broj', $_POST["broj"]);
		$izraz -> bindParam(':datumSmrti', $_POST["datumSmrti"]);
		$izraz -> bindParam(':mjestoSmrti', $_POST["mjestoSmrti"]);
		$izraz -> bindParam(':datumPokopa', $_POST["datumPokopa"]);
		$izraz -> bindParam(':mjestoPokopa', $_POST["mjestoPokopa"]);
		$izraz -> bindParam(':ime', $_POST["ime"]);
		$izraz -> bindParam(':prezime', $_POST["prezime"]);
		$izraz -> bindParam(':spol', $_POST["spol"]);
		$izraz -> bindParam(':mjestoRodjenja', $_POST["mjestoRodjenja"]);
		$izraz -> bindParam(':datumRodjenja', $_POST["datumRodjenja"]);
		$izraz -> bindParam(':jmbg', $_POST["jmbg"]);
		$izraz -> bindParam(':supruznik', $_POST["supruznik"]);
		$izraz -> bindParam(':otac', $_POST["otac"]);
		$izraz -> bindParam(':majka', $_POST["majka"]);
		$izraz -> bindParam(':mjestoPrebivanja', $_POST["mjestoPrebivanja"]);
		$izraz -> bindParam(':ulica', $_POST["ulica"]);
		$izraz -> bindParam(':kucniBroj', $_POST["kucniBroj"]);
		$izraz -> bindParam(':potvrdjenSakramentima', $_POST["potvrdjenSakramentima"]);
		$izraz -> bindParam(':sluzbenik', $_POST["sluzbenik"]);
		$izraz -> bindParam(':zabiljeske', $_POST["zabiljeske"]);
		$izraz -> execute();
		
		$mu_id = $veza -> lastInsertId();
		$_POST["hfMuId"] = $mu_id;
		$porukaOSpremanju = "Zapis uspješno unešen. <a class='pl55' href=" . $_SERVER["PHP_SELF"] . ">Unos novog zapisa</a>";
}else{
	$izraz = $veza -> prepare("update maticaUmrlih set zupa_id=:zupa_id,mk_id=:mk_id,svezak=:svezak,zaGodinu=:zaGodinu,stranica=:stranica,broj=:broj,
							   datumSmrti=:datumSmrti,mjestoSmrti=:mjestoSmrti,datumPokopa=:datumPokopa,mjestoPokopa=:mjestoPokopa,ime=:ime,prezime=:prezime,
							   spol=:spol,mjestoRodjenja=:mjestoRodjenja,datumRodjenja=:datumRodjenja,jmbg=:jmbg,supruznik=:supruznik,
							   otac=:otac,majka=:majka,mjestoPrebivanja=:mjestoPrebivanja,ulica=:ulica,kucniBroj=:kucniBroj,potvrdjenSakramentima=:potvrdjenSakramentima,
							   sluzbenik=:sluzbenik,zabiljeske=:zabiljeske
						       where id=:id;");
		$izraz -> bindParam(':zupa_id', $_POST["zupa"]);
		$izraz -> bindParam(':mk_id', $_POST["hfMkId"]);		
		$izraz -> bindParam(':svezak', $_POST["svezak"]);
		$izraz -> bindParam(':zaGodinu', $_POST["zaGodinu"]);
		$izraz -> bindParam(':stranica', $_POST["stranica"]);
		$izraz -> bindParam(':broj', $_POST["broj"]);
		$izraz -> bindParam(':datumSmrti', $_POST["datumSmrti"]);
		$izraz -> bindParam(':mjestoSmrti', $_POST["mjestoSmrti"]);
		$izraz -> bindParam(':datumPokopa', $_POST["datumPokopa"]);
		$izraz -> bindParam(':mjestoPokopa', $_POST["mjestoPokopa"]);
		$izraz -> bindParam(':ime', $_POST["ime"]);
		$izraz -> bindParam(':prezime', $_POST["prezime"]);
		$izraz -> bindParam(':spol', $_POST["spol"]);
		$izraz -> bindParam(':mjestoRodjenja', $_POST["mjestoRodjenja"]);
		$izraz -> bindParam(':datumRodjenja', $_POST["datumRodjenja"]);
		$izraz -> bindParam(':jmbg', $_POST["jmbg"]);
		$izraz -> bindParam(':supruznik', $_POST["supruznik"]);
		$izraz -> bindParam(':otac', $_POST["otac"]);
		$izraz -> bindParam(':majka', $_POST["majka"]);
		$izraz -> bindParam(':mjestoPrebivanja', $_POST["mjestoPrebivanja"]);
		$izraz -> bindParam(':ulica', $_POST["ulica"]);
		$izraz -> bindParam(':kucniBroj', $_POST["kucniBroj"]);
		$izraz -> bindParam(':potvrdjenSakramentima', $_POST["potvrdjenSakramentima"]);
		$izraz -> bindParam(':sluzbenik', $_POST["sluzbenik"]);
		$izraz -> bindParam(':zabiljeske', $_POST["zabiljeske"]);
		$izraz -> bindParam(':id', $_POST["hfMuId"]);
		$izraz -> execute();
		
		
		$porukaOSpremanju = "Podaci uspješno izmjenjeni <a class='pl55' href=" . $_SERVER["PHP_SELF"] . ">Unos novog zapisa</a>";
}
