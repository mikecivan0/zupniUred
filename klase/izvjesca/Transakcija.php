<?php
class Transakcija extends SQL{
	
	private $iznos;
	public $kvartal;
	public $godina;
	
	function __construct(){
		parent::__construct();
	}
	
	public function dohvatiIznoseZaGI($stavka,$zupa,$godina){
		
		$this->izraz = $this->veza->prepare('select SUM(iznos) as iznos from transakcije 
											 where svrha_id in (select svrha_id from kalkulacije where zupa_id=' . $zupa . ' and stavka_id=' . $stavka . ') 
											 and zupa_id=' . $zupa . ' and YEAR(datum)=' . $godina . ';');
		$this->izraz->execute();
		$this->iznos = $this->izraz -> fetch(PDO::FETCH_COLUMN);
		$this->iznos = ($this->iznos==null) ? 0.00 : $this->iznos;	
		return $this->iznos;
	}
	
	public function dohvatiKvartalIGodinu($zupa,$transakcija_id){
		
		$this->izraz = $this->veza->prepare('select YEAR(datum) as godina, QUARTER(datum) as kvartal from transakcije where 
											 zupa_id=' . $zupa . ' and id=' . $transakcija_id);
		$this->izraz->execute();
		$kvartalIGodina = $this->izraz -> fetch(PDO::FETCH_OBJ);
		$this->kvartal = $kvartalIGodina->kvartal;
		$this->godina = $kvartalIGodina->godina;
	}
	
	public function dohvatiIznoseZaKI($stavka,$zupa,$kvartal,$godina){
		$this->izraz = $this->veza->prepare('select SUM(iznos) as iznos from transakcije 
											 where svrha_id in (select svrha_id from kalkulacije where zupa_id=' . $zupa . ' and stavka_id=' . $stavka . ') 
											 and zupa_id=' . $zupa . ' and YEAR(datum)=' . $godina . ' and QUARTER(datum)=' . $kvartal .';');
		$this->izraz->execute();
		$this->iznos = $this->izraz -> fetch(PDO::FETCH_COLUMN);
		$this->iznos = ($this->iznos==null) ? 0.00 : $this->iznos;	
		return $this->iznos;
	}

}
