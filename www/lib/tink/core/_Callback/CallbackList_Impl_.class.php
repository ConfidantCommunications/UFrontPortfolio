<?php

// Generated by Haxe 3.4.4
class tink_core__Callback_CallbackList_Impl_ {
	public function __construct(){}
	static function _new() {
		$this1 = (new _hx_array(array()));
		return $this1;
	}
	static function get_length($this1) {
		return $this1->length;
	}
	static function add($this1, $cb) {
		$this2 = null;
		$this3 = (new _hx_array(array()));
		$this3->length = 1;
		$this2 = $this3;
		$ret = $this2;
		$ret[0] = $cb;
		$cell = $ret;
		$this1->push($cell);
		$this4 = array(new _hx_lambda(array(&$cell, &$this1), "tink_core__Callback_CallbackList_Impl__0"), 'execute');
		return $this4;
	}
	static function invoke($this1, $data) {
		$_g = 0;
		$_g1 = $this1->copy();
		while($_g < $_g1->length) {
			$cell = $_g1[$_g];
			$_g = $_g + 1;
			if($cell[0] !== null) {
				$cell[0]($data);
			}
			unset($cell);
		}
	}
	static function clear($this1) {
		$_g = 0;
		$_g1 = $this1->splice(0, $this1->length);
		while($_g < $_g1->length) {
			$cell = $_g1[$_g];
			$_g = $_g + 1;
			$cell[0] = null;
			unset($cell);
		}
	}
	static $__properties__ = array("get_length" => "get_length");
	function __toString() { return 'tink.core._Callback.CallbackList_Impl_'; }
}
function tink_core__Callback_CallbackList_Impl__0(&$cell, &$this1) {
	{
		if($this1->remove($cell)) {
			$cell[0] = null;
		}
		$cell = null;
	}
}
