<?php

class ufront_web_result_BytesResult extends ufront_web_result_FileResult {
	public function __construct($bytes = null, $contentType = null, $fileDownloadName = null) {
		if(!php_Boot::$skip_constructor) {
		parent::__construct($contentType,$fileDownloadName);
		$this->bytes = $bytes;
	}}
	public $bytes;
	public function executeResult($actionContext) {
		parent::executeResult($actionContext);
		$actionContext->httpContext->response->writeBytes($this->bytes, 0, $this->bytes->length);
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
	function __toString() { return 'ufront.web.result.BytesResult'; }
}
