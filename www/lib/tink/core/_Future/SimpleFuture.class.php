<?php

// Generated by Haxe 3.4.4
class tink_core__Future_SimpleFuture implements tink_core__Future_FutureObject{
	public function __construct($f) {
		if(!php_Boot::$skip_constructor) {
		$this->f = $f;
	}}
	public $f;
	public $gathered;
	public function handle($callback) {
		return $this->f($callback);
	}
	public function map($f) {
		$_gthis = $this;
		return new tink_core__Future_SimpleFuture(array(new _hx_lambda(array(&$_gthis, &$f), "tink_core__Future_SimpleFuture_0"), 'execute'));
	}
	public function flatMap($f) {
		$f1 = $f;
		$_gthis = $this;
		$tmp = new tink_core__Future_SimpleFuture(array(new _hx_lambda(array(&$_gthis, &$f1), "tink_core__Future_SimpleFuture_1"), 'execute'));
		return tink_core__Future_Future_Impl_::flatten($tmp);
	}
	public function gather() {
		return tink_core_FutureTrigger::gatherFuture($this);
	}
	public function eager() {
		$ret = tink_core_FutureTrigger::gatherFuture($this);
		$ret->handle(tink_core__Callback_Callback_Impl_::fromNiladic(array(new _hx_lambda(array(), "tink_core__Future_SimpleFuture_2"), 'execute')));
		return $ret;
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
	function __toString() { return 'tink.core._Future.SimpleFuture'; }
}
function tink_core__Future_SimpleFuture_0(&$_gthis, &$f, $cb) {
	{
		return $_gthis->f(array(new _hx_lambda(array(&$cb, &$f), "tink_core__Future_SimpleFuture_3"), 'execute'));
	}
}
function tink_core__Future_SimpleFuture_1(&$_gthis, &$f1, $cb) {
	{
		return $_gthis->f(array(new _hx_lambda(array(&$cb, &$f1), "tink_core__Future_SimpleFuture_4"), 'execute'));
	}
}
function tink_core__Future_SimpleFuture_2() {
	{
	}
}
function tink_core__Future_SimpleFuture_3(&$cb, &$f, $v) {
	{
		$tmp = call_user_func_array($f, array($v));
		tink_core__Callback_Callback_Impl_::invoke($cb, $tmp);
	}
}
function tink_core__Future_SimpleFuture_4(&$cb, &$f1, $v) {
	{
		$tmp1 = call_user_func_array($f1, array($v));
		tink_core__Callback_Callback_Impl_::invoke($cb, $tmp1);
	}
}
