<?php
class Poruka extends SQL{
	
	private $posiljatelj, $primatelj, $poruka;
	
	function __construct($posiljatelj, $primatelj, $poruka){
		$this-> posiljatelj = $posiljatelj;
		$this-> primatelj = $primatelj;
		$this-> poruka = $poruka;
	}
	
	public function posalji(){
		parent::__construct();
		
		//unesi za pošiljatelja
		$this->izraz = $this->veza->prepare("insert into poruke(posiljatelj_id,primatelj_id,datum,vrijeme,poruka,procitano,obrisano,za)
						      values(:posiljatelj_id,:primatelj_id,:datum,:vrijeme,:poruka,1,0,:za)");
		$this->izraz->bindParam(":posiljatelj_id",$this-> posiljatelj);
		$this->izraz->bindParam(":primatelj_id",$this-> primatelj);
		$this->izraz->bindParam(":datum",date("Y-m-d"));
		$this->izraz->bindParam(":vrijeme",date("H:i"));
		$this->izraz->bindParam(":poruka",$this-> poruka);
		$this->izraz->bindParam(":za",$this-> posiljatelj);
		$this->izraz->execute();
		
		//unesi za primatelja
		$this->izraz = $this->veza->prepare("insert into poruke(posiljatelj_id,primatelj_id,datum,vrijeme,poruka,procitano,obrisano,za)
						      values(:posiljatelj_id,:primatelj_id,:datum,:vrijeme,:poruka,0,0,:za)");
		$this->izraz->bindParam(":posiljatelj_id",$this-> posiljatelj);
		$this->izraz->bindParam(":primatelj_id",$this-> primatelj);
		$this->izraz->bindParam(":datum",date("Y-m-d"));
		$this->izraz->bindParam(":vrijeme",date("H:i"));
		$this->izraz->bindParam(":poruka",$this-> poruka);
		$this->izraz->bindParam(":za",$this-> primatelj);
		$this->izraz->execute();
		
		header('location: index.php');
	}

}
