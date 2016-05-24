<?php

class ufront_web_result_FilePathResult extends ufront_web_result_FileResult {
	public function __construct($fileName = null, $contentType = null, $fileDownloadName = null) {
		if(!php_Boot::$skip_constructor) {
		parent::__construct($contentType,$fileDownloadName);
		$this->fileName = $fileName;
	}}
	public $fileName;
	public function executeResult($actionContext) {
		parent::executeResult($actionContext);
		if(null !== $this->fileName) {
			if(!file_exists($this->fileName)) {
				throw new HException(ufront_web_HttpError::pageNotFound(_hx_anonymous(array("fileName" => "FilePathResult.hx", "lineNumber" => 33, "className" => "ufront.web.result.FilePathResult", "methodName" => "executeResult"))));
			}
			try {
				$bytes = sys_io_File::getBytes($this->fileName);
				$actionContext->httpContext->response->writeBytes($bytes, 0, $bytes->length);
				return ufront_core_SurpriseTools::success();
			}catch(Exception $__hx__e) {
				$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
				$e = $_ex_;
				{
					throw new HException(ufront_web_HttpError::internalServerError("Failed to read file " . _hx_string_or_null($this->fileName) . " in FilePathResult: " . Std::string($e), $e, _hx_anonymous(array("fileName" => "FilePathResult.hx", "lineNumber" => 40, "className" => "ufront.web.result.FilePathResult", "methodName" => "executeResult"))));
				}
			}
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
	function __toString() { return 'ufront.web.result.FilePathResult'; }
}
