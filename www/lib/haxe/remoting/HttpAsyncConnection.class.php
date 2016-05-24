<?php

class haxe_remoting_HttpAsyncConnection implements haxe_remoting_AsyncConnection{
	public function __construct($data, $path) {
		if(!php_Boot::$skip_constructor) {
		$this->__data = $data;
		$this->__path = $path;
	}}
	public $__data;
	public $__path;
	public $__dynamics = array();
	public function __get($n) {
		if(isset($this->__dynamics[$n]))
			return $this->__dynamics[$n];
	}
	public function __set($n, $v) {
		$this->__dynamics[$n] = $v;
	}
	public function __call($n, $a) {
		if(isset($this->__dynamics[$n]) && is_callable($this->__dynamics[$n]))
			return call_user_func_array($this->__dynamics[$n], $a);
		if('toString' == $n)
			return $this->__toString();
		throw new HException("Unable to call <".$n.">");
	}
	function __toString() { return 'haxe.remoting.HttpAsyncConnection'; }
}
