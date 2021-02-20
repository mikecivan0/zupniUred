<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

if(isset($_GET["id"])){
	$izraz = $veza -> prepare("select z.id as id,zu.id as zupa_id,zu.nazivZupe,zu.adresaUreda,m.nazivMjesta,m.pbr 
	from zupnici z inner join zupe zu on z.zupa_id=zu.id
	inner join mjesta m on zu.mjesto_id=m.id
	where z.user_id=:id;");
	$izraz -> execute($_GET);
	$zupe = $izraz -> fetchAll(PDO::FETCH_OBJ);
}
