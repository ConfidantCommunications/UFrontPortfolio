<?php

class ufront_log_BrowserConsoleLogger implements ufront_app_UFLogHandler{
	public function __construct() {}
	public function log($ctx, $appMessages) { if(!php_Boot::$skip_constructor) {
		if($ctx->response->get_contentType() === "text/html" && !$ctx->response->isRedirect()) {
			$results = (new _hx_array(array()));
			{
				$_g = 0;
				$_g1 = $ctx->messages;
				while($_g < $_g1->length) {
					$msg = $_g1[$_g];
					++$_g;
					$results->push(ufront_log_BrowserConsoleLogger::formatMessage($msg));
					unset($msg);
				}
			}
			if($results->length > 0) {
				$script = "\x0A<script type=\"text/javascript\">\x0A" . _hx_string_or_null($results->join("\x0A")) . "\x0A</script>";
				$newContent = ufront_web_result_CallJavascriptResult::insertScriptsBeforeBodyTag($ctx->response->getBuffer(), (new _hx_array(array($script))));
				$ctx->response->clearContent();
				$ctx->response->write($newContent);
			}
		}
		return ufront_core_SurpriseTools::success();
	}}
	static function formatMessage($m) {
		$type = null;
		{
			$_g = $m->type;
			switch($_g->index) {
			case 0:{
				$type = "log";
			}break;
			case 1:{
				$type = "info";
			}break;
			case 2:{
				$type = "warn";
			}break;
			case 3:{
				$type = "error";
			}break;
			}
		}
		$extras = null;
		if(_hx_field($m, "pos") !== null && $m->pos->customParams !== null) {
			$extras = ", " . _hx_string_or_null($m->pos->customParams->join(", "));
		} else {
			$extras = "";
		}
		$msg = "" . _hx_string_or_null($m->pos->className) . "." . _hx_string_or_null($m->pos->methodName) . "(" . _hx_string_rec($m->pos->lineNumber, "") . "): " . Std::string($m->msg) . _hx_string_or_null($extras);
		return "console." . _hx_string_or_null($type) . "(decodeURIComponent(\"" . _hx_string_or_null(rawurlencode($msg)) . "\"))";
	}
	function __toString() { return 'ufront.log.BrowserConsoleLogger'; }
}
