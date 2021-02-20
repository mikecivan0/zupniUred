<?php

class IspisFinancija extends SQL{
	
	public static function pocetakTablice($nazivRedaPrimitka,$nazivRedaIzdatka){
		return '<table style="border-collapse: collapse; border: 2px solid black !important; margin-bottom: 5mm;">
				<thead>
					<tr style="height: 8mm !important;">
						<td style="border: 2px solid black !important; width: 10mm; text-align: center;"><b>BR.</b></td>
						<td style="border: 2px solid black !important; width: 24mm; text-align: center;"><b>DATUM</b></td>
						<td style="border: 2px solid black !important; width: 70mm; text-align: center;"><b>STAVKA</b></td>
						<td style="border: 2px solid black !important; width: 33mm; text-align: center;"><b>' . $nazivRedaPrimitka . '</b></td>
						<td style="border: 2px solid black !important; width: 33mm; text-align: center;"><b>' . $nazivRedaIzdatka . '</b></td>
					</tr>
				</thead>
				<tbody>';
	}
	
	public static function krajTablice(){
		return '</tbody>
			</table>';
	}
	
	public static function redUTablici($count,$transakcija,$datum,$godinaTransakcije,$mjesecTransakcije,$iznos){
		if($transakcija->grupa_id==1||$transakcija->grupa_id==2){
			$primitak = $iznos;
			$izdatak = null;
		}else{
			$primitak = null;
			$izdatak = $iznos;
		} 
		$napomena = (strlen($transakcija->napomena)>0) ? " (" . $transakcija->napomena . ")" : null;
		echo  '<tr class="rukopis" style="height: 8.5mm !important;">
			   		<td style="border: 1px solid black !important; width: 10mm; text-align: center;">' . $count . '.</td>
					<td style="border: 1px solid black !important; width: 24mm; text-align: center;">' . $datum . '</td>
					<td class="fwb" style="border: 1px solid black !important; width: 70mm; text-align: left; font-size: 12px; padding-left: 1mm;">' . $transakcija -> nazivSvrhe . $napomena . '</td>
					<td style="border-top: 1px solid black !important; border-bottom: 1px solid black !important; border-left: 2px solid black !important; border-right: 2px solid black !important;width: 33mm; text-align: right; padding-right: 1mm;">' . $primitak . '</td>
					<td style="border-top: 1px solid black !important; border-bottom: 1px solid black !important; border-left: 2px solid black !important; border-right: 2px solid black !important;width: 33mm; text-align: right; padding-right: 1mm;">' . $izdatak . '</td>
			   </tr>';
	}
	
	public static function zbrajanjeNaKrajuLista($ukupnoPrimanja,$ukupnoIzdataka,$prethodnoStanjePrimanja,$prethodnoStanjeIzdataka,$stanjePrimanja,$stanjeIzdataka){
			  echo '<tr style="height: 8mm !important;">
						<td style="border: 2px solid black !important; width: 10mm;"></td>
						<td style="border: 2px solid black !important; width: 24mm;"></td>
						<td style="border: 2px solid black !important; width: 70mm; text-align: center;"><b>UKUPNO</b></td>
						<td class="rukopis fwn b" style="border: 2px solid black !important; width: 33mm; text-align: right; padding-right: 1mm;">' . $ukupnoPrimanja . '</td>
						<td class="rukopis fwn b" style="border: 2px solid black !important; width: 33mm; text-align: right; padding-right: 1mm;">' . $ukupnoIzdataka . '</td>
					</tr>	
					<tr style="height: 8mm !important;">
						<td style="border: 2px solid black !important; width: 10mm;"></td>
						<td style="border: 2px solid black !important; width: 24mm;"></td>
						<td style="border: 2px solid black !important; width: 70mm; text-align: center;"><b>Stanje s prethodne stranice</b></td>
						<td class="rukopis fwn b" style="border: 2px solid black !important; width: 33mm; text-align: right; padding-right: 1mm;">' . $prethodnoStanjePrimanja . '</td>
						<td class="rukopis fwn b" style="border: 2px solid black !important; width: 33mm; text-align: right; padding-right: 1mm;">' . $prethodnoStanjeIzdataka . '</td>
					</tr>	
					<tr style="height: 8mm !important;">
						<td style="border: 2px solid black !important; width: 10mm;"></td>
						<td style="border: 2px solid black !important; width: 24mm;"></td>
						<td style="border: 2px solid black !important; width: 70mm; text-align: center;"><b>STANJE</b></td>
						<td class="rukopis fwn b" style="border: 2px solid black !important; width: 33mm; text-align: right; padding-right: 1mm;">' . $stanjePrimanja . '</td>
						<td class="rukopis fwn b" style="border: 2px solid black !important; width: 33mm; text-align: right; padding-right: 1mm;">' . $stanjeIzdataka . '</td>
					</tr>';
	}
	
	
	public static function prazniRedoviTablice($brTr){
		for ($i=0; $i < $brTr; $i++) { 
			  echo '<tr style="height: 8mm !important;">
				   		<td style="border: 1px solid black !important; width: 10mm; text-align: center;"></td>
						<td style="border: 1px solid black !important; width: 24mm; text-align: center;"></td>
						<td style="border: 1px solid black !important; width: 70mm; text-align: left;"></td>
						<td style="border-top: 1px solid black !important; border-bottom: 1px solid black !important; border-left: 2px solid black !important; border-right: 2px solid black !important;width: 33mm; text-align: right;"></td>
						<td style="border-top: 1px solid black !important; border-bottom: 1px solid black !important; border-left: 2px solid black !important; border-right: 2px solid black !important;width: 33mm; text-align: right;"></td>
			  		</tr>';
			}
	}
	
