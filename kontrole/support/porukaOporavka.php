<?php

$error = empty($_POST["poruka"]) ? 'crveniRub' : null;
if (strlen(trim($_POST["kontakt"]))==0) {
		$g=new stdClass();
		$g->element="kontakt";
		$g->poruka="Obavezno kontakt";
		array_push($greske,$g);
	}