<?php 
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}


	if (trim(strlen($_POST["stavka"]))==0) {
		$g=new stdClass();
		$g->element="stavka";
		$g->poruka="Obavezan naziv stavke";
		array_push($greske,$g);
	}
	
	if ($_POST["izvjesce_id"]==1) {
		if($_POST["grupa_id"]==1||$_POST["grupa_id"]==3){
			$g=new stdClass();
			$g->element="stavka";
			$g->poruka="U kvartalnom izvješću možete odabrati samo grupe 'Primitak B-1' i 'Izdatak D-1'.";
			array_push($greske,$g);
		}		
	}
	
	if(empty($greske)){
		$izraz = $veza -> prepare("select * from stavke where nazivStavke=:stavka and grupa_id=:grupa_id and izvjesce_id=:izvjesce_id
								   and zupa_id=:id;");
		$izraz->bindParam(':stavka',$_POST["stavka"]);
		$izraz->bindParam(':grupa_id',$_POST["grupa_id"]);
		$izraz->bindParam(':izvjesce_id',$_POST["izvjesce_id"]);
		$izraz->bindParam(':id',$_GET["id"]);
		$izraz -> execute();
		$stavka = $izraz -> fetch(PDO::FETCH_OBJ);
		
		if(!empty($stavka)){
			$g=new stdClass();
			$g->element="stavka";
			$g->poruka="Stavka sa tim nazivom, u tom izvješću i u toj grupi već postoji.";
			array_push($greske,$g);
			}
	}

	