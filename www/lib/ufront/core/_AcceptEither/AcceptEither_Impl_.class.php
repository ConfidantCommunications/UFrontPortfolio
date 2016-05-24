<?php

class ufront_core__AcceptEither_AcceptEither_Impl_ {
	public function __construct(){}
	static function _new($e) {
		return $e;
	}
	static function get_value($this1) {
		switch($this1->index) {
		case 0:{
			$v = _hx_deref($this1)->params[0];
			return $v;
		}break;
		case 1:{
			$v1 = _hx_deref($this1)->params[0];
			return $v1;
		}break;
		}
	}
	static function get_type($this1) {
		return $this1;
	}
	static function fromA($v) {
		$e = tink_core_Either::Left($v);
		return $e;
	}
	static function fromB($v) {
		$e = tink_core_Either::Right($v);
		return $e;
	}
	static $__properties__ = array("get_type" => "get_type","get_value" => "get_value");
	function __toString() { return 'ufront.core._AcceptEither.AcceptEither_Impl_'; }
}
