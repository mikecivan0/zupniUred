<?php

$error = empty($_POST["poruka"]) ? 'crveniRub' : null;

if (trim(strlen($_POST["primatelj"]))==0) {
		$g=new stdClass();
		$g->element="primatelj";
		$g->poruka="Obavezno primatelj";
		array_push($greske,$g);
	}