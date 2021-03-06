<?php

// Generated by Haxe 3.4.4
class ufront_web_result_ViewResult extends ufront_web_result_ActionResult {
	public function __construct($data = null, $viewPath = null, $templatingEngine = null) {
		if(!php_Boot::$skip_constructor) {
		$tmp = null;
		if($data !== null) {
			$tmp = $data;
		} else {
			$obj = _hx_anonymous(array());
			$this1 = null;
			if($obj !== null) {
				$this1 = $obj;
			} else {
				$this1 = _hx_anonymous(array());
			}
			$tmp = ufront_view__TemplateData_TemplateData_Impl_::setObject($this1, _hx_anonymous(array()));
		}
		$this->data = $tmp;
		$this->helpers = new haxe_ds_StringMap();
		$this->partials = new haxe_ds_StringMap();
		$tmp1 = null;
		if($viewPath !== null) {
			$tmp1 = ufront_web_result_TemplateSource::TFromEngine($viewPath, $templatingEngine);
		} else {
			$tmp1 = ufront_web_result_TemplateSource::$TUnknown;
		}
		$this->templateSource = $tmp1;
		$this->layoutSource = ufront_web_result_TemplateSource::$TUnknown;
		$this->finalOutputTrigger = new tink_core_FutureTrigger();
		$this->finalOutput = (property_exists($this->finalOutputTrigger, "future") ? $this->finalOutputTrigger->future: array($this->finalOutputTrigger, "future"));
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
		$this->helpers->set($name, $helper);
		return $this;
	}
	public function addHelpers($helpers) {
		{
			$name = $helpers->keys();
			while($name->hasNext()) {
				$name1 = $name->next();
				$this->addHelper($name1, $helpers->get($name1));
				unset($name1);
			}
		}
		return $this;
	}
	public function addPartial($name, $partialPath, $templatingEngine = null) {
		{
			$v = ufront_web_result_TemplateSource::TFromEngine($partialPath, $templatingEngine);
			$this->partials->set($name, $v);
		}
		return $this;
	}
	public function addPartialString($name, $partialTemplate, $templatingEngine) {
		{
			$v = ufront_web_result_TemplateSource::TFromString($partialTemplate, $templatingEngine);
			$this->partials->set($name, $v);
		}
		return $this;
	}
	public function addPartials($partials, $templatingEngine = null) {
		{
			$name = $partials->keys();
			while($name->hasNext()) {
				$name1 = $name->next();
				$this->addPartial($name1, $partials->get($name1), $templatingEngine);
				unset($name1);
			}
		}
		return $this;
	}
	public function addPartialStrings($partials, $templatingEngine) {
		{
			$name = $partials->keys();
			while($name->hasNext()) {
				$name1 = $name->next();
				$this->addPartialString($name1, $partials->get($name1), $templatingEngine);
				unset($name1);
			}
		}
		return $this;
	}
	public function executeResult($actionContext) {
		$_gthis = $this;
		$_g = $this->layoutSource;
		$tmp = null;
		if($_g->index === 3) {
			$tmp = true;
		} else {
			$tmp = false;
		}
		if($tmp) {
			$this->layoutSource = ufront_web_result_ViewResult::inferLayoutFromContext($actionContext);
		}
		$_g1 = $this->templateSource;
		$tmp1 = null;
		if($_g1->index === 3) {
			$tmp1 = true;
		} else {
			$tmp1 = false;
		}
		if($tmp1) {
			$this->templateSource = ufront_web_result_ViewResult::inferViewPathFromContext($actionContext);
		}
		if($this->viewFolder === null) {
			$this->viewFolder = ufront_web_result_ViewResult::getViewFolder($actionContext);
		}
		$viewEngine = null;
		try {
			$viewEngine = $actionContext->httpContext->injector->getValueForType("ufront.view.UFViewEngine", null);
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
			$e = $_ex_;
			{
				return ufront_core_SurpriseTools::asSurpriseError($e, "Failed to find a UFViewEngine in ViewResult.executeResult(), please make sure that one is made available in your application's injector", _hx_anonymous(array("fileName" => "ViewResult.hx", "lineNumber" => 456, "className" => "ufront.web.result.ViewResult", "methodName" => "executeResult")));
			}
		}
		$this1 = _hx_anonymous(array());
		$defaultData = $this1;
		$controller = Std::instance($actionContext->controller, _hx_qtype("ufront.web.Controller"));
		if($controller !== null) {
			ufront_view__TemplateData_TemplateData_Impl_::set($defaultData, "baseUri", $controller->baseUri);
		}
		return tink_core__Future_Future_Impl_::_tryMap($this->renderResult($viewEngine, $defaultData), array(new _hx_lambda(array(&$_gthis, &$actionContext), "ufront_web_result_ViewResult_0"), 'execute'));
	}
	public function renderResult($viewEngine, $defaultData = null) {
		$_gthis = $this;
		$_g = $this->layoutSource;
		$tmp = null;
		if($_g->index === 3) {
			$tmp = true;
		} else {
			$tmp = false;
		}
		if($tmp) {
			return ufront_core_SurpriseTools::asSurpriseError(null, "No layout template source was set on the ViewResult", _hx_anonymous(array("fileName" => "ViewResult.hx", "lineNumber" => 491, "className" => "ufront.web.result.ViewResult", "methodName" => "renderResult")));
		}
		$_g1 = $this->templateSource;
		$tmp1 = null;
		if($_g1->index === 3) {
			$tmp1 = true;
		} else {
			$tmp1 = false;
		}
		if($tmp1) {
			return ufront_core_SurpriseTools::asSurpriseError(null, "No view template source was set on the ViewResult", _hx_anonymous(array("fileName" => "ViewResult.hx", "lineNumber" => 493, "className" => "ufront.web.result.ViewResult", "methodName" => "renderResult")));
		}
		if($defaultData === null) {
			$obj = _hx_anonymous(array());
			$this1 = null;
			if($obj !== null) {
				$this1 = $obj;
			} else {
				$this1 = _hx_anonymous(array());
			}
			$defaultData = ufront_view__TemplateData_TemplateData_Impl_::setObject($this1, _hx_anonymous(array()));
		}
		if($this->viewFolder !== null) {
			$this->templateSource = ufront_web_result_ViewResult::addViewFolderToPath($this->templateSource, $this->viewFolder);
			$this->layoutSource = ufront_web_result_ViewResult::addViewFolderToPath($this->layoutSource, $this->viewFolder);
		}
		$templateReady = ufront_web_result_ViewResult::loadTemplateFromSource($this->templateSource, $viewEngine);
		$layoutReady = ufront_web_result_ViewResult::loadTemplateFromSource($this->layoutSource, $viewEngine);
		$partialsReady = ufront_web_result_ViewResult::loadPartialTemplates((new _hx_array(array(ufront_web_result_ViewResult::$globalPartials, $this->partials))), $viewEngine);
		$combinedFuture = tink_core__Future_Future_Impl_::ofMany((new _hx_array(array($templateReady, $layoutReady, $partialsReady))), null);
		$handle = array(new _hx_lambda(array(&$combinedFuture), "ufront_web_result_ViewResult_1"), 'execute');
		$map = array(new _hx_lambda(array(&$combinedFuture), "ufront_web_result_ViewResult_2"), 'execute');
		return _hx_deref(_hx_anonymous(array("handle" => $handle, "map" => $map)))->map(array(new _hx_lambda(array(&$_gthis, &$defaultData), "ufront_web_result_ViewResult_3"), 'execute'));
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
		$obj = _hx_anonymous(array());
		$this1 = null;
		if($obj !== null) {
			$this1 = $obj;
		} else {
			$this1 = _hx_anonymous(array());
		}
		return new ufront_web_result_ViewResult(ufront_view__TemplateData_TemplateData_Impl_::setObject($this1, $data), null, null);
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
				$_g = $_g + 1;
				{
					$key = $set->keys();
					while($key->hasNext()) {
						$key1 = $key->next();
						$v = $set->get($key1);
						$combinedMaps->set($key1, $v);
						unset($v,$key1);
					}
					unset($key);
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
		$tmp = null;
		if($viewFolderMeta !== null) {
			$tmp = $viewFolderMeta->length > 0;
		} else {
			$tmp = false;
		}
		if($tmp) {
			$viewFolder = "" . Std::string($viewFolderMeta[0]);
			$viewFolder = haxe_io_Path::removeTrailingSlashes($viewFolder);
		} else {
			$controllerName = Type::getClass($actionContext->controller);
			$controllerName1 = _hx_explode(".", Type::getClassName($controllerName))->pop();
			$controllerName2 = strtolower(_hx_char_at($controllerName1, 0));
			$controllerName1 = _hx_string_or_null($controllerName2) . _hx_string_or_null(_hx_substr($controllerName1, 1, null));
			if(StringTools::endsWith($controllerName1, "Controller")) {
				$controllerName1 = _hx_substr($controllerName1, 0, strlen($controllerName1) - 10);
			}
			$viewFolder = $controllerName1;
		}
		return $viewFolder;
	}
	static function inferViewPathFromContext($actionContext) {
		$viewPath = null;
		$controllerCls = Type::getClass($actionContext->controller);
		$fieldsMeta = haxe_rtti_Meta::getFields($controllerCls);
		$actionFieldMeta = Reflect::field($fieldsMeta, $actionContext->action);
		$tmp = null;
		$tmp1 = null;
		if($actionFieldMeta !== null) {
			$tmp1 = $actionFieldMeta->template !== null;
		} else {
			$tmp1 = false;
		}
		if($tmp1) {
			$tmp = $actionFieldMeta->template->length > 0;
		} else {
			$tmp = false;
		}
		if($tmp) {
			$viewPath = "" . Std::string($actionFieldMeta->template[0]);
		} else {
			$action = $actionContext->action;
			$startsWithDo = StringTools::startsWith($action, "do");
			$thirdCharUpperCase = null;
			if(strlen($action) > 2) {
				$thirdCharUpperCase1 = _hx_char_at($action, 2);
				$thirdCharUpperCase = $thirdCharUpperCase1 === strtoupper(_hx_char_at($action, 2));
			} else {
				$thirdCharUpperCase = false;
			}
			$tmp2 = null;
			if($startsWithDo) {
				$tmp2 = $thirdCharUpperCase;
			} else {
				$tmp2 = false;
			}
			if($tmp2) {
				$action = _hx_substr($action, 2, null);
			}
			$viewPath1 = strtolower(_hx_char_at($action, 0));
			$viewPath = _hx_string_or_null($viewPath1) . _hx_string_or_null(_hx_substr($action, 1, null));
		}
		return ufront_web_result_TemplateSource::TFromEngine($viewPath, null);
	}
	static function inferLayoutFromContext($actionContext) {
		$layoutPath = null;
		$controllerCls = Type::getClass($actionContext->controller);
		$classMeta = haxe_rtti_Meta::getType($controllerCls);
		$fieldsMeta = haxe_rtti_Meta::getFields($controllerCls);
		$actionFieldMeta = Reflect::field($fieldsMeta, $actionContext->action);
		$tmp = null;
		$tmp1 = null;
		if($actionFieldMeta !== null) {
			$tmp1 = $actionFieldMeta->layout !== null;
		} else {
			$tmp1 = false;
		}
		if($tmp1) {
			$tmp = $actionFieldMeta->layout->length > 0;
		} else {
			$tmp = false;
		}
		if($tmp) {
			$layoutPath = "" . Std::string($actionFieldMeta->layout[0]);
		} else {
			$tmp2 = null;
			if($classMeta->layout !== null) {
				$tmp2 = $classMeta->layout->length > 0;
			} else {
				$tmp2 = false;
			}
			if($tmp2) {
				$layoutPath = "" . Std::string($classMeta->layout[0]);
			} else {
				try {
					$layoutPath = $actionContext->httpContext->injector->getValueForType("String", "defaultLayout");
					$tmp3 = null;
					if($layoutPath !== null) {
						$tmp3 = StringTools::startsWith($layoutPath, "/") === false;
					} else {
						$tmp3 = false;
					}
					if($tmp3) {
						$layoutPath = "/" . _hx_string_or_null($layoutPath);
					}
				}catch(Exception $__hx__e) {
					$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
					$e = $_ex_;
					{
					}
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
		if($layoutSource->index === 1) {
			$engine = _hx_deref($layoutSource)->params[1];
			$path = _hx_deref($layoutSource)->params[0];
			if(StringTools::startsWith($path, "/")) {
				$path = _hx_substr($path, 1, null);
			} else {
				$path = "" . _hx_string_or_null($viewFolder) . "/" . _hx_string_or_null($path);
			}
			return ufront_web_result_TemplateSource::TFromEngine($path, $engine);
		} else {
			return $layoutSource;
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
				$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
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
		{
			$name = $allPartialSources->keys();
			while($name->hasNext()) {
				$name1 = $name->next();
				$source = $allPartialSources->get($name1);
				$surprise = ufront_web_result_ViewResult::loadTemplateFromSource($source, $engine);
				call_user_func_array($surprise, array(array(new _hx_lambda(array(&$allPartialTemplates, &$name1, &$partialErrors, &$source), "ufront_web_result_ViewResult_4"), 'execute')));
				$allPartialFutures->push($surprise);
				unset($surprise,$source,$name1);
			}
		}
		return tink_core__Future_Future_Impl_::map(tink_core__Future_Future_Impl_::ofMany($allPartialFutures, null), array(new _hx_lambda(array(&$allPartialTemplates, &$partialErrors), "ufront_web_result_ViewResult_5"), 'execute'), null);
	}
	static function addHelpersForPartials($partialTemplates, $contextData, $contextHelpers) {
		$name = $partialTemplates->keys();
		while($name->hasNext()) {
			$name1 = $name->next();
			$partial = $partialTemplates->get($name1);
			$partialFn = array(new _hx_lambda(array(&$contextData, &$contextHelpers, &$name1, &$partial), "ufront_web_result_ViewResult_6"), 'execute');
			{
				$v = ufront_view__TemplateHelper_TemplateHelper_Impl_::from1($partialFn);
				$contextHelpers->set($name1, $v);
				unset($v);
			}
			unset($partialFn,$partial,$name1);
		}
	}
	static function executeTemplate($section, $tplOutcome, $combinedData, $combinedHelpers) {
		switch($tplOutcome->index) {
		case 0:{
			$tpl = _hx_deref($tplOutcome)->params[0];
			try {
				return tink_core_Outcome::Success(call_user_func_array($tpl, array($combinedData, $combinedHelpers)));
			}catch(Exception $__hx__e) {
				$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
				$e = $_ex_;
				{
					$tmp = "Unable to execute " . _hx_string_or_null($section) . " template: " . Std::string($e);
					return ufront_web_result_ViewResult::error($tmp, $e, _hx_anonymous(array("fileName" => "ViewResult.hx", "lineNumber" => 693, "className" => "ufront.web.result.ViewResult", "methodName" => "executeTemplate")));
				}
			}
		}break;
		case 1:{
			$err = _hx_deref($tplOutcome)->params[0];
			$tmp1 = "Unable to load " . _hx_string_or_null($section) . " template: " . Std::string($err);
			return ufront_web_result_ViewResult::error($tmp1, $err, _hx_anonymous(array("fileName" => "ViewResult.hx", "lineNumber" => 696, "className" => "ufront.web.result.ViewResult", "methodName" => "executeTemplate")));
		}break;
		}
	}
	static function error($reason, $data, $pos = null) {
		return tink_core_Outcome::Failure(ufront_web_HttpError::internalServerError($reason, $data, $pos));
	}
	function __toString() { return 'ufront.web.result.ViewResult'; }
}
ufront_web_result_ViewResult::$globalValues = ufront_web_result_ViewResult_7();
ufront_web_result_ViewResult::$globalHelpers = new haxe_ds_StringMap();
ufront_web_result_ViewResult::$globalPartials = new haxe_ds_StringMap();
function ufront_web_result_ViewResult_0(&$_gthis, &$actionContext, $finalOut) {
	{
		$finalOut = ufront_web_result_ContentResult::replaceVirtualLinks($actionContext, $finalOut);
		$_gthis->writeResponse($finalOut, $actionContext);
		{
			$_this = $_gthis->finalOutputTrigger;
			if($_this->{"list"} !== null) {
				$list = $_this->{"list"};
				$_this->{"list"} = null;
				$_this->result = $finalOut;
				tink_core__Callback_CallbackList_Impl_::invoke($list, $finalOut);
				tink_core__Callback_CallbackList_Impl_::clear($list);
			}
		}
		return tink_core_Noise::$Noise;
	}
}
function ufront_web_result_ViewResult_1(&$combinedFuture, $cb) {
	{
		call_user_func_array($combinedFuture, array(array(new _hx_lambda(array(&$cb), "ufront_web_result_ViewResult_8"), 'execute')));
	}
}
function ufront_web_result_ViewResult_2(&$combinedFuture, $cb1) {
	{
		return tink_core__Future_Future_Impl_::map($combinedFuture, array(new _hx_lambda(array(&$cb1), "ufront_web_result_ViewResult_9"), 'execute'), null);
	}
}
function ufront_web_result_ViewResult_3(&$_gthis, &$defaultData, $viewTemplate, $layoutTemplate, $partialTemplates) {
	{
		try {
			$combinedData = ufront_view__TemplateData_TemplateData_Impl_::fromMany((new _hx_array(array($defaultData, ufront_web_result_ViewResult::$globalValues, $_gthis->data))));
			$combinedHelpers = ufront_web_result_ViewResult::getCombinedMap((new _hx_array(array(ufront_web_result_ViewResult::$globalHelpers, $_gthis->helpers))));
			ufront_web_result_ViewResult::addHelpersForPartials(tink_core_OutcomeTools::sure($partialTemplates), $combinedData, $combinedHelpers);
			$viewOut = tink_core_OutcomeTools::sure(ufront_web_result_ViewResult::executeTemplate("view", $viewTemplate, $combinedData, $combinedHelpers));
			$tmp2 = null;
			if($layoutTemplate->index === 0) {
				if(_hx_deref($layoutTemplate)->params[0] === null) {
					$tmp2 = true;
				} else {
					$tmp2 = false;
				}
			} else {
				$tmp2 = false;
			}
			if($tmp2) {
				return tink_core_Outcome::Success($viewOut);
			} else {
				$layoutOut = tink_core_OutcomeTools::sure(ufront_web_result_ViewResult::executeTemplate("layout", $layoutTemplate, ufront_view__TemplateData_TemplateData_Impl_::set($combinedData, "viewContent", $viewOut), $combinedHelpers));
				return tink_core_Outcome::Success($layoutOut);
			}
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
			if(($e = $_ex_) instanceof tink_core_TypedError){
				return tink_core_Outcome::Failure($e);
			} else throw $__hx__e;;
		}
	}
}
function ufront_web_result_ViewResult_4(&$allPartialTemplates, &$name1, &$partialErrors, &$source, $outcome) {
	{
		switch($outcome->index) {
		case 0:{
			$tpl = _hx_deref($outcome)->params[0];
			if($tpl !== null) {
				$allPartialTemplates->set($name1, $tpl);
			} else {
				$v = "Partial " . _hx_string_or_null($name1) . " must be either TFromString or TFromEngine, was ";
				$v1 = _hx_string_or_null($v) . Std::string($source);
				$v2 = ufront_web_HttpError::internalServerError($v1, null, _hx_anonymous(array("fileName" => "ViewResult.hx", "lineNumber" => 647, "className" => "ufront.web.result.ViewResult", "methodName" => "loadPartialTemplates")));
				$partialErrors->set($name1, $v2);
			}
		}break;
		case 1:{
			$err = _hx_deref($outcome)->params[0];
			$partialErrors->set($name1, $err);
		}break;
		}
	}
}
function ufront_web_result_ViewResult_5(&$allPartialTemplates, &$partialErrors, $_) {
	{
		$numberOfErrors = Lambda::count($partialErrors, null);
		switch($numberOfErrors) {
		case 0:{
			return tink_core_Outcome::Success($allPartialTemplates);
		}break;
		case 1:{
			$_g = (new _hx_array(array()));
			{
				$e = $partialErrors->iterator();
				while($e->hasNext()) {
					$e1 = $e->next();
					$_g->push($e1);
					unset($e1);
				}
			}
			$err1 = $_g[0];
			return tink_core_Outcome::Failure($err1);
		}break;
		default:{
			$_g1 = (new _hx_array(array()));
			{
				$name2 = $partialErrors->keys();
				while($name2->hasNext()) {
					$name3 = $name2->next();
					$_g1->push($name3);
					unset($name3);
				}
			}
			$partialNames = $_g1;
			$tmp = "Partials " . Std::string($partialNames) . " failed to load: ";
			$tmp1 = _hx_string_or_null($tmp) . _hx_string_or_null($partialErrors->toString());
			return ufront_web_result_ViewResult::error($tmp1, $partialErrors, _hx_anonymous(array("fileName" => "ViewResult.hx", "lineNumber" => 661, "className" => "ufront.web.result.ViewResult", "methodName" => "loadPartialTemplates")));
		}break;
		}
	}
}
function ufront_web_result_ViewResult_6(&$contextData, &$contextHelpers, &$name1, &$partial, $partialData) {
	{
		$this1 = _hx_anonymous(array());
		$combinedPartialData = $this1;
		ufront_view__TemplateData_TemplateData_Impl_::setObject($combinedPartialData, $contextData);
		ufront_view__TemplateData_TemplateData_Impl_::setObject($combinedPartialData, $partialData);
		ufront_view__TemplateData_TemplateData_Impl_::set($combinedPartialData, "__current__", $partialData);
		return tink_core_OutcomeTools::sure(ufront_web_result_ViewResult::executeTemplate("Partial[" . _hx_string_or_null($name1) . "]", tink_core_Outcome::Success($partial), $combinedPartialData, $contextHelpers));
	}
}
function ufront_web_result_ViewResult_7() {
	{
		$obj = _hx_anonymous(array());
		$this1 = null;
		if($obj !== null) {
			$this1 = $obj;
		} else {
			$this1 = _hx_anonymous(array());
		}
		return ufront_view__TemplateData_TemplateData_Impl_::setObject($this1, _hx_anonymous(array()));
	}
}
function ufront_web_result_ViewResult_8(&$cb, $values) {
	{
		call_user_func_array($cb, array($values[0], $values[1], $values[2]));
	}
}
function ufront_web_result_ViewResult_9(&$cb1, $values1) {
	{
		return call_user_func_array($cb1, array($values1[0], $values1[1], $values1[2]));
	}
}
