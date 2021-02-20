<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}

//spremanje osnovnih podataka
$izraz = $veza -> prepare("update obiteljskiListovi set zupa_id=:zupa_id,prezime=:prezime,adresa=:adresa,telefon=:telefon,
														dosliIz=:dosliIz,crkvenoKada=:crkvenoKada,crkvenoGdje=:crkvenoGdje,
														civilnoKada=:civilnoKada,civilnoGdje=:civilnoGdje,opaske=:opaske,
														biljeske=:biljeske,lukna=:lukna,darovi=:darovi
														where id=:id 
														and zupa_id in(select zupa_id from zupnici where user_id=:userId)");
$izraz -> bindParam(':zupa_id', $_POST["zupa"]);
$izraz -> bindParam(':prezime', $_POST["prezime"]);
$izraz -> bindParam(':adresa', $_POST["adresa"]);
$izraz -> bindParam(':telefon', $_POST["telefon"]);
$izraz -> bindParam(':dosliIz', $_POST["dosliIz"]);
$izraz -> bindParam(':crkvenoKada', $_POST["crkvenoKada"]);
$izraz -> bindParam(':crkvenoGdje', $_POST["crkvenoGdje"]);
$izraz -> bindParam(':civilnoKada', $_POST["civilnoKada"]);
$izraz -> bindParam(':civilnoGdje', $_POST["civilnoGdje"]);
$izraz -> bindParam(':opaske', $_POST["opaske"]);
$izraz -> bindParam(':biljeske', $_POST["biljeske"]);
$izraz -> bindParam(':lukna', $_POST["lukna"]);
$izraz -> bindParam(':darovi', $_POST["darovi"]);
$izraz -> bindParam(':id', $olId);
$izraz -> bindParam(':userId', $podaci->userId);
$izraz -> execute();

//update članova sa zupa_id
$izraz = $veza -> prepare("update clanovi set zupa_id=:zupa_id where ol_id=:ol_id
						   and zupa_id in(select zupa_id from zupnici where user_id=:userId)");
$izraz -> bindParam(':zupa_id', $_POST["zupa"]);
$izraz -> bindParam(':ol_id', $olId);
$izraz -> bindParam(':userId', $podaci->userId);
$izraz -> execute();


//spremanje podataka muža
if(!empty($_POST["muzIme"])){ //ako uopće ima podataka
	if(empty($_POST["muzClanId"])){ //ako još nije bio upisan napravi novog člana
		$izraz4 = $veza -> prepare("insert into clanovi(zupa_id,ol_id,uloga_id,ime,zanimanje,datumRodjenja,mjestoRodjenja,datumKrstenja,mjestoKrstenja,
													   datumPricesti,mjestoPricesti,datumPotvrde,mjestoPotvrde,datumSmrti,mjestoSmrti)
											   values(:zupa_id,:ol_id,1,:ime,:zanimanje,:datumRodjenja,:mjestoRodjenja,:datumKrstenja,:mjestoKrstenja,
													   :datumPricesti,:mjestoPricesti,:datumPotvrde,:mjestoPotvrde,:datumSmrti,:mjestoSmrti)");
		$izraz4 -> bindParam(':zupa_id', $_POST["zupa"]);
		$izraz4 -> bindParam(':ol_id', $olId);
		$izraz4 -> bindParam(':ime', $_POST["muzIme"]);
		$izraz4 -> bindParam(':zanimanje', $_POST["muzZanimanje"]);
		$izraz4 -> bindParam(':datumRodjenja', $_POST["muzDatumRodjenja"]);
		$izraz4 -> bindParam(':mjestoRodjenja', $_POST["muzMjestoRodjenja"]);
		$izraz4 -> bindParam(':datumKrstenja', $_POST["muzDatumKrstenja"]);
		$izraz4 -> bindParam(':mjestoKrstenja', $_POST["muzMjestoKrstenja"]);
		$izraz4 -> bindParam(':datumPricesti', $_POST["muzDatumPricesti"]);
		$izraz4 -> bindParam(':mjestoPricesti', $_POST["muzMjestoPricesti"]);
		$izraz4 -> bindParam(':datumPotvrde', $_POST["muzDatumPotvrde"]);
		$izraz4 -> bindParam(':mjestoPotvrde', $_POST["muzMjestoPotvrde"]);
		$izraz4 -> bindParam(':datumSmrti', $_POST["muzDatumSmrti"]);
		$izraz4 -> bindParam(':mjestoSmrti', $_POST["muzMjestoSmrti"]);		
		$izraz4 -> execute();
		
		$_POST["muzClanId"] = $veza->lastInsertId(); //zbog buga kod Input klase da daje prednost POST vrijednosti
	}else{ //ako je već bio upisan dopuni podatke
		$izraz5 = $veza -> prepare("update clanovi set ime=:ime,zanimanje=:zanimanje,
													  datumRodjenja=:datumRodjenja,mjestoRodjenja=:mjestoRodjenja,
													  datumKrstenja=:datumKrstenja,mjestoKrstenja=:mjestoKrstenja,
													  datumPricesti=:datumPricesti,mjestoPricesti=:mjestoPricesti,
													  datumPotvrde=:datumPotvrde,mjestoPotvrde=:mjestoPotvrde,
													  datumSmrti=:datumSmrti,mjestoSmrti=:mjestoSmrti
													  where id=:id and zupa_id in(select zupa_id from zupnici where user_id=:userId)");
		$izraz5 -> bindParam(':ime', $_POST["muzIme"]);
		$izraz5 -> bindParam(':zanimanje', $_POST["muzZanimanje"]);
		$izraz5 -> bindParam(':datumRodjenja', $_POST["muzDatumRodjenja"]);
		$izraz5 -> bindParam(':mjestoRodjenja', $_POST["muzMjestoRodjenja"]);
		$izraz5 -> bindParam(':datumKrstenja', $_POST["muzDatumKrstenja"]);
		$izraz5 -> bindParam(':mjestoKrstenja', $_POST["muzMjestoKrstenja"]);
		$izraz5 -> bindParam(':datumPricesti', $_POST["muzDatumPricesti"]);
		$izraz5 -> bindParam(':mjestoPricesti', $_POST["muzMjestoPricesti"]);
		$izraz5 -> bindParam(':datumPotvrde', $_POST["muzDatumPotvrde"]);
		$izraz5 -> bindParam(':mjestoPotvrde', $_POST["muzMjestoPotvrde"]);
		$izraz5 -> bindParam(':datumSmrti', $_POST["muzDatumSmrti"]);
		$izraz5 -> bindParam(':mjestoSmrti', $_POST["muzMjestoSmrti"]);
		$izraz5 -> bindParam(':id', $_POST["muzClanId"]);
		$izraz5 -> bindParam(':userId', $podaci->userId);				
		$izraz5 -> execute();
	}	 
}


//spremanje podataka žene
if(!empty($_POST["zenaIme"])){ //ako uopće ima podataka 
	if(empty($_POST["zenaClanId"])){ //ako još nije bila upisana napravi novog člana
		$izraz2 = $veza -> prepare("insert into clanovi(zupa_id,ol_id,uloga_id,ime,zanimanje,datumRodjenja,mjestoRodjenja,datumKrstenja,mjestoKrstenja,
													   datumPricesti,mjestoPricesti,datumPotvrde,mjestoPotvrde,datumSmrti,mjestoSmrti)
											   values(:zupa_id,:ol_id,2,:ime,:zanimanje,:datumRodjenja,:mjestoRodjenja,:datumKrstenja,:mjestoKrstenja,
													   :datumPricesti,:mjestoPricesti,:datumPotvrde,:mjestoPotvrde,:datumSmrti,:mjestoSmrti)");
		$izraz2 -> bindParam(':zupa_id', $_POST["zupa"]);
		$izraz2 -> bindParam(':ol_id', $olId);
		$izraz2 -> bindParam(':ime', $_POST["zenaIme"]);
		$izraz2 -> bindParam(':zanimanje', $_POST["zenaZanimanje"]);
		$izraz2 -> bindParam(':datumRodjenja', $_POST["zenaDatumRodjenja"]);
		$izraz2 -> bindParam(':mjestoRodjenja', $_POST["zenaMjestoRodjenja"]);
		$izraz2 -> bindParam(':datumKrstenja', $_POST["zenaDatumKrstenja"]);
		$izraz2 -> bindParam(':mjestoKrstenja', $_POST["zenaMjestoKrstenja"]);
		$izraz2 -> bindParam(':datumPricesti', $_POST["zenaDatumPricesti"]);
		$izraz2 -> bindParam(':mjestoPricesti', $_POST["zenaMjestoPricesti"]);
		$izraz2 -> bindParam(':datumPotvrde', $_POST["zenaDatumPotvrde"]);
		$izraz2 -> bindParam(':mjestoPotvrde', $_POST["zenaMjestoPotvrde"]);
		$izraz2 -> bindParam(':datumSmrti', $_POST["zenaDatumSmrti"]);
		$izraz2 -> bindParam(':mjestoSmrti', $_POST["zenaMjestoSmrti"]);		
		$izraz2 -> execute();
		
		$_POST["zenaClanId"] = $veza->lastInsertId(); //zbog buga kod Input klase da daje prednost POST vrijednosti
		
	}else{ //ako je već bila upisana dopuni podatke
		$izraz3 = $veza -> prepare("update clanovi set ime=:ime,zanimanje=:zanimanje,
													  datumRodjenja=:datumRodjenja,mjestoRodjenja=:mjestoRodjenja,
													  datumKrstenja=:datumKrstenja,mjestoKrstenja=:mjestoKrstenja,
													  datumPricesti=:datumPricesti,mjestoPricesti=:mjestoPricesti,
													  datumPotvrde=:datumPotvrde,mjestoPotvrde=:mjestoPotvrde,
													  datumSmrti=:datumSmrti,mjestoSmrti=:mjestoSmrti
													  where id=:id and zupa_id in(select zupa_id from zupnici where user_id=:userId)");
		$izraz3 -> bindParam(':ime', $_POST["zenaIme"]);
		$izraz3 -> bindParam(':zanimanje', $_POST["zenaZanimanje"]);
		$izraz3 -> bindParam(':datumRodjenja', $_POST["zenaDatumRodjenja"]);
		$izraz3 -> bindParam(':mjestoRodjenja', $_POST["zenaMjestoRodjenja"]);
		$izraz3 -> bindParam(':datumKrstenja', $_POST["zenaDatumKrstenja"]);
		$izraz3 -> bindParam(':mjestoKrstenja', $_POST["zenaMjestoKrstenja"]);
		$izraz3 -> bindParam(':datumPricesti', $_POST["zenaDatumPricesti"]);
		$izraz3 -> bindParam(':mjestoPricesti', $_POST["zenaMjestoPricesti"]);
		$izraz3 -> bindParam(':datumPotvrde', $_POST["zenaDatumPotvrde"]);
		$izraz3 -> bindParam(':mjestoPotvrde', $_POST["zenaMjestoPotvrde"]);
		$izraz3 -> bindParam(':datumSmrti', $_POST["zenaDatumSmrti"]);
		$izraz3 -> bindParam(':mjestoSmrti', $_POST["zenaMjestoSmrti"]);
		$izraz3 -> bindParam(':id', $_POST["zenaClanId"]);
		$izraz3 -> bindParam(':userId', $podaci->userId);				
		$izraz3 -> execute();
	}	 
}


$porukaOSpremanju = "Podaci spremljeni";
