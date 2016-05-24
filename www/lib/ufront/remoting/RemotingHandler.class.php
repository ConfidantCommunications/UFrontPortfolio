<?php

class ufront_remoting_RemotingHandler implements ufront_app_UFRequestHandler{
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->apiContexts = new HList();
		$this->apis = new HList();
	}}
	public $apiContexts;
	public $apis;
	public $context;
	public function loadApi($api) {
		$this->apis->push($api);
	}
	public function loadApis($newAPIs) {
		if(null == $newAPIs) throw new HException('null iterable');
		$__hx__it = $newAPIs->iterator();
		while($__hx__it->hasNext()) {
			unset($api);
			$api = $__hx__it->next();
			$this->apis->push($api);
		}
	}
	public function loadApiContext($apiContext) {
		$this->apiContexts->push($apiContext);
		{
			$newAPIs = ufront_api_UFApiContext::getApisInContext($apiContext);
			if(null == $newAPIs) throw new HException('null iterable');
			$__hx__it = $newAPIs->iterator();
			while($__hx__it->hasNext()) {
				unset($api);
				$api = $__hx__it->next();
				$this->apis->push($api);
			}
		}
	}
	public function handleRequest($httpContext) {
		$doneTrigger = new tink_core_FutureTrigger();
		if(ufront_remoting_RemotingHandler_0($this, $doneTrigger, $httpContext)) {
			$r = $httpContext->response;
			$remotingResponse = null;
			$r->setOk();
			$path = null;
			$args = null;
			try {
				$this->initializeContext($httpContext->injector);
				$params = $httpContext->request->get_params();
				if(!$params->exists("__x")) {
					throw new HException("Remoting call did not have parameter `__x` which describes which API call to make.  Aborting");
				}
				$remotingCall = ufront_core__MultiValueMap_MultiValueMap_Impl_::get($params, "__x");
				$u = new ufront_remoting_RemotingUnserializer($remotingCall, $httpContext->request->get_files());
				try {
					$path = $u->unserialize();
					$args = $u->unserialize();
					{
						$_g1 = 0;
						$_g = $args->length;
						while($_g1 < $_g) {
							$i = $_g1++;
							$baseUpload = Std::instance($args[$i], _hx_qtype("ufront.web.upload.BaseUpload"));
							if($baseUpload !== null && $baseUpload->attachedUpload !== null) {
								$args[$i] = $baseUpload->attachedUpload;
							}
							unset($i,$baseUpload);
						}
					}
				}catch(Exception $__hx__e) {
					$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
					$e = $_ex_;
					{
						throw new HException("Unable to deserialize remoting call: " . Std::string($e) . ". Remoting call string: " . _hx_string_or_null($remotingCall));
					}
				}
				$apiCallFinished = $this->executeApiCall($path, $args, $this->context, $httpContext->actionContext);
				$remotingResponse = tink_core__Future_Future_Impl_::map($apiCallFinished, array(new _hx_lambda(array(&$apiCallFinished, &$args, &$doneTrigger, &$e, &$httpContext, &$params, &$path, &$r, &$remotingCall, &$remotingResponse, &$u), "ufront_remoting_RemotingHandler_1"), 'execute'), null);
			}catch(Exception $__hx__e) {
				$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
				$e1 = $_ex_;
				{
					$error = $e1;
					$apiNotFoundMessages = (new _hx_array(array("Invalid path", "No such object", "Can't access", "No such method")));
					if($path !== null && $args !== null && Std::is($e1, _hx_qtype("String")) && Lambda::exists($apiNotFoundMessages, array(new _hx_lambda(array(&$apiNotFoundMessages, &$args, &$doneTrigger, &$e1, &$error, &$httpContext, &$path, &$r, &$remotingResponse), "ufront_remoting_RemotingHandler_2"), 'execute'))) {
						$remotingResponse = tink_core__Future_Future_Impl_::sync("Unable to access " . _hx_string_or_null($path->join(".")) . " - API Not Found (" . _hx_string_or_null($error) . "). See " . Std::string($this->context->objects));
						$r->setNotFound();
					} else {
						$r->setInternalError();
						$remotingResponse = tink_core__Future_Future_Impl_::sync($this->remotingError($e1, $httpContext));
					}
				}
			}
			$remotingResponse(array(new _hx_lambda(array(&$args, &$doneTrigger, &$e1, &$httpContext, &$path, &$r, &$remotingResponse), "ufront_remoting_RemotingHandler_3"), 'execute'));
		} else {
			$result1 = tink_core_Outcome::Success(tink_core_Noise::$Noise);
			if($doneTrigger->{"list"} === null) {
				false;
			} else {
				$list1 = $doneTrigger->{"list"};
				$doneTrigger->{"list"} = null;
				$doneTrigger->result = $result1;
				tink_core__Callback_CallbackList_Impl_::invoke($list1, $result1);
				tink_core__Callback_CallbackList_Impl_::clear($list1);
				true;
			}
		}
		return $doneTrigger->future;
	}
	public function initializeContext($injector) {
		$this->context = new haxe_remoting_Context();
		if(null == $this->apiContexts) throw new HException('null iterable');
		$__hx__it = $this->apiContexts->iterator();
		while($__hx__it->hasNext()) {
			unset($apiContextClass);
			$apiContextClass = $__hx__it->next();
			$apiContext = $injector->_instantiate($apiContextClass);
			{
				$_g = 0;
				$_g1 = Reflect::fields($apiContext);
				while($_g < $_g1->length) {
					$fieldName = $_g1[$_g];
					++$_g;
					$api = Reflect::field($apiContext, $fieldName);
					if(Reflect::isObject($api)) {
						$this->context->addObject($fieldName, $api, false);
					}
					unset($fieldName,$api);
				}
				unset($_g1,$_g);
			}
			unset($apiContext);
		}
		if(null == $this->apis) throw new HException('null iterable');
		$__hx__it = $this->apis->iterator();
		while($__hx__it->hasNext()) {
			unset($apiClass);
			$apiClass = $__hx__it->next();
			$className = Type::getClassName($apiClass);
			$api1 = $injector->_instantiate($apiClass);
			$this->context->addObject($className, $api1, false);
			unset($className,$api1);
		}
	}
	public function executeApiCall($path, $args, $remotingContext, $actionContext) {
		if($remotingContext->objects->exists($path[0]) === false) {
			throw new HException("Invalid path " . _hx_string_or_null($path->join(".")));
		}
		$actionContext->handler = $this;
		$actionContext->action = $path[$path->length - 1];
		$actionContext->controller = $remotingContext->objects->get($path[0])->obj;
		$actionContext->args = $args;
		$returnType = null;
		try {
			$fieldsMeta = haxe_rtti_Meta::getFields(Type::getClass($actionContext->controller));
			$actionMeta = Reflect::field($fieldsMeta, $actionContext->action);
			$returnType = $actionMeta->returnType[0];
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			$e = $_ex_;
			{
				$returnType = 0;
			}
		}
		$flags = $returnType;
		$result = $remotingContext->call($path, $args);
		if(($flags & 1 << ufront_api_ApiReturnType::$ARTFuture->index) !== 0) {
			return $result;
		} else {
			if(($flags & 1 << ufront_api_ApiReturnType::$ARTVoid->index) !== 0) {
				return tink_core__Future_Future_Impl_::sync(null);
			} else {
				return tink_core__Future_Future_Impl_::sync($result);
			}
		}
	}
	public function remotingError($e, $httpContext) {
		$httpContext->messages->push(_hx_anonymous(array("msg" => $e, "pos" => _hx_anonymous(array("fileName" => "RemotingHandler.hx", "lineNumber" => 209, "className" => "ufront.remoting.RemotingHandler", "methodName" => "remotingError")), "type" => ufront_log_MessageType::$MError)));
		if(ufront_remoting_RemotingHandler_4($this, $e, $httpContext)) {
			$s = new ufront_remoting_RemotingSerializer(ufront_remoting_RemotingDirection::$RDServerToClient);
			$s->serializeException($e);
			$serializedException = "hxe" . _hx_string_or_null($s->toString());
			return $serializedException;
		} else {
			$s1 = new ufront_remoting_RemotingSerializer(ufront_remoting_RemotingDirection::$RDServerToClient);
			$s1->serializeException($e);
			return "hxr" . _hx_string_or_null($s1->toString());
		}
	}
	public function toString() {
		return "ufront.remoting.RemotingHandler";
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
	function __toString() { return $this->toString(); }
}
function ufront_remoting_RemotingHandler_0(&$__hx__this, &$doneTrigger, &$httpContext) {
	{
		$this1 = $httpContext->request->get_clientHeaders();
		$name = strtolower("X-Haxe-Remoting");
		return $this1->exists($name);
	}
}
function ufront_remoting_RemotingHandler_1(&$apiCallFinished, &$args, &$doneTrigger, &$e, &$httpContext, &$params, &$path, &$r, &$remotingCall, &$remotingResponse, &$u, $data) {
	{
		$s = new ufront_remoting_RemotingSerializer(ufront_remoting_RemotingDirection::$RDServerToClient);
		$s->serialize($data);
		return "hxr" . _hx_string_or_null($s->toString());
	}
}
function ufront_remoting_RemotingHandler_2(&$apiNotFoundMessages, &$args, &$doneTrigger, &$e1, &$error, &$httpContext, &$path, &$r, &$remotingResponse, $msg) {
	{
		return StringTools::startsWith($error, $msg);
	}
}
function ufront_remoting_RemotingHandler_3(&$args, &$doneTrigger, &$e1, &$httpContext, &$path, &$r, &$remotingResponse, $response) {
	{
		$r->set_contentType("application/x-haxe-remoting");
		$r->clearContent();
		$r->write($response);
		$httpContext->completion |= 1 << ufront_web_context_RequestCompletion::$CRequestHandlersComplete->index;
		{
			$result = tink_core_Outcome::Success(tink_core_Noise::$Noise);
			if($doneTrigger->{"list"} === null) {
				false;
			} else {
				$list = $doneTrigger->{"list"};
				$doneTrigger->{"list"} = null;
				$doneTrigger->result = $result;
				tink_core__Callback_CallbackList_Impl_::invoke($list, $result);
				tink_core__Callback_CallbackList_Impl_::clear($list);
				true;
			}
		}
	}
}
function ufront_remoting_RemotingHandler_4(&$__hx__this, &$e, &$httpContext) {
	{
		$this1 = $httpContext->request->get_clientHeaders();
		$name = strtolower("X-Ufront-Remoting");
		return $this1->exists($name);
	}
}
