<?php

class ufront_web_result_ViewResult extends ufront_web_result_ActionResult {
	public function __construct($data = null, $viewPath = null, $templatingEngine = null) {
		if(!php_Boot::$skip_constructor) {
		if($data !== null) {
			$this->data = $data;
		} else {
			$this->data = ufront_view__TemplateData_TemplateData_Impl_::setObject(ufront_web_result_ViewResult_0($this, $data, $templatingEngine, $viewPath), _hx_anonymous(array()));
		}
		$this->helpers = new haxe_ds_StringMap();
		$this->partials = new haxe_ds_StringMap();
		if($viewPath !== null) {
			$this->templateSource = ufront_web_result_TemplateSource::TFromEngine($viewPath, $templatingEngine);
		} else {
			$this->templateSource = ufront_web_result_TemplateSource::$TUnknown;
		}
		$this->layoutSource = ufront_web_result_TemplateSource::$TUnknown;
		$this->finalOutputTrigger = new tink_core_FutureTrigger();
		$this->finalOutput = $this->finalOutputTrigger->future;
	}}
	public $data;
	public $helpers;
	public $partials;
	public $viewFolder;
	public $templateSource;
	public $layoutSource;
	public $finalOutput;
	public $finalOutputTrigger;
	public function withLayout($layoutPath, $templatingEngine = null) {
		$this->layoutSource = ufront_web_result_TemplateSource::TFromEngine($layoutPath, $templatingEngine);
		return $this;
	}
	public function withoutLayout() {
		$this->layoutSource = ufront_web_result_TemplateSource::$TNone;
		return $this;
	}
	public function usingTemplateString($template, $layout = null, $templatingEngine = null) {
		if($templatingEngine === null) {
			$templatingEngine = ufront_view_TemplatingEngines::get_haxe();
		}
		if($template !== null) {
			$this->templateSource = ufront_web_result_TemplateSource::TFromString($template, $templatingEngine);
		}
		if($layout !== null) {
			$this->layoutSource = ufront_web_result_TemplateSource::TFromString($layout, $templatingEngine);
		}
		return $this;
	}
	public function setVar($key, $val) {
		ufront_view__TemplateData_TemplateData_Impl_::array_set($this->data, $key, $val);
		return $this;
	}
	public function setVars($map = null, $obj = null) {
		if($map !== null) {
			ufront_view__TemplateData_TemplateData_Impl_::setMap($this->data, $map);
		}
		if($obj !== null) {
			ufront_view__TemplateData_TemplateData_Impl_::setObject($this->data, $obj);
		}
		return $this;
	}
	public function addHelper($name, $helper) {
		{
			$this->helpers->set($name, $helper);
			$helper;
		}
		return $this;
	}
	public function addHelpers($helpers) {
		if(null == $helpers) throw new HException('null iterable');
		$__hx__it = $helpers->keys();
		while($__hx__it->hasNext()) {
			unset($name);
			$name = $__hx__it->next();
			$this->addHelper($name, $helpers->get($name));
		}
		return $this;
	}
	public function addPartial($name, $partialPath, $templatingEngine = null) {
		{
			$v = ufront_web_result_TemplateSource::TFromEngine($partialPath, $templatingEngine);
			$this->partials->set($name, $v);
			$v;
		}
		return $this;
	}
	public function addPartialString($name, $partialTemplate, $templatingEngine) {
		{
			$v = ufront_web_result_TemplateSource::TFromString($partialTemplate, $templatingEngine);
			$this->partials->set($name, $v);
			$v;
		}
		return $this;
	}
	public function addPartials($partials, $templatingEngine = null) {
		if(null == $partials) throw new HException('null iterable');
		$__hx__it = $partials->keys();
		while($__hx__it->hasNext()) {
			unset($name);
			$name = $__hx__it->next();
			$this->addPartial($name, $partials->get($name), $templatingEngine);
		}
		return $this;
	}
	public function addPartialStrings($partials, $templatingEngine) {
		if(null == $partials) throw new HException('null iterable');
		$__hx__it = $partials->keys();
		while($__hx__it->hasNext()) {
			unset($name);
			$name = $__hx__it->next();
			$this->addPartialString($name, $partials->get($name), $templatingEngine);
		}
		return $this;
	}
	public function executeResult($actionContext) {
		$_g = $this;
		if(ufront_web_result_ViewResult_1($this, $_g, $actionContext)) {
			$this->layoutSource = ufront_web_result_ViewResult::inferLayoutFromContext($actionContext);
		}
		if(ufront_web_result_ViewResult_2($this, $_g, $actionContext)) {
			$this->templateSource = ufront_web_result_ViewResult::inferViewPathFromContext($actionContext);
		}
		if($this->viewFolder === null) {
			$this->viewFolder = ufront_web_result_ViewResult::getViewFolder($actionContext);
		}
		$viewEngine = null;
		try {
			$viewEngine = $actionContext->httpContext->injector->getValueForType("ufront.view.UFViewEngine", null);
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			$e = $_ex_;
			{
				return ufront_core_SurpriseTools::asSurpriseError($e, "Failed to find a UFViewEngine in ViewResult.executeResult(), please make sure that one is made available in your application's injector", _hx_anonymous(array("fileName" => "ViewResult.hx", "lineNumber" => 456, "className" => "ufront.web.result.ViewResult", "methodName" => "executeResult")));
			}
		}
		$defaultData = _hx_anonymous(array());
		$controller = Std::instance($actionContext->controller, _hx_qtype("ufront.web.Controller"));
		if($controller !== null) {
			ufront_view__TemplateData_TemplateData_Impl_::set($defaultData, "baseUri", $controller->baseUri);
		}
		return tink_core__Future_Future_Impl_::_tryMap($this->renderResult($viewEngine, $defaultData), array(new _hx_lambda(array(&$_g, &$actionContext, &$controller, &$defaultData, &$e, &$viewEngine), "ufront_web_result_ViewResult_3"), 'execute'));
	}
	public function renderResult($viewEngine, $defaultData = null) {
		$_g = $this;
		if(ufront_web_result_ViewResult_4($this, $_g, $defaultData, $viewEngine)) {
			return ufront_core_SurpriseTools::asSurpriseError(null, "No layout template source was set on the ViewResult", _hx_anonymous(array("fileName" => "ViewResult.hx", "lineNumber" => 491, "className" => "ufront.web.result.ViewResult", "methodName" => "renderResult")));
		}
		if(ufront_web_result_ViewResult_5($this, $_g, $defaultData, $viewEngine)) {
			return ufront_core_SurpriseTools::asSurpriseError(null, "No view template source was set on the ViewResult", _hx_anonymous(array("fileName" => "ViewResult.hx", "lineNumber" => 493, "className" => "ufront.web.result.ViewResult", "methodName" => "renderResult")));
		}
		if($defaultData === null) {
			$defaultData = ufront_view__TemplateData_TemplateData_Impl_::setObject(ufront_web_result_ViewResult_6($this, $_g, $defaultData, $viewEngine), _hx_anonymous(array()));
		}
		if($this->viewFolder !== null) {
			$this->templateSource = ufront_web_result_ViewResult::addViewFolderToPath($this->templateSource, $this->viewFolder);
			$this->layoutSource = ufront_web_result_ViewResult::addViewFolderToPath($this->layoutSource, $this->viewFolder);
		}
		$templateReady = ufront_web_result_ViewResult::loadTemplateFromSource($this->templateSource, $viewEngine);
		$layoutReady = ufront_web_result_ViewResult::loadTemplateFromSource($this->layoutSource, $viewEngine);
		$partialsReady = ufront_web_result_ViewResult::loadPartialTemplates((new _hx_array(array(ufront_web_result_ViewResult::$globalPartials, $this->partials))), $viewEngine);
		return _hx_deref((ufront_web_result_ViewResult_7($this, $_g, $defaultData, $layoutReady, $partialsReady, $templateReady, $viewEngine)))->map(array(new _hx_lambda(array(&$_g, &$defaultData, &$layoutReady, &$partialsReady, &$templateReady, &$viewEngine), "ufront_web_result_ViewResult_8"), 'execute'));
	}
	public function writeResponse($response, $actionContext) {
		$actionContext->httpContext->response->set_contentType("text/html");
		$actionContext->httpContext->response->write($response);
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
	static function create($data) {
		return new ufront_web_result_ViewResult(ufront_view__TemplateData_TemplateData_Impl_::setObject(ufront_web_result_ViewResult_9($data), $data), null, null);
	}
	static $globalValues;
	static $globalHelpers;
	static $globalPartials;
	static function getCombinedMap($mapSets) {
		$combinedMaps = new haxe_ds_StringMap();
		{
			$_g = 0;
			while($_g < $mapSets->length) {
				$set = $mapSets[$_g];
				++$_g;
				if(null == $set) throw new HException('null iterable');
				$__hx__it = $set->keys();
				while($__hx__it->hasNext()) {
					unset($key);
					$key = $__hx__it->next();
					$v = $set->get($key);
					$combinedMaps->set($key, $v);
					$v;
					unset($v);
				}
				unset($set);
			}
		}
		return $combinedMaps;
	}
	static function getViewFolder($actionContext) {
		$controllerCls = Type::getClass($actionContext->controller);
		$viewFolderMeta = haxe_rtti_Meta::getType($controllerCls)->viewFolder;
		$viewFolder = null;
		if($viewFolderMeta !== null && $viewFolderMeta->length > 0) {
			$viewFolder = "" . Std::string($viewFolderMeta[0]);
			$viewFolder = haxe_io_Path::removeTrailingSlashes($viewFolder);
		} else {
			$controllerName = _hx_explode(".", Type::getClassName(Type::getClass($actionContext->controller)))->pop();
			$controllerName = _hx_string_or_null(strtolower(_hx_char_at($controllerName, 0))) . _hx_string_or_null(_hx_substr($controllerName, 1, null));
			if(StringTools::endsWith($controllerName, "Controller")) {
				$controllerName = _hx_substr($controllerName, 0, strlen($controllerName) - 10);
			}
			$viewFolder = $controllerName;
		}
		return $viewFolder;
	}
	static function inferViewPathFromContext($actionContext) {
		$viewPath = null;
		$controllerCls = Type::getClass($actionContext->controller);
		$fieldsMeta = haxe_rtti_Meta::getFields($controllerCls);
		$actionFieldMeta = Reflect::field($fieldsMeta, $actionContext->action);
		if($actionFieldMeta !== null && $actionFieldMeta->template !== null && $actionFieldMeta->template->length > 0) {
			$viewPath = "" . Std::string($actionFieldMeta->template[0]);
		} else {
			$action = $actionContext->action;
			$startsWithDo = StringTools::startsWith($action, "do");
			$thirdCharUpperCase = strlen($action) > 2 && _hx_char_at($action, 2) === strtoupper(_hx_char_at($action, 2));
			if($startsWithDo && $thirdCharUpperCase) {
				$action = _hx_substr($action, 2, null);
			}
			$viewPath = _hx_string_or_null(strtolower(_hx_char_at($action, 0))) . _hx_string_or_null(_hx_substr($action, 1, null));
		}
		return ufront_web_result_TemplateSource::TFromEngine($viewPath, null);
	}
	static function inferLayoutFromContext($actionContext) {
		$layoutPath = null;
		$controllerCls = Type::getClass($actionContext->controller);
		$classMeta = haxe_rtti_Meta::getType($controllerCls);
		$fieldsMeta = haxe_rtti_Meta::getFields($controllerCls);
		$actionFieldMeta = Reflect::field($fieldsMeta, $actionContext->action);
		if($actionFieldMeta !== null && $actionFieldMeta->layout !== null && $actionFieldMeta->layout->length > 0) {
			$layoutPath = "" . Std::string($actionFieldMeta->layout[0]);
		} else {
			if($classMeta->layout !== null && $classMeta->layout->length > 0) {
				$layoutPath = "" . Std::string($classMeta->layout[0]);
			} else {
				try {
					$layoutPath = $actionContext->httpContext->injector->getValueForType("String", "defaultLayout");
					if($layoutPath !== null && StringTools::startsWith($layoutPath, "/") === false) {
						$layoutPath = "/" . _hx_string_or_null($layoutPath);
					}
				}catch(Exception $__hx__e) {
					$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
					$e = $_ex_;
					{}
				}
			}
		}
		if($layoutPath !== null) {
			return ufront_web_result_TemplateSource::TFromEngine($layoutPath, null);
		} else {
			return ufront_web_result_TemplateSource::$TNone;
		}
	}
	static function addViewFolderToPath($layoutSource, $viewFolder) {
		switch($layoutSource->index) {
		case 1:{
			$engine = _hx_deref($layoutSource)->params[1];
			$path = _hx_deref($layoutSource)->params[0];
			{
				if(StringTools::startsWith($path, "/")) {
					$path = _hx_substr($path, 1, null);
				} else {
					$path = "" . _hx_string_or_null($viewFolder) . "/" . _hx_string_or_null($path);
				}
				return ufront_web_result_TemplateSource::TFromEngine($path, $engine);
			}
		}break;
		default:{
			return $layoutSource;
		}break;
		}
	}
	static function loadTemplateFromSource($source, $engine) {
		switch($source->index) {
		case 0:{
			$templatingEngine = _hx_deref($source)->params[1];
			$str = _hx_deref($source)->params[0];
			try {
				return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Success($templatingEngine->factory($str)));
			}catch(Exception $__hx__e) {
				$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
				$e = $_ex_;
				{
					$engine1 = "Templating Engine: \"" . _hx_string_or_null($templatingEngine->type) . "\"";
					$template = "String template: \"" . _hx_string_or_null($str) . "\"";
					return tink_core__Future_Future_Impl_::sync(ufront_web_result_ViewResult::error("Failed to parse template.", "" . _hx_string_or_null($engine1) . "\x0A" . _hx_string_or_null($template), _hx_anonymous(array("fileName" => "ViewResult.hx", "lineNumber" => 630, "className" => "ufront.web.result.ViewResult", "methodName" => "loadTemplateFromSource"))));
				}
			}
		}break;
		case 1:{
			$templatingEngine1 = _hx_deref($source)->params[1];
			$path = _hx_deref($source)->params[0];
			return $engine->getTemplate($path, $templatingEngine1);
		}break;
		case 2:case 3:{
			return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Success(null));
		}break;
		}
	}
	static function loadPartialTemplates($partialSources, $engine) {
		$allPartialSources = ufront_web_result_ViewResult::getCombinedMap($partialSources);
		$allPartialTemplates = new haxe_ds_StringMap();
		$partialErrors = new haxe_ds_StringMap();
		$allPartialFutures = (new _hx_array(array()));
		if(null == $allPartialSources) throw new HException('null iterable');
		$__hx__it = $allPartialSources->keys();
		while($__hx__it->hasNext()) {
			unset($name);
			$name = $__hx__it->next();
			$source = $allPartialSources->get($name);
			$surprise = ufront_web_result_ViewResult::loadTemplateFromSource($source, $engine);
			$surprise(array(new _hx_lambda(array(&$allPartialFutures, &$allPartialSources, &$allPartialTemplates, &$engine, &$name, &$partialErrors, &$partialSources, &$source, &$surprise), "ufront_web_result_ViewResult_10"), 'execute'));
			$allPartialFutures->push($surprise);
			unset($surprise,$source);
		}
		return tink_core__Future_Future_Impl_::map(tink_core__Future_Future_Impl_::ofMany($allPartialFutures, null), array(new _hx_lambda(array(&$allPartialFutures, &$allPartialSources, &$allPartialTemplates, &$engine, &$partialErrors, &$partialSources), "ufront_web_result_ViewResult_11"), 'execute'), null);
	}
	static function addHelpersForPartials($partialTemplates, $contextData, $contextHelpers) {
		if(null == $partialTemplates) throw new HException('null iterable');
		$__hx__it = $partialTemplates->keys();
		while($__hx__it->hasNext()) {
			unset($name);
			$name = $__hx__it->next();
			$partial = $partialTemplates->get($name);
			$partialFn = array(new _hx_lambda(array(&$contextData, &$contextHelpers, &$name, &$partial, &$partialTemplates), "ufront_web_result_ViewResult_12"), 'execute');
			{
				$v = ufront_view__TemplateHelper_TemplateHelper_Impl_::from1($partialFn);
				$contextHelpers->set($name, $v);
				$v;
				unset($v);
			}
			unset($partialFn,$partial);
		}
	}
	static function executeTemplate($section, $tplOutcome, $combinedData, $combinedHelpers) {
		switch($tplOutcome->index) {
		case 0:{
			$tpl = _hx_deref($tplOutcome)->params[0];
			try {
				return tink_core_Outcome::Success($tpl($combinedData, $combinedHelpers));
			}catch(Exception $__hx__e) {
				$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
				$e = $_ex_;
				{
					return ufront_web_result_ViewResult::error("Unable to execute " . _hx_string_or_null($section) . " template: " . Std::string($e), $e, _hx_anonymous(array("fileName" => "ViewResult.hx", "lineNumber" => 693, "className" => "ufront.web.result.ViewResult", "methodName" => "executeTemplate")));
				}
			}
		}break;
		case 1:{
			$err = _hx_deref($tplOutcome)->params[0];
			return ufront_web_result_ViewResult::error("Unable to load " . _hx_string_or_null($section) . " template: " . Std::string($err), $err, _hx_anonymous(array("fileName" => "ViewResult.hx", "lineNumber" => 696, "className" => "ufront.web.result.ViewResult", "methodName" => "executeTemplate")));
		}break;
		}
	}
	static function error($reason, $data, $pos = null) {
		return tink_core_Outcome::Failure(ufront_web_HttpError::internalServerError($reason, $data, $pos));
	}
	function __toString() { return 'ufront.web.result.ViewResult'; }
}
ufront_web_result_ViewResult::$globalValues = ufront_view__TemplateData_TemplateData_Impl_::setObject(ufront_web_result_ViewResult_13(), _hx_anonymous(array()));
ufront_web_result_ViewResult::$globalHelpers = new haxe_ds_StringMap();
ufront_web_result_ViewResult::$globalPartials = new haxe_ds_StringMap();
function ufront_web_result_ViewResult_0(&$__hx__this, &$data, &$templatingEngine, &$viewPath) {
	{
		$obj = _hx_anonymous(array());
		return (($obj !== null) ? $obj : _hx_anonymous(array()));
	}
}
function ufront_web_result_ViewResult_1(&$__hx__this, &$_g, &$actionContext) {
	{
		$_g1 = $__hx__this->layoutSource;
		switch($_g1->index) {
		case 3:{
			return true;
		}break;
		default:{
			return false;
		}break;
		}
		unset($_g1);
	}
}
function ufront_web_result_ViewResult_2(&$__hx__this, &$_g, &$actionContext) {
	{
		$_g2 = $__hx__this->templateSource;
		switch($_g2->index) {
		case 3:{
			return true;
		}break;
		default:{
			return false;
		}break;
		}
		unset($_g2);
	}
}
function ufront_web_result_ViewResult_3(&$_g, &$actionContext, &$controller, &$defaultData, &$e, &$viewEngine, $finalOut) {
	{
		$finalOut = ufront_web_result_ContentResult::replaceVirtualLinks($actionContext, $finalOut);
		$_g->writeResponse($finalOut, $actionContext);
		{
			$_this = $_g->finalOutputTrigger;
			if($_this->{"list"} === null) {
				false;
			} else {
				$list = $_this->{"list"};
				$_this->{"list"} = null;
				$_this->result = $finalOut;
				tink_core__Callback_CallbackList_Impl_::invoke($list, $finalOut);
				tink_core__Callback_CallbackList_Impl_::clear($list);
				true;
			}
		}
		return tink_core_Noise::$Noise;
	}
}
function ufront_web_result_ViewResult_4(&$__hx__this, &$_g, &$defaultData, &$viewEngine) {
	{
		$_g1 = $__hx__this->layoutSource;
		switch($_g1->index) {
		case 3:{
			return true;
		}break;
		default:{
			return false;
		}break;
		}
		unset($_g1);
	}
}
function ufront_web_result_ViewResult_5(&$__hx__this, &$_g, &$defaultData, &$viewEngine) {
	{
		$_g2 = $__hx__this->templateSource;
		switch($_g2->index) {
		case 3:{
			return true;
		}break;
		default:{
			return false;
		}break;
		}
		unset($_g2);
	}
}
function ufront_web_result_ViewResult_6(&$__hx__this, &$_g, &$defaultData, &$viewEngine) {
	{
		$obj = _hx_anonymous(array());
		return (($obj !== null) ? $obj : _hx_anonymous(array()));
	}
}
function ufront_web_result_ViewResult_7(&$__hx__this, &$_g, &$defaultData, &$layoutReady, &$partialsReady, &$templateReady, &$viewEngine) {
	{
		$combinedFuture = tink_core__Future_Future_Impl_::ofMany((new _hx_array(array($templateReady, $layoutReady, $partialsReady))), null);
		$handle = array(new _hx_lambda(array(&$_g, &$combinedFuture, &$defaultData, &$layoutReady, &$partialsReady, &$templateReady, &$viewEngine), "ufront_web_result_ViewResult_14"), 'execute');
		$map = array(new _hx_lambda(array(&$_g, &$combinedFuture, &$defaultData, &$handle, &$layoutReady, &$partialsReady, &$templateReady, &$viewEngine), "ufront_web_result_ViewResult_15"), 'execute');
		return _hx_anonymous(array("handle" => $handle, "map" => $map));
	}
}
function ufront_web_result_ViewResult_8(&$_g, &$defaultData, &$layoutReady, &$partialsReady, &$templateReady, &$viewEngine, $viewTemplate, $layoutTemplate, $partialTemplates) {
	{
		try {
			$combinedData = ufront_view__TemplateData_TemplateData_Impl_::fromMany((new _hx_array(array($defaultData, ufront_web_result_ViewResult::$globalValues, $_g->data))));
			$combinedHelpers = ufront_web_result_ViewResult::getCombinedMap((new _hx_array(array(ufront_web_result_ViewResult::$globalHelpers, $_g->helpers))));
			ufront_web_result_ViewResult::addHelpersForPartials(tink_core_OutcomeTools::sure($partialTemplates), $combinedData, $combinedHelpers);
			$viewOut = tink_core_OutcomeTools::sure(ufront_web_result_ViewResult::executeTemplate("view", $viewTemplate, $combinedData, $combinedHelpers));
			if(ufront_web_result_ViewResult_16($_g, $combinedData, $combinedHelpers, $defaultData, $layoutReady, $layoutTemplate, $partialTemplates, $partialsReady, $templateReady, $viewEngine, $viewOut, $viewTemplate)) {
				return tink_core_Outcome::Success($viewOut);
			} else {
				$layoutOut = tink_core_OutcomeTools::sure(ufront_web_result_ViewResult::executeTemplate("layout", $layoutTemplate, ufront_view__TemplateData_TemplateData_Impl_::set($combinedData, "viewContent", $viewOut), $combinedHelpers));
				return tink_core_Outcome::Success($layoutOut);
			}
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			if(($e = $_ex_) instanceof tink_core_TypedError){
				return tink_core_Outcome::Failure($e);
			} else throw $__hx__e;;
		}
	}
}
function ufront_web_result_ViewResult_9(&$data) {
	{
		$obj = _hx_anonymous(array());
		return (($obj !== null) ? $obj : _hx_anonymous(array()));
	}
}
function ufront_web_result_ViewResult_10(&$allPartialFutures, &$allPartialSources, &$allPartialTemplates, &$engine, &$name, &$partialErrors, &$partialSources, &$source, &$surprise, $outcome) {
	{
		switch($outcome->index) {
		case 0:{
			$tpl = _hx_deref($outcome)->params[0];
			if($tpl !== null) {
				{
					$allPartialTemplates->set($name, $tpl);
					$tpl;
				}
			} else {
				$v = ufront_web_HttpError::internalServerError("Partial " . _hx_string_or_null($name) . " must be either TFromString or TFromEngine, was " . Std::string($source), null, _hx_anonymous(array("fileName" => "ViewResult.hx", "lineNumber" => 647, "className" => "ufront.web.result.ViewResult", "methodName" => "loadPartialTemplates")));
				$partialErrors->set($name, $v);
				$v;
			}
		}break;
		case 1:{
			$err = _hx_deref($outcome)->params[0];
			{
				$partialErrors->set($name, $err);
				$err;
			}
		}break;
		}
	}
}
function ufront_web_result_ViewResult_11(&$allPartialFutures, &$allPartialSources, &$allPartialTemplates, &$engine, &$partialErrors, &$partialSources, $_) {
	{
		$numberOfErrors = Lambda::count($partialErrors, null);
		switch($numberOfErrors) {
		case 0:{
			return tink_core_Outcome::Success($allPartialTemplates);
		}break;
		case 1:{
			$err1 = _hx_array_get((ufront_web_result_ViewResult_17($_, $allPartialFutures, $allPartialSources, $allPartialTemplates, $engine, $numberOfErrors, $partialErrors, $partialSources)), 0);
			return tink_core_Outcome::Failure($err1);
		}break;
		default:{
			$partialNames = null;
			{
				$_g1 = (new _hx_array(array()));
				if(null == $partialErrors) throw new HException('null iterable');
				$__hx__it = $partialErrors->keys();
				while($__hx__it->hasNext()) {
					unset($name1);
					$name1 = $__hx__it->next();
					$_g1->push($name1);
				}
				$partialNames = $_g1;
			}
			return ufront_web_result_ViewResult::error("Partials " . Std::string($partialNames) . " failed to load: " . _hx_string_or_null($partialErrors->toString()), $partialErrors, _hx_anonymous(array("fileName" => "ViewResult.hx", "lineNumber" => 661, "className" => "ufront.web.result.ViewResult", "methodName" => "loadPartialTemplates")));
		}break;
		}
	}
}
function ufront_web_result_ViewResult_12(&$contextData, &$contextHelpers, &$name, &$partial, &$partialTemplates, $partialData) {
	{
		$combinedPartialData = _hx_anonymous(array());
		ufront_view__TemplateData_TemplateData_Impl_::setObject($combinedPartialData, $contextData);
		ufront_view__TemplateData_TemplateData_Impl_::setObject($combinedPartialData, $partialData);
		ufront_view__TemplateData_TemplateData_Impl_::set($combinedPartialData, "__current__", $partialData);
		return tink_core_OutcomeTools::sure(ufront_web_result_ViewResult::executeTemplate("Partial[" . _hx_string_or_null($name) . "]", tink_core_Outcome::Success($partial), $combinedPartialData, $contextHelpers));
	}
}
function ufront_web_result_ViewResult_13() {
	{
		$obj = _hx_anonymous(array());
		return (($obj !== null) ? $obj : _hx_anonymous(array()));
	}
}
function ufront_web_result_ViewResult_14(&$_g, &$combinedFuture, &$defaultData, &$layoutReady, &$partialsReady, &$templateReady, &$viewEngine, $cb) {
	{
		$combinedFuture(array(new _hx_lambda(array(&$_g, &$cb, &$combinedFuture, &$defaultData, &$layoutReady, &$partialsReady, &$templateReady, &$viewEngine), "ufront_web_result_ViewResult_18"), 'execute'));
	}
}
function ufront_web_result_ViewResult_15(&$_g, &$combinedFuture, &$defaultData, &$handle, &$layoutReady, &$partialsReady, &$templateReady, &$viewEngine, $cb1) {
	{
		return tink_core__Future_Future_Impl_::map($combinedFuture, array(new _hx_lambda(array(&$_g, &$cb1, &$combinedFuture, &$defaultData, &$handle, &$layoutReady, &$partialsReady, &$templateReady, &$viewEngine), "ufront_web_result_ViewResult_19"), 'execute'), null);
	}
}
function ufront_web_result_ViewResult_16(&$_g, &$combinedData, &$combinedHelpers, &$defaultData, &$layoutReady, &$layoutTemplate, &$partialTemplates, &$partialsReady, &$templateReady, &$viewEngine, &$viewOut, &$viewTemplate) {
	switch($layoutTemplate->index) {
	case 0:{
		if(_hx_deref($layoutTemplate)->params[0] === null) {
			return true;
		} else {
			switch(_hx_deref($layoutTemplate)->params[0]) {
			default:{
				return false;
			}break;
			}
		}
	}break;
	default:{
		return false;
	}break;
	}
}
function ufront_web_result_ViewResult_17(&$_, &$allPartialFutures, &$allPartialSources, &$allPartialTemplates, &$engine, &$numberOfErrors, &$partialErrors, &$partialSources) {
	{
		$_g = (new _hx_array(array()));
		if(null == $partialErrors) throw new HException('null iterable');
		$__hx__it = $partialErrors->iterator();
		while($__hx__it->hasNext()) {
			unset($e);
			$e = $__hx__it->next();
			$_g->push($e);
		}
		return $_g;
	}
}
function ufront_web_result_ViewResult_18(&$_g, &$cb, &$combinedFuture, &$defaultData, &$layoutReady, &$partialsReady, &$templateReady, &$viewEngine, $values) {
	{
		call_user_func_array($cb, array($values[0], $values[1], $values[2]));
	}
}
function ufront_web_result_ViewResult_19(&$_g, &$cb1, &$combinedFuture, &$defaultData, &$handle, &$layoutReady, &$partialsReady, &$templateReady, &$viewEngine, $values1) {
	{
		return call_user_func_array($cb1, array($values1[0], $values1[1], $values1[2]));
	}
}
