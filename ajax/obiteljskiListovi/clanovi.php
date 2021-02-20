<?php

if (!$_POST["ime"]) {
	exit ;
}

include_once '../../config/conf.php';

if(isset($_POST["modalClanId"])){ //ako je zatražena promjena podataka
	//provjeri je li taj član u župi tog usera
	$izraz = $veza->prepare("select * from clanovi where id=:id and ol_id=:ol_id
						 	 and zupa_id in (select zupa_id from zupnici where user_id=:user_id);");
	$izraz->bindParam(':id', $_POST["modalClanId"]);
	$izraz->bindParam(':ol_id', $_POST["ol_id"]);
	$izraz->bindParam(':user_id', $podaci->userId);
	$izraz->execute();
	$clan = $izraz->fetch(PDO::FETCH_OBJ);
	
	if(!empty($clan)){ //ako je župljanin izmijeni podatke
		$izraz = $veza->prepare("update clanovi set ime=:ime,datumRodjenja=:datumRodjenja,mjestoRodjenja=:mjestoRodjenja,
								 datumKrstenja=:datumKrstenja,mjestoKrstenja=:mjestoKrstenja,
								 datumPricesti=:datumPricesti,mjestoPricesti=:mjestoPricesti,
								 datumPotvrde=:datumPotvrde,mjestoPotvrde=:mjestoPotvrde,
								 datumVjencanja=:datumVjencanja,mjestoVjencanja=:mjestoVjencanja,
								 datumSmrti=:datumSmrti,mjestoSmrti=:mjestoSmrti
								 where id=:id;");
		$izraz->bindParam(':ime', $_POST["ime"]);
		$izraz->bindParam(':datumRodjenja', $_POST["datumRodjenja"]);
		$izraz->bindParam(':mjestoRodjenja', $_POST["mjestoRodjenja"]);
		$izraz->bindParam(':datumKrstenja', $_POST["datumKrstenja"]);
		$izraz->bindParam(':mjestoKrstenja', $_POST["mjestoKrstenja"]);
		$izraz->bindParam(':datumPricesti', $_POST["datumPricesti"]);
		$izraz->bindParam(':mjestoPricesti', $_POST["mjestoPricesti"]);
		$izraz->bindParam(':datumPotvrde', $_POST["datumPotvrde"]);
		$izraz->bindParam(':mjestoPotvrde', $_POST["mjestoPotvrde"]);
		$izraz->bindParam(':datumVjencanja', $_POST["datumVjencanja"]);
		$izraz->bindParam(':mjestoVjencanja', $_POST["mjestoVjencanja"]);
		$izraz->bindParam(':datumSmrti', $_POST["datumSmrti"]);
		$izraz->bindParam(':mjestoSmrti', $_POST["mjestoSmrti"]);
		$izraz->bindParam(':id', $_POST["modalClanId"]);
		$izraz->execute();
		
		//stavi nove podatke u klasu da se prenesu u tablicu
		$noviPodaci = new stdClass();
		$noviPodaci->ime = $_POST["ime"];
		$noviPodaci->datumRodjenja = $_POST["datumRodjenja"];
		$noviPodaci->mjestoRodjenja = $_POST["mjestoRodjenja"];
		$noviPodaci->datumKrstenja = $_POST["datumKrstenja"];
		$noviPodaci->mjestoKrstenja = $_POST["mjestoKrstenja"];
		$noviPodaci->datumPricesti = $_POST["datumPricesti"];
		$noviPodaci->mjestoPricesti = $_POST["mjestoPricesti"];
		$noviPodaci->datumPotvrde = $_POST["datumPotvrde"];
		$noviPodaci->mjestoPotvrde = $_POST["mjestoPotvrde"];
		$noviPodaci->datumVjencanja = $_POST["datumVjencanja"];
		$noviPodaci->mjestoVjencanja = $_POST["mjestoVjencanja"];
		$noviPodaci->datumSmrti = $_POST["datumSmrti"];
		$noviPodaci->mjestoSmrti = $_POST["mjestoSmrti"];
		$noviPodaci->id = $_POST["modalClanId"];
		$noviPodaci->uloga_id = $clan->uloga_id;
		
		echo json_encode($noviPodaci);
	}else{
		echo "Error";
	}
}else{ //ako se unosi novi član
	//provjeri je li odabrana župa u nadležnosti usera
	$izraz = $veza->prepare("select * from zupnici where user_id=:user_id and zupa_id=:zupa_id;");
	$izraz->bindParam(':zupa_id', $_POST["zupa_id"]);
	$izraz->bindParam(':user_id', $podaci->userId);
	$izraz->execute();
	$imaZupa = $izraz->fetch(PDO::FETCH_OBJ);
	
	if(!empty($imaZupa)){ //ako je župnik onda unesi podatke
		$izraz = $veza->prepare("insert into clanovi(zupa_id,ol_id,uloga_id,ime,datumRodjenja,mjestoRodjenja,datumKrstenja,mjestoKrstenja,
								 datumPricesti,mjestoPricesti,datumPotvrde,mjestoPotvrde,datumVjencanja,mjestoVjencanja,
								 datumSmrti,mjestoSmrti)
								 values(:zupa_id,:ol_id,:uloga_id,:ime,:datumRodjenja,:mjestoRodjenja,:datumKrstenja,:mjestoKrstenja,
								 :datumPricesti,:mjestoPricesti,:datumPotvrde,:mjestoPotvrde,:datumVjencanja,:mjestoVjencanja,
								 :datumSmrti,:mjestoSmrti);");
		$izraz->bindParam(':zupa_id', $_POST["zupa_id"]);
		$izraz->bindParam(':ol_id', $_POST["ol_id"]);
		$izraz->bindParam(':uloga_id', $_POST["uloga_id"]);
		$izraz->bindParam(':ime', $_POST["ime"]);
		$izraz->bindParam(':datumRodjenja', $_POST["datumRodjenja"]);
		$izraz->bindParam(':mjestoRodjenja', $_POST["mjestoRodjenja"]);
		$izraz->bindParam(':datumKrstenja', $_POST["datumKrstenja"]);
		$izraz->bindParam(':mjestoKrstenja', $_POST["mjestoKrstenja"]);
		$izraz->bindParam(':datumPricesti', $_POST["datumPricesti"]);
		$izraz->bindParam(':mjestoPricesti', $_POST["mjestoPricesti"]);
		$izraz->bindParam(':datumPotvrde', $_POST["datumPotvrde"]);
		$izraz->bindParam(':mjestoPotvrde', $_POST["mjestoPotvrde"]);
		$izraz->bindParam(':datumVjencanja', $_POST["datumVjencanja"]);
		$izraz->bindParam(':mjestoVjencanja', $_POST["mjestoVjencanja"]);
		$izraz->bindParam(':datumSmrti', $_POST["datumSmrti"]);
		$izraz->bindParam(':mjestoSmrti', $_POST["mjestoSmrti"]);
		$izraz->execute();
		
		//stavi podatke u klasu da se prenesu u tablicu
		$noviClan = new stdClass();
		$noviClan->id = $veza->lastInsertId();
		$noviClan->uloga_id = $_POST["uloga_id"];
		$noviClan->ime = $_POST["ime"];
		$noviClan->datumRodjenja = $_POST["datumRodjenja"];
		$noviClan->mjestoRodjenja = $_POST["mjestoRodjenja"];
		$noviClan->datumKrstenja = $_POST["datumKrstenja"];
		$noviClan->mjestoKrstenja = $_POST["mjestoKrstenja"];
		$noviClan->datumPricesti = $_POST["datumPricesti"];
		$noviClan->mjestoPricesti = $_POST["mjestoPricesti"];
		$noviClan->datumPotvrde = $_POST["datumPotvrde"];
		$noviClan->mjestoPotvrde = $_POST["mjestoPotvrde"];
		$noviClan->datumVjencanja = $_POST["datumVjencanja"];
		$noviClan->mjestoVjencanja = $_POST["mjestoVjencanja"];
		$noviClan->datumSmrti = $_POST["datumSmrti"];
		$noviClan->mjestoSmrti = $_POST["mjestoSmrti"];		
		
		echo json_encode($noviClan);		
	}else{
		echo "Error";
	}
}
