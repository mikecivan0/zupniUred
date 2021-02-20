<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}

	$izraz = $veza -> prepare("update poruke set procitano=1 where id=:id and procitano=0");
	$izraz -> bindParam(':id', $_GET["poruka"]);
	$izraz -> execute();
	
