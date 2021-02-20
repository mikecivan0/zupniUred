<?php
include_once '../../config/conf.php';
include_once '../../kontrole/dozvola.php';
include_once '../../sql/printanje/nadjiZupu.php'; //kreiraj objekt $zupa
include_once '../../sql/admin/udaljenosti/osnovno/nadjiUdaljenosti.php';
//kreiraj $objDokument sa podacima udaljenosti
include_once '../../sql/admin/printeri/nadjiPrinter.php';
//kreiraj objekt $printer
include_once '../../alati/Printanje.php';
include_once '../../alati/Alati.php';
//obj_ColumnToArrayToObj($objDokument,"udaljenosti"); //napravi objekt od dobivenih podataka iz stringa $objDokument>udaljenosti
//obj_ColumnToArrayToObj($zupa,"udaljenosti*"); //napravi objekt od dobivenih podataka iz stringa $zupa->udaljenosti*

//uključi alat za kreiranje pdf-a
include_once '../../alati/mpdf/mpdf.php';

//ako treba preview tada se učitavaju položaji polja samo iz tablice dokumenti, a ako treba printati onda se zbrajaju i vrijednosti za odabrani printer
if($_GET["preview"]){
	$mpdf=new mPDF('utf8',array(205,137),12,'Arial',0,0,0,0,0,0);		
	$pristupnica = Alati::dodajMM($objDokument,"udaljenosti");
	$mpdf -> SetWatermarkImage('../../img/predlosci/' . basename($_SERVER['PHP_SELF'],'.php') . 'Str' . $_GET["stranica"] . '.jpg',0.6,array(205,137),array(1.1,0.5));
	$mpdf -> showWatermarkImage = true;
}else{
	$mpdf=new mPDF('utf8','A4',12,'Arial',0,0,0,0,0,0);
	$pristupnica = Alati::prilagodiUdaljenosti(Alati::obj_ColumnToArrayToObj($objDokument,"udaljenosti"), Alati::obj_ColumnToArrayToObj($printer,"udaljenostiPristupnica")); //prilagodi udaljenosti unutar objekta	
}


//zadaj što da kreira
switch ($_GET["stranica"]) {
	case '1' :
		$html = Printanje::polje($pristupnica -> potvrdjenikTop, $pristupnica -> pristupnicaLeft, $_POST['potvrdjenik'], 'f w105 sredina','',55) . 
				Printanje::polje($pristupnica -> roditeljTop, $pristupnica -> pristupnicaLeft, $_POST['roditelj'], 'f w105 sredina','',55) . 
				Printanje::polje($pristupnica -> rodjenjeTop, $pristupnica -> pristupnicaLeft, $_POST['rodjenje'], 'f w105 sredina','',55) . 
				Printanje::polje(Alati::prilagodiVisinu($_POST["krstenje"], $pristupnica -> krstenjeTop,55), $pristupnica -> pristupnicaLeft, $_POST['krstenje'], 'f w105 sredina','',55) . 
				Printanje::polje($pristupnica -> maticaTop, $pristupnica -> svezLeft, $_POST['svez'], 'f w30 sredina','float:left',55) . 
				Printanje::polje($pristupnica -> maticaTop, $pristupnica -> strLeft, $_POST['str'], 'f w25 sredina','float:left',55) . 
				Printanje::polje($pristupnica -> maticaTop, $pristupnica -> brLeft, $_POST['br'], 'f w25 sredina','float:left',55) . 
				Printanje::polje($pristupnica -> adresaTop, $pristupnica -> pristupnicaLeft, $_POST['adresa'], 'f w105 sredina','',55) . 
				Printanje::polje($pristupnica -> kumTop, $pristupnica -> pristupnicaLeft, $_POST['kum'], 'f w105 sredina','',55) . 		
				Printanje::polje(Alati::prilagodiVisinu($_POST["mjestoIDatum"], $pristupnica -> mjestoIDatumTop,30),$pristupnica -> mjestoIDatumLeft,$_POST["mjestoIDatum"], 'f w50 sredina','',30);
		break;

	case '2' :
		$html = Printanje::polje($pristupnica -> datumPotvrdeTop, $pristupnica -> obavijestLeft, Alati::datum($_POST['datumPotvrde']), 'f w120 sredina','',null) . 
		$html = Printanje::polje($pristupnica -> zupaPotvrdeTop, $pristupnica -> obavijestLeft, $_POST['zupaPotvrde'], 'f w120 sredina','',60) . 
		$html = Printanje::polje($pristupnica -> potvrditeljTop, $pristupnica -> obavijestLeft, $_POST['potvrditelj'], 'f w120 sredina','',60) . 
		$html = Printanje::polje($pristupnica -> upisanoTop, $pristupnica -> upisanoJavljenoLeft, $_POST['upisano'], 'f w120 sredina','',null) . 
		$html = Printanje::polje($pristupnica -> javljenoTop, $pristupnica -> upisanoJavljenoLeft, $_POST['javljeno'], 'f w120 sredina','',null);
		break;
}
$mpdf -> WriteHTML($html);
$mpdf -> Output();
exit ;
