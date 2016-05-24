<?php

class ufront_web_context_HttpContext {
	public function __construct($request, $response, $appInjector = null, $session = null, $auth = null, $urlFilters = null, $relativeContentDir = null) {
		if(!php_Boot::$skip_constructor) {
		if($relativeContentDir === null) {
			$relativeContentDir = "uf-content";
		}
		ufront_web_HttpError::throwIfNull($response, null, _hx_anonymous(array("fileName" => "HttpContext.hx", "lineNumber" => 214, "className" => "ufront.web.context.HttpContext", "methodName" => "new")));
		ufront_web_HttpError::throwIfNull($request, null, _hx_anonymous(array("fileName" => "HttpContext.hx", "lineNumber" => 215, "className" => "ufront.web.context.HttpContext", "methodName" => "new")));
		$this->request = $request;
		$this->response = $response;
		if($urlFilters !== null) {
			$this->urlFilters = $urlFilters;
		} else {
			$this->urlFilters = (new _hx_array(array()));
		}
		$this->_relativeContentDir = $relativeContentDir;
		$this->actionContext = new ufront_web_context_ActionContext($this);
		$this->messages = (new _hx_array(array()));
		$this->completion = 0;
		if($appInjector !== null) {
			$this->injector = $appInjector->createChildInjector();
		} else {
			$this->injector = new minject_Injector(null);
		}
		$this->injector->mapType("ufront.web.context.HttpContext", null, null)->toValue($this);
		$this->injector->mapType("ufront.web.context.HttpRequest", null, null)->toValue($request);
		$this->injector->mapType("ufront.web.context.HttpResponse", null, null)->toValue($response);
		$this->injector->mapType("ufront.web.context.ActionContext", null, null)->toValue($this->actionContext);
		$this->injector->mapType("ufront.log.MessageList", null, null)->toValue(new ufront_log_MessageList($this->messages, null));
		$this->injector->mapType("minject.Injector", null, null)->toValue($this->injector);
		if($session !== null) {
			$this->session = $session;
		}
		if($this->session === null) {
			try {
				$this->session = $this->injector->getValueForType("ufront.web.session.UFHttpSession", null);
			}catch(Exception $__hx__e) {
				$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
				$e = $_ex_;
				{
					$msg = "Failed to load UFHttpSession: " . Std::string($e) . ". Using VoidSession instead." . _hx_string_or_null(haxe_CallStack::toString(haxe_CallStack::exceptionStack()));
					$this->messages->push(_hx_anonymous(array("msg" => $msg, "pos" => _hx_anonymous(array("fileName" => "HttpContext.hx", "lineNumber" => 236, "className" => "ufront.web.context.HttpContext", "methodName" => "new")), "type" => ufront_log_MessageType::$MLog)));
				}
			}
		}
		if($this->session === null) {
			$this->session = new ufront_web_session_VoidSession();
		}
		$this->injector->mapType("ufront.web.session.UFHttpSession", null, null)->toValue($this->session);
		$this->injector->mapRuntimeTypeOf($this->session, null)->toValue($this->session);
		if($auth !== null) {
			$this->auth = $auth;
		}
		if($this->auth === null) {
			try {
				$this->auth = $this->injector->getValueForType("ufront.auth.UFAuthHandler", null);
			}catch(Exception $__hx__e) {
				$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
				$e1 = $_ex_;
				{
					$msg1 = "Failed to load UFAuthHandler: " . Std::string($e1) . ". Using NobodyAuthHandler instead." . _hx_string_or_null(haxe_CallStack::toString(haxe_CallStack::exceptionStack()));
					$this->messages->push(_hx_anonymous(array("msg" => $msg1, "pos" => _hx_anonymous(array("fileName" => "HttpContext.hx", "lineNumber" => 244, "className" => "ufront.web.context.HttpContext", "methodName" => "new")), "type" => ufront_log_MessageType::$MLog)));
				}
			}
		}
		if($this->auth === null) {
			$this->auth = new ufront_auth_NobodyAuthHandler();
		}
		$this->injector->mapType("ufront.auth.UFAuthHandler", null, null)->toValue($this->auth);
		$this->injector->mapRuntimeTypeOf($this->auth, null)->toValue($this->auth);
	}}
	public $injector;
	public $request;
	public $response;
	public $session;
	public $sessionID;
	public $auth;
	public $currentUser;
	public $currentUserID;
	public $actionContext;
	public $completion;
	public $urlFilters;
	public $messages;
	public $contentDirectory;
	public $_requestUri;
	public $_relativeContentDir;
	public $_contentDir;
	public function getRequestUri() {
		if(null === $this->_requestUri) {
			$url = ufront_web_url_PartialUrl::parse($this->request->get_uri());
			{
				$_g = 0;
				$_g1 = $this->urlFilters;
				while($_g < $_g1->length) {
					$filter = $_g1[$_g];
					++$_g;
					$filter->filterIn($url);
					unset($filter);
				}
			}
			$this->_requestUri = $url->toString();
		}
		return $this->_requestUri;
	}
	public function generateUri($uri, $isPhysical = null) {
		if($isPhysical === null) {
			$isPhysical = false;
		}
		$uriOut = ufront_web_url_VirtualUrl::parse($uri, $isPhysical);
		$i = $this->urlFilters->length - 1;
		while($i >= 0) {
			_hx_array_get($this->urlFilters, $i--)->filterOut($uriOut);
		}
		return $uriOut->toString();
	}
	public function setUrlFilters($filters) {
		if($filters !== null) {
			$this->urlFilters = $filters;
		} else {
			$this->urlFilters = (new _hx_array(array()));
		}
		$this->_requestUri = null;
	}
	public function commitSession() {
		if($this->session !== null) {
			return $this->session->commit();
		} else {
			return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Success(tink_core_Noise::$Noise));
		}
	}
	public function ufTrace($msg, $pos = null) {
		$this->messages->push(_hx_anonymous(array("msg" => $msg, "pos" => $pos, "type" => ufront_log_MessageType::$MTrace)));
	}
	public function ufLog($msg, $pos = null) {
		$this->messages->push(_hx_anonymous(array("msg" => $msg, "pos" => $pos, "type" => ufront_log_MessageType::$MLog)));
	}
	public function ufWarn($msg, $pos = null) {
		$this->messages->push(_hx_anonymous(array("msg" => $msg, "pos" => $pos, "type" => ufront_log_MessageType::$MWarning)));
	}
	public function ufError($msg, $pos = null) {
		$this->messages->push(_hx_anonymous(array("msg" => $msg, "pos" => $pos, "type" => ufront_log_MessageType::$MError)));
	}
	public function toString() {
		return "HttpContext";
	}
	public function get_sessionID() {
		if(null !== $this->session) {
			return $this->session->get_id();
		} else {
			return null;
		}
	}
	public function get_currentUser() {
		if(null !== $this->auth) {
			return $this->auth->get_currentUser();
		} else {
			return null;
		}
	}
	public function get_currentUserID() {
		if($this->auth !== null && $this->auth->get_currentUser() !== null) {
			return $this->auth->get_currentUser()->get_userID();
		} else {
			return null;
		}
	}
	public function get_contentDirectory() {
		if($this->_contentDir === null) {
			if($this->request->get_scriptDirectory() !== null) {
				$this->_contentDir = _hx_string_or_null(haxe_io_Path::addTrailingSlash($this->request->get_scriptDirectory())) . _hx_string_or_null(haxe_io_Path::addTrailingSlash($this->_relativeContentDir));
			} else {
				$this->_contentDir = haxe_io_Path::addTrailingSlash($this->_relativeContentDir);
			}
		}
		return $this->_contentDir;
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
	static function createContext($request = null, $response = null, $appInjector = null, $session = null, $auth = null, $urlFilters = null, $relativeContentDir = null) {
		if($relativeContentDir === null) {
			$relativeContentDir = "uf-content";
		}
		if(null === $request) {
			$request = ufront_web_context_HttpRequest::create();
		}
		if(null === $response) {
			$response = ufront_web_context_HttpResponse::create();
		}
		return new ufront_web_context_HttpContext($request, $response, $appInjector, $session, $auth, $urlFilters, $relativeContentDir);
	}
	static $__properties__ = array("get_contentDirectory" => "get_contentDirectory","get_currentUserID" => "get_currentUserID","get_currentUser" => "get_currentUser","get_sessionID" => "get_sessionID");
	function __toString() { return $this->toString(); }
}
