<?php

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
		if($context->injector->hasMappingForType("String", "sessionName")) {
			$this->sessionName = $context->injector->getValueForType("String", "sessionName");
		} else {
			$this->sessionName = ufront_web_session_CacheSession::$defaultSessionName;
		}
		if($context->injector->hasMappingForType("Int", "sessionExpiry")) {
			$this->expiry = $context->injector->getValueForType("Int", "sessionExpiry");
		} else {
			$this->expiry = ufront_web_session_CacheSession::$defaultExpiry;
		}
		if($context->injector->hasMappingForType("String", "sessionSavePath")) {
			$this->savePath = $context->injector->getValueForType("String", "sessionSavePath");
		} else {
			$this->savePath = ufront_web_session_CacheSession::$defaultSavePath;
		}
		if($cacheConnection === null) {
			throw new HException(ufront_web_HttpError::internalServerError("No UFCacheConnection was injected into CacheSession", null, _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 166, "className" => "ufront.web.session.CacheSession", "methodName" => "injectConfig"))));
		} else {
			$this->cache = $cacheConnection->getNamespace($this->savePath);
		}
	}
	public function setExpiry($e) {
		$this->expiry = $e;
	}
	public function init() {
		$_g = $this;
		$startFreshSession = array(new _hx_lambda(array(&$_g), "ufront_web_session_CacheSession_0"), 'execute');
		if(!$this->started) {
			$this->get_id();
			if($this->sessionID === null || !ufront_web_session_CacheSession_1($this, $_g, $startFreshSession)) {
				return ufront_core_SurpriseTools::asSurprise(call_user_func($startFreshSession));
			} else {
				return tink_core__Future_Future_Impl_::map($this->cache->get($this->sessionID), array(new _hx_lambda(array(&$_g, &$startFreshSession), "ufront_web_session_CacheSession_2"), 'execute'), null);
			}
		} else {
			return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Success(tink_core_Noise::$Noise));
		}
	}
	public function commit() {
		$_g = $this;
		$oldSessionID = $this->sessionID;
		$sessionIDSurprise = null;
		if($this->sessionID === null || $this->regenerateFlag) {
			$sessionIDSurprise = $this->findNewSessionID();
		} else {
			$sessionIDSurprise = tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Success($this->sessionID));
		}
		return tink_core__Future_Future_Impl_::_tryFailingFlatMap(tink_core__Future_Future_Impl_::_tryMap(tink_core__Future_Future_Impl_::_tryFailingFlatMap(tink_core__Future_Future_Impl_::_tryFailingFlatMap(tink_core__Future_Future_Impl_::_tryMap($sessionIDSurprise, array(new _hx_lambda(array(&$_g, &$oldSessionID, &$sessionIDSurprise), "ufront_web_session_CacheSession_3"), 'execute')), array(new _hx_lambda(array(&$_g, &$oldSessionID, &$sessionIDSurprise), "ufront_web_session_CacheSession_4"), 'execute')), array(new _hx_lambda(array(&$_g, &$oldSessionID, &$sessionIDSurprise), "ufront_web_session_CacheSession_5"), 'execute')), array(new _hx_lambda(array(&$_g, &$oldSessionID, &$sessionIDSurprise), "ufront_web_session_CacheSession_6"), 'execute')), array(new _hx_lambda(array(&$_g, &$oldSessionID, &$sessionIDSurprise), "ufront_web_session_CacheSession_7"), 'execute'));
	}
	public function findNewSessionID() {
		$_g = $this;
		$tryID = ufront_core_Uuid::create();
		return tink_core__Future_Future_Impl_::flatMap($this->cache->get($tryID), array(new _hx_lambda(array(&$_g, &$tryID), "ufront_web_session_CacheSession_8"), 'execute'), null);
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
		return $this->sessionData !== null && $this->sessionData->exists($name);
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
		if($this->sessionData !== null && ($this->started || $this->get_id() !== null)) {
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
		return $this->started || $this->get_id() !== null;
	}
	public function isReady() {
		return $this->started;
	}
	public function get_id() {
		if($this->sessionID === null) {
			$this->sessionID = ufront_core__MultiValueMap_MultiValueMap_Impl_::get($this->context->request->get_cookies(), $this->sessionName);
		}
		if($this->sessionID === null) {
			$this->sessionID = ufront_core__MultiValueMap_MultiValueMap_Impl_::get($this->context->request->get_params(), $this->sessionName);
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
		return $id !== null && ufront_core_Uuid::isValid($id);
	}
	static $__properties__ = array("get_id" => "get_id");
	function __toString() { return $this->toString(); }
}
ufront_web_session_CacheSession::$__meta__ = _hx_anonymous(array("obj" => _hx_anonymous(array("rtti" => (new _hx_array(array((new _hx_array(array("injectConfig", "ufront.web.context.HttpContext", "", "", "ufront.cache.UFCacheConnection", "", ""))))))))));
function ufront_web_session_CacheSession_0(&$_g) {
	{
		$_g->regenerateID();
		$_g->sessionData = new haxe_ds_StringMap();
		$_g->started = true;
		return tink_core_Outcome::Success(tink_core_Noise::$Noise);
	}
}
function ufront_web_session_CacheSession_1(&$__hx__this, &$_g, &$startFreshSession) {
	{
		$id = $__hx__this->sessionID;
		return $id !== null && ufront_core_Uuid::isValid($id);
	}
}
function ufront_web_session_CacheSession_2(&$_g, &$startFreshSession, $outcome) {
	{
		switch($outcome->index) {
		case 0:{
			$data = _hx_deref($outcome)->params[0];
			{
				$_g->sessionData = Std::instance($data, _hx_qtype("haxe.ds.StringMap"));
				if($_g->sessionData !== null) {
					$_g->started = true;
					return tink_core_Outcome::Success(tink_core_Noise::$Noise);
				} else {
					{
						$msg = "Failed to unserialize session " . _hx_string_or_null($_g->sessionID) . " (Was " . Std::string(Type::typeof($data)) . ", expected StringMap), starting a fresh session instead.";
						$_g->context->messages->push(_hx_anonymous(array("msg" => $msg, "pos" => _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 214, "className" => "ufront.web.session.CacheSession", "methodName" => "init")), "type" => ufront_log_MessageType::$MWarning)));
					}
					return call_user_func($startFreshSession);
				}
			}
		}break;
		case 1:{
			$error = _hx_deref($outcome)->params[0];
			switch(_hx_deref($outcome)->params[0]->index) {
			case 0:{
				$_g->context->messages->push(_hx_anonymous(array("msg" => "Client requested session " . _hx_string_or_null($_g->sessionID) . ", but it did not exist in the cache. Starting a fresh session instead.", "pos" => _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 218, "className" => "ufront.web.session.CacheSession", "methodName" => "init")), "type" => ufront_log_MessageType::$MWarning)));
				return call_user_func($startFreshSession);
			}break;
			case 2:{
				$msg1 = _hx_deref(_hx_deref($outcome)->params[0])->params[0];
				{
					$_g->context->messages->push(_hx_anonymous(array("msg" => "Failed to read cache for session " . _hx_string_or_null($_g->sessionID) . ": " . _hx_string_or_null($msg1) . ". Starting a fresh session instead.", "pos" => _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 221, "className" => "ufront.web.session.CacheSession", "methodName" => "init")), "type" => ufront_log_MessageType::$MWarning)));
					return call_user_func($startFreshSession);
				}
			}break;
			default:{
				return tink_core_Outcome::Failure(tink_core_TypedError::withData(null, "Failed to initialize session", $error, _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 224, "className" => "ufront.web.session.CacheSession", "methodName" => "init"))));
			}break;
			}
		}break;
		}
	}
}
function ufront_web_session_CacheSession_3(&$_g, &$oldSessionID, &$sessionIDSurprise, $id) {
	{
		$_g->sessionID = $id;
		return tink_core_Noise::$Noise;
	}
}
function ufront_web_session_CacheSession_4(&$_g, &$oldSessionID, &$sessionIDSurprise, $_) {
	{
		if($_g->regenerateFlag) {
			$_g->commitFlag = true;
			if($oldSessionID !== null) {
				return ufront_core_SurpriseTools::changeFailureToError($_g->cache->remove($oldSessionID), null, _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 255, "className" => "ufront.web.session.CacheSession", "methodName" => "commit")));
			} else {
				return ufront_core_SurpriseTools::success();
			}
		}
		return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Success(tink_core_Noise::$Noise));
	}
}
function ufront_web_session_CacheSession_5(&$_g, &$oldSessionID, &$sessionIDSurprise, $_1) {
	{
		if($_g->commitFlag && $_g->sessionData !== null) {
			return ufront_core_SurpriseTools::changeFailureToError(ufront_web_session_CacheSession_9($_1, $_g, $oldSessionID, $sessionIDSurprise), null, _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 262, "className" => "ufront.web.session.CacheSession", "methodName" => "commit")));
		}
		return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Success(tink_core_Noise::$Noise));
	}
}
function ufront_web_session_CacheSession_6(&$_g, &$oldSessionID, &$sessionIDSurprise, $_2) {
	{
		if($_g->expiryFlag && !$_g->closeFlag) {
			$_g->setCookie($_g->sessionID, $_g->expiry);
		}
		return tink_core_Noise::$Noise;
	}
}
function ufront_web_session_CacheSession_7(&$_g, &$oldSessionID, &$sessionIDSurprise, $_3) {
	{
		if($_g->closeFlag) {
			$_g->setCookie("", -1);
			return ufront_core_SurpriseTools::changeFailureToError($_g->cache->remove($_g->sessionID), null, _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 275, "className" => "ufront.web.session.CacheSession", "methodName" => "commit")));
		}
		return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Success(tink_core_Noise::$Noise));
	}
}
function ufront_web_session_CacheSession_8(&$_g, &$tryID, $outcome) {
	{
		switch($outcome->index) {
		case 0:{
			$outcome1 = _hx_deref($outcome)->params[0];
			return $_g->findNewSessionID();
		}break;
		case 1:{
			$e = _hx_deref($outcome)->params[0];
			switch(_hx_deref($outcome)->params[0]->index) {
			case 0:{
				$_g->setCookie($tryID, $_g->expiry);
				return tink_core__Future_Future_Impl_::map($_g->cache->set($tryID, ufront_web_session_CacheSession_10($_g, $e, $outcome, $tryID)), array(new _hx_lambda(array(&$_g, &$e, &$outcome, &$tryID), "ufront_web_session_CacheSession_11"), 'execute'), null);
			}break;
			default:{
				return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Failure(tink_core_TypedError::withData(null, "Failed to find new session ID, cache error", $e, _hx_anonymous(array("fileName" => "CacheSession.hx", "lineNumber" => 297, "className" => "ufront.web.session.CacheSession", "methodName" => "findNewSessionID")))));
			}break;
			}
		}break;
		}
	}
}
function ufront_web_session_CacheSession_9(&$_1, &$_g, &$oldSessionID, &$sessionIDSurprise) {
	{
		$s = $_g->cache->set($_g->sessionID, ufront_web_session_CacheSession_12($_1, $_g, $oldSessionID, $sessionIDSurprise));
		return ufront_core_SurpriseTools::changeSuccessTo($s, tink_core_Noise::$Noise);
	}
}
function ufront_web_session_CacheSession_10(&$_g, &$e, &$outcome, &$tryID) {
	{
		$v = new haxe_ds_StringMap();
		$f = tink_core__Future_Future_Impl_::sync($v);
		return $f;
	}
}
function ufront_web_session_CacheSession_11(&$_g, &$e, &$outcome, &$tryID, $outcome2) {
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
function ufront_web_session_CacheSession_12(&$_1, &$_g, &$oldSessionID, &$sessionIDSurprise) {
	{
		$f = tink_core__Future_Future_Impl_::sync($_g->sessionData);
		return $f;
	}
}
