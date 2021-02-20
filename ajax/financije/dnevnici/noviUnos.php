<?php

if (!$_POST) {
	exit ;
}

include_once '../../../config/conf.php';

//kontrola da se ne pokuša unositi u podatke druge župe
$izraz = $veza -> prepare("select zupa_id from zupnici where zupa_id=:zupa_id and user_id=:user_id;");
$izraz -> bindValue(":zupa_id", $_POST["zupa_id"]);
$izraz -> bindValue(":user_id", $podaci -> userId);
$izraz -> execute();
$zupa = $izraz -> fetch(PDO::FETCH_OBJ);
if (!empty($zupa)) {
	$markTransakcije = md5($podaci -> userId . date("c"));
	$izraz = $veza -> prepare("insert into transakcije(svrha_id,zupa_id,markTransakcije,iznos,datum,napomena) 
							   values(:svrha_id,:zupa_id,:markTransakcije,:iznos,:datum,:napomena);");
	$izraz -> bindValue(":svrha_id", $_POST["svrha_id"]);
	$izraz -> bindValue(":zupa_id", $_POST["zupa_id"]);
	$izraz -> bindValue(":markTransakcije", $markTransakcije);
	$izraz -> bindValue(":iznos", $_POST["iznos"]);
	$izraz -> bindValue(":datum", $_POST["datum"]);
	$izraz -> bindValue(":napomena", $_POST["napomena"]);
	$izraz -> execute();

	//provjeri ima li automatkih unosa
	$izraz = $veza -> prepare("select * from automatskiUnosi
							   where primSvrha_id=:svrha_id and zupa_id=:zupa_id;");
	$izraz -> bindValue(":svrha_id", $_POST["svrha_id"]);
	$izraz -> bindValue(":zupa_id", $_POST["zupa_id"]);
	$izraz -> execute();
	$automatskiUnos1 = $izraz -> fetch(PDO::FETCH_OBJ);
	if (!empty($automatskiUnos1)) {//ako ima automatksihUnosa
		$mjesec = date('n', strtotime($_POST["datum"]));
		$godina = date('Y', strtotime($_POST["datum"]));

		$izraz = $veza -> prepare("insert into transakcije(svrha_id,zupa_id,markTransakcije,iznos,datum,napomena) 
							   values(:svrha_id,:zupa_id,:markTransakcije,:iznos,:datum,:napomena);");
		$izraz -> bindValue(":svrha_id", $automatskiUnos1 -> autoSvrha_id);
		$izraz -> bindValue(":zupa_id", $_POST["zupa_id"]);
		$izraz -> bindValue(":markTransakcije", $markTransakcije);
		$izraz -> bindValue(":iznos", $_POST["iznos"]);
		$izraz -> bindValue(":datum", $_POST["datum"]);
		$izraz -> bindValue(":napomena", $_POST["napomena"]);
		$izraz -> execute();

		//provjeri ima li automatkih unosa nakon prvog automatskog unosa
		$izraz = $veza -> prepare("select * from automatskiUnosi
								   where primSvrha_id=:svrha_id and zupa_id=:zupa_id;");
		$izraz -> bindValue(":svrha_id", $automatskiUnos1 -> autoSvrha_id);
		$izraz -> bindValue(":zupa_id", $_POST["zupa_id"]);
		$izraz -> execute();
		$automatskiUnos2 = $izraz -> fetch(PDO::FETCH_OBJ);
		if (!empty($automatskiUnos2)) {
			$izraz = $veza -> prepare("insert into transakcije(svrha_id,zupa_id,markTransakcije,iznos,datum,napomena) 
								   values(:svrha_id,:zupa_id,:markTransakcije,:iznos,:datum,:napomena);");
			$izraz -> bindValue(":svrha_id", $automatskiUnos2 -> autoSvrha_id);
			$izraz -> bindValue(":zupa_id", $_POST["zupa_id"]);
			$izraz -> bindValue(":markTransakcije", $markTransakcije);
			$izraz -> bindValue(":iznos", $_POST["iznos"]);
			$izraz -> bindValue(":datum", $_POST["datum"]);
			$izraz -> bindValue(":napomena", $_POST["napomena"]);
			$izraz -> execute();
		}
	}
	echo "OK";
} else {
	echo "Ne možete uređivati tuđe dnevnike!";
}
