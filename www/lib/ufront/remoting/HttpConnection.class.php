<?php

class ufront_remoting_HttpConnection extends haxe_remoting_HttpConnection {
	public function __construct($url, $path) { if(!php_Boot::$skip_constructor) {
		parent::__construct($url,$path);
	}}
	public function call($params) {
		$h = new ufront_remoting_HttpWithUploads($this->__url, false, ufront_remoting_HttpConnection::$TIMEOUT);
		$data = null;
		$status = null;
		$s = new ufront_remoting_RemotingSerializer(ufront_remoting_RemotingDirection::$RDClientToServer);
		$s->serialize($this->__path);
		$s->serialize($params);
		$remotingCallString = _hx_string_or_null($this->__path->join(".")) . "(" . _hx_string_or_null($params->join(",")) . ")";
		$responseCode = null;
		$responseText = null;
		$result = null;
		$throwError = array(new _hx_lambda(array(&$data, &$h, &$params, &$remotingCallString, &$responseCode, &$responseText, &$result, &$s, &$status), "ufront_remoting_HttpConnection_0"), 'execute');
		$setResult = array(new _hx_lambda(array(&$data, &$h, &$params, &$remotingCallString, &$responseCode, &$responseText, &$result, &$s, &$status, &$throwError), "ufront_remoting_HttpConnection_1"), 'execute');
		$onStatus = array(new _hx_lambda(array(&$data, &$h, &$params, &$remotingCallString, &$responseCode, &$responseText, &$result, &$s, &$setResult, &$status, &$throwError), "ufront_remoting_HttpConnection_2"), 'execute');
		$onData = array(new _hx_lambda(array(&$data, &$h, &$onStatus, &$params, &$remotingCallString, &$responseCode, &$responseText, &$result, &$s, &$setResult, &$status, &$throwError), "ufront_remoting_HttpConnection_3"), 'execute');
		$onError = array(new _hx_lambda(array(&$data, &$h, &$onData, &$onStatus, &$params, &$remotingCallString, &$responseCode, &$responseText, &$result, &$s, &$setResult, &$status, &$throwError), "ufront_remoting_HttpConnection_4"), 'execute');
		$h->handle($onStatus, $onData, $onError);
		$h->setHeader("X-Haxe-Remoting", "1");
		$h->setHeader("X-Ufront-Remoting", "1");
		$h->setParam("__x", $s->toString());
		$h->attachUploads($s->uploads);
		$h->send();
		return $result;
	}
	static $TIMEOUT = 10.;
	static function urlConnect($url) {
		return new ufront_remoting_HttpConnection($url, (new _hx_array(array())));
	}
	function __toString() { return 'ufront.remoting.HttpConnection'; }
}
function ufront_remoting_HttpConnection_0(&$data, &$h, &$params, &$remotingCallString, &$responseCode, &$responseText, &$result, &$s, &$status, $v) {
	{
		throw new HException($v);
	}
}
function ufront_remoting_HttpConnection_1(&$data, &$h, &$params, &$remotingCallString, &$responseCode, &$responseText, &$result, &$s, &$status, &$throwError, $v1) {
	{
		$result = $v1;
	}
}
function ufront_remoting_HttpConnection_2(&$data, &$h, &$params, &$remotingCallString, &$responseCode, &$responseText, &$result, &$s, &$setResult, &$status, &$throwError, $s1) {
	{
		$responseCode = $status;
	}
}
function ufront_remoting_HttpConnection_3(&$data, &$h, &$onStatus, &$params, &$remotingCallString, &$responseCode, &$responseText, &$result, &$s, &$setResult, &$status, &$throwError, $str) {
	{
		$responseText = $str;
		ufront_remoting_RemotingUtil::processResponse($responseText, $setResult, $throwError, $remotingCallString);
	}
}
function ufront_remoting_HttpConnection_4(&$data, &$h, &$onData, &$onStatus, &$params, &$remotingCallString, &$responseCode, &$responseText, &$result, &$s, &$setResult, &$status, &$throwError, $errorData) {
	{
		if(500 === $responseCode) {
			ufront_remoting_RemotingUtil::processResponse($h->responseData(), $setResult, $throwError, $remotingCallString);
		} else {
			call_user_func_array($throwError, array(ufront_remoting_RemotingError::RHttpError($remotingCallString, $responseCode, $h->responseData())));
		}
	}
}
