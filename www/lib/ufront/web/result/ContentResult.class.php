<?php

class ufront_web_result_ContentResult extends ufront_web_result_ActionResult {
	public function __construct($content = null, $contentType = null) {
		if(!php_Boot::$skip_constructor) {
		if($content !== null) {
			$this->content = $content;
		} else {
			$this->content = "";
		}
		$this->contentType = $contentType;
	}}
	public $content;
	public $contentType;
	public function executeResult($actionContext) {
		if(null !== $this->contentType) {
			$actionContext->httpContext->response->set_contentType($this->contentType);
		}
		if($actionContext->httpContext->response->get_contentType() === "text/html") {
			$this->content = ufront_web_result_ContentResult::replaceVirtualLinks($actionContext, $this->content);
		}
		$actionContext->httpContext->response->write($this->content);
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
	static function create($content) {
		return new ufront_web_result_ContentResult($content, null);
	}
	static function replaceVirtualLinks($actionContext, $html) {
		$singleQuotes = new EReg("(')(~/[^'\\s]*)'", "gi");
		$doubleQuotes = new EReg("(\")(~/[^\"\\s]*)\"", "gi");
		$transformUri = array(new _hx_lambda(array(&$actionContext, &$doubleQuotes, &$html, &$singleQuotes), "ufront_web_result_ContentResult_0"), 'execute');
		$html = $singleQuotes->map($html, $transformUri);
		$html = $doubleQuotes->map($html, $transformUri);
		return $html;
	}
	function __toString() { return 'ufront.web.result.ContentResult'; }
}
function ufront_web_result_ContentResult_0(&$actionContext, &$doubleQuotes, &$html, &$singleQuotes, $r) {
	{
		$quote = $r->matched(1);
		$originalUri = $r->matched(2);
		$transformedUri = ufront_web_result_ActionResult::transformUri($actionContext, $originalUri);
		return _hx_string_or_null($quote) . _hx_string_or_null($transformedUri) . _hx_string_or_null($quote);
	}
}