	public static function redUGI($count,$stavka,$iznos){
		if($iznos!=0){
			$array = self::iznosUArray($iznos,10);	
		}
		
		$tr = '<tr style="font-family: \"Times New Roman\", Georgia, Serif;">
					<td style="width: 12mm; text-align: center;">' . $count . '.</td>
					<td style="width: 108mm; text-align: left; padding-left: 10px;">' . $stavka->nazivStavke . '</td>';
					if($iznos!=0){
						foreach ($array as $key => $value) {
							$tr .= self::resetkaSaBrojevima($key, $value);
						}
					}else{
						$tr.= self::praznaResetka(10);
					}
		$tr .= '</tr>';		
		echo $tr;
	}
	
	public static function naslovUGI($grupa){
		$naslov = strtoupper(str_replace('ak', 'ci', explode(' ', $grupa->nazivGrupe)[0]));
		echo "<div style='border: 1px solid black; border-bottom: none; width: 99.8%; text-align: center; font-family: \"Times New Roman\", Georgia, Serif; font-size: 18px;'><b>" . $naslov . "</b></div>";		
	}
	
	public static function ukupnoZaGrupuUGI($naziv,$iznos){
		$naziv = 'UKUPNO ' . strtoupper(str_replace('ak', 'ci', $naziv));
		$array = self::iznosUArray($iznos,10);						
		$tr = '<tr style="font-family: \"Times New Roman\", Georgia, Serif;">
					<td style="width: 12mm; text-align: center; border-right: none;"></td>
					<td style="width: 108mm; text-align: left; border-left: none; font-size: 20px;"><b>' . $naziv . ':</b></td>';
					if($iznos!=0){					
						foreach ($array as $key => $value) {
							$tr .= self::resetkaSaBrojevima($key, $value, true);
						}
					}else{
						$tr.= self::praznaResetka(10);
					}
		$tr .= '</tr>';		
		echo $tr;
	}
	
	private static function iznosUArray($iznos,$brojMjesta){
		$iznos = str_replace(',','', str_replace('.', '', number_format($iznos, 2)));
		$brojZnakova = strlen($iznos);
		$brojevi = str_split($iznos);
		$razlika = $brojMjesta - $brojZnakova;
		$array = array();
		for ($i=1; $i <= $razlika; $i++) { 
			$array[$i] = "";
		}
		foreach ($brojevi as $key => $value) {
			array_push($array,$value);
		}
		
		return $array;
	}
	
	private static function resetkaSaBrojevima($key,$value,$bold=false){
		$td= '<td class="rukopis fwb" style="width: 4.3mm; line-height: 8mm !important; text-align: center;';
		$td .= ($key==8) ? ' border-right: 2px black solid;' : null;
		$td .= '">';
		$td .= ($bold==true) ? '<b>' . $value . '</b>' : $value ;
		$td .= '</td>';
		
		return $td;
	}
	
	private static function praznaResetka($broj){
		$td = '';
		for ($i=1; $i <= $broj; $i++) { 
			$td .= '<td style="width: 4.3mm; height: 35px !important;';
			$td .= ($i==8) ? ' border-right: 2px black solid;' : null;
			$td .= '"></td>';
		}
		
		return $td;
	}
	
	public static function zaglavlje($grupa){
		$blagajna = explode(' ', $grupa->nazivGrupe)[1];
		$prviDio = ($grupa->id==1||$grupa->id==3)? "REDOVITI" : "PROLAZNI";
		echo "<div style='font-family: \"Times New Roman\", Georgia, Serif; padding: 0 0 2mm 2mm; font-size: 18px;'><b>" . $prviDio . " BLAGAJNIČKI DNEVNIK</b> - Župna blagajna " . $blagajna . "</div>";
	}
	
	public static function bezTockeIZareza($iznos){
		return (strlen(trim($iznos))!=0) ? str_replace(',','', str_replace('.', '', number_format($iznos, 2))) : null;		
	}
	
	public function brojStranice($broj){
		echo "<div style='font-family: \"Times New Roman\", Georgia, Serif; font-size: 18px; text-align: right; margin-bottom: 3mm;'>" . $broj . "</div>";
	}
	
	public static function polje($top,$left,$var,$class,$style=''){
		return '<div class="' . $class . '" style="top: ' . $top . ' left: ' . $left . $style .  '">' . $var . '</div>';
	}
	
	public static function kvartalUMjesece($kvartal){
		switch ($kvartal) {
			case 1:
				$mjeseci = "I-II-III";
				break;
			
			case 2:
				$mjeseci = "IV-V-VI";
				break;
			
			case 3:
				$mjeseci = "VII-VIII-IX";
				break;
				
			case 4:
				$mjeseci = "X-XI-XII";
				break;
			
		}
		echo $mjeseci;
	}
}