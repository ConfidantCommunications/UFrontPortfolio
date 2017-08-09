<?php

// Generated by Haxe 3.4.2
class StringTools {
	public function __construct(){}
	static function startsWith($s, $start) {
		if(strlen($s) >= strlen($start)) {
			return _hx_substr($s, 0, strlen($start)) === $start;
		} else {
			return false;
		}
	}
	static function endsWith($s, $end) {
		$elen = strlen($end);
		$slen = strlen($s);
		if($slen >= $elen) {
			return _hx_substr($s, $slen - $elen, $elen) === $end;
		} else {
			return false;
		}
	}
	function __toString() { return 'StringTools'; }
}
