<?php

// Generated by Haxe 3.4.4
class ufront_remoting_HttpAsyncConnection extends haxe_remoting_HttpAsyncConnection {
	public function __construct($data, $path) { if(!php_Boot::$skip_constructor) {
		parent::__construct($data,$path);
	}}
	public function resolve($name) {
		$dataCopy = _hx_anonymous(array("url" => $this->__data->url, "error" => (property_exists($this->__data, "error") ? $this->__data->error: array($this->__data, "error"))));
		$c = new ufront_remoting_HttpAsyncConnection($dataCopy, $this->__path->copy());
		$c->__path->push($name);
		return $c;
	}
	public function call($params, $onResult = null) {
		$_gthis = $this;
		$h = new ufront_remoting_HttpWithUploads($this->__data->url, true, null);
		$h->setHeader("X-Haxe-Remoting", "1");
		$h->setHeader("X-Ufront-Remoting", "1");
		$s = new ufront_remoting_RemotingSerializer(ufront_remoting_RemotingDirection::$RDClientToServer);
		$s->serialize($this->__path);
		$s->serialize($params);
		$tmp = $s->toString();
		$h->setParam("__x", $tmp);
		$remotingCallString = _hx_string_or_null($this->__path->join(".")) . "(";
		$remotingCallString1 = _hx_string_or_null($remotingCallString) . _hx_string_or_null($params->join(",")) . ")";
		$responseCode = null;
		$onStatus = array(new _hx_lambda(array(&$responseCode), "ufront_remoting_HttpAsyncConnection_0"), 'execute');
		$onData = array(new _hx_lambda(array(&$_gthis, &$onResult, &$remotingCallString1), "ufront_remoting_HttpAsyncConnection_1"), 'execute');
		$onError = array(new _hx_lambda(array(&$_gthis, &$h, &$onResult, &$remotingCallString1, &$responseCode), "ufront_remoting_HttpAsyncConnection_2"), 'execute');
		$h->handle($onStatus, $onData, $onError);
		$uploadsReady = $h->attachUploads($s->uploads);
		call_user_func_array($uploadsReady, array(array(new _hx_lambda(array(&$h, &$onError, &$onStatus), "ufront_remoting_HttpAsyncConnection_3"), 'execute')));
	}
	static function urlConnect($url, $errorHandler = null) {
		if($errorHandler === null) {
			$errorHandler = (property_exists("ufront_remoting_RemotingUtil", "defaultErrorHandler") ? ufront_remoting_RemotingUtil::$defaultErrorHandler: array("ufront_remoting_RemotingUtil", "defaultErrorHandler"));
		}
		return new ufront_remoting_HttpAsyncConnection(_hx_anonymous(array("url" => $url, "error" => $errorHandler)), (new _hx_array(array())));
	}
	function __toString() { return 'ufront.remoting.HttpAsyncConnection'; }
}
function ufront_remoting_HttpAsyncConnection_0(&$responseCode, $status) {
	{
		$responseCode = $status;
	}
}
function ufront_remoting_HttpAsyncConnection_1(&$_gthis, &$onResult, &$remotingCallString1, $data) {
	{
		ufront_remoting_RemotingUtil::processResponse($data, $onResult, (property_exists($_gthis->__data, "error") ? $_gthis->__data->error: array($_gthis->__data, "error")), $remotingCallString1);
	}
}
function ufront_remoting_HttpAsyncConnection_2(&$_gthis, &$h, &$onResult, &$remotingCallString1, &$responseCode, $errorData) {
	{
		if(500 === $responseCode) {
			$onError1 = $h->responseData();
			ufront_remoting_RemotingUtil::processResponse($onError1, $onResult, (property_exists($_gthis->__data, "error") ? $_gthis->__data->error: array($_gthis->__data, "error")), $remotingCallString1);
		} else {
			if(404 === $responseCode) {
				$errorHandler = (property_exists($_gthis->__data, "error") ? $_gthis->__data->error: array($_gthis->__data, "error"));
				$onError2 = $h->responseData();
				call_user_func_array($errorHandler, array(ufront_remoting_RemotingError::RApiNotFound($remotingCallString1, $onError2)));
			} else {
				$errorHandler1 = (property_exists($_gthis->__data, "error") ? $_gthis->__data->error: array($_gthis->__data, "error"));
				$onError3 = $h->responseData();
				call_user_func_array($errorHandler1, array(ufront_remoting_RemotingError::RHttpError($remotingCallString1, $responseCode, $onError3)));
			}
		}
	}
}
function ufront_remoting_HttpAsyncConnection_3(&$h, &$onError, &$onStatus, $outcome) {
	{
		switch($outcome->index) {
		case 0:{
			$h->send();
		}break;
		case 1:{
			$err = _hx_deref($outcome)->params[0];
			{
				call_user_func_array($onStatus, array(0));
				$tmp1 = "Failed to read attachments: " . Std::string($err);
				call_user_func_array($onError, array($tmp1));
			}
		}break;
		}
	}
}
