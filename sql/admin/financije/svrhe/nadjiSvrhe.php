<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

$izraz = $veza -> prepare("select s.id,s.nazivSvrhe,s.grupa_id,g.nazivGrupe 
	                 	   from svrhe s inner join grupe g on s.grupa_id=g.id
						   where s.zupa_id is null
	                 	   order by g.id,s.nazivSvrhe;");
	$izraz -> execute();
	$svrhe = $izraz -> fetchAll(PDO::FETCH_OBJ);