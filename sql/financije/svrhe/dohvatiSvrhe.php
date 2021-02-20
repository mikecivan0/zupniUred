<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}
	
	$izraz = $veza -> prepare("select s.*,g.nazivGrupe from svrhe s
							   inner join grupe g on s.grupa_id=g.id
							   where s.zupa_id=:zupa_id order by g.id,s.nazivSvrhe;");
	$izraz -> bindParam(':zupa_id', $_GET["id"]);
	$izraz -> execute();
	$svrhe = $izraz -> fetchAll(PDO::FETCH_OBJ);
	