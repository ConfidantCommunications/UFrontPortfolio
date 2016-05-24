<?php

class ufront_web_result_RedirectResult extends ufront_web_result_ActionResult {
	public function __construct($url, $permanentRedirect = null) {
		if(!php_Boot::$skip_constructor) {
		if($permanentRedirect === null) {
			$permanentRedirect = false;
		}
		ufront_web_HttpError::throwIfNull($url, "url", _hx_anonymous(array("fileName" => "RedirectResult.hx", "lineNumber" => 38, "className" => "ufront.web.result.RedirectResult", "methodName" => "new")));
		$this->url = $url;
		$this->permanentRedirect = $permanentRedirect;
	}}
	public $url;
	public $permanentRedirect;
	public function executeResult($actionContext) {
		ufront_web_HttpError::throwIfNull($actionContext, "actionContext", _hx_anonymous(array("fileName" => "RedirectResult.hx", "lineNumber" => 44, "className" => "ufront.web.result.RedirectResult", "methodName" => "executeResult")));
		$actionContext->httpContext->response->clearContent();
		$actionContext->httpContext->response->clearHeaders();
		$transformedUrl = ufront_web_result_ActionResult::transformUri($actionContext, $this->url);
		if($this->permanentRedirect) {
			$actionContext->httpContext->response->permanentRedirect($transformedUrl);
		} else {
			$actionContext->httpContext->response->redirect($transformedUrl);
		}
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
	static function create($url) {
		return new ufront_web_result_RedirectResult($url, false);
	}
	static function createPermanent($url) {
		return new ufront_web_result_RedirectResult($url, true);
	}
	function __toString() { return 'ufront.web.result.RedirectResult'; }
}
