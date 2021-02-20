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

//ako treba preview tada se učitavaju položaji polja samo iz tablice dokumenti, a ako treba printati onda se zbrajaju i vrijednosti za odabrani printer
if($_GET["preview"]){
	$mpdf=new mPDF('utf8',array(206,137),12,'Arial',0,0,0,0,0,0);	
	$potvrdnica = Alati::dodajMM($objDokument,"udaljenosti");
	$mpdf -> SetWatermarkImage('../../img/predlosci/' . basename($_SERVER['PHP_SELF'],'.php') . '.jpg',0.6,array(206,137),array(1,0.7));
	$mpdf -> showWatermarkImage = true;
}else{
	$mpdf=new mPDF('utf8','A4',12,'Arial',0,0,0,0,0,0);	
	$potvrdnica = Alati::prilagodiUdaljenosti(Alati::obj_ColumnToArrayToObj($objDokument,"udaljenosti"), Alati::obj_ColumnToArrayToObj($printer,"udaljenostiPotvrdnica")); //prilagodi udaljenosti unutar objekta	
}

//kako je spolLeft promjenjiv ovisno o dobijenoj vrijednosti treba ga posebno obraditi
$spolLeft = ($_POST["spol"]==0) ? $potvrdnica -> spolZLeft : $potvrdnica -> spolMLeft;
$html = '';
if($_POST["spol"]==1){
	$html .= Printanje::polje($potvrdnica -> rodKrsKrizTop, $potvrdnica -> rodjKrizLeft, 'x', 'f','float: left;',null) .
			 Printanje::polje($potvrdnica -> rodKrsKrizTop, $potvrdnica -> krstKrizLeft, 'x', 'f','float: left;',null) .
			 Printanje::polje($potvrdnica -> pricPotvKrizTop, $potvrdnica -> pricKrizLeft, 'x', 'f','float: left;',null) .
			 Printanje::polje($potvrdnica -> pricPotvKrizTop, $potvrdnica -> potvKrizLeft, 'x', 'f','float: left;',null) .
			 Printanje::polje($potvrdnica -> vjenKrizTop, $potvrdnica -> vjenKrizLeft, 'x', 'f','float: left;',null);
}


//zadaj što da kreira
$html .= Printanje::polje($potvrdnica -> biskupijaTop, $potvrdnica -> biskupijaLeft, Alati::oduzmiZadnjuRijec($biskupija), 'f','',null) .
		Printanje::polje($potvrdnica -> zupaTop, $potvrdnica -> zupaLeft, $podaciZupe, 'f', Alati::odrediFont($podaciZupe),null) .
		Printanje::polje($potvrdnica -> brojDokumentaTop, $potvrdnica -> brojDokumentaLeft, $_POST["brojDokumenta"], 'broj f w50','',null) .
		Printanje::polje($potvrdnica -> imePrezimeTop, $potvrdnica -> imePrezimeLeft, $_POST["imePrezime"], 'f w130 sredina','',70) .	
		Printanje::polje($potvrdnica -> spolTop, $spolLeft, '__', 'f w5','float:left',null) .			
		Printanje::polje($potvrdnica -> roditeljiTop, $potvrdnica -> otacLeft, $_POST["otac"], 'f w70 sredina','',40) .		
		Printanje::polje($potvrdnica -> roditeljiTop, $potvrdnica -> majkaLeft, $_POST["majka"], 'f w90 sredina','',50) .		
		Printanje::polje(Alati::prilagodiVisinu($_POST["rodjen"], $potvrdnica -> rodjenKrstenTop,40), $potvrdnica -> rodjenLeft, $_POST["rodjen"], 'f w70 sredina','float:left',40) .
		Printanje::polje(Alati::prilagodiVisinu($_POST["krsten"], $potvrdnica -> rodjenKrstenTop,40), $potvrdnica -> krstenLeft, $_POST["krsten"], 'f w70 sredina','float:left',40) .
		Printanje::polje($potvrdnica -> pricescenPotvrdjenTop, $potvrdnica -> pricescenLeft, $_POST["datumPricesti"], 'f w60 sredina','float:left',null) .
		Printanje::polje($potvrdnica -> pricescenPotvrdjenTop, $potvrdnica -> potvrdjenLeft, $_POST["datumPotvrde"], 'f w60 sredina','float:left',null) .
		Printanje::polje($potvrdnica -> vjencanTop, $potvrdnica -> vjencanLeft, $_POST["datumVjencanja"], 'f w50 sredina','float:left',null) .
		Printanje::polje(Alati::prilagodiVisinu($_POST["mjesto"], $potvrdnica -> mjestoDatumTop,40), $potvrdnica -> mjestoLeft, $_POST["mjesto"], 'f w70 sredina','float:left',40) .		
		Printanje::polje($potvrdnica -> mjestoDatumTop, $potvrdnica -> datumLeft, Alati::datum($_POST["datum"]), 'broj f w80 sredina','float:left',null);
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;