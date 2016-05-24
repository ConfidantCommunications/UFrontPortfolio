<?php

class ufront_remoting_HttpAsyncConnection extends haxe_remoting_HttpAsyncConnection {
	public function __construct($data, $path) { if(!php_Boot::$skip_constructor) {
		parent::__construct($data,$path);
	}}
	public function resolve($name) {
		$dataCopy = _hx_anonymous(array("url" => $this->__data->url, "error" => (isset($this->__data->error) ? $this->__data->error: array($this->__data, "error"))));
		$c = new ufront_remoting_HttpAsyncConnection($dataCopy, $this->__path->copy());
		$c->__path->push($name);
		return $c;
	}
	public function call($params, $onResult = null) {
		$_g = $this;
		$h = new ufront_remoting_HttpWithUploads($this->__data->url, true, null);
		$h->setHeader("X-Haxe-Remoting", "1");
		$h->setHeader("X-Ufront-Remoting", "1");
		$s = new ufront_remoting_RemotingSerializer(ufront_remoting_RemotingDirection::$RDClientToServer);
		$s->serialize($this->__path);
		$s->serialize($params);
		$h->setParam("__x", $s->toString());
		$remotingCallString = _hx_string_or_null($this->__path->join(".")) . "(" . _hx_string_or_null($params->join(",")) . ")";
		$responseCode = null;
		$onStatus = array(new _hx_lambda(array(&$_g, &$h, &$onResult, &$params, &$remotingCallString, &$responseCode, &$s), "ufront_remoting_HttpAsyncConnection_0"), 'execute');
		$onData = array(new _hx_lambda(array(&$_g, &$h, &$onResult, &$onStatus, &$params, &$remotingCallString, &$responseCode, &$s), "ufront_remoting_HttpAsyncConnection_1"), 'execute');
		$onError = array(new _hx_lambda(array(&$_g, &$h, &$onData, &$onResult, &$onStatus, &$params, &$remotingCallString, &$responseCode, &$s), "ufront_remoting_HttpAsyncConnection_2"), 'execute');
		$h->handle($onStatus, $onData, $onError);
		$uploadsReady = $h->attachUploads($s->uploads);
		$uploadsReady(array(new _hx_lambda(array(&$_g, &$h, &$onData, &$onError, &$onResult, &$onStatus, &$params, &$remotingCallString, &$responseCode, &$s, &$uploadsReady), "ufront_remoting_HttpAsyncConnection_3"), 'execute'));
	}
	static function urlConnect($url, $errorHandler = null) {
		if($errorHandler === null) {
			$errorHandler = (isset(ufront_remoting_RemotingUtil::$defaultErrorHandler) ? ufront_remoting_RemotingUtil::$defaultErrorHandler: array("ufront_remoting_RemotingUtil", "defaultErrorHandler"));
		}
		return new ufront_remoting_HttpAsyncConnection(_hx_anonymous(array("url" => $url, "error" => $errorHandler)), (new _hx_array(array())));
	}
	function __toString() { return 'ufront.remoting.HttpAsyncConnection'; }
}
function ufront_remoting_HttpAsyncConnection_0(&$_g, &$h, &$onResult, &$params, &$remotingCallString, &$responseCode, &$s, $status) {
	{
		$responseCode = $status;
	}
}
function ufront_remoting_HttpAsyncConnection_1(&$_g, &$h, &$onResult, &$onStatus, &$params, &$remotingCallString, &$responseCode, &$s, $data) {
	{
		ufront_remoting_RemotingUtil::processResponse($data, $onResult, (isset($_g->__data->error) ? $_g->__data->error: array($_g->__data, "error")), $remotingCallString);
	}
}
function ufront_remoting_HttpAsyncConnection_2(&$_g, &$h, &$onData, &$onResult, &$onStatus, &$params, &$remotingCallString, &$responseCode, &$s, $errorData) {
	{
		if(500 === $responseCode) {
			ufront_remoting_RemotingUtil::processResponse($h->responseData(), $onResult, (isset($_g->__data->error) ? $_g->__data->error: array($_g->__data, "error")), $remotingCallString);
		} else {
			if(404 === $responseCode) {
				$errorHandler = (isset($_g->__data->error) ? $_g->__data->error: array($_g->__data, "error"));
				call_user_func_array($errorHandler, array(ufront_remoting_RemotingError::RApiNotFound($remotingCallString, $h->responseData())));
			} else {
				$errorHandler1 = (isset($_g->__data->error) ? $_g->__data->error: array($_g->__data, "error"));
				call_user_func_array($errorHandler1, array(ufront_remoting_RemotingError::RHttpError($remotingCallString, $responseCode, $h->responseData())));
			}
		}
	}
}
function ufront_remoting_HttpAsyncConnection_3(&$_g, &$h, &$onData, &$onError, &$onResult, &$onStatus, &$params, &$remotingCallString, &$responseCode, &$s, &$uploadsReady, $outcome) {
	{
		switch($outcome->index) {
		case 0:{
			$h->send();
		}break;
		case 1:{
			$err = _hx_deref($outcome)->params[0];
			{
				call_user_func_array($onStatus, array(0));
				call_user_func_array($onError, array("Failed to read attachments: " . Std::string($err)));
			}
		}break;
		}
	}
}
