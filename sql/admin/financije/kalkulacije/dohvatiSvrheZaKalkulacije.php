<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

$izraz = $veza -> prepare("select s.nazivSvrhe,g.nazivGrupe,s.id
						   from svrhe s inner join grupe g on s.grupa_id=g.id
						   where s.zupa_id is null
						   order by g.id,s.nazivSvrhe;");
	$izraz -> execute();
	$svrhe = $izraz -> fetchAll(PDO::FETCH_OBJ);
	
if(isset($_GET["id"])){
	$izraz = $veza -> prepare("select svrha_id from kalkulacije where id=:id and zupa_id is null;");
	$izraz -> bindParam(":id", $_GET["id"]);
	$izraz -> execute();
	$getSvrha= $izraz -> fetch(PDO::FETCH_OBJ);
}
	
	$selectSvrhe = "<label>Stavka dnevnika</label><select name='svrha_id' id='svrha_id'>";
	foreach ($svrhe as $svrha) {
		$selectSvrhe .= "<option value='" . $svrha->id . "'";
		if(!$_POST&&isset($_GET["id"])){
			$selectSvrhe .= ($svrha->id==$getSvrha->svrha_id) ? " selected=true" : null;
		}elseif($_POST&&isset($_POST["grupa_id"])){
			$selectSvrhe .= ($_POST["grupa_id"]==$svrha->id) ? " selected=true" : null;
		}
		$selectSvrhe .= ">" . $svrha->nazivSvrhe . " - " . $svrha->nazivGrupe . "</option>";
	}
	$selectSvrhe .= "</select>";
