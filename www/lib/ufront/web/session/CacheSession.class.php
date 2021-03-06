<?php

// Generated by Haxe 3.4.4
class ufront_web_session_CacheSession implements ufront_web_session_UFHttpSession{
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->started = false;
		$this->commitFlag = false;
		$this->closeFlag = false;
		$this->regenerateFlag = false;
		$this->expiryFlag = false;
		$this->sessionData = null;
		$this->sessionID = null;
		$this->oldSessionID = null;
	}}
	public $started;
	public $commitFlag;
	public $closeFlag;
	public $regenerateFlag;
	public $expiryFlag;
	public $sessionID;
	public $oldSessionID;
	public $sessionData;
	public $cache;
	public $context;
	public $sessionName;
	public $expiry;
	public $savePath;
	public function injectConfig($context, $cacheConnection) {
		$this->context = $context;
		$tmp = null;
		if($context->injector->hasMappingForType("String", "sessionName")) {
			$tmp = $context->injector->getValueForType("String", "sessionName");
		} else {
			$tmp = ufront_web_session_CacheSession::$defaultSessionName;
		}
		$this->sessionName = $tmp;
		$tmp1 = null;
		if($context->injector->hasMappingForType("Int", "sessionExpiry")) {
			$tmp1 = $context->injector->getValueForType("Int", "sessionExpiry");
		} else {
			$tmp1 = ufront_web_session_CacheSession::$defaultExpiry;
		}
		$this->expiry = $tmp1;
		$tmp2 = null;
		if($context->injector->hasMappingForType("String", "sessionSavePath")) {
			$tmp2 = $context->injector->getValueForType("String", "sessionSavePath");
		} else {
			$tmp2 = ufront_web_session_CacheSession::$defaultSavePath;
		}
		$this->savePath = $tmp2;
		$tmp3 = null;
		if($cacheConnection === null) {
			throw new HException(ufront_web_HttpError::internalServerError("No UFCacheConnection was injected into CacheSession", null, _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 166, "className" => "ufront.web.session.CacheSession", "methodName" => "injectConfig"))));
		} else {
			$tmp3 = $cacheConnection->getNamespace($this->savePath);
		}
		$this->cache = $tmp3;
	}
	public function setExpiry($e) {
		$this->expiry = $e;
	}
	public function init() {
		$_gthis = $this;
		$startFreshSession = array(new _hx_lambda(array(&$_gthis), "ufront_web_session_CacheSession_0"), 'execute');
		if(!$this->started) {
			$this->get_id();
			$tmp = null;
			if($this->sessionID !== null) {
				$id = $this->sessionID;
				$tmp1 = null;
				if($id !== null) {
					$tmp1 = ufront_core_Uuid::isValid($id);
				} else {
					$tmp1 = false;
				}
				$tmp = !$tmp1;
			} else {
				$tmp = true;
			}
			if($tmp) {
				return ufront_core_SurpriseTools::asSurprise(call_user_func($startFreshSession));
			} else {
				return tink_core__Future_Future_Impl_::map($this->cache->get($this->sessionID), array(new _hx_lambda(array(&$_gthis, &$startFreshSession), "ufront_web_session_CacheSession_1"), 'execute'), null);
			}
		} else {
			return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Success(tink_core_Noise::$Noise));
		}
	}
	public function commit() {
		$_gthis = $this;
		$oldSessionID = $this->sessionID;
		$sessionIDSurprise = null;
		$sessionIDSurprise1 = null;
		if($this->sessionID !== null) {
			$sessionIDSurprise1 = $this->regenerateFlag;
		} else {
			$sessionIDSurprise1 = true;
		}
		if($sessionIDSurprise1) {
			$sessionIDSurprise = $this->findNewSessionID();
		} else {
			$sessionIDSurprise = tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Success($this->sessionID));
		}
		return tink_core__Future_Future_Impl_::_tryFailingFlatMap(tink_core__Future_Future_Impl_::_tryMap(tink_core__Future_Future_Impl_::_tryFailingFlatMap(tink_core__Future_Future_Impl_::_tryFailingFlatMap(tink_core__Future_Future_Impl_::_tryMap($sessionIDSurprise, array(new _hx_lambda(array(&$_gthis), "ufront_web_session_CacheSession_2"), 'execute')), array(new _hx_lambda(array(&$_gthis, &$oldSessionID), "ufront_web_session_CacheSession_3"), 'execute')), array(new _hx_lambda(array(&$_gthis), "ufront_web_session_CacheSession_4"), 'execute')), array(new _hx_lambda(array(&$_gthis), "ufront_web_session_CacheSession_5"), 'execute')), array(new _hx_lambda(array(&$_gthis), "ufront_web_session_CacheSession_6"), 'execute'));
	}
	public function findNewSessionID() {
		$_gthis = $this;
		$tryID = ufront_core_Uuid::create();
		return tink_core__Future_Future_Impl_::flatMap($this->cache->get($tryID), array(new _hx_lambda(array(&$_gthis, &$tryID), "ufront_web_session_CacheSession_7"), 'execute'), null);
	}
	public function setCookie($id, $expiryLength) {
		$expireAt = null;
		if($expiryLength <= 0) {
			$expireAt = null;
		} else {
			$d = Date::now();
			$expireAt = Date::fromTime($d->getTime() + 1000.0 * $expiryLength);
		}
		$path = "/";
		$domain = null;
		$secure = false;
		$sessionCookie = new ufront_web_HttpCookie($this->sessionName, $id, $expireAt, $domain, $path, $secure, null);
		if($expiryLength < 0) {
			$sessionCookie->expireNow();
		}
		$this->context->response->setCookie($sessionCookie);
	}
	public function get($name) {
		if(!$this->started) {
			throw new HException(ufront_web_HttpError::internalServerError("Trying to access session data before calling init()", _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 320, "className" => "ufront.web.session.CacheSession", "methodName" => "get")), _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 428, "className" => "ufront.web.session.CacheSession", "methodName" => "checkStarted"))));
		}
		if($this->sessionData !== null) {
			return $this->sessionData->get($name);
		} else {
			return null;
		}
	}
	public function set($name, $value) {
		if(!$this->started) {
			throw new HException(ufront_web_HttpError::internalServerError("Trying to access session data before calling init()", _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 332, "className" => "ufront.web.session.CacheSession", "methodName" => "set")), _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 428, "className" => "ufront.web.session.CacheSession", "methodName" => "checkStarted"))));
		}
		if($this->sessionData !== null) {
			$this->sessionData->set($name, $value);
			$this->commitFlag = true;
		}
	}
	public function exists($name) {
		if(!$this->started) {
			throw new HException(ufront_web_HttpError::internalServerError("Trying to access session data before calling init()", _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 345, "className" => "ufront.web.session.CacheSession", "methodName" => "exists")), _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 428, "className" => "ufront.web.session.CacheSession", "methodName" => "checkStarted"))));
		}
		if($this->sessionData !== null) {
			return $this->sessionData->exists($name);
		} else {
			return false;
		}
	}
	public function remove($name) {
		if(!$this->started) {
			throw new HException(ufront_web_HttpError::internalServerError("Trying to access session data before calling init()", _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 355, "className" => "ufront.web.session.CacheSession", "methodName" => "remove")), _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 428, "className" => "ufront.web.session.CacheSession", "methodName" => "checkStarted"))));
		}
		if($this->sessionData !== null) {
			$this->sessionData->remove($name);
			$this->commitFlag = true;
		}
	}
	public function clear() {
		$tmp = null;
		if($this->sessionData !== null) {
			if(!$this->started) {
				$tmp = $this->get_id() !== null;
			} else {
				$tmp = true;
			}
		} else {
			$tmp = false;
		}
		if($tmp) {
			$this->sessionData = new haxe_ds_StringMap();
			$this->commitFlag = true;
		}
	}
	public function triggerCommit() {
		$this->commitFlag = true;
	}
	public function regenerateID() {
		$this->regenerateFlag = true;
	}
	public function isActive() {
		if(!$this->started) {
			return $this->get_id() !== null;
		} else {
			return true;
		}
	}
	public function isReady() {
		return $this->started;
	}
	public function get_id() {
		if($this->sessionID === null) {
			$tmp = $this->context->request->get_cookies();
			$this->sessionID = ufront_core__MultiValueMap_MultiValueMap_Impl_::get($tmp, $this->sessionName);
		}
		if($this->sessionID === null) {
			$tmp1 = $this->context->request->get_params();
			$this->sessionID = ufront_core__MultiValueMap_MultiValueMap_Impl_::get($tmp1, $this->sessionName);
		}
		return $this->sessionID;
	}
	public function close() {
		if(!$this->started) {
			throw new HException(ufront_web_HttpError::internalServerError("Trying to access session data before calling init()", _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 411, "className" => "ufront.web.session.CacheSession", "methodName" => "close")), _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 428, "className" => "ufront.web.session.CacheSession", "methodName" => "checkStarted"))));
		}
		$this->sessionData = null;
		$this->closeFlag = true;
	}
	public function toString() {
		if($this->sessionData !== null) {
			return $this->sessionData->toString();
		} else {
			return "{}";
		}
	}
	public function generateSessionID() {
		return ufront_core_Uuid::create();
	}
	public function checkStarted($pos = null) {
		if(!$this->started) {
			throw new HException(ufront_web_HttpError::internalServerError("Trying to access session data before calling init()", $pos, _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 428, "className" => "ufront.web.session.CacheSession", "methodName" => "checkStarted"))));
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
	static function __meta__() { $args = func_get_args(); return call_user_func_array(self::$__meta__, $args); }
	static $__meta__;
	static $defaultSessionName = "UfrontSessionID";
	static $defaultSavePath = "sessions";
	static $defaultExpiry = 0;
	static function isValidID($id) {
		if($id !== null) {
			return ufront_core_Uuid::isValid($id);
		} else {
			return false;
		}
	}
	static $__properties__ = array("get_id" => "get_id");
	function __toString() { return $this->toString(); }
}
ufront_web_session_CacheSession::$__meta__ = _hx_anonymous(array("obj" => _hx_anonymous(array("rtti" => (new _hx_array(array((new _hx_array(array("injectConfig", "ufront.web.context.HttpContext", "", "", "ufront.cache.UFCacheConnection", "", ""))))))))));
function ufront_web_session_CacheSession_0(&$_gthis) {
	{
		$_gthis->regenerateID();
		$_gthis->sessionData = new haxe_ds_StringMap();
		$_gthis->started = true;
		return tink_core_Outcome::Success(tink_core_Noise::$Noise);
	}
}
function ufront_web_session_CacheSession_1(&$_gthis, &$startFreshSession, $outcome) {
	{
		switch($outcome->index) {
		case 0:{
			$data = _hx_deref($outcome)->params[0];
			$_gthis->sessionData = Std::instance($data, _hx_qtype("haxe.ds.StringMap"));
			if($_gthis->sessionData !== null) {
				$_gthis->started = true;
				return tink_core_Outcome::Success(tink_core_Noise::$Noise);
			} else {
				{
					$_this = $_gthis->context;
					$msg = "Failed to unserialize session " . _hx_string_or_null($_gthis->sessionID) . " (Was ";
					$msg1 = _hx_string_or_null($msg) . Std::string(Type::typeof($data)) . ", expected StringMap), starting a fresh session instead.";
					$_this->messages->push(_hx_anonymous(array("msg" => $msg1, "pos" => _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 214, "className" => "ufront.web.session.CacheSession", "methodName" => "init")), "type" => ufront_log_MessageType::$MWarning)));
				}
				return call_user_func($startFreshSession);
			}
		}break;
		case 1:{
			switch(_hx_deref($outcome)->params[0]->index) {
			case 0:{
				$_gthis->context->messages->push(_hx_anonymous(array("msg" => "Client requested session " . _hx_string_or_null($_gthis->sessionID) . ", but it did not exist in the cache. Starting a fresh session instead.", "pos" => _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 218, "className" => "ufront.web.session.CacheSession", "methodName" => "init")), "type" => ufront_log_MessageType::$MWarning)));
				return call_user_func($startFreshSession);
			}break;
			case 2:{
				$msg2 = _hx_deref(_hx_deref($outcome)->params[0])->params[0];
				$_gthis->context->messages->push(_hx_anonymous(array("msg" => "Failed to read cache for session " . _hx_string_or_null($_gthis->sessionID) . ": " . _hx_string_or_null($msg2) . ". Starting a fresh session instead.", "pos" => _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 221, "className" => "ufront.web.session.CacheSession", "methodName" => "init")), "type" => ufront_log_MessageType::$MWarning)));
				return call_user_func($startFreshSession);
			}break;
			default:{
				$error = _hx_deref($outcome)->params[0];
				return tink_core_Outcome::Failure(tink_core_TypedError::withData(null, "Failed to initialize session", $error, _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 224, "className" => "ufront.web.session.CacheSession", "methodName" => "init"))));
			}break;
			}
		}break;
		}
	}
}
function ufront_web_session_CacheSession_2(&$_gthis, $id) {
	{
		$_gthis->sessionID = $id;
		return tink_core_Noise::$Noise;
	}
}
function ufront_web_session_CacheSession_3(&$_gthis, &$oldSessionID, $_) {
	{
		if($_gthis->regenerateFlag) {
			$_gthis->commitFlag = true;
			if($oldSessionID !== null) {
				$tmp = $_gthis->cache->remove($oldSessionID);
				return ufront_core_SurpriseTools::changeFailureToError($tmp, null, _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 255, "className" => "ufront.web.session.CacheSession", "methodName" => "commit")));
			} else {
				return ufront_core_SurpriseTools::success();
			}
		}
		return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Success(tink_core_Noise::$Noise));
	}
}
function ufront_web_session_CacheSession_4(&$_gthis, $_1) {
	{
		$tmp1 = null;
		if($_gthis->commitFlag) {
			$tmp1 = $_gthis->sessionData !== null;
		} else {
			$tmp1 = false;
		}
		if($tmp1) {
			$_gthis1 = $_gthis->cache;
			$_gthis2 = $_gthis->sessionID;
			$this1 = tink_core__Future_Future_Impl_::sync($_gthis->sessionData);
			$tmp2 = ufront_core_SurpriseTools::changeSuccessTo($_gthis1->set($_gthis2, $this1), tink_core_Noise::$Noise);
			return ufront_core_SurpriseTools::changeFailureToError($tmp2, null, _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 262, "className" => "ufront.web.session.CacheSession", "methodName" => "commit")));
		}
		return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Success(tink_core_Noise::$Noise));
	}
}
function ufront_web_session_CacheSession_5(&$_gthis, $_2) {
	{
		$tmp3 = null;
		if($_gthis->expiryFlag) {
			$tmp3 = !$_gthis->closeFlag;
		} else {
			$tmp3 = false;
		}
		if($tmp3) {
			$_gthis->setCookie($_gthis->sessionID, $_gthis->expiry);
		}
		return tink_core_Noise::$Noise;
	}
}
function ufront_web_session_CacheSession_6(&$_gthis, $_3) {
	{
		if($_gthis->closeFlag) {
			$_gthis->setCookie("", -1);
			$tmp4 = $_gthis->cache->remove($_gthis->sessionID);
			return ufront_core_SurpriseTools::changeFailureToError($tmp4, null, _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 275, "className" => "ufront.web.session.CacheSession", "methodName" => "commit")));
		}
		return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Success(tink_core_Noise::$Noise));
	}
}
function ufront_web_session_CacheSession_7(&$_gthis, &$tryID, $outcome) {
	{
		switch($outcome->index) {
		case 0:{
			$outcome1 = _hx_deref($outcome)->params[0];
			return $_gthis->findNewSessionID();
		}break;
		case 1:{
			if(_hx_deref($outcome)->params[0]->index === 0) {
				$_gthis->setCookie($tryID, $_gthis->expiry);
				$_gthis1 = $_gthis->cache;
				$v = new haxe_ds_StringMap();
				$this1 = tink_core__Future_Future_Impl_::sync($v);
				return tink_core__Future_Future_Impl_::map($_gthis1->set($tryID, $this1), array(new _hx_lambda(array(&$tryID), "ufront_web_session_CacheSession_8"), 'execute'), null);
			} else {
				$e = _hx_deref($outcome)->params[0];
				return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Failure(tink_core_TypedError::withData(null, "Failed to find new session ID, cache error", $e, _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 297, "className" => "ufront.web.session.CacheSession", "methodName" => "findNewSessionID")))));
			}
		}break;
		}
	}
}
function ufront_web_session_CacheSession_8(&$tryID, $outcome2) {
	{
		switch($outcome2->index) {
		case 0:{
			return tink_core_Outcome::Success($tryID);
		}break;
		case 1:{
			$err = _hx_deref($outcome2)->params[0];
			return tink_core_Outcome::Failure(tink_core_TypedError::withData(null, "Failed to reserve session ID " . _hx_string_or_null($tryID), $err, _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 294, "className" => "ufront.web.session.CacheSession", "methodName" => "findNewSessionID"))));
		}break;
		}
	}
}
