<?php

class ufront_core__Futuristic_Futuristic_Impl_ {
	public function __construct(){}
	static function _new($f) {
		return $f;
	}
	static function fromSync($v) {
		$f = tink_core__Future_Future_Impl_::sync($v);
		return $f;
	}
	static function asFuture($this1) {
		return $this1;
	}
	function __toString() { return 'ufront.core._Futuristic.Futuristic_Impl_'; }
}
