<?php

class php_Lib {
	public function __construct(){}
	static function isCli() {
		return (0 == strncasecmp(PHP_SAPI, 'cli', 3));
	}
	static function toPhpArray($a) {
		return $a->a;
	}
	static function hashOfAssociativeArray($arr) {
		$h = new haxe_ds_StringMap();
		$h->h = $arr;
		return $h;
	}
	static function associativeArrayOfHash($hash) {
		return $hash->h;
	}
	static function associativeArrayOfObject($ob) {
		return (array) $ob;
	}
	static function rethrow($e) {
		if(Std::is($e, _hx_qtype("php.Exception"))) {
			$__rtex__ = $e;
			throw $__rtex__;
		} else {
			throw new HException($e);
		}
	}
	function __toString() { return 'php.Lib'; }
}
