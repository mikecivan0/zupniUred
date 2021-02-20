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

//ako treba preview tada se učitavaju položaji polja samo iz tablice dokumenti, a ako treba printati onda se zbrajaju i vrijednosti za odabrani printer
if($_GET["preview"]){
	$mpdf=new mPDF('utf8',array(205,139),12,'Arial',0,0,0,0,0,0);		
	$posvjedocenje = Alati::dodajMM($objDokument,"udaljenosti");
	$mpdf -> SetWatermarkImage('../../img/predlosci/' . basename($_SERVER['PHP_SELF'],'.php') . '.jpg',0.6,array(205,139),array(1.1,0.5));
	$mpdf -> showWatermarkImage = true;
}else{
	$mpdf=new mPDF('utf8','A4',12,'Arial',0,0,0,0,0,0);
	$posvjedocenje = Alati::prilagodiUdaljenosti(Alati::obj_ColumnToArrayToObj($objDokument,"udaljenosti"), Alati::obj_ColumnToArrayToObj($printer,"udaljenostiPosvjedocenje")); //prilagodi udaljenosti unutar objekta	
}

//kako je spolLeft promjenjiv ovisno o dobijenoj vrijednosti treba ga posebno obraditi
$html = '';
$spolLeft = ($_POST["spol"]==0) ? $posvjedocenje -> spolZLeft : $posvjedocenje -> spolMLeft;
if($_POST["spol"]==1){
	$html .= Printanje::polje($posvjedocenje -> rodKrsKrizTop, $posvjedocenje -> rodjKrizLeft, 'x', 'f','float: left;',null) .
			 Printanje::polje($posvjedocenje -> rodKrsKrizTop, $posvjedocenje -> krstKrizLeft, 'x', 'f','float: left;',null) .
			 Printanje::polje($posvjedocenje -> potvVjenKrizTop, $posvjedocenje -> potvKrizLeft, 'x', 'f','float: left;',null) .
			 Printanje::polje($posvjedocenje -> potvVjenKrizTop, $posvjedocenje -> vjenKrizLeft, 'x', 'f','float: left;',null);
}


//zadaj što da kreira
$html .= Printanje::polje($posvjedocenje -> biskupijaTop, $posvjedocenje -> biskupijaLeft, Alati::oduzmiZadnjuRijec($biskupija), 'f','',null) .
		Printanje::polje($posvjedocenje -> zupaTop, $posvjedocenje -> zupaLeft, $podaciZupe, 'f', Alati::odrediFont($podaciZupe),null) .
		Printanje::polje($posvjedocenje -> brojDokumentaTop, $posvjedocenje -> brojDokumentaLeft, $_POST["brojDokumenta"], 'broj f w50','',null) .
		Printanje::polje($posvjedocenje -> imePrezimeTop, $posvjedocenje -> imePrezimeLeft, $_POST["imePrezime"], 'f w130 sredina','',70) .
		Printanje::polje(Alati::prilagodiVisinu($_POST["rodjen"], $posvjedocenje -> rodjenKrstenTop,40), $posvjedocenje -> rodjenLeft, $_POST["rodjen"], 'f w70 sredina','float:left',40) .
		Printanje::polje(Alati::prilagodiVisinu($_POST["krsten"], $posvjedocenje -> rodjenKrstenTop,40), $posvjedocenje -> krstenLeft, $_POST["krsten"], 'f w70 sredina','float:left',40) .		
		Printanje::polje($posvjedocenje -> potvrdjenVjencanTop, $posvjedocenje -> potvrdjenLeft, $_POST["datumPotvrde"], 'f w60 sredina','float:left',null) .
		Printanje::polje($posvjedocenje -> potvrdjenVjencanTop, $posvjedocenje -> vjencanLeft, $_POST["datumVjencanja"], 'f w60 sredina','float:left',null) .
		Printanje::polje($posvjedocenje -> spolTop, $spolLeft, '_______', 'f w20','',null) .
		Printanje::polje(Alati::prilagodiVisinu($_POST["mjesto"], $posvjedocenje -> mjestoDatumTop,40), $posvjedocenje -> mjestoLeft, $_POST["mjesto"], 'f w70 sredina','float:left',40) .		
		Printanje::polje($posvjedocenje -> mjestoDatumTop, $posvjedocenje -> datumLeft, Alati::datum($_POST["datum"]), 'broj f w80 sredina','float:left',null);
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
