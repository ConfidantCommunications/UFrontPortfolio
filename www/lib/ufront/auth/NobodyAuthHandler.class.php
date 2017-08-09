<?php

// Generated by Haxe 3.4.2
class ufront_auth_NobodyAuthHandler implements ufront_auth_UFAuthHandler{
	public function __construct() {
		;
	}
	public function isLoggedIn() {
		return false;
	}
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
		$p = $permissions->iterator();
		while($p->hasNext()) {
			$p1 = $p->next();
			throw new HException(ufront_web_HttpError::authError(ufront_auth_AuthError::ANoPermission($p1), _hx_anonymous(array("fileName" => "NobodyAuthHandler.hx", "lineNumber" => 32, "className" => "ufront.auth.NobodyAuthHandler", "methodName" => "requirePermissions"))));
			unset($p1);
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
