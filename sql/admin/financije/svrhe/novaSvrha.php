<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

if(isset($_POST)){
	//dohvati zadnji markSvrhe uvećan za 1

	$izraz = $veza -> prepare("select markSvrhe+1 from svrhe where zupa_id is null order by markSvrhe desc limit 1;");	
	$izraz -> execute();
	$markSvrhe = $izraz->fetch(PDO::FETCH_COLUMN);
	
	$izraz = $veza -> prepare("insert into svrhe(nazivSvrhe,grupa_id,markSvrhe) values(:svrha,:grupa_id,:markSvrhe)");
	$izraz->bindParam(':svrha', $_POST["svrha"]);
	$izraz->bindParam(':grupa_id', $_POST["grupa_id"]);
	$izraz->bindParam(':markSvrhe', $markSvrhe);
	$izraz -> execute();
	header ('location:' . $putanjaApp . 'admin/financije/svrhe/svrhe.php');
}
