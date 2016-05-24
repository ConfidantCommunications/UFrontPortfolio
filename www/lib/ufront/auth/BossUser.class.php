<?php

class ufront_auth_BossUser implements ufront_auth_UFAuthUser{
	public function __construct() {}
	public $userID;
	public function can($p = null, $ps = null) {
		if(!php_Boot::$skip_constructor) {
		return true;
	}}
	public function get_userID() {
		return "The Boss";
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
	static $__properties__ = array("get_userID" => "get_userID");
	function __toString() { return 'ufront.auth.BossUser'; }
}
