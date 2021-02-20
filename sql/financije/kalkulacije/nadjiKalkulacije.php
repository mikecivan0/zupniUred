<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
	
	
$izraz = $veza -> prepare("select k.id,s.nazivSvrhe,st.nazivStavke,i.nazivIzvjesca,
						   g.nazivGrupe as nazivGrupeStavke,g2.nazivGrupe as nazivGrupeSvrhe
						   from kalkulacije k 
						   inner join svrhe s on k.svrha_id=s.id
						   inner join stavke st on k.stavka_id=st.id
						   inner join izvjesca i on st.izvjesce_id=i.id
						   inner join grupe g on st.grupa_id=g.id
						   inner join grupe g2 on s.grupa_id=g2.id
						   where k.zupa_id=:zupa_id
						   order by i.id,g.id,st.nazivStavke,s.nazivSvrhe;");
	$izraz->bindParam(':zupa_id', $_GET["id"]);
	$izraz -> execute();
	$kalkulacije = $izraz -> fetchAll(PDO::FETCH_OBJ);