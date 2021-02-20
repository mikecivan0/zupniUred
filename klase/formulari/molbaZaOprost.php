<?php


class MolbaZaOprost{
	
	public static function ConvertPost($tko){
		if($tko==1){
			$_POST["imeIPrezimeKatolik"] = $_POST["imeIPrezimeOn"];
			$_POST["imeIPrezimeNekatolik"] = $_POST["imeIPrezimeOna"];
		}else{
			$_POST["imeIPrezimeKatolik"] = $_POST["imeIPrezimeOna"];
			$_POST["imeIPrezimeNekatolik"] = $_POST["imeIPrezimeOn"];
		}
	}
}