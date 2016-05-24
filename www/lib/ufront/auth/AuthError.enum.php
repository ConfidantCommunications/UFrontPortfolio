<?php

class ufront_auth_AuthError extends Enum {
	public static function ALoginFailed($msg) { return new ufront_auth_AuthError("ALoginFailed", 1, array($msg)); }
	public static function ANoPermission($p) { return new ufront_auth_AuthError("ANoPermission", 3, array($p)); }
	public static $ANotLoggedIn;
	public static function ANotLoggedInAs($u) { return new ufront_auth_AuthError("ANotLoggedInAs", 2, array($u)); }
	public static $__constructors = array(1 => 'ALoginFailed', 3 => 'ANoPermission', 0 => 'ANotLoggedIn', 2 => 'ANotLoggedInAs');
	}
ufront_auth_AuthError::$ANotLoggedIn = new ufront_auth_AuthError("ANotLoggedIn", 0);
