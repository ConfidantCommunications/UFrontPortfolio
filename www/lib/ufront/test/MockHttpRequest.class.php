<?php

class ufront_test_MockHttpRequest extends ufront_web_context_HttpRequest {
	public function __construct($uri = null) { if(!php_Boot::$skip_constructor) {
		if($uri === null) {
			$uri = "/";
		}
		$this->setQueryString("");
		$this->setPostString("");
		$this->setQuery(ufront_test_MockHttpRequest_0($this, $uri));
		$this->setPost(ufront_test_MockHttpRequest_1($this, $uri));
		$this->setFiles(ufront_test_MockHttpRequest_2($this, $uri));
		$this->setCookies(ufront_test_MockHttpRequest_3($this, $uri));
		$this->setHostName("localhost");
		$this->setClientIP("127.0.0.1");
		$this->setUri($uri);
		$this->setClientHeaders(new haxe_ds_StringMap());
		$this->setUserAgent(ufront_web_UserAgent::fromString("Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0"));
		$this->setHttpMethod("GET");
		$this->setScriptDirectory("/var/www/");
		$this->setAuthorization(null);
		$this->setIsMultipart(false);
	}}
	public function setParams($params) {
		$this->params = $params;
		return $this;
	}
	public function get_queryString() {
		return $this->queryString;
	}
	public function setQueryString($qs) {
		$this->queryString = $qs;
		return $this;
	}
	public function get_postString() {
		return $this->postString;
	}
	public function setPostString($ps) {
		$this->postString = $ps;
		return $this;
	}
	public function get_query() {
		return $this->query;
	}
	public function setQuery($query) {
		$this->query = $query;
		return $this;
	}
	public function get_post() {
		return $this->post;
	}
	public function setPost($post) {
		$this->post = $post;
		return $this;
	}
	public function get_files() {
		return $this->files;
	}
	public function setFiles($files) {
		$this->files = $files;
		return $this;
	}
	public function get_cookies() {
		return $this->cookies;
	}
	public function setCookies($cookies) {
		$this->cookies = $cookies;
		return $this;
	}
	public function get_hostName() {
		return $this->hostName;
	}
	public function setHostName($hostName) {
		$this->hostName = $hostName;
		return $this;
	}
	public function get_clientIP() {
		return $this->clientIP;
	}
	public function setClientIP($clientIP) {
		$this->clientIP = $clientIP;
		return $this;
	}
	public function get_uri() {
		return $this->uri;
	}
	public function setUri($uri) {
		$this->uri = $uri;
		return $this;
	}
	public function get_clientHeaders() {
		return $this->clientHeaders;
	}
	public function setClientHeaders($clientHeaders) {
		$this->clientHeaders = $clientHeaders;
		return $this;
	}
	public function get_userAgent() {
		return $this->userAgent;
	}
	public function setUserAgent($userAgent) {
		$this->userAgent = $userAgent;
		return $this;
	}
	public function get_httpMethod() {
		return $this->httpMethod;
	}
	public function setHttpMethod($httpMethod) {
		$this->httpMethod = $httpMethod;
		return $this;
	}
	public function get_scriptDirectory() {
		return $this->scriptDirectory;
	}
	public function setScriptDirectory($scriptDirectory) {
		$this->scriptDirectory = $scriptDirectory;
		return $this;
	}
	public function get_authorization() {
		return $this->authorization;
	}
	public function setAuthorization($authorization) {
		$this->authorization = $authorization;
		return $this;
	}
	public function setIsMultipart($isMultipart) {
		if($isMultipart) {
			$this1 = $this->get_clientHeaders();
			ufront_core__MultiValueMap_MultiValueMap_Impl_::set($this1, strtolower("Content-Type"), "multipart/form-data; charset=UTF-8");
		} else {
			$this2 = $this->get_clientHeaders();
			ufront_core__MultiValueMap_MultiValueMap_Impl_::set($this2, strtolower("Content-Type"), "application/x-www-form-urlencoded; charset=UTF-8");
		}
		return $this;
	}
	public function parseMultipart($onPart = null, $onData = null, $onEndPart = null) {
		throw new HException(ufront_web_HttpError::wrap("parseMultipart is not supported in MockHttpRequest", null, _hx_anonymous(array("fileName" => "MockHttpRequest.hx", "lineNumber" => 158, "className" => "ufront.test.MockHttpRequest", "methodName" => "parseMultipart"))));
	}
	static $__properties__ = array("get_authorization" => "get_authorization","get_scriptDirectory" => "get_scriptDirectory","get_httpMethod" => "get_httpMethod","get_userAgent" => "get_userAgent","get_clientHeaders" => "get_clientHeaders","get_uri" => "get_uri","get_clientIP" => "get_clientIP","get_hostName" => "get_hostName","get_cookies" => "get_cookies","get_files" => "get_files","get_post" => "get_post","get_query" => "get_query","get_postString" => "get_postString","get_queryString" => "get_queryString","get_params" => "get_params");
	function __toString() { return 'ufront.test.MockHttpRequest'; }
}
function ufront_test_MockHttpRequest_0(&$__hx__this, &$uri) {
	{
		$map = new haxe_ds_StringMap();
		return $map;
	}
}
function ufront_test_MockHttpRequest_1(&$__hx__this, &$uri) {
	{
		$map1 = new haxe_ds_StringMap();
		return $map1;
	}
}
function ufront_test_MockHttpRequest_2(&$__hx__this, &$uri) {
	{
		$map2 = new haxe_ds_StringMap();
		return $map2;
	}
}
function ufront_test_MockHttpRequest_3(&$__hx__this, &$uri) {
	{
		$map3 = new haxe_ds_StringMap();
		return $map3;
	}
}
