<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

if(isset($_POST)){
	$izraz = $veza -> prepare("select * from zupnici where zupa_id=:id and user_id=:user_id");
	$izraz->bindParam(':id', $_GET["zupa_id"]);
	$izraz->bindParam(':user_id', $podaci->userId);
	$izraz -> execute();
	$ima = $izraz -> fetch(PDO::FETCH_OBJ);
	
	if(!empty($ima)){
		$izraz = $veza -> prepare("update svrhe set nazivSvrhe=:svrha,grupa_id=:grupa_id where id=:id");
		$izraz->bindParam(':svrha', $_POST["svrha"]);
		$izraz->bindParam(':grupa_id', $_POST["grupa_id"]);
		$izraz->bindParam(':id',  $_GET["id"]);
		$izraz -> execute();
	}
	header ('location:' . $putanjaApp . 'financije/svrhe/svrhe.php?id=' . $_GET["zupa_id"]);
}



	
