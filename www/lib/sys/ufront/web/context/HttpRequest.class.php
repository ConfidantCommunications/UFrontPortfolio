<?php

class sys_ufront_web_context_HttpRequest extends ufront_web_context_HttpRequest {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->_parsed = false;
	}}
	public function get_queryString() {
		if($this->queryString === null) {
			$this->queryString = php_Web::getParamsString();
			if($this->queryString === null) {
				$this->queryString = "";
			}
			$indexOfHash = _hx_index_of($this->queryString, "#", null);
			if($indexOfHash > -1) {
				$this->queryString = _hx_substring($this->queryString, 0, $indexOfHash);
			}
		}
		return $this->queryString;
	}
	public function get_postString() {
		if($this->postString === null) {
			if($this->get_httpMethod() === "GET") {
				$this->postString = "";
			} else {
				$this->postString = php_Web::getPostData();
			}
			if($this->postString === null) {
				$this->postString = "";
			}
		}
		return $this->postString;
	}
	public $_parsed;
	public function parseMultipart($onPart = null, $onData = null, $onEndPart = null) {
		$_g = $this;
		if(!$this->isMultipart()) {
			return ufront_core_SurpriseTools::success();
		}
		if($this->_parsed) {
			throw new HException(ufront_web_HttpError::internalServerError("parseMultipart() has been called more than once.", null, _hx_anonymous(array("fileName" => "HttpRequest.hx", "lineNumber" => 90, "className" => "sys.ufront.web.context.HttpRequest", "methodName" => "parseMultipart"))));
		}
		$this->_parsed = true;
		if($onPart === null) {
			$onPart = array(new _hx_lambda(array(&$_g, &$onData, &$onEndPart, &$onPart), "sys_ufront_web_context_HttpRequest_0"), 'execute');
		}
		if($onData === null) {
			$onData = array(new _hx_lambda(array(&$_g, &$onData, &$onEndPart, &$onPart), "sys_ufront_web_context_HttpRequest_1"), 'execute');
		}
		if($onEndPart === null) {
			$onEndPart = array(new _hx_lambda(array(&$_g, &$onData, &$onEndPart, &$onPart), "sys_ufront_web_context_HttpRequest_2"), 'execute');
		}
		$this->post = new haxe_ds_StringMap();
		$noParts = true;
		$isFile = false;
		$partName = null;
		$fileName = null;
		$currentContent = null;
		$callbackFutures = (new _hx_array(array()));
		$errors = (new _hx_array(array()));
		$processCallbackResult = array(new _hx_lambda(array(&$_g, &$callbackFutures, &$currentContent, &$errors, &$fileName, &$isFile, &$noParts, &$onData, &$onEndPart, &$onPart, &$partName), "sys_ufront_web_context_HttpRequest_3"), 'execute');
		$doEndOfPart = array(new _hx_lambda(array(&$_g, &$callbackFutures, &$currentContent, &$errors, &$fileName, &$isFile, &$noParts, &$onData, &$onEndPart, &$onPart, &$partName, &$processCallbackResult), "sys_ufront_web_context_HttpRequest_4"), 'execute');
		$doPart = array(new _hx_lambda(array(&$_g, &$callbackFutures, &$currentContent, &$doEndOfPart, &$errors, &$fileName, &$isFile, &$noParts, &$onData, &$onEndPart, &$onPart, &$partName, &$processCallbackResult), "sys_ufront_web_context_HttpRequest_5"), 'execute');
		$doData = array(new _hx_lambda(array(&$_g, &$callbackFutures, &$currentContent, &$doEndOfPart, &$doPart, &$errors, &$fileName, &$isFile, &$noParts, &$onData, &$onEndPart, &$onPart, &$partName, &$processCallbackResult), "sys_ufront_web_context_HttpRequest_6"), 'execute');
		try {
			sys_ufront_web_context__HttpRequest_WebOverride::parseMultipart($doPart, $doData);
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			$e = $_ex_;
			{
				$stack = haxe_CallStack::toString(haxe_CallStack::exceptionStack());
				$err1 = "Failed to parse multipart data: " . Std::string($e) . "\x0A" . _hx_string_or_null($stack);
				$errors->push($err1);
			}
		}
		if($noParts === false) {
			call_user_func($doEndOfPart);
		}
		if($callbackFutures->length > 0) {
			return tink_core__Future_Future_Impl_::flatMap(tink_core__Future_Future_Impl_::ofMany($callbackFutures, null), array(new _hx_lambda(array(&$_g, &$callbackFutures, &$currentContent, &$doData, &$doEndOfPart, &$doPart, &$e, &$errors, &$fileName, &$isFile, &$noParts, &$onData, &$onEndPart, &$onPart, &$partName, &$processCallbackResult), "sys_ufront_web_context_HttpRequest_7"), 'execute'), null);
		} else {
			$data5 = tink_core_Outcome::Success(tink_core_Noise::$Noise);
			return tink_core__Future_Future_Impl_::sync($data5);
		}
	}
	public function get_query() {
		if($this->query === null) {
			$this->query = sys_ufront_web_context_HttpRequest::getMultiValueMapFromString($this->get_queryString());
		}
		return $this->query;
	}
	public function get_post() {
		if($this->post === null) {
			if($this->get_httpMethod() === "GET") {
				$this->post = new haxe_ds_StringMap();
			} else {
				if($this->isMultipart()) {
					if($this->_parsed === false) {
						$this->parseMultipart(null, null, null);
					}
				} else {
					$this->post = sys_ufront_web_context_HttpRequest::getMultiValueMapFromString($this->get_postString());
				}
			}
		}
		return $this->post;
	}
	public function get_cookies() {
		if($this->cookies === null) {
			$map = php_Web::getCookies();
			$this->cookies = ufront_core__MultiValueMap_MultiValueMap_Impl_::fromStringMap($map);
		}
		return $this->cookies;
	}
	public function get_hostName() {
		if($this->hostName === null) {
			$this->hostName = $_SERVER['SERVER_NAME'];
		}
		return $this->hostName;
	}
	public function get_clientIP() {
		if($this->clientIP === null) {
			$this->clientIP = $_SERVER['REMOTE_ADDR'];
		}
		return $this->clientIP;
	}
	public function get_uri() {
		if($this->uri === null) {
			$this->uri = php_Web::getURI();
			$this->uri = urldecode($this->uri);
		}
		return $this->uri;
	}
	public function get_clientHeaders() {
		if($this->clientHeaders === null) {
			$this->clientHeaders = new haxe_ds_StringMap();
			$headers = php_Lib::hashOfAssociativeArray(apache_request_headers());
			if(null == $headers) throw new HException('null iterable');
			$__hx__it = $headers->keys();
			while($__hx__it->hasNext()) {
				unset($name);
				$name = $__hx__it->next();
				$_g = 0;
				$_g1 = _hx_explode(",", $headers->get($name));
				while($_g < $_g1->length) {
					$val = $_g1[$_g];
					++$_g;
					{
						$value = trim($val);
						ufront_core__MultiValueMap_MultiValueMap_Impl_::add($this->clientHeaders, strtolower($name), $value);
						unset($value);
					}
					unset($val);
				}
				unset($_g1,$_g);
			}
		}
		return $this->clientHeaders;
	}
	public function get_httpMethod() {
		if($this->httpMethod === null) {
			$this->httpMethod = php_Web::getMethod();
			if($this->httpMethod === null) {
				$this->httpMethod = "";
			}
		}
		return $this->httpMethod;
	}
	public function get_scriptDirectory() {
		if($this->scriptDirectory === null) {
			$this->scriptDirectory = _hx_string_or_null(dirname($_SERVER["SCRIPT_FILENAME"])) . "/";
		}
		return $this->scriptDirectory;
	}
	public function get_authorization() {
		if(_hx_field($this, "authorization") === null) {
			$this->authorization = php_Web::getAuthorization();
			if(_hx_field($this, "authorization") === null) {
				$this->authorization = _hx_anonymous(array("user" => null, "pass" => null));
			}
		}
		return $this->authorization;
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
	static function getMultiValueMapFromString($s) {
		$map = new haxe_ds_StringMap();
		{
			$_g = 0;
			$_g1 = _hx_explode("&", $s);
			while($_g < $_g1->length) {
				$part = $_g1[$_g];
				++$_g;
				$index = _hx_index_of($part, "=", null);
				if($index > 0) {
					$name = _hx_substr($part, 0, $index);
					$val = _hx_substr($part, $index + 1, null);
					ufront_core__MultiValueMap_MultiValueMap_Impl_::add($map, urldecode($name), urldecode($val));
					unset($val,$name);
				}
				unset($part,$index);
			}
		}
		return $map;
	}
	static $__properties__ = array("get_authorization" => "get_authorization","get_scriptDirectory" => "get_scriptDirectory","get_httpMethod" => "get_httpMethod","get_userAgent" => "get_userAgent","get_clientHeaders" => "get_clientHeaders","get_uri" => "get_uri","get_clientIP" => "get_clientIP","get_hostName" => "get_hostName","get_cookies" => "get_cookies","get_files" => "get_files","get_post" => "get_post","get_query" => "get_query","get_postString" => "get_postString","get_queryString" => "get_queryString","get_params" => "get_params");
	function __toString() { return 'sys.ufront.web.context.HttpRequest'; }
}
function sys_ufront_web_context_HttpRequest_0(&$_g, &$onData, &$onEndPart, &$onPart, $_, $_1) {
	{
		$data = tink_core_Outcome::Success(tink_core_Noise::$Noise);
		return tink_core__Future_Future_Impl_::sync($data);
	}
}
function sys_ufront_web_context_HttpRequest_1(&$_g, &$onData, &$onEndPart, &$onPart, $_2, $_3, $_4) {
	{
		$data1 = tink_core_Outcome::Success(tink_core_Noise::$Noise);
		return tink_core__Future_Future_Impl_::sync($data1);
	}
}
function sys_ufront_web_context_HttpRequest_2(&$_g, &$onData, &$onEndPart, &$onPart) {
	{
		$data2 = tink_core_Outcome::Success(tink_core_Noise::$Noise);
		return tink_core__Future_Future_Impl_::sync($data2);
	}
}
function sys_ufront_web_context_HttpRequest_3(&$_g, &$callbackFutures, &$currentContent, &$errors, &$fileName, &$isFile, &$noParts, &$onData, &$onEndPart, &$onPart, &$partName, $surprise) {
	{
		$callbackFutures->push($surprise);
		$surprise(array(new _hx_lambda(array(&$_g, &$callbackFutures, &$currentContent, &$errors, &$fileName, &$isFile, &$noParts, &$onData, &$onEndPart, &$onPart, &$partName, &$surprise), "sys_ufront_web_context_HttpRequest_8"), 'execute'));
	}
}
function sys_ufront_web_context_HttpRequest_4(&$_g, &$callbackFutures, &$currentContent, &$errors, &$fileName, &$isFile, &$noParts, &$onData, &$onEndPart, &$onPart, &$partName, &$processCallbackResult) {
	{
		if($isFile) {
			call_user_func_array($processCallbackResult, array(call_user_func($onEndPart)));
		} else {
			if($currentContent !== null) {
				ufront_core__MultiValueMap_MultiValueMap_Impl_::add($_g->get_post(), $partName, $currentContent);
			}
		}
	}
}
function sys_ufront_web_context_HttpRequest_5(&$_g, &$callbackFutures, &$currentContent, &$doEndOfPart, &$errors, &$fileName, &$isFile, &$noParts, &$onData, &$onEndPart, &$onPart, &$partName, &$processCallbackResult, $newPartName, $newPartFilename) {
	{
		call_user_func($doEndOfPart);
		$noParts = false;
		$currentContent = null;
		$partName = urldecode($newPartName);
		$isFile = false;
		if($newPartFilename !== null && $newPartFilename !== "") {
			$fileName = urldecode($newPartFilename);
			ufront_core__MultiValueMap_MultiValueMap_Impl_::add($_g->get_post(), $partName, $fileName);
			call_user_func_array($processCallbackResult, array(call_user_func_array($onPart, array($partName, $fileName))));
			$isFile = true;
		}
	}
}
function sys_ufront_web_context_HttpRequest_6(&$_g, &$callbackFutures, &$currentContent, &$doEndOfPart, &$doPart, &$errors, &$fileName, &$isFile, &$noParts, &$onData, &$onEndPart, &$onPart, &$partName, &$processCallbackResult, $bytes, $pos, $len) {
	{
		if($isFile) {
			if($len > 0) {
				call_user_func_array($processCallbackResult, array(call_user_func_array($onData, array($bytes, $pos, $len))));
			}
		} else {
			if($currentContent === null) {
				$currentContent = "";
			}
			$currentContent .= _hx_string_or_null($bytes->getString($pos, $len));
		}
	}
}
function sys_ufront_web_context_HttpRequest_7(&$_g, &$callbackFutures, &$currentContent, &$doData, &$doEndOfPart, &$doPart, &$e, &$errors, &$fileName, &$isFile, &$noParts, &$onData, &$onEndPart, &$onPart, &$partName, &$processCallbackResult, $_5) {
	{
		if($errors->length === 0) {
			$data3 = tink_core_Outcome::Success(tink_core_Noise::$Noise);
			return tink_core__Future_Future_Impl_::sync($data3);
		} else {
			$data4 = tink_core_Outcome::Failure(tink_core_TypedError::withData(null, "Error parsing multipart request data", $errors, _hx_anonymous(array("fileName" => "HttpRequest.hx", "lineNumber" => 171, "className" => "sys.ufront.web.context.HttpRequest", "methodName" => "parseMultipart"))));
			return tink_core__Future_Future_Impl_::sync($data4);
		}
	}
}
function sys_ufront_web_context_HttpRequest_8(&$_g, &$callbackFutures, &$currentContent, &$errors, &$fileName, &$isFile, &$noParts, &$onData, &$onEndPart, &$onPart, &$partName, &$surprise, $outcome) {
	{
		switch($outcome->index) {
		case 1:{
			$err = _hx_deref($outcome)->params[0];
			$errors->push($err->toString());
		}break;
		default:{}break;
		}
	}
}
