<?php


class MolbaZaMjesovituZenidbu{
	
	public static function ConvertPost($tko){
		if($tko==1){
			$_POST["vjeraOn"] = 'rkt.';
			$_POST["vjeraOna"] = $_POST["vjeraOstaloOna"];
		}else{
			$_POST["vjeraOna"] = 'rkt.';
			$_POST["vjeraOn"] = $_POST["vjeraOstaloOn"];
		}
	}
}