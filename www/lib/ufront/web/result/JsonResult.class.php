<?php

class ufront_web_result_JsonResult extends ufront_web_result_ActionResult {
	public function __construct($content) {
		if(!php_Boot::$skip_constructor) {
		ufront_web_HttpError::throwIfNull($content, "content", _hx_anonymous(array("fileName" => "JsonResult.hx", "lineNumber" => 26, "className" => "ufront.web.result.JsonResult", "methodName" => "new")));
		$this->content = $content;
	}}
	public $content;
	public function executeResult($actionContext) {
		ufront_web_HttpError::throwIfNull($actionContext, "actionContext", _hx_anonymous(array("fileName" => "JsonResult.hx", "lineNumber" => 31, "className" => "ufront.web.result.JsonResult", "methodName" => "executeResult")));
		$serialized = haxe_Json::phpJsonEncode($this->content, null, null);
		$actionContext->httpContext->response->write($serialized);
		$actionContext->httpContext->response->set_contentType("application/json");
		return ufront_core_SurpriseTools::success();
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
		return new ufront_web_result_JsonResult($data);
	}
	function __toString() { return 'ufront.web.result.JsonResult'; }
}
