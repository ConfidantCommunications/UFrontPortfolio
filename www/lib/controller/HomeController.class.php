<?php

class controller_HomeController extends ufront_web_Controller {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		parent::__construct();
	}}
	public $testApi;
	public function main() {
		return ufront_web_result_AddClientActionResult::addClientAction(new ufront_web_result_PartialViewResult(ufront_view__TemplateData_TemplateData_Impl_::setObject(controller_HomeController_0($this), _hx_anonymous(array("title" => "Confidant Communications : Graphic Design, HTML5 Games, Flash Programming and Joomla Developer in Saskatoon, Saskatchewan", "panel1classes" => "recessed0", "panel2classes" => "", "panel3classes" => ""))), null, null), controller_HomeController_1($this), _hx_anonymous(array("msg" => "simpleAction")));
	}
	public function about() {
		return ufront_web_result_AddClientActionResult::addClientAction(new ufront_web_result_PartialViewResult(ufront_view__TemplateData_TemplateData_Impl_::setObject(controller_HomeController_2($this), _hx_anonymous(array("title" => "Confidant Communications : About Us", "portfolioItem" => "", "panel1classes" => "recessed0 recessed1", "panel2classes" => "recessed0", "panel3classes" => "", "gobackLink" => "/"))), null, null), controller_HomeController_3($this), _hx_anonymous(array("msg" => "simpleAction")));
	}
	public function contact() {
		return ufront_web_result_AddClientActionResult::addClientAction(new ufront_web_result_PartialViewResult(ufront_view__TemplateData_TemplateData_Impl_::setObject(controller_HomeController_4($this), _hx_anonymous(array("title" => "Confidant Communications : Contact Us", "portfolioItem" => "", "panel1classes" => "recessed0 recessed1", "panel2classes" => "recessed0", "panel3classes" => "", "gobackLink" => "/"))), null, null), controller_HomeController_5($this), _hx_anonymous(array("msg" => "simpleAction")));
	}
	public function portfolio() {
		$_g = $this;
		$path = "portfolio.json";
		return tink_core__Future_Future_Impl_::_tryMap($this->testApi->getJson($path), array(new _hx_lambda(array(&$_g, &$path), "controller_HomeController_6"), 'execute'));
	}
	public function returnPortfolioItem($id) {
		return tink_core__Future_Future_Impl_::_tryMap($this->testApi->getItem($id), array(new _hx_lambda(array(&$id), "controller_HomeController_7"), 'execute'));
	}
	public function processJson($pJson) {
		$parsed = haxe_Json::phpJsonDecode($pJson);
		return $parsed->items;
	}
	public function execute() {
		$uriParts = $this->context->actionContext->get_uriParts();
		$params = $this->context->request->get_params();
		$method = $this->context->request->get_httpMethod();
		$this->context->actionContext->controller = $this;
		$this->context->actionContext->action = "execute";
		try {
			if(strtolower($method) === "get" && 0 === $uriParts->length) {
				$this->context->actionContext->action = "main";
				$this->context->actionContext->args = (new _hx_array(array()));
				$this->context->actionContext->get_uriParts()->splice(0, 0);
				$wrappingRequired = null;
				{
					$i = haxe_rtti_Meta::getFields(_hx_qtype("controller.HomeController"))->main->wrapResult[0];
					$wrappingRequired = $i;
				}
				$result = $this->wrapResult($this->main(), $wrappingRequired);
				$this->setContextActionResultWhenFinished($result);
				return $result;
			} else {
				if(strtolower($method) === "get" && 1 === $uriParts->length && $uriParts[0] === "about") {
					$this->context->actionContext->action = "about";
					$this->context->actionContext->args = (new _hx_array(array()));
					$this->context->actionContext->get_uriParts()->splice(0, 1);
					$wrappingRequired1 = null;
					{
						$i1 = haxe_rtti_Meta::getFields(_hx_qtype("controller.HomeController"))->about->wrapResult[0];
						$wrappingRequired1 = $i1;
					}
					$result1 = $this->wrapResult($this->about(), $wrappingRequired1);
					$this->setContextActionResultWhenFinished($result1);
					return $result1;
				} else {
					if(strtolower($method) === "get" && 1 === $uriParts->length && $uriParts[0] === "contact") {
						$this->context->actionContext->action = "contact";
						$this->context->actionContext->args = (new _hx_array(array()));
						$this->context->actionContext->get_uriParts()->splice(0, 1);
						$wrappingRequired2 = null;
						{
							$i2 = haxe_rtti_Meta::getFields(_hx_qtype("controller.HomeController"))->contact->wrapResult[0];
							$wrappingRequired2 = $i2;
						}
						$result2 = $this->wrapResult($this->contact(), $wrappingRequired2);
						$this->setContextActionResultWhenFinished($result2);
						return $result2;
					} else {
						if(strtolower($method) === "get" && 1 === $uriParts->length && $uriParts[0] === "portfolio") {
							$this->context->actionContext->action = "portfolio";
							$this->context->actionContext->args = (new _hx_array(array()));
							$this->context->actionContext->get_uriParts()->splice(0, 1);
							$wrappingRequired3 = null;
							{
								$i3 = haxe_rtti_Meta::getFields(_hx_qtype("controller.HomeController"))->portfolio->wrapResult[0];
								$wrappingRequired3 = $i3;
							}
							$result3 = $this->wrapResult($this->portfolio(), $wrappingRequired3);
							$this->setContextActionResultWhenFinished($result3);
							return $result3;
						} else {
							if(strtolower($method) === "get" && 2 === $uriParts->length && $uriParts[0] === "portfolio" && strlen($uriParts[1]) > 0) {
								$id = $uriParts[1];
								$this->context->actionContext->action = "returnPortfolioItem";
								$this->context->actionContext->args = (new _hx_array(array($id)));
								$this->context->actionContext->get_uriParts()->splice(0, 2);
								$wrappingRequired4 = null;
								{
									$i4 = haxe_rtti_Meta::getFields(_hx_qtype("controller.HomeController"))->returnPortfolioItem->wrapResult[0];
									$wrappingRequired4 = $i4;
								}
								$result4 = $this->wrapResult($this->returnPortfolioItem($id), $wrappingRequired4);
								$this->setContextActionResultWhenFinished($result4);
								return $result4;
							}
						}
					}
				}
			}
			throw new HException(ufront_web_HttpError::pageNotFound(_hx_anonymous(array("fileName" => "HomeController.hx", "lineNumber" => 20, "className" => "controller.HomeController", "methodName" => "execute"))));
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			$e = $_ex_;
			{
				return ufront_core_SurpriseTools::asSurpriseError($e, "Uncaught error while executing " . Std::string($this->context->actionContext->controller) . "." . _hx_string_or_null($this->context->actionContext->action) . "()", _hx_anonymous(array("fileName" => "HomeController.hx", "lineNumber" => 20, "className" => "controller.HomeController", "methodName" => "execute")));
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
controller_HomeController::$__meta__ = _hx_anonymous(array("obj" => _hx_anonymous(array("rtti" => (new _hx_array(array((new _hx_array(array("testApi", "api.AsyncTestApi", "")))))))), "fields" => _hx_anonymous(array("main" => _hx_anonymous(array("wrapResult" => (new _hx_array(array(3))))), "about" => _hx_anonymous(array("wrapResult" => (new _hx_array(array(3))))), "contact" => _hx_anonymous(array("wrapResult" => (new _hx_array(array(3))))), "portfolio" => _hx_anonymous(array("wrapResult" => (new _hx_array(array(4))))), "returnPortfolioItem" => _hx_anonymous(array("wrapResult" => (new _hx_array(array(4)))))))));
function controller_HomeController_0(&$__hx__this) {
	{
		$obj = _hx_anonymous(array());
		return (($obj !== null) ? $obj : _hx_anonymous(array()));
	}
}
function controller_HomeController_1(&$__hx__this) {
	{
		$className = Type::getClassName(_hx_qtype("actions.ConfidantInterface"));
		return $className;
	}
}
function controller_HomeController_2(&$__hx__this) {
	{
		$obj = _hx_anonymous(array());
		return (($obj !== null) ? $obj : _hx_anonymous(array()));
	}
}
function controller_HomeController_3(&$__hx__this) {
	{
		$className = Type::getClassName(_hx_qtype("actions.ConfidantInterface"));
		return $className;
	}
}
function controller_HomeController_4(&$__hx__this) {
	{
		$obj = _hx_anonymous(array());
		return (($obj !== null) ? $obj : _hx_anonymous(array()));
	}
}
function controller_HomeController_5(&$__hx__this) {
	{
		$className = Type::getClassName(_hx_qtype("actions.ConfidantInterface"));
		return $className;
	}
}
function controller_HomeController_6(&$_g, &$path, $result) {
	{
		return ufront_web_result_AddClientActionResult::addClientAction(new ufront_web_result_PartialViewResult(controller_HomeController_8($_g, $path, $result), null, null), controller_HomeController_9($_g, $path, $result), _hx_anonymous(array("msg" => "simpleAction")));
	}
}
function controller_HomeController_7(&$id, $result) {
	{
		return ufront_web_result_AddClientActionResult::addClientAction(new ufront_web_result_PartialViewResult(controller_HomeController_10($id, $result), "portfolio.html", null), controller_HomeController_11($id, $result), _hx_anonymous(array("msg" => "simpleAction")));
	}
}
function controller_HomeController_8(&$_g, &$path, &$result) {
	{
		$d = _hx_anonymous(array("title" => "Confidant Communications : Portfolio", "content" => $_g->processJson($result), "portfolioItem" => "", "panel1classes" => "recessed0 recessed1", "panel2classes" => "recessed0", "panel3classes" => "", "gobackLink" => "/"));
		return ufront_view__TemplateData_TemplateData_Impl_::setObject(controller_HomeController_12($_g, $d, $path, $result), $d);
	}
}
function controller_HomeController_9(&$_g, &$path, &$result) {
	{
		$className = Type::getClassName(_hx_qtype("actions.ConfidantInterface"));
		return $className;
	}
}
function controller_HomeController_10(&$id, &$result) {
	{
		$d = _hx_anonymous(array("title" => "Confidant Communications : Portfolio : " . _hx_string_or_null($result->title), "content" => new _hx_array(array()), "portfolioItem" => $result, "panel1classes" => "recessed0 recessed1 recessed2", "panel2classes" => "recessed0 recessed1", "panel3classes" => "recessed0", "gobackLink" => "/portfolio/"));
		return ufront_view__TemplateData_TemplateData_Impl_::setObject(controller_HomeController_13($d, $id, $result), $d);
	}
}
function controller_HomeController_11(&$id, &$result) {
	{
		$className = Type::getClassName(_hx_qtype("actions.ConfidantInterface"));
		return $className;
	}
}
function controller_HomeController_12(&$_g, &$d, &$path, &$result) {
	{
		$obj = _hx_anonymous(array());
		return (($obj !== null) ? $obj : _hx_anonymous(array()));
	}
}
function controller_HomeController_13(&$d, &$id, &$result) {
	{
		$obj = _hx_anonymous(array());
		return (($obj !== null) ? $obj : _hx_anonymous(array()));
	}
}
