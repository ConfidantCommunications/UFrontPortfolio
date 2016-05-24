<?php

class ufront_web_result_HttpAuthResult extends ufront_web_result_ActionResult {
	public function __construct($message, $failureMessage) {
		if(!php_Boot::$skip_constructor) {
		$this->message = $message;
		if($failureMessage !== null) {
			$this->failureMessage = $failureMessage;
		} else {
			$this->failureMessage = $message;
		}
	}}
	public $message;
	public $failureMessage;
	public function executeResult($actionContext) {
		$actionContext->httpContext->response->requireAuthentication($this->message);
		$actionContext->httpContext->response->write($this->failureMessage);
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
	static function requireAuth($context, $username, $password, $message = null, $failureMessage = null, $successFn) {
		$auth = $context->request->get_authorization();
		if($auth !== null && $auth->user === $username && $auth->pass === $password) {
			return call_user_func($successFn);
		} else {
			$result = new ufront_web_result_HttpAuthResult($message, $failureMessage);
			return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Success($result));
		}
	}
	function __toString() { return 'ufront.web.result.HttpAuthResult'; }
}
