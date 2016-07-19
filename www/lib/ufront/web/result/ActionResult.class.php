<?php

class ufront_web_result_ActionResult {
	public function __construct(){}
	public function executeResult($actionContext) {
		return ufront_core_SurpriseTools::success();
	}
	static function transformUri($actionContext, $uri) {
		if(StringTools::startsWith($uri, "~/")) {
			return $actionContext->httpContext->generateUri(_hx_substr($uri, 2, null), null);
		} else {
			return $uri;
		}
	}
	static function wrap($resultValue) {
		if($resultValue === null) {
			return new ufront_web_result_EmptyResult(null);
		} else {
			$actionResultValue = Std::instance($resultValue, _hx_qtype("ufront.web.result.ActionResult"));
			if($actionResultValue === null) {
				$actionResultValue = new ufront_web_result_ContentResult(Std::string($resultValue), null);
			}
			return $actionResultValue;
		}
	}
	function __toString() { return 'ufront.web.result.ActionResult'; }
}