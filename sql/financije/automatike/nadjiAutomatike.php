<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

$izraz = $veza -> prepare("select au.id, sp.nazivSvrhe as primSvrhaNaziv, gp.nazivGrupe as primGrupaNaziv, 
	   					   				 sa.nazivSvrhe as autoSvrhaNaziv, ga.nazivGrupe as autoGrupaNaziv   
						   from automatskiUnosi au 
						   inner join svrhe sp on au.primSvrha_id=sp.id 
						   inner join svrhe sa on au.autoSvrha_id=sa.id
						   inner join grupe gp on sp.grupa_id=gp.id
						   inner join grupe ga on sa.grupa_id=ga.id
						   where au.zupa_id=:id
						   order by sp.grupa_id desc, primSvrhaNaziv, autoSvrhaNaziv;");
	$izraz -> execute($_GET);
	$automatike = $izraz -> fetchAll(PDO::FETCH_OBJ);