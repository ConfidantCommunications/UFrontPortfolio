<?php

// Generated by Haxe 3.4.2
class ufront_web_upload_BaseUpload {
	public function __construct($postName, $originalFileName, $size, $contentType = null) {
		if(!php_Boot::$skip_constructor) {
		$this->postName = $postName;
		$this->originalFileName = haxe_io_Path::withoutDirectory($originalFileName);
		$this->size = $size;
		$this->contentType = $contentType;
	}}
	public $postName;
	public $originalFileName;
	public $size;
	public $contentType;
	public $attachedUpload;
	public function hxSerialize($s) {
		$rs = Std::instance($s, _hx_qtype("ufront.remoting.RemotingSerializer"));
		$attachingUpload = null;
		if($rs !== null) {
			$_g = $rs->direction;
			if($_g->index === 0) {
				$attachingUpload = true;
			} else {
				$attachingUpload = false;
			}
		} else {
			$attachingUpload = false;
		}
		$s->serialize($attachingUpload);
		if($attachingUpload) {
			if(Std::is($this, _hx_qtype("ufront.web.upload.UFFileUpload")) === false) {
				throw new HException("BaseUpload can only be serialized if the sub-class matches the UFFileUpload interface");
			}
			$uniquePostName = _hx_string_or_null($this->postName) . "_";
			$uniquePostName1 = _hx_string_or_null($uniquePostName) . _hx_string_or_null(ufront_core_Uuid::create());
			ufront_core__MultiValueMap_MultiValueMap_Impl_::add($rs->uploads, $uniquePostName1, $this);
			$s->serialize($uniquePostName1);
		}
		$s->serialize($this->postName);
		$s->serialize($this->originalFileName);
		$s->serialize($this->size);
		$s->serialize($this->contentType);
	}
	public function hxUnserialize($s) {
		$uploadAttached = $s->unserialize();
		$rs = Std::instance($s, _hx_qtype("ufront.remoting.RemotingUnserializer"));
		if($uploadAttached) {
			if($rs === null) {
				throw new HException("Unable to Unserialize upload. It was serialized with RemotingSerializer, it must be unserialized with RemotingUnserializer");
			}
			$uniquePostName = $s->unserialize();
			if($rs->uploads->exists($uniquePostName)) {
				$this->attachedUpload = ufront_core__MultiValueMap_MultiValueMap_Impl_::get($rs->uploads, $uniquePostName);
			} else {
				throw new HException("Unable to find upload attached as " . _hx_string_or_null($uniquePostName));
			}
		}
		$this->postName = $s->unserialize();
		$this->originalFileName = $s->unserialize();
		$this->size = $s->unserialize();
		$this->contentType = $s->unserialize();
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
	function __toString() { return 'ufront.web.upload.BaseUpload'; }
}
