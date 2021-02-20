<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}


if ($title == 'Promjena transakcije') { //ovo je kod promjene transakcije
	
	$izraz = $veza -> prepare("select s.*,g.nazivGrupe from svrhe s
							   inner join grupe g on s.grupa_id=g.id
							   where s.zupa_id=:zupa_id and s.grupa_id in (1,3) order by g.id,s.nazivSvrhe");
	$izraz -> bindParam(':zupa_id', $zupa_id);	
	$izraz -> execute();
	$svrhe = $izraz -> fetchAll(PDO::FETCH_OBJ);
	
	$select = "<label>Stavka</label><select name='svrha_id' id='svrha_id'>";
	foreach ($svrhe as $svrha) {
		$select .= "<option value='" . $svrha -> id . "'";
		$select .= ($svrha->id==$svrha_id) ? "selected='selected'" : null;
		$select .= ">" . $svrha -> nazivSvrhe . " - " . $svrha -> nazivGrupe . "</option>";
	}
	$select .= "</select>";
	
} else { //ovo je za unos nove transakcije
	
	$izraz = $veza -> prepare("select s.*,g.nazivGrupe from svrhe s
							   inner join grupe g on s.grupa_id=g.id
							   where s.zupa_id=:id and s.grupa_id in (1,3) order by g.id,s.nazivSvrhe");
	$izraz -> bindParam(':id', $_GET["id"]);
	$izraz -> execute();
	$svrhe = $izraz -> fetchAll(PDO::FETCH_OBJ);
	
	$select = "<label>Stavka</label><select name='svrha_id' id='svrha_id'>";
	foreach ($svrhe as $svrha) {
		$select .= "<option value='" . $svrha -> id . "'>" . $svrha -> nazivSvrhe . " - " . $svrha -> nazivGrupe . "</option>";
	}
	$select .= "</select>";
	
}
