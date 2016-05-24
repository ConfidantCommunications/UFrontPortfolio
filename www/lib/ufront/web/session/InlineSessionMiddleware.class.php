<?php

class ufront_web_session_InlineSessionMiddleware implements ufront_app_UFMiddleware{
	public function __construct() {}
	public function requestIn($ctx) { if(!php_Boot::$skip_constructor) {
		if(ufront_web_session_InlineSessionMiddleware::$alwaysStart || $ctx->session->get_id() !== null && $ctx->session->get_id() !== "") {
			return $ctx->session->init();
		} else {
			return ufront_core_SurpriseTools::success();
		}
	}}
	public function responseOut($ctx) {
		if($ctx->session !== null && $ctx->session->isReady()) {
			return $ctx->session->commit();
		} else {
			return ufront_core_SurpriseTools::success();
		}
	}
	static $alwaysStart = false;
	function __toString() { return 'ufront.web.session.InlineSessionMiddleware'; }
}
