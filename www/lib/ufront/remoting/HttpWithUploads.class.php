<?php

class ufront_remoting_HttpWithUploads {
	public function __construct($url, $async, $timeout = null) {
		if(!php_Boot::$skip_constructor) {
		$this->h = new haxe_Http($url);
		if($async === false) {
			if($timeout !== null) {
				$this->h->cnxTimeout = $timeout;
			}
		}
		$this->async = $async;
	}}
	public $h;
	public $async;
	public function setHeader($k, $v) {
		$this->h->setHeader($k, $v);
	}
	public function setParam($k, $v) {
		$this->h->setParameter($k, $v);
	}
	public function attachUploads($uploads) {
		$_g2 = $this;
		$allUploadsReady = (new _hx_array(array()));
		$failedUploads = (new _hx_array(array()));
		if(null == $uploads) throw new HException('null iterable');
		$__hx__it = $uploads->keys();
		while($__hx__it->hasNext()) {
			unset($postName);
			$postName = $__hx__it->next();
			$_g = 0;
			$_g1 = ufront_core__MultiValueMap_MultiValueMap_Impl_::getAll($uploads, $postName);
			while($_g < $_g1->length) {
				$upload = $_g1[$_g];
				++$_g;
				$finished = false;
				$surprise = tink_core__Future_Future_Impl_::map($upload->getBytes(), array(new _hx_lambda(array(&$_g, &$_g1, &$_g2, &$allUploadsReady, &$failedUploads, &$finished, &$postName, &$upload, &$uploads), "ufront_remoting_HttpWithUploads_0"), 'execute'), null);
				if($this->async === false && !$finished) {
					throw new HException("upload.getBytes() resolved asynchronously, and was not ready in time for the synchronous HttpConnection remoting call");
				}
				$allUploadsReady->push($surprise);
				unset($upload,$surprise,$finished);
			}
			unset($_g1,$_g);
		}
		return tink_core__Future_Future_Impl_::map(tink_core__Future_Future_Impl_::ofMany($allUploadsReady, null), array(new _hx_lambda(array(&$_g2, &$allUploadsReady, &$failedUploads, &$uploads), "ufront_remoting_HttpWithUploads_1"), 'execute'), null);
	}
	public function send() {
		$this->h->request(true);
	}
	public function responseData() {
		return $this->h->responseData;
	}
	public function handle($onStatus, $onData, $onError) {
		$this->h->onStatus = $onStatus;
		$this->h->onData = $onData;
		$this->h->onError = $onError;
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
	function __toString() { return 'ufront.remoting.HttpWithUploads'; }
}
function ufront_remoting_HttpWithUploads_0(&$_g, &$_g1, &$_g2, &$allUploadsReady, &$failedUploads, &$finished, &$postName, &$upload, &$uploads, $outcome) {
	{
		switch($outcome->index) {
		case 0:{
			$bytes = _hx_deref($outcome)->params[0];
			{
				$bytesInput = new haxe_io_BytesInput($bytes, null, null);
				$_g2->h->fileTransfer($postName, $upload->originalFileName, $bytesInput, $upload->size, $upload->contentType);
				$finished = true;
			}
		}break;
		case 1:{
			$err = _hx_deref($outcome)->params[0];
			$failedUploads->push($err);
		}break;
		}
	}
}
function ufront_remoting_HttpWithUploads_1(&$_g2, &$allUploadsReady, &$failedUploads, &$uploads, $_) {
	{
		if($failedUploads->length === 0) {
			return tink_core_Outcome::Success(tink_core_Noise::$Noise);
		} else {
			return tink_core_Outcome::Failure(new tink_core_TypedError(null, "Failed to read attachments: " . Std::string($failedUploads), _hx_anonymous(array("fileName" => "HttpWithUploads.hx", "lineNumber" => 102, "className" => "ufront.remoting.HttpWithUploads", "methodName" => "attachUploads"))));
		}
	}
}
