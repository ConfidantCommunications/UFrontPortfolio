<?php

// Generated by Haxe 3.4.2
class ufront_web_session_InlineSessionMiddleware implements ufront_app_UFMiddleware{
	public function __construct() {}
	public function requestIn($ctx) {
		$tmp = null;
		if(!ufront_web_session_InlineSessionMiddleware::$alwaysStart) {
			if($ctx->session->get_id() !== null) {
				$tmp = $ctx->session->get_id() !== "";
			} else {
				$tmp = false;
			}
		} else {
			$tmp = true;
		}
		if($tmp) {
			return $ctx->session->init();
		} else {
			return ufront_core_SurpriseTools::success();
		}
	}
	public function responseOut($ctx) {
		$tmp = null;
		if($ctx->session !== null) {
			$tmp = $ctx->session->isReady();
		} else {
			$tmp = false;
		}
		if($tmp) {
			return $ctx->session->commit();
		} else {
			return ufront_core_SurpriseTools::success();
		}
	}
	static $alwaysStart = false;
	function __toString() { return 'ufront.web.session.InlineSessionMiddleware'; }
}
