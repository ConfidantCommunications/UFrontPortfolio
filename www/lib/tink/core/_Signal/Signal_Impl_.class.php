<?php

// Generated by Haxe 3.4.4
class tink_core__Signal_Signal_Impl_ {
	public function __construct(){}
	static function _new($f) {
		$this1 = new tink_core__Signal_SimpleSignal($f);
		return $this1;
	}
	static function map($this1, $f, $gather = null) {
		if($gather === null) {
			$gather = true;
		}
		$this2 = new tink_core__Signal_SimpleSignal(array(new _hx_lambda(array(&$f, &$this1), "tink_core__Signal_Signal_Impl__0"), 'execute'));
		$ret = $this2;
		if($gather) {
			return tink_core__Signal_Signal_Impl_::gather($ret);
		} else {
			return $ret;
		}
	}
	static function flatMap($this1, $f, $gather = null) {
		if($gather === null) {
			$gather = true;
		}
		$this2 = new tink_core__Signal_SimpleSignal(array(new _hx_lambda(array(&$f, &$this1), "tink_core__Signal_Signal_Impl__1"), 'execute'));
		$ret = $this2;
		if($gather) {
			return tink_core__Signal_Signal_Impl_::gather($ret);
		} else {
			return $ret;
		}
	}
	static function filter($this1, $f, $gather = null) {
		if($gather === null) {
			$gather = true;
		}
		$this2 = new tink_core__Signal_SimpleSignal(array(new _hx_lambda(array(&$f, &$this1), "tink_core__Signal_Signal_Impl__2"), 'execute'));
		$ret = $this2;
		if($gather) {
			return tink_core__Signal_Signal_Impl_::gather($ret);
		} else {
			return $ret;
		}
	}
	static function select($this1, $selector, $gather = null) {
		if($gather === null) {
			$gather = true;
		}
		$this2 = new tink_core__Signal_SimpleSignal(array(new _hx_lambda(array(&$selector, &$this1), "tink_core__Signal_Signal_Impl__3"), 'execute'));
		$ret = $this2;
		if($gather) {
			return tink_core__Signal_Signal_Impl_::gather($ret);
		} else {
			return $ret;
		}
	}
	static function join($this1, $other, $gather = null) {
		if($gather === null) {
			$gather = true;
		}
		$this2 = new tink_core__Signal_SimpleSignal(array(new _hx_lambda(array(&$other, &$this1), "tink_core__Signal_Signal_Impl__4"), 'execute'));
		$ret = $this2;
		if($gather) {
			return tink_core__Signal_Signal_Impl_::gather($ret);
		} else {
			return $ret;
		}
	}
	static function nextTime($this1, $condition = null) {
		$ret = new tink_core_FutureTrigger();
		$link = null;
		$immediate = false;
		$link = $this1->handle(array(new _hx_lambda(array(&$condition, &$immediate, &$link, &$ret), "tink_core__Signal_Signal_Impl__5"), 'execute'));
		if($immediate) {
			if($link !== null) {
				$link->dissolve();
			}
		}
		return $ret;
	}
	static function next($this1, $condition = null) {
		return tink_core__Signal_Signal_Impl_::nextTime($this1, $condition);
	}
	static function noise($this1) {
		return tink_core__Signal_Signal_Impl_::map($this1, array(new _hx_lambda(array(), "tink_core__Signal_Signal_Impl__6"), 'execute'), null);
	}
	static function gather($this1) {
		$ret = tink_core__Signal_Signal_Impl_::trigger();
		$this1->handle(array(new _hx_lambda(array(&$ret), "tink_core__Signal_Signal_Impl__7"), 'execute'));
		return $ret;
	}
	static function generate($generator) {
		$ret = tink_core__Signal_Signal_Impl_::trigger();
		call_user_func_array($generator, array((property_exists($ret, "trigger") ? $ret->trigger: array($ret, "trigger"))));
		return $ret;
	}
	static function trigger() {
		return new tink_core_SignalTrigger();
	}
	static function ofClassical($add, $remove, $gather = null) {
		if($gather === null) {
			$gather = true;
		}
		$this1 = new tink_core__Signal_SimpleSignal(array(new _hx_lambda(array(&$add, &$remove), "tink_core__Signal_Signal_Impl__8"), 'execute'));
		$ret = $this1;
		if($gather) {
			return tink_core__Signal_Signal_Impl_::gather($ret);
		} else {
			return $ret;
		}
	}
	function __toString() { return 'tink.core._Signal.Signal_Impl_'; }
}
function tink_core__Signal_Signal_Impl__0(&$f, &$this1, $cb) {
	{
		return $this1->handle(array(new _hx_lambda(array(&$cb, &$f), "tink_core__Signal_Signal_Impl__9"), 'execute'));
	}
}
function tink_core__Signal_Signal_Impl__1(&$f, &$this1, $cb) {
	{
		return $this1->handle(array(new _hx_lambda(array(&$cb, &$f), "tink_core__Signal_Signal_Impl__10"), 'execute'));
	}
}
function tink_core__Signal_Signal_Impl__2(&$f, &$this1, $cb) {
	{
		return $this1->handle(array(new _hx_lambda(array(&$cb, &$f), "tink_core__Signal_Signal_Impl__11"), 'execute'));
	}
}
function tink_core__Signal_Signal_Impl__3(&$selector, &$this1, $cb) {
	{
		return $this1->handle(array(new _hx_lambda(array(&$cb, &$selector), "tink_core__Signal_Signal_Impl__12"), 'execute'));
	}
}
function tink_core__Signal_Signal_Impl__4(&$other, &$this1, $cb) {
	{
		$a = $this1->handle($cb);
		return new tink_core__Callback_LinkPair($a, $other->handle($cb));
	}
}
function tink_core__Signal_Signal_Impl__5(&$condition, &$immediate, &$link, &$ret, $v) {
	{
		$link1 = null;
		if($condition !== null) {
			$link1 = call_user_func_array($condition, array($v));
		} else {
			$link1 = true;
		}
		if($link1) {
			$ret->trigger($v);
			if($link === null) {
				$immediate = true;
			} else {
				if($link !== null) {
					$link->dissolve();
				}
			}
		}
	}
}
function tink_core__Signal_Signal_Impl__6($_) {
	{
		return tink_core_Noise::$Noise;
	}
}
function tink_core__Signal_Signal_Impl__7(&$ret, $x) {
	{
		tink_core__Callback_CallbackList_Impl_::invoke($ret->handlers, $x);
	}
}
function tink_core__Signal_Signal_Impl__8(&$add, &$remove, $cb) {
	{
		$f = array(new _hx_lambda(array(&$cb), "tink_core__Signal_Signal_Impl__13"), 'execute');
		call_user_func_array($add, array($f));
		$this2 = null;
		$f1 = $remove;
		$a1 = $f;
		$this2 = new tink_core__Callback_SimpleLink(array(new _hx_lambda(array(&$a1, &$f1), "tink_core__Signal_Signal_Impl__14"), 'execute'));
		return $this2;
	}
}
function tink_core__Signal_Signal_Impl__9(&$cb, &$f, $result) {
	{
		$this3 = call_user_func_array($f, array($result));
		tink_core__Callback_Callback_Impl_::invoke($cb, $this3);
	}
}
function tink_core__Signal_Signal_Impl__10(&$cb, &$f, $result) {
	{
		call_user_func_array($f, array($result))->handle($cb);
	}
}
function tink_core__Signal_Signal_Impl__11(&$cb, &$f, $result) {
	{
		if(call_user_func_array($f, array($result))) {
			tink_core__Callback_Callback_Impl_::invoke($cb, $result);
		}
	}
}
function tink_core__Signal_Signal_Impl__12(&$cb, &$selector, $result) {
	{
		$_g = call_user_func_array($selector, array($result));
		switch($_g->index) {
		case 0:{
			$v = _hx_deref($_g)->params[0];
			tink_core__Callback_Callback_Impl_::invoke($cb, $v);
		}break;
		case 1:{}break;
		}
	}
}
function tink_core__Signal_Signal_Impl__13(&$cb, $a) {
	{
		tink_core__Callback_Callback_Impl_::invoke($cb, $a);
	}
}
function tink_core__Signal_Signal_Impl__14(&$a1, &$f1) {
	{
		call_user_func_array($f1, array($a1));
	}
}
