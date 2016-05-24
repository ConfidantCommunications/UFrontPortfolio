<?php

class ufront_app_UfrontApplication extends ufront_app_HttpApplication {
	public function __construct($optionsIn = null) {
		if(!php_Boot::$skip_constructor) {
		$this->appTemplatingEngines = new HList();
		$this->firstRun = true;
		parent::__construct();
		$this->configuration = ufront_app_DefaultUfrontConfiguration::get();
		{
			$_g = 0;
			$_g1 = Reflect::fields($optionsIn);
			while($_g < $_g1->length) {
				$field = $_g1[$_g];
				++$_g;
				$value = Reflect::field($optionsIn, $field);
				$this->configuration->{$field} = $value;
				unset($value,$field);
			}
		}
		$this->mvcHandler = new ufront_web_MVCHandler($this->configuration->indexController);
		$this->remotingHandler = new ufront_remoting_RemotingHandler();
		if($this->configuration->remotingApi !== null) {
			$_this = $this->remotingHandler;
			$apiContext = $this->configuration->remotingApi;
			$_this->apiContexts->push($apiContext);
			{
				$newAPIs = ufront_api_UFApiContext::getApisInContext($apiContext);
				if(null == $newAPIs) throw new HException('null iterable');
				$__hx__it = $newAPIs->iterator();
				while($__hx__it->hasNext()) {
					unset($api);
					$api = $__hx__it->next();
					$_this->apis->push($api);
				}
			}
		}
		if(null == $this->configuration->controllers) throw new HException('null iterable');
		$__hx__it = $this->configuration->controllers->iterator();
		while($__hx__it->hasNext()) {
			unset($controller);
			$controller = $__hx__it->next();
			$this->injector->mapRuntimeTypeOf($controller, null)->_toClass($controller);
		}
		$this->addModule($this->requestMiddleware, null, $this->configuration->requestMiddleware, false);
		$this->addModule($this->requestHandlers, null, (new _hx_array(array($this->remotingHandler, $this->mvcHandler))), false);
		$this->addModule($this->responseMiddleware, null, $this->configuration->responseMiddleware, true);
		$this->addModule($this->errorHandlers, null, $this->configuration->errorHandlers, false);
		if(!$this->configuration->disableServerTrace) {
			$logger = new ufront_log_ServerConsoleLogger();
			$this->addModule($this->logHandlers, $logger, null, false);
		}
		if(!$this->configuration->disableBrowserTrace) {
			{
				$logger1 = new ufront_log_BrowserConsoleLogger();
				$this->addModule($this->logHandlers, $logger1, null, false);
			}
			{
				$logger2 = new ufront_log_RemotingLogger();
				$this->addModule($this->logHandlers, $logger2, null, false);
			}
		}
		if(null !== $this->configuration->logFile) {
			$logger3 = new ufront_log_FileLogger($this->configuration->logFile);
			$this->addModule($this->logHandlers, $logger3, null, false);
		}
		$path = $this->configuration->basePath;
		if(StringTools::endsWith($path, "/")) {
			$path = _hx_substr($path, 0, strlen($path) - 1);
		}
		if(StringTools::startsWith($path, "/")) {
			$path = _hx_substr($path, 1, null);
		}
		if(strlen($path) > 0) {
			parent::addUrlFilter(new ufront_web_url_filter_DirectoryUrlFilter($path));
		}
		if($this->configuration->urlRewrite !== true) {
			parent::addUrlFilter(new ufront_web_url_filter_PathInfoUrlFilter(null, null));
		}
		if($this->configuration->sessionImplementation !== null) {
			$this->injector->mapType("ufront.web.session.UFHttpSession", null, null)->_toClass($this->configuration->sessionImplementation);
			$this->injector->mapRuntimeTypeOf($this->configuration->sessionImplementation, null)->_toClass($this->configuration->sessionImplementation);
		}
		if($this->configuration->authImplementation !== null) {
			$this->injector->mapType("ufront.auth.UFAuthHandler", null, null)->_toClass($this->configuration->authImplementation);
			$this->injector->mapRuntimeTypeOf($this->configuration->authImplementation, null)->_toClass($this->configuration->authImplementation);
		}
		if($this->configuration->viewEngine !== null) {
			$this->injector->mapType("String", "viewPath", null)->toValue($this->configuration->viewPath);
			$this->injector->mapType("ufront.view.UFViewEngine", null, null)->_toSingleton($this->configuration->viewEngine);
		}
		if($this->configuration->contentDirectory !== null) {
			$this->setContentDirectory($this->configuration->contentDirectory);
		}
		if($this->configuration->defaultLayout !== null) {
			$this->injector->mapType("String", "defaultLayout", null)->toValue($this->configuration->defaultLayout);
		}
		{
			$_g2 = 0;
			$_g11 = $this->configuration->templatingEngines;
			while($_g2 < $_g11->length) {
				$te = $_g11[$_g2];
				++$_g2;
				$this->addTemplatingEngine($te);
				unset($te);
			}
		}
	}}
	public $configuration;
	public $mvcHandler;
	public $remotingHandler;
	public $viewEngine;
	public function execute($httpContext) {
		ufront_web_HttpError::throwIfNull($httpContext, "httpContext", _hx_anonymous(array("fileName" => "UfrontApplication.hx", "lineNumber" => 173, "className" => "ufront.app.UfrontApplication", "methodName" => "execute")));
		if($this->firstRun) {
			$this->initOnFirstExecute($httpContext);
		}
		if(null == $this->configuration->apis) throw new HException('null iterable');
		$__hx__it = $this->configuration->apis->iterator();
		while($__hx__it->hasNext()) {
			unset($api);
			$api = $__hx__it->next();
			$httpContext->injector->mapRuntimeTypeOf($api, null)->_toSingleton($api);
			$asyncApi = ufront_api_UFAsyncApi::getAsyncApi($api);
			if($asyncApi !== null) {
				$httpContext->injector->mapRuntimeTypeOf($asyncApi, null)->_toSingleton($asyncApi);
			}
			unset($asyncApi);
		}
		return parent::execute($httpContext);
	}
	public $firstRun;
	public function initOnFirstExecute($httpContext) {
		$this->firstRun = false;
		$this->injector->mapType("String", "scriptDirectory", null)->toValue($httpContext->request->get_scriptDirectory());
		$this->injector->mapType("String", "contentDirectory", null)->toValue($httpContext->get_contentDirectory());
		if($this->configuration->viewEngine !== null) {
			try {
				$this->viewEngine = $this->injector->getValueForType("ufront.view.UFViewEngine", null);
				if(null == $this->appTemplatingEngines) throw new HException('null iterable');
				$__hx__it = $this->appTemplatingEngines->iterator();
				while($__hx__it->hasNext()) {
					unset($te);
					$te = $__hx__it->next();
					$this->viewEngine->engines->push($te);
				}
			}catch(Exception $__hx__e) {
				$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
				$e = $_ex_;
				{
					$msg = "Failed to load view engine " . _hx_string_or_null(Type::getClassName($this->configuration->viewEngine)) . ": " . Std::string($e);
					$httpContext->messages->push(_hx_anonymous(array("msg" => $msg, "pos" => _hx_anonymous(array("fileName" => "UfrontApplication.hx", "lineNumber" => 206, "className" => "ufront.app.UfrontApplication", "methodName" => "initOnFirstExecute")), "type" => ufront_log_MessageType::$MWarning)));
				}
			}
		}
	}
	public function loadApiContext($apiContext) {
		{
			$_this = $this->remotingHandler;
			$_this->apiContexts->push($apiContext);
			{
				$newAPIs = ufront_api_UFApiContext::getApisInContext($apiContext);
				if(null == $newAPIs) throw new HException('null iterable');
				$__hx__it = $newAPIs->iterator();
				while($__hx__it->hasNext()) {
					unset($api);
					$api = $__hx__it->next();
					$_this->apis->push($api);
				}
			}
		}
		return $this;
	}
	public $appTemplatingEngines;
	public function addTemplatingEngine($engine) {
		$this->appTemplatingEngines->add($engine);
		if($this->viewEngine !== null) {
			$this->viewEngine->engines->push($engine);
		}
		return $this;
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
	function __toString() { return 'ufront.app.UfrontApplication'; }
}
