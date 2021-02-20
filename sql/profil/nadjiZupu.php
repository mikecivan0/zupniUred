<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

$izraz = $veza -> prepare("select * from zupe z left join printeri p on z.printer_id=p.id
						   inner join mjesta m on z.mjesto_id=m.id
						   where z.id=:id");
	$izraz -> execute($_GET);
	$zupa = $izraz -> fetch(PDO::FETCH_OBJ);