<?php
class Obavijest extends SQL{
	
	private $obavijest,$posiljatelj;
	
	function __construct($obavijest,$posiljatelj){
		$this-> obavijest = $obavijest;
		$this-> posiljatelj = $posiljatelj;
	}
	
	public function posalji(){
		parent::__construct();
		
		//unesi za pošiljatelja
		$this->izraz = $this->veza->prepare("select id from users;");
		$this->izraz->bindParam(":id",$this-> posiljatelj);
		$this->izraz->execute();
		$primatelji = $this->izraz->fetchAll(PDO::FETCH_OBJ);
		
		foreach ($primatelji as $primatelj) {
			//unesi za primatelja
			$procitano = ($primatelj->id==$this->posiljatelj) ? 1 : 0;
			$this->izraz = $this->veza->prepare("insert into poruke(posiljatelj_id,primatelj_id,datum,vrijeme,poruka,procitano,obrisano,za)
							      values(:posiljatelj_id,:primatelj_id,:datum,:vrijeme,:poruka,:procitano,0,:za)");
			$this->izraz->bindParam(":posiljatelj_id",$this-> posiljatelj);
			$this->izraz->bindParam(":primatelj_id",$primatelj-> id);
			$this->izraz->bindParam(":datum",date("Y-m-d"));
			$this->izraz->bindParam(":vrijeme",date("H:i"));
			$this->izraz->bindParam(":poruka",$this-> obavijest);
			$this->izraz->bindParam(":procitano",$procitano);
			$this->izraz->bindParam(":za",$primatelj-> id);
			$this->izraz->execute();
		}
		
		header('location: index.php');
	}

}
