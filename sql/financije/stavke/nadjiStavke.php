<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

$izraz = $veza -> prepare("select s.id,s.nazivStavke,g.nazivGrupe,i.nazivIzvjesca
	                 	   from stavke s inner join grupe g on s.grupa_id=g.id
	                 	   inner join izvjesca i on s.izvjesce_id=i.id
						   where s.zupa_id=:zupa_id
	                 	   order by s.izvjesce_id,s.grupa_id,s.nazivStavke;");
	$izraz->bindParam(':zupa_id', $_GET["id"]);
	$izraz -> execute();
	$stavke = $izraz -> fetchAll(PDO::FETCH_OBJ);