<?php

class ufront_web_result_DirectFilePathResult extends ufront_web_result_ActionResult {
	public function __construct($filePath = null) {
		if(!php_Boot::$skip_constructor) {
		$this->filePath = $filePath;
	}}
	public $filePath;
	public function executeResult($actionContext) {
		ufront_web_HttpError::throwIfNull($actionContext, null, _hx_anonymous(array("fileName" => "DirectFilePathResult.hx", "lineNumber" => 35, "className" => "ufront.web.result.DirectFilePathResult", "methodName" => "executeResult")));
		$this->filePath = haxe_io_Path::normalize($this->filePath);
		if(!file_exists($this->filePath)) {
			throw new HException(ufront_web_HttpError::pageNotFound(_hx_anonymous(array("fileName" => "DirectFilePathResult.hx", "lineNumber" => 39, "className" => "ufront.web.result.DirectFilePathResult", "methodName" => "executeResult"))));
		}
		$scriptDir = $actionContext->httpContext->request->get_scriptDirectory();
		if(StringTools::startsWith($this->filePath, $scriptDir)) {
			$url = _hx_substr($this->filePath, strlen(haxe_io_Path::removeTrailingSlashes($scriptDir)), null);
			return _hx_deref(new ufront_web_result_RedirectResult($url, true))->executeResult($actionContext);
		} else {
			$result = new ufront_web_result_FilePathResult($this->filePath, null, null);
			$result->setContentTypeByFilename(haxe_io_Path::withoutDirectory($this->filePath));
			return $result->executeResult($actionContext);
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
	function __toString() { return 'ufront.web.result.DirectFilePathResult'; }
}