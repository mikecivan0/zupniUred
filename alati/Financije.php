<?php

class Financije extends SQL{
	public static function hrvMjesec($str){
			switch($str){
				case 1:
					$hrvMj = "Siječanj";
				break;
				
				case 2:
					$hrvMj = "Veljača";
				break;
				
				case 3:
					$hrvMj = "Ožujak";
				break;
				
				case 4:
					$hrvMj = "Travanj";
				break;
				
				case 5:
					$hrvMj = "Svibanj";
				break;
				
				case 6:
					$hrvMj = "Lipanj";
				break;
				
				case 7:
					$hrvMj = "Srpanj";
				break;
				
				case 8:
					$hrvMj = "Kolovoz";
				break;
				
				case 9:
					$hrvMj = "Rujan";
				break;
				
				case 10:
					$hrvMj = "Listopad";
				break;
				
				case 11:
					$hrvMj = "Studeni";
				break;
				
				case 12:
					$hrvMj = "Prosinac";
				break;
			}
		return $hrvMj;
	}
	
	public static function daLiJeGodinaIMjesec($godina,$mjesec,$godinaTransakcije,$mjesecTransakcije){
		return ($godinaTransakcije==$godina->godina&&$mjesecTransakcije==$mjesec->mjesec) ? ' class="plavaSlova"' : ' class="crnaSlova"';
	}
	
	public static function daLiJeGodina($prop,$godina,$godinaTransakcije){
		if($prop=='style'){
			return ($godinaTransakcije!=$godina->godina) ? ' style="display: none;"' : null;
		}
		
		if($prop=='class'){
			return ($godinaTransakcije==$godina->godina) ? 'class="plavaSlova"' : 'class="crnaSlova"';
		}
	}
	
	public function nadjiMjeseceZaCrveni($godina){
		parent::__construct();
		
		$this->izraz = $this->veza->prepare("select distinct MONTH(t.datum) as mjesec from 
											 transakcije t inner join svrhe s on t.svrha_id=s.id
						  					 where t.zupa_id=:id and YEAR(datum)=:godina and s.grupa_id in (1,3) order by mjesec;");
		$this->izraz->bindParam(':id', $_GET["id"]);
		$this->izraz->bindParam(':godina', $godina->godina);
		$this->izraz->execute();
		return $this->izraz -> fetchAll(PDO::FETCH_OBJ);	
	}
	
	public function nadjiMjeseceZaPlavi($godina){
		parent::__construct();
		
		$this->izraz = $this->veza->prepare("select distinct MONTH(t.datum) as mjesec from 
											 transakcije t inner join svrhe s on t.svrha_id=s.id
						  					 where t.zupa_id=:id and YEAR(datum)=:godina and s.grupa_id in (2,4) order by mjesec;");
		$this->izraz->bindParam(':id', $_GET["id"]);
		$this->izraz->bindParam(':godina', $godina->godina);
		$this->izraz->execute();
		return $this->izraz -> fetchAll(PDO::FETCH_OBJ);	
	}
	
	public static function pocetakTablice($nazivRedaPrimitka,$nazivRedaIzdatka){
		return '<table class="siroko mb100">
				<thead>
					<tr>
						<td>Broj</td>
						<td>Datum</td>
						<td>Stavka</td>
						<td>' . $nazivRedaPrimitka . '</td>
						<td>' . $nazivRedaIzdatka . '</td>
						<td>Promijeni</td>
						<td>Briši</td>
					</tr>
				</thead>
				<tbody id="podaci">';
	}
	
	public static function krajTablice(){
		return '</tbody>
			</table>';
	}
	
	public static function redUTablici($count,$transakcija,$datum,$godinaTransakcije,$mjesecTransakcije,$iznos,$putanjaApp){
		if($transakcija->grupa_id==1||$transakcija->grupa_id==2){
			$primitak = $iznos;
			$izdatak = null;
		}else{
			$primitak = null;
			$izdatak = $iznos;
		} 
		$napomena = (strlen($transakcija->napomena)>0) ? " (" . $transakcija->napomena . ")" : null;
		echo  '<tr id="' . $transakcija -> id . '">
						<td>' . $count . '.</td>
						<td>' . $datum . '</td>
						<td style="font-size: 12px;">' . $transakcija -> nazivSvrhe . $napomena . '</td>
						<td style="text-align: right;">' . $primitak . '</td>
						<td style="text-align: right;">' . $izdatak . '</td>
						<td class="center">
							<a href="promjenaTransakcije.php?id=' . $_GET["id"] . "&transakcija_id=" . $transakcija->id . "&godina=" . $godinaTransakcije . "&mjesec=" . $mjesecTransakcije . '">
								<img src="' . $putanjaApp . 'img/admin/pen.png"/>
							</a>
						</td>
						<td class="center">
							<a href="#" class="obrisiTr" id="' . $transakcija->id . '"><img src="' . $putanjaApp . 'img/admin/bin.png"/></a>
						</td>
					</tr>';
	}
	
	public static function zbrajanjeNaKrajuLista($ukupnoPrimanja,$ukupnoIzdataka,$prethodnoStanjePrimanja,$prethodnoStanjeIzdataka,$stanjePrimanja,$stanjeIzdataka){
			  echo '<tr>
						<td></td>
						<td></td>
						<td style="border: 1px solid black !important;"><b>UKUPNO</b></td>
						<td style="text-align: right; border: 1px solid black !important;"><b>' . $ukupnoPrimanja . '</b></td>
						<td style="text-align: right; border: 1px solid black !important;"><b>' . $ukupnoIzdataka . '</b></td>
						<td></td>
						<td></td>
					</tr>	
					<tr>
						<td></td>
						<td></td>
						<td style="border: 1px solid black !important;"><b>STANJE SA PRETHODNE STRANICE</b></td>
						<td style="text-align: right; border: 1px solid black !important;"><b>' . $prethodnoStanjePrimanja . '</b></td>
						<td style="text-align: right; border: 1px solid black !important;"><b>' . $prethodnoStanjeIzdataka . '</b></td>
						<td></td>
						<td></td>
					</tr>	
					<tr>
						<td></td>
						<td></td>
						<td style="border: 1px solid black !important;"><b>STANJE</b></td>
						<td style="text-align: right; border: 1px solid black !important;"><b>' . $stanjePrimanja . '</b></td>
						<td style="text-align: right; border: 1px solid black !important;"><b>' . $stanjeIzdataka . '</b></td>
						<td></td>
						<td></td>
					</tr>';
	}
}