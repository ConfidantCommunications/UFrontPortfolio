<?php

class ufront_app_DefaultUfrontConfiguration {
	public function __construct(){}
	static function get() {
		$inlineSession = new ufront_web_session_InlineSessionMiddleware();
		$uploadMiddleware = new ufront_web_upload_TmpFileUploadMiddleware();
		return _hx_anonymous(array("indexController" => _hx_qtype("ufront.app.DefaultUfrontController"), "remotingApi" => null, "urlRewrite" => true, "basePath" => "/", "contentDirectory" => "../uf-content", "logFile" => null, "disableBrowserTrace" => false, "disableServerTrace" => false, "controllers" => CompileTimeClassList::get("null,true,ufront.web.Controller"), "apis" => CompileTimeClassList::get("null,true,ufront.api.UFApi"), "viewEngine" => _hx_qtype("ufront.view.FileViewEngine"), "templatingEngines" => ufront_view_TemplatingEngines::$all, "viewPath" => "view/", "defaultLayout" => null, "sessionImplementation" => _hx_qtype("ufront.web.session.FileSession"), "requestMiddleware" => (new _hx_array(array($uploadMiddleware, $inlineSession))), "responseMiddleware" => (new _hx_array(array($inlineSession, $uploadMiddleware))), "errorHandlers" => (new _hx_array(array(new ufront_web_ErrorPageHandler()))), "authImplementation" => _hx_qtype("ufront.auth.YesBossAuthHandler")));
	}
	function __toString() { return 'ufront.app.DefaultUfrontConfiguration'; }
}
