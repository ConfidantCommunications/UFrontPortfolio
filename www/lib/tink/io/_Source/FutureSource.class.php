<?php

// Generated by Haxe 3.4.4
class tink_io__Source_FutureSource extends tink_io_SourceBase {
	public function __construct($s) {
		if(!php_Boot::$skip_constructor) {
		$this->s = $s;
	}}
	public $s;
	public function read($into, $max = null) {
		if($max === null) {
			$max = 1073741824;
		}
		return tink_core__Future_Future_Impl_::_tryFailingFlatMap($this->s, array(new _hx_lambda(array(&$into, &$max), "tink_io__Source_FutureSource_0"), 'execute'));
	}
	public function close() {
		return tink_core__Future_Future_Impl_::_tryFailingFlatMap($this->s, array(new _hx_lambda(array(), "tink_io__Source_FutureSource_1"), 'execute'));
	}
	public function toString() {
		$ret = "PENDING";
		$this->s->handle(array(new _hx_lambda(array(&$ret), "tink_io__Source_FutureSource_2"), 'execute'));
		return "[FutureSource " . _hx_string_or_null($ret) . "]";
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
	function __toString() { return $this->toString(); }
}
function tink_io__Source_FutureSource_0(&$into, &$max, $s) {
	{
		return $s->read($into, $max);
	}
}
function tink_io__Source_FutureSource_1($s) {
	{
		return $s->close();
	}
}
function tink_io__Source_FutureSource_2(&$ret, $o) {
	{
		$ret = Std::string($o);
	}
}