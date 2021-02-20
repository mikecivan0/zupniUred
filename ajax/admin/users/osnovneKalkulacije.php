<?php

if (!isset($_POST["id"])) {
	exit ;
}

include_once '../../../config/conf.php';

$zupa_id=$_POST["id"];
$poruka = '';
//provjeri da li postoje svrhe,stavke i kalkulacije
$izraz = $veza -> prepare("select * from stavke where zupa_id=:id;");
		$izraz->bindParam(':id', $zupa_id);
		$izraz -> execute();
		$stavke = $izraz -> fetchAll(PDO::FETCH_OBJ);
		if(!empty($stavke)){//provjeri da li postoje svrhe7
			$poruka = "Župa već ima upisane stavke";
			echo $poruka;
		}else{			
			$izraz = $veza -> prepare("select * from svrhe where zupa_id=:id;");
			$izraz->bindParam(':id', $zupa_id);
			$izraz -> execute();
			$svrhe = $izraz -> fetchAll(PDO::FETCH_OBJ);			
			if(!empty($svrhe)){
				$poruka = "Župa već ima upisane svrhe";
				echo $poruka;
			}
		}
		
		
		
if(strlen($poruka)==0){
//dohvaćanje stavki		
$izraz = $veza -> prepare("select izvjesce_id,grupa_id,nazivStavke,markStavke from stavke where zupa_id is null order by izvjesce_id,grupa_id,id;");
		$izraz -> execute();
		$stavke = $izraz -> fetchAll(PDO::FETCH_OBJ);	
		$nizStavki='';
		
		foreach ($stavke as $stavka) {
			$nizStavki.= "(" . $stavka->izvjesce_id . "," . $stavka->grupa_id . ",'" . $stavka->nazivStavke . "'," . $zupa_id . "," . $stavka->markStavke . "),";
		}
		 $nizStavki = substr($nizStavki, 0, -1);
		 
//unos stavki	 
$sql = "insert into stavke(izvjesce_id,grupa_id,nazivStavke,zupa_id,markStavke) values" . $nizStavki;
$izraz = $veza -> prepare($sql);
		$izraz -> execute();
		
		

//dohvaćanje svrha
$izraz = $veza -> prepare("select grupa_id,nazivSvrhe,markSvrhe from svrhe where zupa_id is null order by grupa_id,nazivSvrhe;");
		$izraz -> execute();
		$svrhe = $izraz -> fetchAll(PDO::FETCH_OBJ);	
		$nizSvrha='';
		
		foreach ($svrhe as $svrha) {
			$nizSvrha.= "(" . $svrha->grupa_id . ",'" . $svrha->nazivSvrhe . "'," . $zupa_id . "," . $svrha->markSvrhe . "),";
		}
		 $nizSvrha = substr($nizSvrha, 0, -1);

//unos svrha	 
$sql = "insert into svrhe(grupa_id,nazivSvrhe,zupa_id,markSvrhe) values" . $nizSvrha . ";";
$izraz = $veza -> prepare($sql);
		$izraz -> execute();
		

//nađi markSvrhe i markStavke osnovnih kalkulacija
$izraz = $veza -> prepare("select s.markSvrhe,st.markStavke from 
						   kalkulacije k inner join svrhe s on k.svrha_id=s.id 
						   inner join stavke st on k.stavka_id=st.id
						   where k.zupa_id is null;");
		$izraz -> execute();
		$marksSvrhaIStavki = $izraz -> fetchAll(PDO::FETCH_OBJ);
		
		foreach ($marksSvrhaIStavki as $markSvrhaIStavki) {//za svaku kalkulaciju
			//dohvati mark stavke i svrhe
			$markStavke = $markSvrhaIStavki->markStavke;
			$markSvrhe = $markSvrhaIStavki->markSvrhe;
			
			//nađi id stavke prema markStavke za određenu župu
			$izraz = $veza -> prepare("select id from stavke where markStavke=:markStavke and zupa_id=:zupa_id;");
			$izraz->bindParam(':markStavke',$markStavke);
			$izraz->bindParam(':zupa_id',$zupa_id);
			$izraz -> execute();
			$stavkaId = $izraz -> fetch(PDO::FETCH_COLUMN);
			
			//nađi id svrhe prema markSvrhe za određenu župu
			$izraz = $veza -> prepare("select id from svrhe where markSvrhe=:markSvrhe and zupa_id=:zupa_id;");
			$izraz->bindParam(':markSvrhe',$markSvrhe);
			$izraz->bindParam(':zupa_id',$zupa_id);
			$izraz -> execute();
			$svrhaId = $izraz -> fetch(PDO::FETCH_COLUMN);
			
			//dodaj novu kalkulaciju prema dobijenim id-evima
			$izraz = $veza -> prepare("insert into kalkulacije(stavka_id,svrha_id,zupa_id) values(:stavka_id,:svrha_id,:zupa_id);");
			$izraz->bindParam(':stavka_id',$stavkaId);
			$izraz->bindParam(':svrha_id',$svrhaId);
			$izraz->bindParam(':zupa_id',$zupa_id);
			$izraz -> execute();			 
		}


//nađi markSvrhe i markStavke osnovnih automatika
$izraz = $veza -> prepare("select sa.markSvrhe as markAutoSvrhe,ps.markSvrhe as markPrimSvrhe from 
						   automatskiUnosi au 
						   inner join svrhe ps on au.primSvrha_id=ps.id 
						   inner join svrhe sa on au.autoSvrha_id=sa.id 
						   where au.zupa_id is null;");
		$izraz -> execute();
		$marksSvrhaIStavkiAutomatskogUnosa = $izraz -> fetchAll(PDO::FETCH_OBJ);
		
		foreach ($marksSvrhaIStavkiAutomatskogUnosa as $markSvrhaIStavkiAutomatskogUnosa) {//za svaku kalkulaciju
			//dohvati mark autoSvrhe i primSvrhe
			$markPrimSvrhe = $markSvrhaIStavkiAutomatskogUnosa->markPrimSvrhe;
			$markAutoSvrhe = $markSvrhaIStavkiAutomatskogUnosa->markAutoSvrhe;
		
			//nađi id primSvrhe prema markSvrhe za određenu župu
			$izraz = $veza -> prepare("select id from svrhe where markSvrhe=:markSvrhe and zupa_id=:zupa_id;");
			$izraz->bindParam(':markSvrhe',$markPrimSvrhe);
			$izraz->bindParam(':zupa_id',$zupa_id);
			$izraz -> execute();
			$primSvrhaId = $izraz -> fetch(PDO::FETCH_COLUMN);
			
			//nađi id autoSvrhe prema markSvrhe za određenu župu
			$izraz = $veza -> prepare("select id from svrhe where markSvrhe=:markSvrhe and zupa_id=:zupa_id;");
			$izraz->bindParam(':markSvrhe',$markAutoSvrhe);
			$izraz->bindParam(':zupa_id',$zupa_id);
			$izraz -> execute();
			$autoSvrhaId = $izraz -> fetch(PDO::FETCH_COLUMN);
			
			//dodaj novu kalkulaciju prema dobijenim id-evima
			$izraz = $veza -> prepare("insert into automatskiUnosi(primSvrha_id,autoSvrha_id,zupa_id) values(:primSvrha_id,:autoSvrha_id,:zupa_id);");
			$izraz->bindParam(':primSvrha_id',$primSvrhaId);
			$izraz->bindParam(':autoSvrha_id',$autoSvrhaId);
			$izraz->bindParam(':zupa_id',$zupa_id);
			$izraz -> execute();			 
		}
		echo "Osnovne kalkulacije su učitane";
}