<?php

class ufront_web_session_FileSession implements ufront_web_session_UFHttpSession{
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->started = false;
		$this->commitFlag = false;
		$this->closeFlag = false;
		$this->regenerateFlag = false;
		$this->expiryFlag = false;
		$this->sessionData = null;
		$this->sessionID = null;
	}}
	public $started;
	public $commitFlag;
	public $closeFlag;
	public $regenerateFlag;
	public $expiryFlag;
	public $sessionID;
	public $sessionData;
	public $context;
	public function injectConfig($context) {
		if($context->injector->hasMappingForType("String", "sessionName")) {
			$this->sessionName = $context->injector->getValueForType("String", "sessionName");
		} else {
			$this->sessionName = ufront_web_session_FileSession::$defaultSessionName;
		}
		if($context->injector->hasMappingForType("Int", "sessionExpiry")) {
			$this->expiry = $context->injector->getValueForType("Int", "sessionExpiry");
		} else {
			$this->expiry = ufront_web_session_FileSession::$defaultExpiry;
		}
		if($context->injector->hasMappingForType("String", "sessionSavePath")) {
			$this->savePath = $context->injector->getValueForType("String", "sessionSavePath");
		} else {
			$this->savePath = ufront_web_session_FileSession::$defaultSavePath;
		}
		$this->savePath = haxe_io_Path::addTrailingSlash($this->savePath);
		if(!StringTools::startsWith($this->savePath, "/")) {
			$this->savePath = _hx_string_or_null($context->get_contentDirectory()) . _hx_string_or_null($this->savePath);
		}
	}
	public $sessionName;
	public $expiry;
	public $savePath;
	public function setExpiry($e) {
		$this->expiry = $e;
	}
	public function init() {
		$_g = $this;
		if(!$this->started) {
			$this->get_id();
			$this->sessionData = new haxe_ds_StringMap();
			return tink_core__Future_Future_Impl_::_tryMap(tink_core__Future_Future_Impl_::_tryMap(tink_core__Future_Future_Impl_::_tryFailingFlatMap($this->doCreateSessionDirectory(), (isset($this->doReadSessionFile) ? $this->doReadSessionFile: array($this, "doReadSessionFile"))), (isset($this->doUnserializeSessionData) ? $this->doUnserializeSessionData: array($this, "doUnserializeSessionData"))), array(new _hx_lambda(array(&$_g), "ufront_web_session_FileSession_0"), 'execute'));
		} else {
			return ufront_core_SurpriseTools::success();
		}
	}
	public function doCreateSessionDirectory() {
		$dir = haxe_io_Path::removeTrailingSlashes($this->savePath);
		return ufront_core_SurpriseTools::tryCatchSurprise(array(new _hx_lambda(array(&$dir), "ufront_web_session_FileSession_1"), 'execute'), "Failed to create directory " . _hx_string_or_null($dir), _hx_anonymous(array("fileName" => "FileSession.hx", "lineNumber" => 203, "className" => "ufront.web.session.FileSession", "methodName" => "doCreateSessionDirectory")));
	}
	public function doReadSessionFile($_) {
		if(ufront_web_session_FileSession_2($this, $_)) {
			$filename = "" . _hx_string_or_null($this->savePath) . _hx_string_or_null($this->sessionID) . ".sess";
			try {
				return ufront_core_SurpriseTools::asGoodSurprise(sys_io_File::getContent($filename));
			}catch(Exception $__hx__e) {
				$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
				$e = $_ex_;
				{
					return ufront_core_SurpriseTools::asGoodSurprise(null);
				}
			}
		} else {
			$this->context->messages->push(_hx_anonymous(array("msg" => "Session ID " . _hx_string_or_null($this->sessionID) . " was invalid, resetting session.", "pos" => _hx_anonymous(array("fileName" => "FileSession.hx", "lineNumber" => 243, "className" => "ufront.web.session.FileSession", "methodName" => "doReadSessionFile")), "type" => ufront_log_MessageType::$MWarning)));
			$this->sessionID = null;
			return ufront_core_SurpriseTools::asGoodSurprise(null);
		}
	}
	public function doUnserializeSessionData($content) {
		if($content !== null) {
			try {
				$this->sessionData = haxe_Unserializer::run($content);
			}catch(Exception $__hx__e) {
				$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
				$e = $_ex_;
				{
					$this->context->messages->push(_hx_anonymous(array("msg" => "Failed to unserialize session data: " . Std::string($e), "pos" => _hx_anonymous(array("fileName" => "FileSession.hx", "lineNumber" => 256, "className" => "ufront.web.session.FileSession", "methodName" => "doUnserializeSessionData")), "type" => ufront_log_MessageType::$MWarning)));
				}
			}
		}
		return tink_core_Noise::$Noise;
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
	public function commit() {
		if($this->sessionID === null && $this->sessionData !== null) {
			$this->regenerateID();
		}
		return tink_core__Future_Future_Impl_::_tryFailingFlatMap(tink_core__Future_Future_Impl_::_tryFailingFlatMap(tink_core__Future_Future_Impl_::_tryFailingFlatMap($this->doRegenerateID(), (isset($this->doSaveSessionContent) ? $this->doSaveSessionContent: array($this, "doSaveSessionContent"))), (isset($this->doSetExpiry) ? $this->doSetExpiry: array($this, "doSetExpiry"))), (isset($this->doCloseSession) ? $this->doCloseSession: array($this, "doCloseSession")));
	}
	public function doRegenerateID() {
		$_g = $this;
		if($this->regenerateFlag) {
			$oldSessionID = $this->sessionID;
			return ufront_core_SurpriseTools::tryCatchSurprise(array(new _hx_lambda(array(&$_g, &$oldSessionID), "ufront_web_session_FileSession_3"), 'execute'), null, _hx_anonymous(array("fileName" => "FileSession.hx", "lineNumber" => 295, "className" => "ufront.web.session.FileSession", "methodName" => "doRegenerateID")));
		} else {
			return ufront_core_SurpriseTools::success();
		}
	}
	public function doSaveSessionContent($_) {
		if($this->commitFlag && $this->sessionData !== null) {
			$filePath = "" . _hx_string_or_null($this->savePath) . _hx_string_or_null($this->sessionID) . ".sess";
			$content = null;
			try {
				$content = haxe_Serializer::run($this->sessionData);
			}catch(Exception $__hx__e) {
				$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
				$e = $_ex_;
				{
					return $e->asSurpriseError("Failed to serialize session content");
				}
			}
			return ufront_core_SurpriseTools::tryCatchSurprise(array(new _hx_lambda(array(&$_, &$content, &$e, &$filePath), "ufront_web_session_FileSession_4"), 'execute'), null, _hx_anonymous(array("fileName" => "FileSession.hx", "lineNumber" => 344, "className" => "ufront.web.session.FileSession", "methodName" => "doSaveSessionContent")));
		} else {
			return ufront_core_SurpriseTools::success();
		}
	}
	public function doSetExpiry($_) {
		if($this->expiryFlag) {
			$this->setCookie($this->sessionID, $this->expiry);
		}
		return ufront_core_SurpriseTools::success();
	}
	public function doCloseSession($_) {
		if($this->closeFlag) {
			$this->setCookie("", -1);
			$filename = "" . _hx_string_or_null($this->savePath) . _hx_string_or_null($this->sessionID) . ".sess";
			return ufront_core_SurpriseTools::tryCatchSurprise(array(new _hx_lambda(array(&$_, &$filename), "ufront_web_session_FileSession_5"), 'execute'), null, _hx_anonymous(array("fileName" => "FileSession.hx", "lineNumber" => 369, "className" => "ufront.web.session.FileSession", "methodName" => "doCloseSession")));
		} else {
			return ufront_core_SurpriseTools::success();
		}
	}
	public function get($name) {
		if(!$this->started) {
			throw new HException(ufront_web_HttpError::internalServerError("Trying to access session data before init() has been run", null, _hx_anonymous(array("fileName" => "FileSession.hx", "lineNumber" => 502, "className" => "ufront.web.session.FileSession", "methodName" => "checkStarted"))));
		}
		if($this->sessionData !== null) {
			return $this->sessionData->get($name);
		} else {
			return null;
		}
	}
	public function set($name, $value) {
		if(!$this->started) {
			throw new HException(ufront_web_HttpError::internalServerError("Trying to access session data before init() has been run", null, _hx_anonymous(array("fileName" => "FileSession.hx", "lineNumber" => 502, "className" => "ufront.web.session.FileSession", "methodName" => "checkStarted"))));
		}
		if($this->sessionData !== null) {
			$this->sessionData->set($name, $value);
			$this->commitFlag = true;
		}
	}
	public function exists($name) {
		if(!$this->started) {
			throw new HException(ufront_web_HttpError::internalServerError("Trying to access session data before init() has been run", null, _hx_anonymous(array("fileName" => "FileSession.hx", "lineNumber" => 502, "className" => "ufront.web.session.FileSession", "methodName" => "checkStarted"))));
		}
		return $this->sessionData !== null && $this->sessionData->exists($name);
	}
	public function remove($name) {
		if(!$this->started) {
			throw new HException(ufront_web_HttpError::internalServerError("Trying to access session data before init() has been run", null, _hx_anonymous(array("fileName" => "FileSession.hx", "lineNumber" => 502, "className" => "ufront.web.session.FileSession", "methodName" => "checkStarted"))));
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
			throw new HException(ufront_web_HttpError::internalServerError("Trying to access session data before init() has been run", null, _hx_anonymous(array("fileName" => "FileSession.hx", "lineNumber" => 502, "className" => "ufront.web.session.FileSession", "methodName" => "checkStarted"))));
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
	public function getSessionFilePath($id) {
		return "" . _hx_string_or_null($this->savePath) . _hx_string_or_null($id) . ".sess";
	}
	public function generateSessionID() {
		return ufront_core_Uuid::create();
	}
	public function checkStarted($pos = null) {
		if(!$this->started) {
			throw new HException(ufront_web_HttpError::internalServerError("Trying to access session data before init() has been run", null, _hx_anonymous(array("fileName" => "FileSession.hx", "lineNumber" => 502, "className" => "ufront.web.session.FileSession", "methodName" => "checkStarted"))));
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
	static $defaultSavePath = "sessions/";
	static $defaultExpiry = 0;
	static function testValidId($id) {
		return $id !== null && ufront_core_Uuid::isValid($id);
	}
	static function notImplemented($p = null) {
		return ufront_core_SurpriseTools::asSurpriseError("FileSession is not implemented on this platform", null, $p);
	}
	static $__properties__ = array("get_id" => "get_id");
	function __toString() { return $this->toString(); }
}
ufront_web_session_FileSession::$__meta__ = _hx_anonymous(array("obj" => _hx_anonymous(array("rtti" => (new _hx_array(array((new _hx_array(array("context", "ufront.web.context.HttpContext", ""))), (new _hx_array(array("injectConfig", "ufront.web.context.HttpContext", "", ""))))))))));
function ufront_web_session_FileSession_0(&$_g, $n) {
	{
		$_g->started = true;
		return tink_core_Noise::$Noise;
	}
}
function ufront_web_session_FileSession_1(&$dir) {
	{
		if(file_exists($dir) === false) {
			$path = haxe_io_Path::addTrailingSlash($dir);
			$_p = null;
			$parts = (new _hx_array(array()));
			while($path !== ($_p = haxe_io_Path::directory($path))) {
				$parts->unshift($path);
				$path = $_p;
			}
			{
				$_g = 0;
				while($_g < $parts->length) {
					$part = $parts[$_g];
					++$_g;
					if(_hx_char_code_at($part, strlen($part) - 1) !== 58 && !file_exists($part)) {
						@mkdir($part, 493);
					}
					unset($part);
				}
			}
		}
		return tink_core_Noise::$Noise;
	}
}
function ufront_web_session_FileSession_2(&$__hx__this, &$_) {
	{
		$id = $__hx__this->sessionID;
		return $id !== null && ufront_core_Uuid::isValid($id);
	}
}
function ufront_web_session_FileSession_3(&$_g, &$oldSessionID) {
	{
		$file = null;
		do {
			$_g->sessionID = ufront_core_Uuid::create();
			$file = "" . _hx_string_or_null($_g->savePath) . _hx_string_or_null($_g->sessionID) . ".sess";
		} while(file_exists($file));
		$_g->setCookie($_g->sessionID, $_g->expiry);
		if($oldSessionID !== null) {
			rename("" . _hx_string_or_null($_g->savePath) . _hx_string_or_null($oldSessionID) . ".sess", $file);
		} else {
			sys_io_File::saveContent($file, "");
		}
		return tink_core_Noise::$Noise;
	}
}
function ufront_web_session_FileSession_4(&$_, &$content, &$e, &$filePath) {
	{
		sys_io_File::saveContent($filePath, $content);
		return tink_core_Noise::$Noise;
	}
}
function ufront_web_session_FileSession_5(&$_, &$filename) {
	{
		@unlink($filename);
		return tink_core_Noise::$Noise;
	}
}
