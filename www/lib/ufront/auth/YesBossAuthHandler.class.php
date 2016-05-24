<?php

class ufront_auth_YesBossAuthHandler implements ufront_auth_UFAuthHandler{
	public function __construct() {}
	public function isLoggedIn() {
		if(!php_Boot::$skip_constructor) {
		return true;
	}}
	public function requireLogin() {}
	public function isLoggedInAs($user) {
		return true;
	}
	public function requireLoginAs($user) {}
	public function hasPermission($permission) {
		return true;
	}
	public function hasPermissions($permissions) {
		return true;
	}
	public function requirePermission($permission) {}
	public function requirePermissions($permissions) {}
	public function toString() {
		return "YesBossAuthHandler";
	}
	public function get_currentUser() {
		return new ufront_auth_BossUser();
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
	static $__properties__ = array("get_currentUser" => "get_currentUser");
	function __toString() { return $this->toString(); }
}
