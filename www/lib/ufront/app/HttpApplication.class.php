<?php

class ufront_app_HttpApplication {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->pathToContentDir = null;
		$this->requestMiddleware = (new _hx_array(array()));
		$this->requestHandlers = (new _hx_array(array()));
		$this->responseMiddleware = (new _hx_array(array()));
		$this->logHandlers = (new _hx_array(array()));
		$this->errorHandlers = (new _hx_array(array()));
		$this->urlFilters = (new _hx_array(array()));
		$this->messages = (new _hx_array(array()));
		$this->injector = new minject_Injector(null);
		$this->injector->mapType("minject.Injector", null, null)->toValue($this->injector);
	}}
	public $injector;
	public $requestMiddleware;
	public $requestHandlers;
	public $responseMiddleware;
	public $logHandlers;
	public $errorHandlers;
	public $urlFilters;
	public $originalTrace;
	public $messages;
	public $modulesReady;
	public $currentModule;
	public $pathToContentDir;
	public function init() {
		$_g = $this;
		$this->originalTrace = (isset(haxe_Log::$trace) ? haxe_Log::$trace: array("haxe_Log", "trace"));
		haxe_Log::$trace = array(new _hx_lambda(array(&$_g), "ufront_app_HttpApplication_0"), 'execute');
		if($this->modulesReady === null) {
			$futures = (new _hx_array(array()));
			{
				$_g1 = 0;
				$_g11 = $this->getModulesThatRequireInit();
				while($_g1 < $_g11->length) {
					$module = $_g11[$_g1];
					++$_g1;
					$futures->push($module->init($this));
					unset($module);
				}
			}
			$this->modulesReady = tink_core__Future_Future_Impl_::map(tink_core__Future_Future_Impl_::ofMany($futures, null), array(new _hx_lambda(array(&$_g, &$futures), "ufront_app_HttpApplication_1"), 'execute'), null);
		}
		return $this->modulesReady;
	}
	public function dispose() {
		$_g = $this;
		$futures = (new _hx_array(array()));
		{
			$_g1 = 0;
			$_g11 = $this->getModulesThatRequireInit();
			while($_g1 < $_g11->length) {
				$module = $_g11[$_g1];
				++$_g1;
				$futures->push($module->dispose($this));
				unset($module);
			}
		}
		return tink_core__Future_Future_Impl_::map(tink_core__Future_Future_Impl_::ofMany($futures, null), array(new _hx_lambda(array(&$_g, &$futures), "ufront_app_HttpApplication_2"), 'execute'), null);
	}
	public function getModulesThatRequireInit() {
		$moduleSets = (new _hx_array(array($this->requestMiddleware, $this->requestHandlers, $this->responseMiddleware, $this->logHandlers, $this->errorHandlers)));
		$modules = (new _hx_array(array()));
		{
			$_g = 0;
			while($_g < $moduleSets->length) {
				$set = $moduleSets[$_g];
				++$_g;
				$_g1 = 0;
				while($_g1 < $set->length) {
					$module = $set[$_g1];
					++$_g1;
					if(Std::is($module, _hx_qtype("ufront.app.UFInitRequired"))) {
						$modules->push($module);
					}
					unset($module);
				}
				unset($set,$_g1);
			}
		}
		return $modules;
	}
	public function addRequestMiddleware($middlewareItem = null, $middleware = null, $first = null) {
		if($first === null) {
			$first = false;
		}
		return $this->addModule($this->requestMiddleware, $middlewareItem, $middleware, $first);
	}
	public function addRequestHandler($handler = null, $handlers = null, $first = null) {
		if($first === null) {
			$first = false;
		}
		return $this->addModule($this->requestHandlers, $handler, $handlers, $first);
	}
	public function addErrorHandler($handler = null, $handlers = null, $first = null) {
		if($first === null) {
			$first = false;
		}
		return $this->addModule($this->errorHandlers, $handler, $handlers, $first);
	}
	public function addResponseMiddleware($middlewareItem = null, $middleware = null, $last = null) {
		if($last === null) {
			$last = false;
		}
		return $this->addModule($this->responseMiddleware, $middlewareItem, $middleware, !$last);
	}
	public function addMiddleware($middlewareItem = null, $middleware = null, $firstInLastOut = null) {
		if($firstInLastOut === null) {
			$firstInLastOut = false;
		}
		$this->addModule($this->requestMiddleware, $middlewareItem, $middleware, $firstInLastOut);
		$this->addModule($this->responseMiddleware, $middlewareItem, $middleware, !$firstInLastOut);
		return $this;
	}
	public function addLogHandler($logger = null, $loggers = null, $first = null) {
		if($first === null) {
			$first = false;
		}
		return $this->addModule($this->logHandlers, $logger, $loggers, $first);
	}
	public function addModule($modulesArr, $newModule = null, $newModules = null, $first) {
		if($newModule !== null) {
			$this->injector->injectInto($newModule);
			if($first) {
				$modulesArr->unshift($newModule);
			} else {
				$modulesArr->push($newModule);
			}
		}
		if($newModules !== null) {
			if(null == $newModules) throw new HException('null iterable');
			$__hx__it = $newModules->iterator();
			while($__hx__it->hasNext()) {
				unset($newModule1);
				$newModule1 = $__hx__it->next();
				$this->injector->injectInto($newModule1);
				if($first) {
					$modulesArr->unshift($newModule1);
				} else {
					$modulesArr->push($newModule1);
				}
			}
		}
		return $this;
	}
	public function execute($httpContext) {
		$_g = $this;
		$httpContext->setUrlFilters($this->urlFilters);
		$reqMidModules = $this->requestMiddleware->map(array(new _hx_lambda(array(&$_g, &$httpContext), "ufront_app_HttpApplication_3"), 'execute'));
		$reqHandModules = $this->requestHandlers->map(array(new _hx_lambda(array(&$_g, &$httpContext, &$reqMidModules), "ufront_app_HttpApplication_4"), 'execute'));
		$resMidModules = $this->responseMiddleware->map(array(new _hx_lambda(array(&$_g, &$httpContext, &$reqHandModules, &$reqMidModules), "ufront_app_HttpApplication_5"), 'execute'));
		$logHandModules = $this->logHandlers->map(array(new _hx_lambda(array(&$_g, &$httpContext, &$reqHandModules, &$reqMidModules, &$resMidModules), "ufront_app_HttpApplication_6"), 'execute'));
		{
			$msg = "Begin executing request " . _hx_string_or_null($httpContext->getRequestUri());
			null;
		}
		$allDone = tink_core__Future_Future_Impl_::_tryFailingFlatMap($this->init(), array(new _hx_lambda(array(&$_g, &$httpContext, &$logHandModules, &$reqHandModules, &$reqMidModules, &$resMidModules), "ufront_app_HttpApplication_7"), 'execute'));
		$allDone(ufront_app_HttpApplication_8($this, $_g, $allDone, $httpContext, $logHandModules, $reqHandModules, $reqMidModules, $resMidModules));
		return $allDone;
	}
	public function logModule($ctx, $msg) {}
	public function executeModules($modules, $ctx, $flag) {
		$_g = $this;
		$done = new tink_core_FutureTrigger();
		$runNext = null;
		{
			$runNext1 = null;
			$runNext1 = array(new _hx_lambda(array(&$_g, &$ctx, &$done, &$flag, &$modules, &$runNext, &$runNext1), "ufront_app_HttpApplication_9"), 'execute');
			$runNext = $runNext1;
		}
		call_user_func($runNext);
		return $done->future;
	}
	public function handleError($err, $ctx, $doneTrigger) {
		$_g = $this;
		if(!(($ctx->completion & 1 << ufront_web_context_RequestCompletion::$CErrorHandlersTriggered->index) !== 0)) {
			$ctx->completion |= 1 << ufront_web_context_RequestCompletion::$CErrorHandlersTriggered->index;
			$errHandlerModules = $this->errorHandlers->map(array(new _hx_lambda(array(&$_g, &$ctx, &$doneTrigger, &$err), "ufront_app_HttpApplication_10"), 'execute'));
			$resMidModules = $this->responseMiddleware->map(array(new _hx_lambda(array(&$_g, &$ctx, &$doneTrigger, &$err, &$errHandlerModules), "ufront_app_HttpApplication_11"), 'execute'));
			$logHandModules = $this->logHandlers->map(array(new _hx_lambda(array(&$_g, &$ctx, &$doneTrigger, &$err, &$errHandlerModules, &$resMidModules), "ufront_app_HttpApplication_12"), 'execute'));
			$allDone = tink_core__Future_Future_Impl_::_tryFailingFlatMap(tink_core__Future_Future_Impl_::_tryFailingFlatMap($this->executeModules($errHandlerModules, $ctx, ufront_web_context_RequestCompletion::$CErrorHandlersComplete), array(new _hx_lambda(array(&$_g, &$ctx, &$doneTrigger, &$err, &$errHandlerModules, &$logHandModules, &$resMidModules), "ufront_app_HttpApplication_13"), 'execute')), array(new _hx_lambda(array(&$_g, &$ctx, &$doneTrigger, &$err, &$errHandlerModules, &$logHandModules, &$resMidModules), "ufront_app_HttpApplication_14"), 'execute'));
			$allDone(ufront_app_HttpApplication_15($this, $_g, $allDone, $ctx, $doneTrigger, $err, $errHandlerModules, $logHandModules, $resMidModules));
		} else {
			$msg = "You had an error after your error handler had already run.  Last active module: " . _hx_string_or_null($this->currentModule->className) . "." . _hx_string_or_null($this->currentModule->methodName);
			Sys::println($msg);
			Sys::println("Error Data: " . Std::string($err->data));
			$err->throwSelf();
		}
	}
	public function clearMessages() {
		{
			$_g1 = 0;
			$_g = $this->messages->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				$this->messages->pop();
				unset($i);
			}
		}
		return ufront_core_SurpriseTools::success();
	}
	public function flush($ctx) {
		if(!(($ctx->completion & 1 << ufront_web_context_RequestCompletion::$CFlushComplete->index) !== 0)) {
			$ctx->response->flush();
			$ctx->completion |= 1 << ufront_web_context_RequestCompletion::$CFlushComplete->index;
		}
		return tink_core_Noise::$Noise;
	}
	public function executeRequest() {
		$context = null;
		if($this->pathToContentDir !== null) {
			$context = ufront_web_context_HttpContext::createContext(null, null, $this->injector, null, null, $this->urlFilters, $this->pathToContentDir);
		} else {
			$context = ufront_web_context_HttpContext::createContext(null, null, $this->injector, null, null, $this->urlFilters, null);
		}
		return $this->execute($context);
	}
	public function useModNekoCache() {}
	public function addUrlFilter($filter) {
		ufront_web_HttpError::throwIfNull($filter, "filter", _hx_anonymous(array("fileName" => "HttpApplication.hx", "lineNumber" => 592, "className" => "ufront.app.HttpApplication", "methodName" => "addUrlFilter")));
		$this->urlFilters->push($filter);
	}
	public function clearUrlFilters() {
		$this->urlFilters = (new _hx_array(array()));
	}
	public function setContentDirectory($relativePath) {
		$this->pathToContentDir = $relativePath;
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
	function __toString() { return 'ufront.app.HttpApplication'; }
}
function ufront_app_HttpApplication_0(&$_g, $msg, $pos) {
	{
		$_g->messages->push(_hx_anonymous(array("msg" => $msg, "pos" => $pos, "type" => ufront_log_MessageType::$MTrace)));
	}
}
function ufront_app_HttpApplication_1(&$_g, &$futures, $outcomes) {
	{
		{
			$_g2 = 0;
			while($_g2 < $outcomes->length) {
				$o = $outcomes[$_g2];
				++$_g2;
				switch($o->index) {
				case 1:{
					$err = _hx_deref($o)->params[0];
					return tink_core_Outcome::Failure($err);
				}break;
				case 0:{}break;
				}
				unset($o);
			}
		}
		return tink_core_Outcome::Success(tink_core_Noise::$Noise);
	}
}
function ufront_app_HttpApplication_2(&$_g, &$futures, $outcomes) {
	{
		$_g->modulesReady = null;
		{
			$_g12 = 0;
			while($_g12 < $outcomes->length) {
				$o = $outcomes[$_g12];
				++$_g12;
				switch($o->index) {
				case 1:{
					return $o;
				}break;
				case 0:{}break;
				}
				unset($o);
			}
		}
		haxe_Log::$trace = (isset($_g->originalTrace) ? $_g->originalTrace: array($_g, "originalTrace"));
		return tink_core_Outcome::Success(tink_core_Noise::$Noise);
	}
}
function ufront_app_HttpApplication_3(&$_g, &$httpContext, $m) {
	{
		$b = _hx_anonymous(array("methodName" => "requestIn", "lineNumber" => -1, "fileName" => "", "customParams" => (new _hx_array(array())), "className" => Type::getClassName(Type::getClass($m))));
		return new tink_core_MPair(ufront_app_HttpApplication_16($__hx__this, $_g, $b, $httpContext, $m), $b);
	}
}
function ufront_app_HttpApplication_4(&$_g, &$httpContext, &$reqMidModules, $m1) {
	{
		$b1 = _hx_anonymous(array("methodName" => "handleRequest", "lineNumber" => -1, "fileName" => "", "customParams" => (new _hx_array(array())), "className" => Type::getClassName(Type::getClass($m1))));
		return new tink_core_MPair(ufront_app_HttpApplication_17($__hx__this, $_g, $b1, $httpContext, $m1, $reqMidModules), $b1);
	}
}
function ufront_app_HttpApplication_5(&$_g, &$httpContext, &$reqHandModules, &$reqMidModules, $m2) {
	{
		$b2 = _hx_anonymous(array("methodName" => "requestOut", "lineNumber" => -1, "fileName" => "", "customParams" => (new _hx_array(array())), "className" => Type::getClassName(Type::getClass($m2))));
		return new tink_core_MPair(ufront_app_HttpApplication_18($__hx__this, $_g, $b2, $httpContext, $m2, $reqHandModules, $reqMidModules), $b2);
	}
}
function ufront_app_HttpApplication_6(&$_g, &$httpContext, &$reqHandModules, &$reqMidModules, &$resMidModules, $m3) {
	{
		$b3 = _hx_anonymous(array("methodName" => "log", "lineNumber" => -1, "fileName" => "", "customParams" => (new _hx_array(array("httpContext", "appMessages"))), "className" => Type::getClassName(Type::getClass($m3))));
		return new tink_core_MPair(ufront_app_HttpApplication_19($__hx__this, $_g, $b3, $httpContext, $m3, $reqHandModules, $reqMidModules, $resMidModules), $b3);
	}
}
function ufront_app_HttpApplication_7(&$_g, &$httpContext, &$logHandModules, &$reqHandModules, &$reqMidModules, &$resMidModules, $n) {
	{
		return tink_core__Future_Future_Impl_::_tryFailingFlatMap($_g->executeModules($reqMidModules, $httpContext, ufront_web_context_RequestCompletion::$CRequestMiddlewareComplete), array(new _hx_lambda(array(&$_g, &$httpContext, &$logHandModules, &$n, &$reqHandModules, &$reqMidModules, &$resMidModules), "ufront_app_HttpApplication_20"), 'execute'));
	}
}
function ufront_app_HttpApplication_8(&$__hx__this, &$_g, &$allDone, &$httpContext, &$logHandModules, &$reqHandModules, &$reqMidModules, &$resMidModules) {
	{
		$f4 = array(new _hx_lambda(array(&$_g, &$allDone, &$httpContext, &$logHandModules, &$reqHandModules, &$reqMidModules, &$resMidModules), "ufront_app_HttpApplication_21"), 'execute');
		return array(new _hx_lambda(array(&$_g, &$allDone, &$f4, &$httpContext, &$logHandModules, &$reqHandModules, &$reqMidModules, &$resMidModules), "ufront_app_HttpApplication_22"), 'execute');
	}
}
function ufront_app_HttpApplication_9(&$_g, &$ctx, &$done, &$flag, &$modules, &$runNext, &$runNext1) {
	{
		$m = $modules->shift();
		if($flag !== null && ($ctx->completion & 1 << $flag->index) !== 0) {
			$result = tink_core_Outcome::Success(tink_core_Noise::$Noise);
			if($done->{"list"} === null) {
				false;
			} else {
				$list = $done->{"list"};
				$done->{"list"} = null;
				$done->result = $result;
				tink_core__Callback_CallbackList_Impl_::invoke($list, $result);
				tink_core__Callback_CallbackList_Impl_::clear($list);
				true;
			}
		} else {
			if($m === null) {
				if($flag !== null) {
					$ctx->completion |= 1 << $flag->index;
				}
				{
					$result1 = tink_core_Outcome::Success(tink_core_Noise::$Noise);
					if($done->{"list"} === null) {
						false;
					} else {
						$list1 = $done->{"list"};
						$done->{"list"} = null;
						$done->result = $result1;
						tink_core__Callback_CallbackList_Impl_::invoke($list1, $result1);
						tink_core__Callback_CallbackList_Impl_::clear($list1);
						true;
					}
				}
			} else {
				$moduleCb = (isset($m->a) ? $m->a: array($m, "a"));
				$_g->currentModule = $m->b;
				$moduleResult = null;
				try {
					$moduleResult = call_user_func_array($moduleCb, array($ctx));
				}catch(Exception $__hx__e) {
					$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
					$e = $_ex_;
					{
						$ctx->messages->push(_hx_anonymous(array("msg" => "Caught error " . Std::string($e) . " while executing module " . _hx_string_or_null($_g->currentModule->className) . "." . _hx_string_or_null($_g->currentModule->methodName) . " in HttpApplication.executeModules()", "pos" => _hx_anonymous(array("fileName" => "HttpApplication.hx", "lineNumber" => 422, "className" => "ufront.app.HttpApplication", "methodName" => "executeModules")), "type" => ufront_log_MessageType::$MLog)));
						$moduleResult = tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Failure(ufront_web_HttpError::wrap($e, null, $_g->currentModule)));
					}
				}
				$moduleResult(array(new _hx_lambda(array(&$_g, &$ctx, &$done, &$e, &$flag, &$m, &$moduleCb, &$moduleResult, &$modules, &$runNext, &$runNext1), "ufront_app_HttpApplication_23"), 'execute'));
			}
		}
	}
}
function ufront_app_HttpApplication_10(&$_g, &$ctx, &$doneTrigger, &$err, $m) {
	{
		$b = null;
		{
			$args = (new _hx_array(array($err->toString())));
			$b = _hx_anonymous(array("methodName" => "handleError", "lineNumber" => -1, "fileName" => "", "customParams" => $args, "className" => Type::getClassName(Type::getClass($m))));
		}
		return new tink_core_MPair(ufront_app_HttpApplication_24($__hx__this, $_g, $b, $ctx, $doneTrigger, $err, $m), $b);
	}
}
function ufront_app_HttpApplication_11(&$_g, &$ctx, &$doneTrigger, &$err, &$errHandlerModules, $m1) {
	{
		$b1 = _hx_anonymous(array("methodName" => "requestOut", "lineNumber" => -1, "fileName" => "", "customParams" => (new _hx_array(array())), "className" => Type::getClassName(Type::getClass($m1))));
		return new tink_core_MPair(ufront_app_HttpApplication_25($__hx__this, $_g, $b1, $ctx, $doneTrigger, $err, $errHandlerModules, $m1), $b1);
	}
}
function ufront_app_HttpApplication_12(&$_g, &$ctx, &$doneTrigger, &$err, &$errHandlerModules, &$resMidModules, $m2) {
	{
		$b2 = _hx_anonymous(array("methodName" => "log", "lineNumber" => -1, "fileName" => "", "customParams" => (new _hx_array(array("httpContext", "appMessages"))), "className" => Type::getClassName(Type::getClass($m2))));
		return new tink_core_MPair(ufront_app_HttpApplication_26($__hx__this, $_g, $b2, $ctx, $doneTrigger, $err, $errHandlerModules, $m2, $resMidModules), $b2);
	}
}
function ufront_app_HttpApplication_13(&$_g, &$ctx, &$doneTrigger, &$err, &$errHandlerModules, &$logHandModules, &$resMidModules, $n) {
	{
		$ctx->completion |= 1 << ufront_web_context_RequestCompletion::$CRequestHandlersComplete->index;
		return ufront_core_SurpriseTools::success();
	}
}
function ufront_app_HttpApplication_14(&$_g, &$ctx, &$doneTrigger, &$err, &$errHandlerModules, &$logHandModules, &$resMidModules, $n1) {
	{
		return tink_core__Future_Future_Impl_::_tryFailingFlatMap($_g->executeModules($resMidModules, $ctx, ufront_web_context_RequestCompletion::$CResponseMiddlewareComplete), array(new _hx_lambda(array(&$_g, &$ctx, &$doneTrigger, &$err, &$errHandlerModules, &$logHandModules, &$n1, &$resMidModules), "ufront_app_HttpApplication_27"), 'execute'));
	}
}
function ufront_app_HttpApplication_15(&$__hx__this, &$_g, &$allDone, &$ctx, &$doneTrigger, &$err, &$errHandlerModules, &$logHandModules, &$resMidModules) {
	{
		$f3 = array(new _hx_lambda(array(&$_g, &$allDone, &$ctx, &$doneTrigger, &$err, &$errHandlerModules, &$logHandModules, &$resMidModules), "ufront_app_HttpApplication_28"), 'execute');
		return array(new _hx_lambda(array(&$_g, &$allDone, &$ctx, &$doneTrigger, &$err, &$errHandlerModules, &$f3, &$logHandModules, &$resMidModules), "ufront_app_HttpApplication_29"), 'execute');
	}
}
function ufront_app_HttpApplication_16(&$__hx__this, &$_g, &$b, &$httpContext, &$m) {
	{
		$f = (isset($m->requestIn) ? $m->requestIn: array($m, "requestIn"));
		return array(new _hx_lambda(array(&$_g, &$b, &$f, &$httpContext, &$m), "ufront_app_HttpApplication_30"), 'execute');
	}
}
function ufront_app_HttpApplication_17(&$__hx__this, &$_g, &$b1, &$httpContext, &$m1, &$reqMidModules) {
	{
		$f1 = (isset($m1->handleRequest) ? $m1->handleRequest: array($m1, "handleRequest"));
		return array(new _hx_lambda(array(&$_g, &$b1, &$f1, &$httpContext, &$m1, &$reqMidModules), "ufront_app_HttpApplication_31"), 'execute');
	}
}
function ufront_app_HttpApplication_18(&$__hx__this, &$_g, &$b2, &$httpContext, &$m2, &$reqHandModules, &$reqMidModules) {
	{
		$f2 = (isset($m2->responseOut) ? $m2->responseOut: array($m2, "responseOut"));
		return array(new _hx_lambda(array(&$_g, &$b2, &$f2, &$httpContext, &$m2, &$reqHandModules, &$reqMidModules), "ufront_app_HttpApplication_32"), 'execute');
	}
}
function ufront_app_HttpApplication_19(&$__hx__this, &$_g, &$b3, &$httpContext, &$m3, &$reqHandModules, &$reqMidModules, &$resMidModules) {
	{
		$f3 = (isset($m3->log) ? $m3->log: array($m3, "log"));
		$a2 = $_g->messages;
		return array(new _hx_lambda(array(&$_g, &$a2, &$b3, &$f3, &$httpContext, &$m3, &$reqHandModules, &$reqMidModules, &$resMidModules), "ufront_app_HttpApplication_33"), 'execute');
	}
}
function ufront_app_HttpApplication_20(&$_g, &$httpContext, &$logHandModules, &$n, &$reqHandModules, &$reqMidModules, &$resMidModules, $n1) {
	{
		return tink_core__Future_Future_Impl_::_tryFailingFlatMap($_g->executeModules($reqHandModules, $httpContext, ufront_web_context_RequestCompletion::$CRequestHandlersComplete), array(new _hx_lambda(array(&$_g, &$httpContext, &$logHandModules, &$n, &$n1, &$reqHandModules, &$reqMidModules, &$resMidModules), "ufront_app_HttpApplication_34"), 'execute'));
	}
}
function ufront_app_HttpApplication_21(&$_g, &$allDone, &$httpContext, &$logHandModules, &$reqHandModules, &$reqMidModules, &$resMidModules) {
	{
		$msg1 = "End executing request " . _hx_string_or_null($httpContext->getRequestUri());
		null;
	}
}
function ufront_app_HttpApplication_22(&$_g, &$allDone, &$f4, &$httpContext, &$logHandModules, &$reqHandModules, &$reqMidModules, &$resMidModules, $r) {
	{
		call_user_func($f4);
	}
}
function ufront_app_HttpApplication_23(&$_g, &$ctx, &$done, &$e, &$flag, &$m, &$moduleCb, &$moduleResult, &$modules, &$runNext, &$runNext1, $result2) {
	{
		switch($result2->index) {
		case 0:{
			call_user_func($runNext1);
		}break;
		case 1:{
			$e1 = _hx_deref($result2)->params[0];
			$_g->handleError($e1, $ctx, $done);
		}break;
		}
	}
}
function ufront_app_HttpApplication_24(&$__hx__this, &$_g, &$b, &$ctx, &$doneTrigger, &$err, &$m) {
	{
		$f = (isset($m->handleError) ? $m->handleError: array($m, "handleError"));
		$a1 = $err;
		return array(new _hx_lambda(array(&$_g, &$a1, &$b, &$ctx, &$doneTrigger, &$err, &$f, &$m), "ufront_app_HttpApplication_35"), 'execute');
	}
}
function ufront_app_HttpApplication_25(&$__hx__this, &$_g, &$b1, &$ctx, &$doneTrigger, &$err, &$errHandlerModules, &$m1) {
	{
		$f1 = (isset($m1->responseOut) ? $m1->responseOut: array($m1, "responseOut"));
		return array(new _hx_lambda(array(&$_g, &$b1, &$ctx, &$doneTrigger, &$err, &$errHandlerModules, &$f1, &$m1), "ufront_app_HttpApplication_36"), 'execute');
	}
}
function ufront_app_HttpApplication_26(&$__hx__this, &$_g, &$b2, &$ctx, &$doneTrigger, &$err, &$errHandlerModules, &$m2, &$resMidModules) {
	{
		$f2 = (isset($m2->log) ? $m2->log: array($m2, "log"));
		$a21 = $_g->messages;
		return array(new _hx_lambda(array(&$_g, &$a21, &$b2, &$ctx, &$doneTrigger, &$err, &$errHandlerModules, &$f2, &$m2, &$resMidModules), "ufront_app_HttpApplication_37"), 'execute');
	}
}
function ufront_app_HttpApplication_27(&$_g, &$ctx, &$doneTrigger, &$err, &$errHandlerModules, &$logHandModules, &$n1, &$resMidModules, $n2) {
	{
		return tink_core__Future_Future_Impl_::_tryFailingFlatMap($_g->executeModules($logHandModules, $ctx, ufront_web_context_RequestCompletion::$CLogHandlersComplete), array(new _hx_lambda(array(&$_g, &$ctx, &$doneTrigger, &$err, &$errHandlerModules, &$logHandModules, &$n1, &$n2, &$resMidModules), "ufront_app_HttpApplication_38"), 'execute'));
	}
}
function ufront_app_HttpApplication_28(&$_g, &$allDone, &$ctx, &$doneTrigger, &$err, &$errHandlerModules, &$logHandModules, &$resMidModules) {
	{
		$result = tink_core_Outcome::Failure($err);
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
function ufront_app_HttpApplication_29(&$_g, &$allDone, &$ctx, &$doneTrigger, &$err, &$errHandlerModules, &$f3, &$logHandModules, &$resMidModules, $r) {
	{
		call_user_func($f3);
	}
}
function ufront_app_HttpApplication_30(&$_g, &$b, &$f, &$httpContext, &$m, $a1) {
	{
		return call_user_func_array($f, array($a1));
	}
}
function ufront_app_HttpApplication_31(&$_g, &$b1, &$f1, &$httpContext, &$m1, &$reqMidModules, $a11) {
	{
		return call_user_func_array($f1, array($a11));
	}
}
function ufront_app_HttpApplication_32(&$_g, &$b2, &$f2, &$httpContext, &$m2, &$reqHandModules, &$reqMidModules, $a12) {
	{
		return call_user_func_array($f2, array($a12));
	}
}
function ufront_app_HttpApplication_33(&$_g, &$a2, &$b3, &$f3, &$httpContext, &$m3, &$reqHandModules, &$reqMidModules, &$resMidModules, $a13) {
	{
		return call_user_func_array($f3, array($a13, $a2));
	}
}
function ufront_app_HttpApplication_34(&$_g, &$httpContext, &$logHandModules, &$n, &$n1, &$reqHandModules, &$reqMidModules, &$resMidModules, $n2) {
	{
		return tink_core__Future_Future_Impl_::_tryFailingFlatMap($_g->executeModules($resMidModules, $httpContext, ufront_web_context_RequestCompletion::$CResponseMiddlewareComplete), array(new _hx_lambda(array(&$_g, &$httpContext, &$logHandModules, &$n, &$n1, &$n2, &$reqHandModules, &$reqMidModules, &$resMidModules), "ufront_app_HttpApplication_39"), 'execute'));
	}
}
function ufront_app_HttpApplication_35(&$_g, &$a1, &$b, &$ctx, &$doneTrigger, &$err, &$f, &$m, $a2) {
	{
		return call_user_func_array($f, array($a1, $a2));
	}
}
function ufront_app_HttpApplication_36(&$_g, &$b1, &$ctx, &$doneTrigger, &$err, &$errHandlerModules, &$f1, &$m1, $a11) {
	{
		return call_user_func_array($f1, array($a11));
	}
}
function ufront_app_HttpApplication_37(&$_g, &$a21, &$b2, &$ctx, &$doneTrigger, &$err, &$errHandlerModules, &$f2, &$m2, &$resMidModules, $a12) {
	{
		return call_user_func_array($f2, array($a12, $a21));
	}
}
function ufront_app_HttpApplication_38(&$_g, &$ctx, &$doneTrigger, &$err, &$errHandlerModules, &$logHandModules, &$n1, &$n2, &$resMidModules, $n3) {
	{
		return tink_core__Future_Future_Impl_::_tryMap($_g->clearMessages(), array(new _hx_lambda(array(&$_g, &$ctx, &$doneTrigger, &$err, &$errHandlerModules, &$logHandModules, &$n1, &$n2, &$n3, &$resMidModules), "ufront_app_HttpApplication_40"), 'execute'));
	}
}
function ufront_app_HttpApplication_39(&$_g, &$httpContext, &$logHandModules, &$n, &$n1, &$n2, &$reqHandModules, &$reqMidModules, &$resMidModules, $n3) {
	{
		return tink_core__Future_Future_Impl_::_tryFailingFlatMap($_g->executeModules($logHandModules, $httpContext, ufront_web_context_RequestCompletion::$CLogHandlersComplete), array(new _hx_lambda(array(&$_g, &$httpContext, &$logHandModules, &$n, &$n1, &$n2, &$n3, &$reqHandModules, &$reqMidModules, &$resMidModules), "ufront_app_HttpApplication_41"), 'execute'));
	}
}
function ufront_app_HttpApplication_40(&$_g, &$ctx, &$doneTrigger, &$err, &$errHandlerModules, &$logHandModules, &$n1, &$n2, &$n3, &$resMidModules, $n4) {
	{
		return $_g->flush($ctx);
	}
}
function ufront_app_HttpApplication_41(&$_g, &$httpContext, &$logHandModules, &$n, &$n1, &$n2, &$n3, &$reqHandModules, &$reqMidModules, &$resMidModules, $n4) {
	{
		return tink_core__Future_Future_Impl_::_tryMap($_g->clearMessages(), array(new _hx_lambda(array(&$_g, &$httpContext, &$logHandModules, &$n, &$n1, &$n2, &$n3, &$n4, &$reqHandModules, &$reqMidModules, &$resMidModules), "ufront_app_HttpApplication_42"), 'execute'));
	}
}
function ufront_app_HttpApplication_42(&$_g, &$httpContext, &$logHandModules, &$n, &$n1, &$n2, &$n3, &$n4, &$reqHandModules, &$reqMidModules, &$resMidModules, $n5) {
	{
		return $_g->flush($httpContext);
	}
}
