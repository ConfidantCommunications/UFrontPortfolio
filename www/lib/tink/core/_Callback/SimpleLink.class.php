<?php

// Generated by Haxe 3.4.4
class tink_core__Callback_SimpleLink implements tink_core__Callback_LinkObject{
	public function __construct($f) {
		if(!php_Boot::$skip_constructor) {
		$this->f = $f;
	}}
	public $f;
	public function dissolve() {
		if($this->f !== null) {
			$this->f();
		}
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
	function __toString() { return 'tink.core._Callback.SimpleLink'; }
}
