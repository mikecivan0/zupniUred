<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

if(isset($_POST)){	
	$izraz = $veza -> prepare("select * from zupnici where zupa_id=:id and user_id=:user_id;");
	$izraz->bindParam(':id', $_GET["zupa_id"]);
	$izraz->bindParam(':user_id', $podaci->userId);
	$izraz -> execute();
	$ima = $izraz -> fetch(PDO::FETCH_OBJ);
	
	if(!empty($ima)){		
		//dohvati zadnji markSvrhe uvećan za 1
		$izraz = $veza -> prepare("select markSvrhe+1 from svrhe where zupa_id=:zupa_id order by markSvrhe desc limit 1;");
		$izraz->bindParam(':zupa_id', $_GET["zupa_id"]);			
		$izraz -> execute();
		$markSvrhe = $izraz->fetch(PDO::FETCH_COLUMN);
		
		//unos nove svrhe
		$izraz = $veza -> prepare("insert into svrhe(nazivSvrhe,grupa_id,markSvrhe,zupa_id) values(:svrha,:grupa_id,:markSvrhe,:zupa_id);");
		$izraz->bindParam(':svrha', $_POST["svrha"]);
		$izraz->bindParam(':grupa_id', $_POST["grupa_id"]);
		$izraz->bindParam(':markSvrhe', $markSvrhe);
		$izraz->bindParam(':zupa_id', $_GET["zupa_id"]);		
		$izraz -> execute();
	}
	header ('location:' . $putanjaApp . 'financije/svrhe/svrhe.php?id=' . $_GET["zupa_id"]);
}
