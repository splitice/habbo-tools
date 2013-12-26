<?php
namespace Splitice\Habbo;

class vl64{
	public static function Decode($string){
		$r = strtok($string, '');
		$wf = array();
		for($i = 0; $i <= strlen($string); $i++){
			//$nbr = abs(ord($string));
			$wf[] = abs(ord(@$string[$i]));
		}

		$total = $wf[0] >> 3 & 7;
		$v = $wf[0] & 3;
		$pos = 1;
		$shift = 2;
		for($b=1;$b<$total;$b++){
			$v |= ($wf[$pos] & 0x3F) << $shift;
			$shift = 2 + 6*$b;
			$pos++;
		}
		if(($wf[0]&4) == 4)
			$v *= -1;
		return abs($v);
	}
	public static function Encode($i){
		$wf = array();
		$pos = 0;
		$spos = 0;
		$bytes = 1;
		$negativeMask = $i>=0?0:4;
		$i = abs($i);
		$wf[$pos++] = 64 + ($i & 3);
		for ($i >>= 2; $i != 0; $i >>= 6){
			$bytes++;
			$wf[$pos++] = 64 + ($i & 0x3f);
		}
		$wf[$spos] = $wf[$spos] | $bytes << 3 | $negativeMask;
		$str = "";
		foreach($wf as $tmp)
			$str .= chr($tmp);
		return str_replace("\0","",$str);
	}
}