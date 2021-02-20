<?php


class IzjavaRoditelja{
	
	public static function ConvertPost($tko){
		if($tko==1){
			$_POST["otac"] = $_POST["otacOn"];
			$_POST["majka"] = $_POST["majkaOn"];
			$_POST["adresa"] = $_POST["mjestoOn"] . ", " . $_POST["ulicaOn"] . " " . $_POST["kBrOn"];
			$_POST["spol"] = 1;
			$_POST["dijete"] = $_POST["imeIPrezimeOn"];
			$_POST["zarucnik"] = $_POST["imeIPrezimeOna"];
			$_POST["nastanjenMjesto"] = $_POST["mjestoOna"];	
			$_POST["ulica"] = $_POST["ulicaOna"];
			$_POST["broj"] = $_POST["kBrOna"];
		}else{
			$_POST["otac"] = $_POST["otacOna"];
			$_POST["majka"] = $_POST["majkaOna"];
			$_POST["adresa"] = $_POST["mjestoOna"] . ", " . $_POST["ulicaOna"] . " " . $_POST["kBrOna"];
			$_POST["spol"] = 0;
			$_POST["dijete"] = $_POST["imeIPrezimeOna"];
			$_POST["zarucnik"] = $_POST["imeIPrezimeOn"];
			$_POST["nastanjenMjesto"] = $_POST["mjestoOn"];	
			$_POST["ulica"] = $_POST["ulicaOn"];
			$_POST["broj"] = $_POST["kBrOn"];
		}
	}
}