<?php


class Izjave{
	
	public static function ConvertPost($tko){
		if($tko==1){
			$_POST["imeIPrezime1"] = $_POST["imeIPrezimeOn"];
			$_POST["imeIPrezime2"] = $_POST["imeIPrezimeOna"];
			$_POST["vjera"] = $_POST["vjeraOstaloOna"];
		}else{
			$_POST["imeIPrezime1"] = $_POST["imeIPrezimeOna"];
			$_POST["imeIPrezime2"] = $_POST["imeIPrezimeOn"];
			$_POST["vjera"] = $_POST["vjeraOstaloOn"];
		}
	}
}