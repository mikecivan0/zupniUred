<?php
class Stavka extends SQL{
	
	private $st;
	
	function __construct(){
		parent::__construct();
	}
	
	public function dohvatiStavkeZaGI($grupa,$zupa){
		
		$this->izraz = $this->veza->prepare('select * from stavke where izvjesce_id=2 and grupa_id=' . $grupa . ' and zupa_id=' . $zupa . ' order by id;');
		$this->izraz->execute();
		$this->st = $this->izraz->fetchAll(PDO::FETCH_OBJ);		
		return $this->st;
	}
	
	public function dohvatiStavkeZaKI($grupa,$zupa){
		
		$this->izraz = $this->veza->prepare('select * from stavke where izvjesce_id=1 and grupa_id=' . $grupa . ' and zupa_id=' . $zupa . ' order by id;');
		$this->izraz->execute();
		$this->st = $this->izraz->fetchAll(PDO::FETCH_OBJ);		
		return $this->st;
	}

}
