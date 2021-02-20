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
	$izjave = Alati::dodajMM($objDokument,"udaljenosti");
	$mpdf -> SetWatermarkImage('../../img/predlosci/' . basename($_SERVER['PHP_SELF'],'.php') . '.jpg',0.6,array(210,295),array(0,0.3));
	$mpdf -> showWatermarkImage = true;
}else{
	$izjave = Alati::prilagodiUdaljenosti(Alati::obj_ColumnToArrayToObj($objDokument,"udaljenosti"), Alati::obj_ColumnToArrayToObj($printer,"udaljenostiIzjave")); //prilagodi udaljenosti unutar objekta	
}

//zadaj što da kreira
$html = Printanje::polje($izjave -> biskupijaTop, $izjave -> biskupijaLeft, Alati::oduzmiZadnjuRijec($biskupija), 'f','',null) .
		Printanje::polje($izjave -> zupaTop, $izjave -> zupaLeft, $podaciZupe, 'f', Alati::odrediFont($podaciZupe),null) .
		Printanje::polje($izjave -> brojDokumentaTop, $izjave -> brojDokumentaLeft, $_POST["brojDokumenta"], 'broj f w50','',null) .		
		Printanje::polje($izjave -> imeIPrezime1Top, $izjave -> imeIPrezime1Left, $_POST["imeIPrezime1"], 'f w160 sredina','',null) .
		Printanje::polje($izjave -> imeIPrezime2Top, $izjave -> imeIPrezime2Left, $_POST["imeIPrezime2"], 'f w130 sredina','',null) .
		Printanje::polje($izjave -> vjeraTop, $izjave -> vjeraLeft, $_POST["vjera"], 'f w80 sredina','',null) .
		Printanje::polje(Alati::prilagodiVisinu($_POST["mjesto1"], $izjave -> mjestoIDatum1Top,32), $izjave -> mjestoLeft, $_POST["mjesto1"], 'f w60 sredina','float: left;',null) .
		Printanje::polje($izjave -> mjestoIDatum1Top, $izjave -> datumLeft, Alati::datum($_POST["datum1"]), 'f w60','float: left;',null) .
		Printanje::polje(Alati::prilagodiVisinu($_POST["mjesto2"], $izjave -> mjestoIDatum2Top,32), $izjave -> mjestoLeft, $_POST["mjesto2"], 'f w60 sredina','float: left;',null) .
		Printanje::polje($izjave -> mjestoIDatum2Top, $izjave -> datumLeft, Alati::datum($_POST["datum2"]), 'f w60','float: left;',null);
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
