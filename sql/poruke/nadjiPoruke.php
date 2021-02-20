<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}

//nađi osobe sa kojima postoji dopisivanje
$izraz = $veza -> prepare("select concat(o.ime,' ',o.prezime) as dopisnik,u.id as dopisnikId 
						from osobe o inner join users u on u.osoba_id=o.id 
						where o.id in(select distinct primatelj_id from poruke where posiljatelj_id=:id and za=:id and obrisano=0 and primatelj_id!=posiljatelj_id) 
						or o.id in(select distinct posiljatelj_id from poruke where primatelj_id=:id and za=:id and obrisano=0 and primatelj_id!=posiljatelj_id);");
$izraz -> bindParam(':id', $podaci -> userId);
$izraz -> execute();
$dopisnici = $izraz -> fetchAll(PDO::FETCH_OBJ);

//osnova upita
$sql = "select concat(o1.ime,' ',o1.prezime) as posiljatelj, concat(o2.ime,' ',o2.prezime) as primatelj,
							   p.id as porukaId, p.poruka, p.procitano, p.datum, p.vrijeme, p.posiljatelj_id, p.primatelj_id
							   from poruke p inner join users u on p.posiljatelj_id=u.id
							   inner join osobe o1 on u.osoba_id=o1.id
							   inner join users u2 on p.primatelj_id=u2.id
							   inner join osobe o2 on u2.osoba_id=o2.id";

//nađi sve poruke
if (!isset($_GET["poruka"]) && !isset($_GET["korisnik"])) {

	//nađi ukupan broj poruka
	$izraz = $veza -> prepare("select count(id) as ukupno from poruke where za=:id and obrisano=0;");
	$izraz -> bindParam(':id', $podaci -> userId);
	$izraz -> execute();
	$ukupniBrojPoruka = $izraz -> fetch(PDO::FETCH_OBJ);
	
	
	//izračunaj ukupni broj stranica za paginaciju
	$brojStranica = ceil($ukupniBrojPoruka -> ukupno / 20);
	
	//provjera da li netko pokušava manipulirati preko get-a
	if (isset($_GET["stranica"])) {
		$_GET["stranica"] = ($_GET["stranica"] > $brojStranica) ? $brojStranica : $_GET["stranica"];
		//ako netko ukuca get sa većim brojem stranice nego što ima u paginaciji stavi mu zadnju stranicu
		$offset = ($_GET["stranica"] - 1) * 20;
		//offset za straničenje poruka
	} else {
		$_GET["stranica"] = 1;
		$offset = 0;
	}

	//nađi poruke
	$sql .= " where za=:id and obrisano=0 order by p.id desc limit " . $offset . ", 20";
	$izraz = $veza -> prepare($sql);
	$izraz -> bindParam(':id', $podaci -> userId);
	$izraz -> execute();
	$poruke = $izraz -> fetchAll(PDO::FETCH_OBJ);

}

//nađi poruke sa oodređenim korisnikom
if (isset($_GET["korisnik"])) {		
	
	//nađi ukupan broj poruka sa određenim korisnikom
	$izraz = $veza -> prepare("select count(id) as ukupno from poruke where za=:id and obrisano=0 and (posiljatelj_id=:on or primatelj_id=:on);");
	$izraz -> bindParam(':id', $podaci -> userId);
	$izraz -> bindParam(':on', $_GET["korisnik"]);
	$izraz -> execute();
	$ukupniBrojPoruka = $izraz -> fetch(PDO::FETCH_OBJ);		
	
	//izračunaj ukupni broj stranica za paginaciju
	$brojStranica = ceil($ukupniBrojPoruka -> ukupno / 20);
	
	//provjera da li netko pokušava manipulirati preko get-a
	if (isset($_GET["stranica"])) {
		$_GET["stranica"] = ($_GET["stranica"] > $brojStranica) ? $brojStranica : $_GET["stranica"];
		//ako netko ukuca get sa većim brojem stranice nego što ima u paginaciji stavi mu zadnju stranicu
		$offset = ($_GET["stranica"] - 1) * 20;
		//offset za straničenje poruka
	} else {
		$_GET["stranica"] = 1;
		$offset = 0;
	}
	
	//nađi poruke sa određenim korisnikom
	$sql .= " where za=:id and obrisano=0 and (p.posiljatelj_id=:on or p.primatelj_id=:on) order by p.id desc 
			  limit " . $offset . ", 20;";
	$izraz = $veza -> prepare($sql);
	$izraz -> bindParam(':id', $podaci -> userId);
	$izraz -> bindParam(':on', $_GET["korisnik"]);
	$izraz -> execute();
	$poruke = $izraz -> fetchAll(PDO::FETCH_OBJ);
}

//nađi određenu poruku
if (isset($_GET["poruka"])) {

	$izraz = $veza -> prepare("select p.*,concat(o.ime,' ',o.prezime) as posiljatelj from poruke p inner join users u on p.posiljatelj_id=u.id
							   inner join osobe o on u.osoba_id=o.id 
							   where p.id=:id");
	$izraz -> bindParam(':id', $_GET["poruka"]);
	$izraz -> execute();
	$poruka = $izraz -> fetch(PDO::FETCH_OBJ);

}

if($podaci->userId==3){
	$izraz = $veza -> prepare("select * from poruke where posiljatelj_id=primatelj_id;");
	$izraz -> execute();
	$obavijesti = $izraz -> fetchAll(PDO::FETCH_OBJ);
}
