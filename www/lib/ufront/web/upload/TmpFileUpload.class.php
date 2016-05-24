<?php

class ufront_web_upload_TmpFileUpload extends ufront_web_upload_BaseUpload implements ufront_web_upload_UFFileUpload{
	public function __construct($tmpFileName, $postName, $originalFileName, $size, $contentType = null) {
		if(!php_Boot::$skip_constructor) {
		parent::__construct($postName,haxe_io_Path::withoutDirectory($originalFileName),$size,$contentType);
		$this->tmpFileName = $tmpFileName;
	}}
	public $tmpFileName;
	public function getBytes() {
		if($this->attachedUpload !== null) {
			return $this->attachedUpload->getBytes();
		}
		try {
			{
				$data = tink_core_Outcome::Success(sys_io_File::getBytes($this->tmpFileName));
				return tink_core__Future_Future_Impl_::sync($data);
			}
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			$e = $_ex_;
			{
				{
					$data1 = tink_core_Outcome::Failure(ufront_web_HttpError::wrap($e, "Error during TmpFileUpload.getBytes()", _hx_anonymous(array("fileName" => "TmpFileUpload.hx", "lineNumber" => 49, "className" => "ufront.web.upload.TmpFileUpload", "methodName" => "getBytes"))));
					return tink_core__Future_Future_Impl_::sync($data1);
				}
			}
		}
	}
	public function getString($encoding = null) {
		if($encoding === null) {
			$encoding = "UTF-8";
		}
		if($this->attachedUpload !== null) {
			return $this->attachedUpload->getString($encoding);
		}
		try {
			{
				$data = tink_core_Outcome::Success(sys_io_File::getContent($this->tmpFileName));
				return tink_core__Future_Future_Impl_::sync($data);
			}
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			$e = $_ex_;
			{
				{
					$data1 = tink_core_Outcome::Failure(ufront_web_HttpError::wrap($e, "Error during TmpFileUpload.getString()", _hx_anonymous(array("fileName" => "TmpFileUpload.hx", "lineNumber" => 67, "className" => "ufront.web.upload.TmpFileUpload", "methodName" => "getString"))));
					return tink_core__Future_Future_Impl_::sync($data1);
				}
			}
		}
	}
	public function writeToFile($newFilePath) {
		if($this->attachedUpload !== null) {
			return $this->attachedUpload->writeToFile($newFilePath);
		}
		try {
			$directory = haxe_io_Path::directory($newFilePath);
			if(!file_exists($directory)) {
				$path = haxe_io_Path::addTrailingSlash($directory);
				$_p = null;
				$parts = (new _hx_array(array()));
				while($path !== ($_p = haxe_io_Path::directory($path))) {
					$parts->unshift($path);
					$path = $_p;
				}
				{
					$_g = 0;
					while($_g < $parts->length) {
						$part = $parts[$_g];
						++$_g;
						if(_hx_char_code_at($part, strlen($part) - 1) !== 58 && !file_exists($part)) {
							@mkdir($part, 493);
						}
						unset($part);
					}
				}
			}
			sys_io_File::copy($this->tmpFileName, $newFilePath);
			return ufront_core_SurpriseTools::success();
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			$e = $_ex_;
			{
				{
					$data = tink_core_Outcome::Failure(ufront_web_HttpError::wrap($e, "Error during TmpFileUpload.writeToFile()", _hx_anonymous(array("fileName" => "TmpFileUpload.hx", "lineNumber" => 87, "className" => "ufront.web.upload.TmpFileUpload", "methodName" => "writeToFile"))));
					return tink_core__Future_Future_Impl_::sync($data);
				}
			}
		}
	}
	public function process($onData, $partSize = null) {
		if($this->attachedUpload !== null) {
			return $this->attachedUpload->process($onData, $partSize);
		}
		try {
			if($partSize === null) {
				$partSize = 8192;
			}
			$doneTrigger = new tink_core_FutureTrigger();
			$fh = sys_io_File::read($this->tmpFileName, null);
			$pos = 0;
			$readNext = null;
			{
				$readNext1 = null;
				$readNext1 = array(new _hx_lambda(array(&$doneTrigger, &$fh, &$onData, &$partSize, &$pos, &$readNext, &$readNext1), "ufront_web_upload_TmpFileUpload_0"), 'execute');
				$readNext = $readNext1;
			}
			call_user_func($readNext);
			return $doneTrigger->future;
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			$e2 = $_ex_;
			{
				{
					$data1 = tink_core_Outcome::Failure(ufront_web_HttpError::wrap($e2, "Error during TmpFileUpload.process()", _hx_anonymous(array("fileName" => "TmpFileUpload.hx", "lineNumber" => 152, "className" => "ufront.web.upload.TmpFileUpload", "methodName" => "process"))));
					return tink_core__Future_Future_Impl_::sync($data1);
				}
			}
		}
	}
	public function deleteTemporaryFile() {
		try {
			@unlink($this->tmpFileName);
			return tink_core_Outcome::Success(tink_core_Noise::$Noise);
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			$e = $_ex_;
			{
				return tink_core_Outcome::Failure(ufront_web_HttpError::wrap($e, "Error during TmpFileUpload.deleteTmpFile()", _hx_anonymous(array("fileName" => "TmpFileUpload.hx", "lineNumber" => 169, "className" => "ufront.web.upload.TmpFileUpload", "methodName" => "deleteTemporaryFile"))));
			}
		}
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
	function __toString() { return 'ufront.web.upload.TmpFileUpload'; }
}
function ufront_web_upload_TmpFileUpload_0(&$doneTrigger, &$fh, &$onData, &$partSize, &$pos, &$readNext, &$readNext1) {
	{
		$final = false;
		$surprise = null;
		try {
			$bytes = $fh->read($partSize);
			$surprise = call_user_func_array($onData, array($bytes, $pos, $bytes->length));
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			if(($e = $_ex_) instanceof haxe_io_Eof){
				$final = true;
				$bytes1 = $fh->readAll($partSize);
				$surprise = call_user_func_array($onData, array($bytes1, $pos, $bytes1->length));
			}
			else { $e1 = $_ex_;
			{
				{
					$data = tink_core_Outcome::Failure(ufront_web_HttpError::wrap($e1, "Error during TmpFileUpload.process", _hx_anonymous(array("fileName" => "TmpFileUpload.hx", "lineNumber" => 132, "className" => "ufront.web.upload.TmpFileUpload", "methodName" => "process"))));
					$surprise = tink_core__Future_Future_Impl_::sync($data);
				}
			}}
		}
		$surprise(array(new _hx_lambda(array(&$doneTrigger, &$e, &$e1, &$fh, &$final, &$onData, &$partSize, &$pos, &$readNext, &$readNext1, &$surprise), "ufront_web_upload_TmpFileUpload_1"), 'execute'));
	}
}
function ufront_web_upload_TmpFileUpload_1(&$doneTrigger, &$e, &$e1, &$fh, &$final, &$onData, &$partSize, &$pos, &$readNext, &$readNext1, &$surprise, $outcome) {
	{
		switch($outcome->index) {
		case 0:{
			if($final === false) {
				$pos += $partSize;
				call_user_func($readNext1);
			} else {
				$result = tink_core_Outcome::Success(tink_core_Noise::$Noise);
				if($doneTrigger->{"list"} === null) {
					false;
				} else {
					$list = $doneTrigger->{"list"};
					$doneTrigger->{"list"} = null;
					$doneTrigger->result = $result;
					tink_core__Callback_CallbackList_Impl_::invoke($list, $result);
					tink_core__Callback_CallbackList_Impl_::clear($list);
					true;
				}
			}
		}break;
		case 1:{
			$err = _hx_deref($outcome)->params[0];
			{
				$result1 = tink_core_Outcome::Failure($err);
				if($doneTrigger->{"list"} === null) {
					false;
				} else {
					$list1 = $doneTrigger->{"list"};
					$doneTrigger->{"list"} = null;
					$doneTrigger->result = $result1;
					tink_core__Callback_CallbackList_Impl_::invoke($list1, $result1);
					tink_core__Callback_CallbackList_Impl_::clear($list1);
					true;
				}
			}
		}break;
		}
	}
}
