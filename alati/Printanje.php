<?php

class Printanje{
	private static function prored($str,$breakpoint){
		if($breakpoint!=null){
	        $duljina = strlen($str);
	      if ($duljina>= $breakpoint) {
	                return ' line-height: 82% !important; padding-top: 0px !important; ';
	        } 
		}
	 }
	
	public static function polje($top,$left,$var,$class,$style='',$breakpoint=27){
		return '<div class="' . $class . '" style="top: ' . $top . ' left: ' . $left . $style . self::prored($var,$breakpoint) .  '">' . $var . '</div>';
	}	
	 
}