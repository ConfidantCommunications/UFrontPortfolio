<?php

// Generated by Haxe 3.4.4
class tink_core__Lazy_LazyFunc implements tink_core__Lazy_LazyObject{
	public function __construct($f) {
		if(!php_Boot::$skip_constructor) {
		$this->f = $f;
	}}
	public $f;
	public $result;
	public function get() {
		if($this->f !== null) {
			$this->result = $this->f();
			$this->f = null;
		}
		return $this->result;
	}
	public function map($f) {
		$_gthis = $this;
		return new tink_core__Lazy_LazyFunc(array(new _hx_lambda(array(&$_gthis, &$f), "tink_core__Lazy_LazyFunc_0"), 'execute'));
	}
	public function flatMap($f) {
		$_gthis = $this;
		return new tink_core__Lazy_LazyFunc(array(new _hx_lambda(array(&$_gthis, &$f), "tink_core__Lazy_LazyFunc_1"), 'execute'));
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
	function __toString() { return 'tink.core._Lazy.LazyFunc'; }
}
function tink_core__Lazy_LazyFunc_0(&$_gthis, &$f) {
	{
		$tmp = $_gthis->get();
		return call_user_func_array($f, array($tmp));
	}
}
function tink_core__Lazy_LazyFunc_1(&$_gthis, &$f) {
	{
		$this1 = $_gthis->get();
		$this2 = call_user_func_array($f, array($this1));
		return $this2->get();
	}
}
