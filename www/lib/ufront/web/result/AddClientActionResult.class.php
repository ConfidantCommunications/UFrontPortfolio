<?php

class ufront_web_result_AddClientActionResult extends ufront_web_result_CallJavascriptResult implements ufront_web_result_WrappedResult{
	public function __construct($originalResult, $clientAction, $data = null) {
		if(!php_Boot::$skip_constructor) {
		parent::__construct($originalResult);
		$this->action = $clientAction;
		$this->actionData = $data;
	}}
	public $action;
	public $actionData;
	public function executeResult($actionContext) {
		$_g = $this;
		return tink_core__Future_Future_Impl_::_tryMap($this->originalResult->executeResult($actionContext), array(new _hx_lambda(array(&$_g, &$actionContext), "ufront_web_result_AddClientActionResult_0"), 'execute'));
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
	static function addClientAction($originalResult, $clientAction, $data = null) {
		return new ufront_web_result_AddClientActionResult($originalResult, $clientAction, $data);
	}
	function __toString() { return 'ufront.web.result.AddClientActionResult'; }
}
function ufront_web_result_AddClientActionResult_0(&$_g, &$actionContext, $n) {
	{
		$response = $actionContext->httpContext->response;
		if($response->get_contentType() === "text/html") {
			$className = $_g->action;
			$serializedData = haxe_Serializer::run($_g->actionData);
			$fnCall = "ufExecuteSerializedAction( \"" . _hx_string_or_null($className) . "\", \"" . _hx_string_or_null($serializedData) . "\" )";
			$script = "<script type=\"text/javascript\">" . _hx_string_or_null($fnCall) . "</script>";
			$newContent = ufront_web_result_CallJavascriptResult::insertScriptsBeforeBodyTag($response->getBuffer(), (new _hx_array(array($script))));
			$response->clearContent();
			$response->write($newContent);
		}
		return tink_core_Noise::$Noise;
	}
}
