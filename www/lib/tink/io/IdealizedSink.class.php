<?php

// Generated by Haxe 3.4.4
class tink_io_IdealizedSink extends tink_io_IdealSinkBase {
	public function __construct($target, $onError) {
		if(!php_Boot::$skip_constructor) {
		$this->target = $target;
		$this->onError = $onError;
	}}
	public $target;
	public $onError;
	public function writeSafely($from) {
		$_gthis = $this;
		$this1 = $this->target->write($from);
		$ret = $this1->map(array(new _hx_lambda(array(&$_gthis, &$from), "tink_io_IdealizedSink_0"), 'execute'));
		return $ret->gather();
	}
	public function closeSafely() {
		$_gthis = $this;
		$this1 = $this->target->close();
		$ret = $this1->map(array(new _hx_lambda(array(&$_gthis), "tink_io_IdealizedSink_1"), 'execute'));
		return $ret->gather();
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->__dynamics[$m]) && is_callable($this->__dynamics[$m]))
			return call_user_func_array($this->__dynamics[$m], $a);
		else if('toString' == $m)
			return $this->__toString();
		else
			throw new HException('Unable to call <'.$m.'>');
	}
	function __toString() { return 'tink.io.IdealizedSink'; }
}
function tink_io_IdealizedSink_0(&$_gthis, &$from, $o) {
	{
		switch($o->index) {
		case 0:{
			$p = _hx_deref($o)->params[0];
			return $p;
		}break;
		case 1:{
			$e = _hx_deref($o)->params[0];
			tink_core__Callback_Callback_Impl_::invoke((property_exists($_gthis, "onError") ? $_gthis->onError: array($_gthis, "onError")), $e);
			$from->clear();
			return -1;
		}break;
		}
	}
}
function tink_io_IdealizedSink_1(&$_gthis, $o) {
	{
		if($o->index === 1) {
			$e = _hx_deref($o)->params[0];
			tink_core__Callback_Callback_Impl_::invoke((property_exists($_gthis, "onError") ? $_gthis->onError: array($_gthis, "onError")), $e);
		}
		return tink_core_Noise::$Noise;
	}
}