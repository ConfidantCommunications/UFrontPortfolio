<?php

// Generated by Haxe 3.4.4
class tink_core__Signal_SignalTrigger_Impl_ {
	public function __construct(){}
	static function _new() {
		$this1 = null;
		$this2 = (new _hx_array(array()));
		$this1 = $this2;
		return $this1;
	}
	static function trigger($this1, $event) {
		tink_core__Callback_CallbackList_Impl_::invoke($this1, $event);
	}
	static function getLength($this1) {
		return $this1->length;
	}
	static function clear($this1) {
		tink_core__Callback_CallbackList_Impl_::clear($this1);
	}
	static function asSignal($this1) {
		$this2 = null;
		$_e = $this1;
		$this2 = array(new _hx_lambda(array(&$_e), "tink_core__Signal_SignalTrigger_Impl__0"), 'execute');
		return $this2;
	}
	function __toString() { return 'tink.core._Signal.SignalTrigger_Impl_'; }
}
function tink_core__Signal_SignalTrigger_Impl__0(&$_e, $cb) {
	{
		return tink_core__Callback_CallbackList_Impl_::add($_e, $cb);
	}
}
