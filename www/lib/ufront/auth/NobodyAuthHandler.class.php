<?php

class ufront_auth_NobodyAuthHandler implements ufront_auth_UFAuthHandler{
	public function __construct() {}
	public function isLoggedIn() {
		if(!php_Boot::$skip_constructor) {
		return false;
	}}
	public function requireLogin() {
		throw new HException(ufront_web_HttpError::authError(ufront_auth_AuthError::$ANotLoggedIn, _hx_anonymous(array("fileName" => "NobodyAuthHandler.hx", "lineNumber" => 20, "className" => "ufront.auth.NobodyAuthHandler", "methodName" => "requireLogin"))));
	}
	public function isLoggedInAs($user) {
		return false;
	}
	public function requireLoginAs($user) {
		throw new HException(ufront_web_HttpError::authError(ufront_auth_AuthError::ANotLoggedInAs($user), _hx_anonymous(array("fileName" => "NobodyAuthHandler.hx", "lineNumber" => 24, "className" => "ufront.auth.NobodyAuthHandler", "methodName" => "requireLoginAs"))));
	}
	public function hasPermission($permission) {
		return false;
	}
	public function hasPermissions($permissions) {
		return false;
	}
	public function requirePermission($permission) {
		throw new HException(ufront_web_HttpError::authError(ufront_auth_AuthError::ANoPermission($permission), _hx_anonymous(array("fileName" => "NobodyAuthHandler.hx", "lineNumber" => 30, "className" => "ufront.auth.NobodyAuthHandler", "methodName" => "requirePermission"))));
	}
	public function requirePermissions($permissions) {
		if(null == $permissions) throw new HException('null iterable');
		$__hx__it = $permissions->iterator();
		while($__hx__it->hasNext()) {
			unset($p);
			$p = $__hx__it->next();
			throw new HException(ufront_web_HttpError::authError(ufront_auth_AuthError::ANoPermission($p), _hx_anonymous(array("fileName" => "NobodyAuthHandler.hx", "lineNumber" => 32, "className" => "ufront.auth.NobodyAuthHandler", "methodName" => "requirePermissions"))));
		}
	}
	public function toString() {
		return "NobodyAuthHandler";
	}
	public function get_currentUser() {
		return null;
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
