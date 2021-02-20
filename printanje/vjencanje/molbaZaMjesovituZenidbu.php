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
	$molbaZaMZ = Alati::dodajMM($objDokument,"udaljenosti");
	$mpdf -> SetWatermarkImage('../../img/predlosci/' . basename($_SERVER['PHP_SELF'],'.php') . '.jpg',0.6,array(210,296),array(0.8,0.6));
	$mpdf -> showWatermarkImage = true;
}else{
	$molbaZaMZ = Alati::prilagodiUdaljenosti(Alati::obj_ColumnToArrayToObj($objDokument,"udaljenosti"), Alati::obj_ColumnToArrayToObj($printer,"udaljenostiMolbaZaMjesovituZenidbu")); //prilagodi udaljenosti unutar objekta	
}

//zadaj što da kreira
$html = Printanje::polje($molbaZaMZ -> biskupijaTop, $molbaZaMZ -> biskupijaLeft, Alati::oduzmiZadnjuRijec($biskupija), 'f','',null) .
		Printanje::polje($molbaZaMZ -> zupaTop, $molbaZaMZ -> zupaLeft, $podaciZupe, 'f', Alati::odrediFont($podaciZupe),null) .
		Printanje::polje($molbaZaMZ -> brojDokumentaTop, $molbaZaMZ -> brojDokumentaLeft, $_POST["brojDokumenta"], 'broj f w50','',null) .		
		Printanje::polje($molbaZaMZ -> ordinarijatTop, $molbaZaMZ -> ordinarijatLeft, $_POST["ordinarijat"], 'f w75 sredina','',null) .
		Printanje::polje($molbaZaMZ -> onTop, $molbaZaMZ -> imeIPrezimeLeft, $_POST["imeIPrezimeOn"], 'f w80 sredina','float: left;',null) .
		Printanje::polje($molbaZaMZ -> onTop, $molbaZaMZ -> vjeraLeft, $_POST["vjeraOn"], 'f w60 sredina','float: left;',null) .
		Printanje::polje($molbaZaMZ -> onaTop, $molbaZaMZ -> imeIPrezimeLeft, $_POST["imeIPrezimeOna"], 'f w80 sredina','float: left;',null) .
		Printanje::polje($molbaZaMZ -> onaTop, $molbaZaMZ -> vjeraLeft, $_POST["vjeraOna"], 'f w60 sredina','float: left;',null) .
		Printanje::polje($molbaZaMZ -> razlogTop, $molbaZaMZ -> razlogLeft, $_POST["razlog"], 'f w160 lh9','',null) .		
		Printanje::polje($molbaZaMZ -> datumTop, $molbaZaMZ -> datumLeft, Alati::datum($_POST["datum"]), 'broj f','',null);
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
