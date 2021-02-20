<?php
class Grupa extends SQL{
	
	private $id;
	private $sql="select * from grupe";
	private $grup;
	
	function __construct($id=null){
		$this-> id = $id;
	}
	
	public function dohvati(){
		parent::__construct();
		$this->sql.=" where id=:id;";		
		$this->izraz = $this->veza->prepare($this->sql);		
		$this->izraz->bindParam(":id",$this->id);
		$this->izraz->execute();
		$this->grup = $this->izraz->fetch(PDO::FETCH_OBJ);
		return $this->grup;
	}
	
	public function dohvatiSve($conds=null){
		parent::__construct();
	    ($conds!=null) ? $this->sql.= $conds : null;
		$this->izraz = $this->veza->prepare($this->sql);
		$this->izraz->execute();
		$this->grup = $this->izraz->fetchAll(PDO::FETCH_OBJ);		
		return $this->grup;
	}
	
	
	public function dohvatiGrupeZaKI(){
		parent::__construct();
		$this->sql.=" where id in (2,4);";
		$this->izraz = $this->veza->prepare($this->sql);
		$this->izraz->execute();		
		$this->grup = $this->izraz->fetchAll(PDO::FETCH_OBJ);
		
		return $this->grup;	
	}

}