<?php

class controller_HomeController extends ufront_web_Controller {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		parent::__construct();
	}}
	public $testApi;
	public function main($args = null) {
		return tink_core__Future_Future_Impl_::_tryMap($this->testApi->test($args->param), array(new _hx_lambda(array(&$args), "controller_HomeController_0"), 'execute'));
	}
	public function about($args = null) {
		return tink_core__Future_Future_Impl_::_tryMap($this->testApi->test($args->param), array(new _hx_lambda(array(&$args), "controller_HomeController_1"), 'execute'));
	}
	public function contact($args = null) {
		return new ufront_web_result_ViewResult(ufront_view__TemplateData_TemplateData_Impl_::setObject(controller_HomeController_2($this, $args), _hx_anonymous(array("title" => "Contact Us"))), null, null);
	}
	public function portfolio($args = null) {
		$ni = (new _hx_array(array("Interactive Development", "Overview", "ThinkSask.ca", "Wapos Bay Flash Site", "PotashCorp Slideshow Player", "Shelterbelt Design Tool", "Lentil Hunter Map", "Print / Miscellaneous", "Book Cover Designs", "T-Shirt Design", "Product Packaging", "Logo Designs", "Websites", "Agtron", "Faith River", "All-West Dental", "Mable Elliott Guest Ranch", "J.B. Black Estates", "ICR Commercial Real Estate", "Transforming Teachers")));
		return _hx_deref(new ufront_web_result_ViewResult(controller_HomeController_3($this, $args, $ni), null, null))->addPartial("portfolioNavPartial", "portfolioNavPartial.html", null);
	}
	public function portfolioNavPartialShell($args = null) {
		return new ufront_web_result_PartialViewResult(ufront_view__TemplateData_TemplateData_Impl_::setObject(controller_HomeController_4($this, $args), _hx_anonymous(array("title" => "PorfolioNav", "random" => "not really random"))), null, null);
	}
	public function mixed($param1, $args) {
		return new ufront_web_result_JsonResult(_hx_anonymous(array("param1" => $param1, "param2" => $args->param2)));
	}
	public function execute() {
		$uriParts = $this->context->actionContext->get_uriParts();
		$params = $this->context->request->get_params();
		$method = $this->context->request->get_httpMethod();
		$this->context->actionContext->controller = $this;
		$this->context->actionContext->action = "execute";
		try {
			if(strtolower($method) === "get" && 0 === $uriParts->length) {
				$_param_tmp_param = ufront_core__MultiValueMap_MultiValueMap_Impl_::get($params, "param");
				$args = _hx_anonymous(array("param" => $_param_tmp_param));
				$this->context->actionContext->action = "main";
				$this->context->actionContext->args = (new _hx_array(array($args)));
				$this->context->actionContext->get_uriParts()->splice(0, 0);
				$wrappingRequired = null;
				{
					$i = haxe_rtti_Meta::getFields(_hx_qtype("controller.HomeController"))->main->wrapResult[0];
					$wrappingRequired = $i;
				}
				$result = $this->wrapResult($this->main($args), $wrappingRequired);
				$this->setContextActionResultWhenFinished($result);
				return $result;
			} else {
				if(strtolower($method) === "get" && 1 === $uriParts->length && $uriParts[0] === "about") {
					$_param_tmp_param1 = ufront_core__MultiValueMap_MultiValueMap_Impl_::get($params, "param");
					$args1 = _hx_anonymous(array("param" => $_param_tmp_param1));
					$this->context->actionContext->action = "about";
					$this->context->actionContext->args = (new _hx_array(array($args1)));
					$this->context->actionContext->get_uriParts()->splice(0, 1);
					$wrappingRequired1 = null;
					{
						$i1 = haxe_rtti_Meta::getFields(_hx_qtype("controller.HomeController"))->about->wrapResult[0];
						$wrappingRequired1 = $i1;
					}
					$result1 = $this->wrapResult($this->about($args1), $wrappingRequired1);
					$this->setContextActionResultWhenFinished($result1);
					return $result1;
				} else {
					if(strtolower($method) === "get" && 1 === $uriParts->length && $uriParts[0] === "contact") {
						$_param_tmp_param2 = ufront_core__MultiValueMap_MultiValueMap_Impl_::get($params, "param");
						$args2 = _hx_anonymous(array("param" => $_param_tmp_param2));
						$this->context->actionContext->action = "contact";
						$this->context->actionContext->args = (new _hx_array(array($args2)));
						$this->context->actionContext->get_uriParts()->splice(0, 1);
						$wrappingRequired2 = null;
						{
							$i2 = haxe_rtti_Meta::getFields(_hx_qtype("controller.HomeController"))->contact->wrapResult[0];
							$wrappingRequired2 = $i2;
						}
						$result2 = $this->wrapResult($this->contact($args2), $wrappingRequired2);
						$this->setContextActionResultWhenFinished($result2);
						return $result2;
					} else {
						if(strtolower($method) === "get" && 1 === $uriParts->length && $uriParts[0] === "portfolio") {
							$_param_tmp_id = ufront_core__MultiValueMap_MultiValueMap_Impl_::get($params, "id");
							$args3 = _hx_anonymous(array("id" => $_param_tmp_id));
							$this->context->actionContext->action = "portfolio";
							$this->context->actionContext->args = (new _hx_array(array($args3)));
							$this->context->actionContext->get_uriParts()->splice(0, 1);
							$wrappingRequired3 = null;
							{
								$i3 = haxe_rtti_Meta::getFields(_hx_qtype("controller.HomeController"))->portfolio->wrapResult[0];
								$wrappingRequired3 = $i3;
							}
							$result3 = $this->wrapResult($this->portfolio($args3), $wrappingRequired3);
							$this->setContextActionResultWhenFinished($result3);
							return $result3;
						} else {
							if(strtolower($method) === "get" && 2 === $uriParts->length && $uriParts[0] === "portfolio" && strlen($uriParts[1]) > 0) {
								$_param_tmp_id1 = ufront_core__MultiValueMap_MultiValueMap_Impl_::get($params, "id");
								$args4 = _hx_anonymous(array("id" => $_param_tmp_id1));
								$this->context->actionContext->action = "portfolioNavPartialShell";
								$this->context->actionContext->args = (new _hx_array(array($args4)));
								$this->context->actionContext->get_uriParts()->splice(0, 2);
								$wrappingRequired4 = null;
								{
									$i4 = haxe_rtti_Meta::getFields(_hx_qtype("controller.HomeController"))->portfolioNavPartialShell->wrapResult[0];
									$wrappingRequired4 = $i4;
								}
								$result4 = $this->wrapResult($this->portfolioNavPartialShell($args4), $wrappingRequired4);
								$this->setContextActionResultWhenFinished($result4);
								return $result4;
							} else {
								if(strtolower($method) === "get" && 2 === $uriParts->length && $uriParts[0] === "mixed" && strlen($uriParts[1]) > 0) {
									$param1 = $uriParts[1];
									if(!$params->exists("param2")) {
										throw new HException(controller_HomeController_5($this, $method, $param1, $params, $uriParts));
									}
									$_param_tmp_param21 = Std::parseInt(ufront_core__MultiValueMap_MultiValueMap_Impl_::get($params, "param2"));
									if($_param_tmp_param21 === null) {
										throw new HException(controller_HomeController_6($this, $_param_tmp_param21, $method, $param1, $params, $uriParts));
									}
									$args5 = _hx_anonymous(array("param2" => $_param_tmp_param21));
									$this->context->actionContext->action = "mixed";
									$this->context->actionContext->args = (new _hx_array(array($param1, $args5)));
									$this->context->actionContext->get_uriParts()->splice(0, 2);
									$wrappingRequired5 = null;
									{
										$i5 = haxe_rtti_Meta::getFields(_hx_qtype("controller.HomeController"))->mixed->wrapResult[0];
										$wrappingRequired5 = $i5;
									}
									$result5 = $this->wrapResult($this->mixed($param1, $args5), $wrappingRequired5);
									$this->setContextActionResultWhenFinished($result5);
									return $result5;
								}
							}
						}
					}
				}
			}
			throw new HException(ufront_web_HttpError::pageNotFound(_hx_anonymous(array("fileName" => "HomeController.hx", "lineNumber" => 8, "className" => "controller.HomeController", "methodName" => "execute"))));
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			$e = $_ex_;
			{
				return ufront_core_SurpriseTools::asSurpriseError($e, "Uncaught error while executing " . Std::string($this->context->actionContext->controller) . "." . _hx_string_or_null($this->context->actionContext->action) . "()", _hx_anonymous(array("fileName" => "HomeController.hx", "lineNumber" => 8, "className" => "controller.HomeController", "methodName" => "execute")));
			}
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
	function __toString() { return 'controller.HomeController'; }
}
controller_HomeController::$__meta__ = _hx_anonymous(array("obj" => _hx_anonymous(array("rtti" => (new _hx_array(array((new _hx_array(array("testApi", "api.AsyncTestApi", "")))))))), "fields" => _hx_anonymous(array("main" => _hx_anonymous(array("wrapResult" => (new _hx_array(array(4))))), "about" => _hx_anonymous(array("wrapResult" => (new _hx_array(array(4))))), "contact" => _hx_anonymous(array("wrapResult" => (new _hx_array(array(3))))), "portfolio" => _hx_anonymous(array("wrapResult" => (new _hx_array(array(3))))), "portfolioNavPartialShell" => _hx_anonymous(array("wrapResult" => (new _hx_array(array(3))))), "mixed" => _hx_anonymous(array("wrapResult" => (new _hx_array(array(3)))))))));
function controller_HomeController_0(&$args, $result) {
	{
		return new ufront_web_result_ViewResult(ufront_view__TemplateData_TemplateData_Impl_::setObject(controller_HomeController_7($args, $result), _hx_anonymous(array("title" => "Confidant Communications : Graphic Design, HTML5 Games, Flash Programming and Joomla Developer in Saskatoon, Saskatchewan", "message" => "Result: " . _hx_string_or_null($result), "renderedBy" => "Server"))), null, null);
	}
}
function controller_HomeController_1(&$args, $result) {
	{
		return new ufront_web_result_ViewResult(ufront_view__TemplateData_TemplateData_Impl_::setObject(controller_HomeController_8($args, $result), _hx_anonymous(array("title" => "Confidant Communications : About Us", "header1" => "About Us", "message" => "Result: " . _hx_string_or_null($result), "renderedBy" => "Server"))), null, null);
	}
}
function controller_HomeController_2(&$__hx__this, &$args) {
	{
		$obj = _hx_anonymous(array());
		return (($obj !== null) ? $obj : _hx_anonymous(array()));
	}
}
function controller_HomeController_3(&$__hx__this, &$args, &$ni) {
	{
		$d = _hx_anonymous(array("title" => "Portfolio", "random" => _hx_string_rec(Math::random(), "") . " willikers", "content" => "The Content", "subcontent" => "The Subcontent", "navItems" => $ni));
		return ufront_view__TemplateData_TemplateData_Impl_::setObject(controller_HomeController_9($args, $d, $ni), $d);
	}
}
function controller_HomeController_4(&$__hx__this, &$args) {
	{
		$obj = _hx_anonymous(array());
		return (($obj !== null) ? $obj : _hx_anonymous(array()));
	}
}
function controller_HomeController_5(&$__hx__this, &$method, &$param1, &$params, &$uriParts) {
	{
		$reason = "Missing parameter " . "param2";
		$message = "Bad Request";
		if($reason !== null) {
			$message .= ": " . _hx_string_or_null($reason);
		}
		return new tink_core_TypedError(400, $message, _hx_anonymous(array("fileName" => "HomeController.hx", "lineNumber" => 109, "className" => "controller.HomeController", "methodName" => "execute")));
	}
}
function controller_HomeController_6(&$__hx__this, &$_param_tmp_param21, &$method, &$param1, &$params, &$uriParts) {
	{
		$reason1 = "Could not parse parameter " . "args.param2" . ":Int = " . _hx_string_or_null(ufront_core__MultiValueMap_MultiValueMap_Impl_::get($params, "param2"));
		$message1 = "Bad Request";
		if($reason1 !== null) {
			$message1 .= ": " . _hx_string_or_null($reason1);
		}
		return new tink_core_TypedError(400, $message1, _hx_anonymous(array("fileName" => "HomeController.hx", "lineNumber" => 109, "className" => "controller.HomeController", "methodName" => "execute")));
	}
}
function controller_HomeController_7(&$args, &$result) {
	{
		$obj = _hx_anonymous(array());
		return (($obj !== null) ? $obj : _hx_anonymous(array()));
	}
}
function controller_HomeController_8(&$args, &$result) {
	{
		$obj = _hx_anonymous(array());
		return (($obj !== null) ? $obj : _hx_anonymous(array()));
	}
}
function controller_HomeController_9(&$args, &$d, &$ni) {
	{
		$obj = _hx_anonymous(array());
		return (($obj !== null) ? $obj : _hx_anonymous(array()));
	}
}
