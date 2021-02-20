<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
	$izraz = $veza -> prepare("update automatskiUnosi set autoSvrha_id=:autoSvrha_id,primSvrha_id=:primSvrha_id 
							   where id=:id and zupa_id is null;");
	$izraz -> execute($_POST);
	
	header ('location:' . $putanjaApp . 'admin/financije/automatike/automatike.php');
	
