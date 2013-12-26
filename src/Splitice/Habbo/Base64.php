<?php
namespace Splitice\Habbo;

class Base64 {
	public static function Encode( $i ){
		if(is_numeric($i)){
			try{
				$s = "";
				for($x = 1; $x <= 2; $x++)
					$s.= chr( (64 + ($i >> 6 * ( 2 - $x) & 0x3f)) );
				return $s;
			}catch(\Exception $e){
				return $e->getMessage();
			}
		}else{
			return false;
		}
	}
		
	public static function Decode( $s ){
		if(is_string($s)){
			try{
				$val = str_split($s);
				$intTot = 0;
				$y = 0;
				for($x = (count($val) -1); $x >= 0; $x--){
					$intTmp = ord($val[$x]) & 0x3F;
					if($y > 0){
						$intTmp = ($intTmp*pow(64, $y));
					}
					$intTot+= $intTmp;
					$y++;
				}
				return $intTot;
			}catch(\Exception $e){
				return $e->getMessage();
			}
		}else{
			return false;
		}
	}
}