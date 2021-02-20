<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}

$izraz = $veza -> prepare("select * from transakcije 
						   where id=:id and zupa_id in (select zupa_id from zupnici where user_id=:user_id);");
$izraz -> bindParam(':id', $_POST["hfId"]);
$izraz -> bindParam(':user_id', $podaci->userId);
$izraz -> execute();
$transakcija = $izraz->fetch(PDO::FETCH_OBJ);

if($transakcija->svrha_id==$_POST["svrha_id"]){//ukoliko se mijenjao samo datum i/ili iznos onda napravi update
	$izraz = $veza -> prepare("update transakcije set datum=:datum,iznos=:iznos,napomena=:napomena 
						   	   where markTransakcije=:markTransakcije
						   	   and zupa_id in (select zupa_id from zupnici where user_id=:user_id);");
	$izraz -> bindParam(':markTransakcije', $transakcija->markTransakcije);
	$izraz -> bindParam(':iznos', $_POST["iznos"]);
	$izraz -> bindParam(':datum', $_POST["datum"]);
	$izraz -> bindParam(':user_id', $podaci->userId);
	$izraz -> bindValue(":napomena", $_POST["napomena"]);
	$izraz -> execute();
}else{//ako je druga svrha onda pobriši unose i unesi novo sa automatskim unosima
	$izraz = $veza -> prepare("delete from transakcije
						   	   where markTransakcije=:markTransakcije and zupa_id in (select zupa_id from zupnici where user_id=:user_id);");
	$izraz -> bindParam(':markTransakcije', $transakcija->markTransakcije);
	$izraz -> bindParam(':user_id', $podaci->userId);
	$izraz -> execute();
	
	
	$markTransakcije = md5($podaci->userId . date("c"));
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
	$automatskiUnos1 = $izraz->fetch(PDO::FETCH_OBJ);
	if(!empty($automatskiUnos1)){//ako ima automatksihUnosa
		$mjesec = date('n',strtotime($_POST["datum"]));
		$godina = date('Y',strtotime($_POST["datum"]));		
		
		$izraz = $veza -> prepare("insert into transakcije(svrha_id,zupa_id,markTransakcije,iznos,datum,napomena) 
							   values(:svrha_id,:zupa_id,:markTransakcije,:iznos,:datum,:napomena);");
		$izraz -> bindValue(":svrha_id", $automatskiUnos1->autoSvrha_id);
		$izraz -> bindValue(":zupa_id", $_POST["zupa_id"]);
		$izraz -> bindValue(":markTransakcije", $markTransakcije);
		$izraz -> bindValue(":iznos", $_POST["iznos"]);
		$izraz -> bindValue(":datum", $_POST["datum"]);
		$izraz -> bindValue(":napomena", $_POST["napomena"]);		
		$izraz -> execute();
		
		//provjeri ima li automatkih unosa nakon prvog automatskog unosa
		$izraz = $veza -> prepare("select * from automatskiUnosi
								   where primSvrha_id=:svrha_id and zupa_id=:zupa_id;");
		$izraz -> bindValue(":svrha_id", $automatskiUnos1->autoSvrha_id);
		$izraz -> bindValue(":zupa_id", $_POST["zupa_id"]);
		$izraz -> execute();	
		$automatskiUnos2 = $izraz->fetch(PDO::FETCH_OBJ);
		if(!empty($automatskiUnos2)){
			$izraz = $veza -> prepare("insert into transakcije(svrha_id,zupa_id,markTransakcije,iznos,datum,napomena) 
								   values(:svrha_id,:zupa_id,:markTransakcije,:iznos,:datum,:napomena);");
			$izraz -> bindValue(":svrha_id", $automatskiUnos2->autoSvrha_id);
			$izraz -> bindValue(":zupa_id", $_POST["zupa_id"]);
			$izraz -> bindValue(":markTransakcije", $markTransakcije);
			$izraz -> bindValue(":iznos", $_POST["iznos"]);
			$izraz -> bindValue(":datum", $_POST["datum"]);
			$izraz -> bindValue(":napomena", $_POST["napomena"]);		
			$izraz -> execute();			
		}		
	}
	
	
}

$datum = explode("-",$_POST["datum"]);

$stranica = ($_POST["hfGrupaId"]==1||$_POST["hfGrupaId"]==3) ? 'crveni' : 'plavi';

header('location: ' . $stranica . '.php?id='. $_POST["zupa_id"] . "&godina=" . $datum[0] . "&mjesec=" . $datum[1]);
