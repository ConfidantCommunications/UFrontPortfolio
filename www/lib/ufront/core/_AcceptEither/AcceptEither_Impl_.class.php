<?php

// Generated by Haxe 3.4.4
class ufront_core__AcceptEither_AcceptEither_Impl_ {
	public function __construct(){}
	static function _new($e) {
		$this1 = $e;
		return $this1;
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
		$this1 = tink_core_Either::Left($v);
		return $this1;
	}
	static function fromB($v) {
		$this1 = tink_core_Either::Right($v);
		return $this1;
	}
	static $__properties__ = array("get_type" => "get_type","get_value" => "get_value");
	function __toString() { return 'ufront.core._AcceptEither.AcceptEither_Impl_'; }
}
