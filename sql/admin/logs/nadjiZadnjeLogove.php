<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

$izraz = $veza -> prepare("select count(id) as ukupno from prijave where user_id!=3;");
	$izraz -> execute();
	$logovi= $izraz -> fetch(PDO::FETCH_OBJ);
	$ukupnoLogova = $logovi->ukupno;
	
	$brojStranica = ceil($ukupnoLogova / 20);
	if (isset($_GET["stranica"])) {
		$_GET["stranica"] = ($_GET["stranica"] > $brojStranica) ? $brojStranica : $_GET["stranica"];
		//ako netko ukuca get sa većim brojem stranice nego što ima u paginaciji stavi mu zadnju stranicu
		$offset = ($_GET["stranica"] - 1) * 20;
		//offset za straničenje poruka
	} else {
		$_GET["stranica"] = 1;
		$offset = 0;
	}
	
$sql = "select p.*,concat(o.ime,' ',o.prezime) as osoba, u.username from 
						   prijave p inner join users u on p.user_id=u.id 
						   inner join osobe o on u.osoba_id=o.id where p.user_id!=3 order by p.id desc limit " . $offset . ", 20;";
$izraz = $veza -> prepare($sql);
	$izraz -> execute();
	$prijave= $izraz -> fetchAll(PDO::FETCH_OBJ);
	