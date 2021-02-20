<?php
include_once '../../config/conf.php';
include_once '../../kontrole/dozvola.php';
include_once '../../sql/printanje/nadjiZupu.php'; //kreiraj objekt $zupa
include_once '../../sql/admin/udaljenosti/osnovno/nadjiUdaljenosti.php'; //kreiraj $objDokument sa podacima udaljenosti
include_once '../../sql/admin/printeri/nadjiPrinter.php'; //kreiraj objekt $printer
include_once '../../alati/Alati.php';
include_once '../../alati/Printanje.php';
//obj_ColumnToArrayToObj($objDokument,"udaljenosti"); //napravi objekt od dobivenih podataka iz stringa $objDokument>udaljenosti
//obj_ColumnToArrayToObj($zupa,"udaljenostiKrsniList"); //napravi objekt od dobivenih podataka iz stringa $printer->udaljenostiKrsniList

//uključi alat za kreiranje pdf-a
include_once '../../alati/mpdf/mpdf.php';
//kreiraj istancu objekta
$mpdf=new mPDF('utf8','A4',12,'Arial',20,20,25.4,28,25.4,28);

//ako treba preview tada se učitavaju položaji polja samo iz tablice dokumenti, a ako treba printati onda se zbrajaju i vrijednosti za odabrani printer
if($_GET["preview"]){
	$izjavaRoditelja = Alati::dodajMM($objDokument,"udaljenosti");
	$mpdf -> SetWatermarkImage('../../img/predlosci/' . basename($_SERVER['PHP_SELF'],'.php') . '.jpg',0.6,array(210,296),array(1.2,0.4));
	$mpdf -> showWatermarkImage = true;
}else{
	$izjavaRoditelja = Alati::prilagodiUdaljenosti(Alati::obj_ColumnToArrayToObj($objDokument,"udaljenosti"), Alati::obj_ColumnToArrayToObj($printer,"udaljenostiIzjavaRoditelja")); //prilagodi udaljenosti unutar objekta	
}

//kako je spolLeft promjenjiv ovisno o dobijenoj vrijednosti treba ga posebno obraditi
$spolLeft = ($_POST["spol"]==0) ? $izjavaRoditelja -> spolLeftZ : $izjavaRoditelja -> spolLeftM;
$nastanjenLeft = ($_POST["spol"]==0) ? $izjavaRoditelja -> nastanjenLeftZ : $izjavaRoditelja -> nastanjenLeftM;



//zadaj što da kreira
$html = Printanje::polje($izjavaRoditelja -> biskupijaTop, $izjavaRoditelja -> biskupijaLeft, Alati::oduzmiZadnjuRijec($biskupija), 'f','',null) .
		Printanje::polje($izjavaRoditelja -> zupaTop, $izjavaRoditelja -> zupaLeft, $podaciZupe, 'f', Alati::odrediFont($podaciZupe),null) .
		Printanje::polje($izjavaRoditelja -> brojDokumentaTop, $izjavaRoditelja -> brojDokumentaLeft, $_POST["brojDokumenta"], 'broj f w50','',null) .
		Printanje::polje($izjavaRoditelja -> otacTop, $izjavaRoditelja -> otacLeft, $_POST["otac"], 'f w155 sredina','',null) .
		Printanje::polje($izjavaRoditelja -> majkaTop, $izjavaRoditelja -> left, $_POST["majka"], 'f w170 sredina','',null) .
		Printanje::polje($izjavaRoditelja -> adresaTop, $izjavaRoditelja -> left, $_POST["adresa"], 'f w170 sredina','',null) .
		Printanje::polje($izjavaRoditelja -> spolTop, $spolLeft, '________', 'f w17','float: left;',null) .
		Printanje::polje($izjavaRoditelja -> dijeteTop, $izjavaRoditelja -> dijeteLeft, $_POST["dijete"], 'f w90 sredina','float: left;',null) .
		Printanje::polje($izjavaRoditelja -> zarucnikTop, $izjavaRoditelja -> zarucnikLeft, $_POST["zarucnik"], 'f w150 sredina','',null) .
		Printanje::polje($izjavaRoditelja -> nastanjenSpolTop, $nastanjenLeft, '__________', 'f w20','',null) .
		Printanje::polje($izjavaRoditelja -> nastanjenTop, $izjavaRoditelja -> nastanjenMjestoLeft, $_POST["nastanjenMjesto"], 'f w130 sredina','',null) .
		Printanje::polje($izjavaRoditelja -> ulicaTop, $izjavaRoditelja -> ulicaLeft, $_POST["ulica"], 'f w120 sredina','',null) .
		Printanje::polje($izjavaRoditelja -> ulicaTop, $izjavaRoditelja -> brojLeft, $_POST["broj"], 'f w35 sredina','',null) .	
		Printanje::polje($izjavaRoditelja -> odobravanjeTop, $izjavaRoditelja -> left, $_POST["odobravanje"], 'f w170 lh9','',null) .		
		Printanje::polje($izjavaRoditelja -> mjestoDatumTop, $izjavaRoditelja -> mjestoLeft, $_POST["mjesto"], 'f w75 sredina','float: left;',null) .		
		Printanje::polje($izjavaRoditelja -> mjestoDatumTop, $izjavaRoditelja -> datumLeft, Alati::datum($_POST["datum"]), 'f w80 sredina','float: left;',null);
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
