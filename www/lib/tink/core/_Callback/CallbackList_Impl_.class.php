<?php

class tink_core__Callback_CallbackList_Impl_ {
	public function __construct(){}
	static function _new() {
		return (new _hx_array(array()));
	}
	static function get_length($this1) {
		return $this1->length;
	}
	static function add($this1, $cb) {
		$cell = null;
		{
			$ret = null;
			$ret = tink_core__Callback_CallbackList_Impl__0($cb, $cell, $ret, $this1);
			$ret[0] = $cb;
			$cell = $ret;
		}
		$this1->push($cell);
		return array(new _hx_lambda(array(&$cb, &$cell, &$this1), "tink_core__Callback_CallbackList_Impl__1"), 'execute');
	}
	static function invoke($this1, $data) {
		$_g = 0;
		$_g1 = $this1->copy();
		while($_g < $_g1->length) {
			$cell = $_g1[$_g];
			++$_g;
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
			++$_g;
			$cell[0] = null;
			unset($cell);
		}
	}
	static $__properties__ = array("get_length" => "get_length");
	function __toString() { return 'tink.core._Callback.CallbackList_Impl_'; }
}
function tink_core__Callback_CallbackList_Impl__0(&$cb, &$cell, &$ret, &$this1) {
	{
		$this2 = null;
		$this2 = (new _hx_array(array()));
		$this2->length = 1;
		return $this2;
	}
}
function tink_core__Callback_CallbackList_Impl__1(&$cb, &$cell, &$this1) {
	{
		if($this1->remove($cell)) {
			$cell[0] = null;
		}
		$cell = null;
	}
}
