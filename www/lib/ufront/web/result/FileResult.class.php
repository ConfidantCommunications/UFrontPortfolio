<?php

class ufront_web_result_FileResult extends ufront_web_result_ActionResult {
	public function __construct($contentType, $fileDownloadName) {
		if(!php_Boot::$skip_constructor) {
		$this->contentType = $contentType;
		$this->fileDownloadName = $fileDownloadName;
		if(null === $contentType) {
			$this->setContentTypeByFilename(null);
		}
	}}
	public $contentType;
	public $fileDownloadName;
	public function setContentTypeByFilename($filename = null) {
		if($filename === null) {
			$filename = $this->fileDownloadName;
		}
		if(null !== $filename) {
			$ext = haxe_io_Path::extension($filename);
			if(ufront_web_result_FileResult::$extMap->exists($ext)) {
				$this->contentType = ufront_web_result_FileResult::$extMap->get($ext);
			}
		}
	}
	public function executeResult($actionContext) {
		ufront_web_HttpError::throwIfNull($actionContext, "actionContext", _hx_anonymous(array("fileName" => "FileResult.hx", "lineNumber" => 79, "className" => "ufront.web.result.FileResult", "methodName" => "executeResult")));
		if(null !== $this->contentType) {
			$actionContext->httpContext->response->set_contentType($this->contentType);
		}
		if(null !== $this->fileDownloadName) {
			$actionContext->httpContext->response->setHeader("content-disposition", "attachment; filename=" . _hx_string_or_null($this->fileDownloadName));
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
	static $extMap;
	function __toString() { return 'ufront.web.result.FileResult'; }
}
ufront_web_result_FileResult::$extMap = ufront_web_result_FileResult_0();
function ufront_web_result_FileResult_0() {
	{
		$_g = new haxe_ds_StringMap();
		$_g->set("jpg", "image/jpeg");
		$_g->set("jpeg", "image/jpeg");
		$_g->set("png", "image/png");
		$_g->set("gif", "image/gif");
		$_g->set("svg", "image/svg+xml");
		$_g->set("tiff", "image/tiff");
		$_g->set("zip", "application/zip");
		$_g->set("atom", "application/atom+xml");
		$_g->set("json", "application/json");
		$_g->set("js", "application/javascript");
		$_g->set("ogg", "application/ogg");
		$_g->set("pdf", "application/pdf");
		$_g->set("ps", "application/postscript");
		$_g->set("rdf", "application/rdf");
		$_g->set("rss", "application/rss");
		$_g->set("woff", "application/woff");
		$_g->set("xml", "application/xml");
		$_g->set("dtd", "application/xml-dtd");
		$_g->set("gz", "application/gzip");
		return $_g;
	}
}
