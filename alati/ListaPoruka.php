<?php

class ListaPoruka{

	protected $posiljatelj, $primatelj;

	function __construct($poruka,$podaci) {
		//odredi pošiljatelja
		switch ($poruka->posiljatelj_id) {
			case 3 :
				$this->posiljatelj = 'admin';
				break;
			case $podaci->userId :
				$this->posiljatelj = 'ja';
				break;
			default :
				$this->posiljatelj = self::skrati($poruka -> posiljatelj);
				break;
		}

		//odredi primatelja
		switch ($poruka->primatelj_id) {
			case 3 :
				$this->primatelj = 'admin';
				break;
			case $podaci->userId :
				$this->primatelj = 'ja';
				break;
			default :
				$this->primatelj = self::skrati($poruka -> primatelj);
				break;
		}
	}
	
	public function primatelj(){
		return $this->primatelj;
	}
	
	public function posiljatelj(){
		return $this->posiljatelj;
	}
	
	public static function skrati($str,$breakpoint=19){
		$list = explode(' ',$str);
		$output = '';
		foreach ($list as $key => $value) {
			if((strlen($output) + strlen($value))<=$breakpoint){
				$output .= $value . ' ';
			}else{
				break;
			}
		}			
		return $output;
	}
}
