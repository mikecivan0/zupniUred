<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}

if(empty($_POST["hfMkId"])){
$izraz = $veza -> prepare("insert into osobe (mjestoPrebivanja,ime,prezime,jmbg,ulica,kucniBroj,spol) 
						   values(:mjestoPrebivanja,:ime,:prezime,:jmbg,:ulica,:kucniBroj,:spol);");
		$izraz -> bindParam(':ime', $_POST["ime"]);
		$izraz -> bindParam(':prezime', $_POST["prezime"]);
		$izraz -> bindParam(':spol', $_POST["spol"]);
		$izraz -> bindParam(':mjestoPrebivanja', $_POST["mjestoPrebivanja"]);
		$izraz -> bindParam(':jmbg', $_POST["jmbg"]);
		$izraz -> bindParam(':ulica', $_POST["ulica"]);
		$izraz -> bindParam(':kucniBroj', $_POST["kucniBroj"]);
		$izraz -> execute();
		
		$osoba_id = $veza -> lastInsertId();
		$_POST["hfOsobaId"] = $osoba_id;
		
		
	$izraz = $veza -> prepare("insert into maticaKrstenih (osoba_id,zupa_id,svezak,zaGodinu,stranica,broj,datumKrstenja,mjestoKrstenja,
														   datumRodjenja,mjestoRodjenja,
														   otac,majka,roditeljiVjencani,prebivaliste,kum,krstitelj,zabiljeske,
														   datumPricesti,mjestoPricesti,datumKrizme,mjestoKrizme) 
												    values(:osoba_id,:zupa_id,:svezak,:zaGodinu,:stranica,:broj,:datumKrstenja,:mjestoKrstenja,
														   :datumRodjenja,:mjestoRodjenja,
													       :otac,:majka,:roditeljiVjencani,:prebivaliste,:kum,:krstitelj,:zabiljeske,
													       :datumPricesti,:mjestoPricesti,:datumKrizme,:mjestoKrizme);");
		$izraz -> bindParam(':osoba_id', $osoba_id);
		$izraz -> bindParam(':zupa_id', $_POST["zupa"]);
		$izraz -> bindParam(':svezak', $_POST["svezak"]);
		$izraz -> bindParam(':zaGodinu', $_POST["zaGodinu"]);
		$izraz -> bindParam(':stranica', $_POST["stranica"]);
		$izraz -> bindParam(':broj', $_POST["broj"]);
		$izraz -> bindParam(':datumKrstenja', $_POST["datumKrstenja"]);
		$izraz -> bindParam(':mjestoKrstenja', $_POST["mjestoKrstenja"]);
		$izraz -> bindParam(':datumRodjenja', $_POST["datumRodjenja"]);
		$izraz -> bindParam(':mjestoRodjenja', $_POST["mjestoRodjenja"]);
		$izraz -> bindParam(':otac', $_POST["otac"]);
		$izraz -> bindParam(':majka', $_POST["majka"]);
		$izraz -> bindParam(':roditeljiVjencani', $_POST["roditeljiVjencani"]);
		$izraz -> bindParam(':prebivaliste', $_POST["mjestoPrebivanja"]);
		$izraz -> bindParam(':kum', $_POST["kum"]);
		$izraz -> bindParam(':krstitelj', $_POST["krstitelj"]);
		$izraz -> bindParam(':zabiljeske', $_POST["zabiljeske"]);
		$izraz -> bindParam(':datumPricesti', $_POST["datumPricesti"]);
		$izraz -> bindParam(':mjestoPricesti', $_POST["mjestoPricesti"]);
		$izraz -> bindParam(':datumKrizme', $_POST["datumKrizme"]);
		$izraz -> bindParam(':mjestoKrizme', $_POST["mjestoKrizme"]);
		$izraz -> execute();
		
		$mk_id = $veza -> lastInsertId();
		$_POST["hfMkId"] = $mk_id;
		$porukaOSpremanju = "Zapis uspješno unešen. <a class='pl55' href=" . $_SERVER["PHP_SELF"] . ">Unos novog zapisa</a>";
}else{
	$izraz = $veza -> prepare("update osobe set ime=:ime,prezime=:prezime,
							   jmbg=:jmbg,ulica=:ulica,kucniBroj=:kucniBroj,spol=:spol
							   where id=:id;");
		$izraz -> bindParam(':ime', $_POST["ime"]);
		$izraz -> bindParam(':prezime', $_POST["prezime"]);
		$izraz -> bindParam(':spol', $_POST["spol"]);
		$izraz -> bindParam(':jmbg', $_POST["jmbg"]);
		$izraz -> bindParam(':ulica', $_POST["ulica"]);
		$izraz -> bindParam(':kucniBroj', $_POST["kucniBroj"]);
		$izraz -> bindParam(':id', $_POST["hfOsobaId"]);
		$izraz -> execute();
		
		
	$izraz = $veza -> prepare("update maticaKrstenih set zupa_id=:zupa_id,svezak=:svezak,zaGodinu=:zaGodinu,stranica=:stranica,broj=:broj,
							datumKrstenja=:datumKrstenja,mjestoKrstenja=:mjestoKrstenja,datumRodjenja=:datumRodjenja,mjestoRodjenja=:mjestoRodjenja,
							otac=:otac,majka=:majka,roditeljiVjencani=:roditeljiVjencani,prebivaliste=:prebivaliste,
							kum=:kum,krstitelj=:krstitelj,zabiljeske=:zabiljeske,datumPricesti=:datumPricesti,mjestoPricesti=:mjestoPricesti,
							datumKrizme=:datumKrizme,mjestoKrizme=:mjestoKrizme
							where id=:id;");
		$izraz -> bindParam(':zupa_id', $_POST["zupa"]);
		$izraz -> bindParam(':svezak', $_POST["svezak"]);
		$izraz -> bindParam(':zaGodinu', $_POST["zaGodinu"]);
		$izraz -> bindParam(':stranica', $_POST["stranica"]);
		$izraz -> bindParam(':broj', $_POST["broj"]);
		$izraz -> bindParam(':datumKrstenja', $_POST["datumKrstenja"]);
		$izraz -> bindParam(':mjestoKrstenja', $_POST["mjestoKrstenja"]);
		$izraz -> bindParam(':datumRodjenja', $_POST["datumRodjenja"]);
		$izraz -> bindParam(':mjestoRodjenja', $_POST["mjestoRodjenja"]);
		$izraz -> bindParam(':otac', $_POST["otac"]);
		$izraz -> bindParam(':majka', $_POST["majka"]);
		$izraz -> bindParam(':roditeljiVjencani', $_POST["roditeljiVjencani"]);
		$izraz -> bindParam(':prebivaliste', $_POST["mjestoPrebivanja"]);
		$izraz -> bindParam(':kum', $_POST["kum"]);
		$izraz -> bindParam(':krstitelj', $_POST["krstitelj"]);
		$izraz -> bindParam(':zabiljeske', $_POST["zabiljeske"]);
		$izraz -> bindParam(':datumPricesti', $_POST["datumPricesti"]);
		$izraz -> bindParam(':mjestoPricesti', $_POST["mjestoPricesti"]);
		$izraz -> bindParam(':datumKrizme', $_POST["datumKrizme"]);
		$izraz -> bindParam(':mjestoKrizme', $_POST["mjestoKrizme"]);
		$izraz -> bindParam(':id', $_POST["hfMkId"]);
		$izraz -> execute();
		
		$porukaOSpremanju = "Podaci uspješno izmjenjeni <a class='pl55' href=" . $_SERVER["PHP_SELF"] . ">Unos novog zapisa</a>";
}
