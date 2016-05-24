<?php

class ufront_log_ServerConsoleLogger implements ufront_app_UFLogHandler{
	public function __construct() {}
	public function log($ctx, $appMessages) { if(!php_Boot::$skip_constructor) {
		$messages = (new _hx_array(array()));
		$userDetails = $ctx->request->get_clientIP();
		try {
			if((((null !== $ctx->session) ? $ctx->session->get_id() : null)) !== null) {
				$userDetails .= " " . _hx_string_or_null((((null !== $ctx->session) ? $ctx->session->get_id() : null)));
			}
			if(((($ctx->auth !== null && $ctx->auth->get_currentUser() !== null) ? $ctx->auth->get_currentUser()->get_userID() : null)) !== null) {
				$userDetails .= " " . _hx_string_or_null(((($ctx->auth !== null && $ctx->auth->get_currentUser() !== null) ? $ctx->auth->get_currentUser()->get_userID() : null)));
			}
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			$e = $_ex_;
			{}
		}
		$requestLog = "[" . _hx_string_or_null($ctx->request->get_httpMethod()) . " " . _hx_string_or_null($ctx->request->get_uri()) . "] from [" . _hx_string_or_null($userDetails) . "], response: [" . _hx_string_rec($ctx->response->status, "") . " " . _hx_string_or_null($ctx->response->get_contentType()) . "]";
		$messages->push($requestLog);
		{
			$_g = 0;
			$_g1 = $ctx->messages;
			while($_g < $_g1->length) {
				$msg = $_g1[$_g];
				++$_g;
				$messages->push(ufront_log_ServerConsoleLogger::formatMsg($msg));
				unset($msg);
			}
		}
		if($appMessages !== null) {
			$_g2 = 0;
			while($_g2 < $appMessages->length) {
				$msg1 = $appMessages[$_g2];
				++$_g2;
				$messages->push(ufront_log_ServerConsoleLogger::formatMsg($msg1));
				unset($msg1);
			}
		}
		ufront_log_ServerConsoleLogger::writeLog($messages->join("\x0A  "), null);
		return ufront_core_SurpriseTools::success();
	}}
	static function formatMsg($m) {
		$extras = null;
		if(_hx_field($m, "pos") !== null && $m->pos->customParams !== null) {
			$extras = ", " . _hx_string_or_null($m->pos->customParams->join(", "));
		} else {
			$extras = "";
		}
		$type = _hx_substr(Type::enumConstructor($m->type), 1, null);
		return "" . _hx_string_or_null($type) . ": " . _hx_string_or_null($m->pos->className) . "." . _hx_string_or_null($m->pos->methodName) . "(" . _hx_string_rec($m->pos->lineNumber, "") . "): " . Std::string($m->msg) . _hx_string_or_null($extras);
	}
	static function writeLog($message, $type = null) {
		error_log($message);
	}
	function __toString() { return 'ufront.log.ServerConsoleLogger'; }
}
