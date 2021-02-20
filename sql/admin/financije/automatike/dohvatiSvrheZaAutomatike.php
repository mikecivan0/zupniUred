<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

$izraz = $veza -> prepare("select s.*,g.nazivGrupe from 
						   svrhe s inner join grupe g on s.grupa_id=g.id 
						   where s.grupa_id in(2,3) and zupa_id is null
						   order by grupa_id desc,s.nazivSvrhe;");
	$izraz -> execute();
	$primSvrhe = $izraz -> fetchAll(PDO::FETCH_OBJ);
	
$izraz = $veza -> prepare("select s.*,g.nazivGrupe from 
						   svrhe s inner join grupe g on s.grupa_id=g.id 
						   where s.grupa_id in(2,4) and zupa_id is null
						   order by grupa_id,s.nazivSvrhe;");
	$izraz -> execute();
	$autoSvrhe = $izraz -> fetchAll(PDO::FETCH_OBJ);
	
if(isset($_GET["id"])){
	$izraz = $veza -> prepare("select primSvrha_id,autoSvrha_id 
							   from automatskiUnosi where id=:id and zupa_id is null;");
	$izraz -> bindParam(":id", $_GET["id"]);
	$izraz -> execute();
	$getAutomatika = $izraz -> fetch(PDO::FETCH_OBJ);
	$primSvrha_id = $getAutomatika->primSvrha_id;
	$autoSvrha_id = $getAutomatika->autoSvrha_id;
}
	
	
	//slaganje optiona za primSvrhe
	$selectPrimSvrhe = "<label>Ručnim unosom ove stavke</label><select name='primSvrha_id' id='primSvrha_id'>";
	foreach ($primSvrhe as $primSvrha) {
		$selectPrimSvrhe .= "<option value='" . $primSvrha->id . "'";
		if(!$_POST&&isset($_GET["id"])){
			$selectPrimSvrhe .= ($primSvrha->id==$primSvrha_id) ? " selected=true" : null;
		}elseif($_POST&&isset($_POST["primSvrha_id"])){
			$selectPrimSvrhe .= ($_POST["primSvrha_id"]==$primSvrha->id) ? " selected=true" : null;
		}
		$selectPrimSvrhe .= ">" . $primSvrha->nazivSvrhe . " - " . $primSvrha->nazivGrupe . "</option>";
	}
	$selectPrimSvrhe .= "</select>";
	
	
	//slaganje optiona za autoSvrhe
	$selectAutoSvrhe = "<label>ova stavka će se automatski unijeti</label><select name='autoSvrha_id' id='autoSvrha_id'>";
	foreach ($autoSvrhe as $autoSvrha) {
		$selectAutoSvrhe .= "<option value='" . $autoSvrha->id . "'";
		if(!$_POST&&isset($_GET["id"])){
			$selectAutoSvrhe .= ($autoSvrha->id==$autoSvrha_id) ? " selected=true" : null;
		}elseif($_POST&&isset($_POST["autoSvrha_id"])){
			$selectAutoSvrhe .= ($_POST["autoSvrha_id"]==$autoSvrha->id) ? " selected=true" : null;
		}
		$selectAutoSvrhe .= ">" . $autoSvrha->nazivSvrhe . " - " . $autoSvrha->nazivGrupe . "</option>";
	}
	$selectAutoSvrhe .= "</select>";
