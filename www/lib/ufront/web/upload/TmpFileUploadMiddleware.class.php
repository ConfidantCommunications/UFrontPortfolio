<?php

// Generated by Haxe 3.4.4
class ufront_web_upload_TmpFileUploadMiddleware implements ufront_app_UFMiddleware{
	public function __construct() {}
	public function requestIn($ctx) {
		$tmp = null;
		if(strtolower($ctx->request->get_httpMethod()) === "post") {
			$tmp = $ctx->request->isMultipart();
		} else {
			$tmp = false;
		}
		if($tmp) {
			$file = null;
			$postName = null;
			$origFileName = null;
			$size = 0;
			$tmpFilePath = null;
			$dateStr = DateTools::format(Date::now(), "%Y%m%d-%H%M");
			$dir = $ctx->get_contentDirectory();
			$dir1 = _hx_string_or_null($dir) . _hx_string_or_null(haxe_io_Path::addTrailingSlash(ufront_web_upload_TmpFileUploadMiddleware::$subDir));
			{
				$path = haxe_io_Path::addTrailingSlash(haxe_io_Path::removeTrailingSlashes($dir1));
				$_p = null;
				$parts = (new _hx_array(array()));
				while(true) {
					$_p = haxe_io_Path::directory($path);
					if(!($path !== $_p)) {
						break;
					}
					$parts->unshift($path);
					$path = $_p;
				}
				{
					$_g = 0;
					while($_g < $parts->length) {
						$part = $parts[$_g];
						$_g = $_g + 1;
						$tmp1 = null;
						if(_hx_char_code_at($part, strlen($part) - 1) !== 58) {
							$tmp1 = !file_exists($part);
						} else {
							$tmp1 = false;
						}
						if($tmp1) {
							@mkdir($part, 493);
						}
						unset($tmp1,$part);
					}
				}
			}
			$onPart = array(new _hx_lambda(array(&$dateStr, &$dir1, &$file, &$origFileName, &$postName, &$size, &$tmpFilePath), "ufront_web_upload_TmpFileUploadMiddleware_0"), 'execute');
			$onData = array(new _hx_lambda(array(&$file, &$size), "ufront_web_upload_TmpFileUploadMiddleware_1"), 'execute');
			$onEndPart = array(new _hx_lambda(array(&$ctx, &$file, &$origFileName, &$postName, &$size, &$tmpFilePath), "ufront_web_upload_TmpFileUploadMiddleware_2"), 'execute');
			return tink_core__Future_Future_Impl_::map($ctx->request->parseMultipart($onPart, $onData, $onEndPart), array(new _hx_lambda(array(), "ufront_web_upload_TmpFileUploadMiddleware_3"), 'execute'), null);
		} else {
			return ufront_core_SurpriseTools::success();
		}
	}
	public function responseOut($ctx) {
		$tmp = null;
		if(strtolower($ctx->request->get_httpMethod()) === "post") {
			$tmp = $ctx->request->isMultipart();
		} else {
			$tmp = false;
		}
		if($tmp) {
			$f = ufront_core__MultiValueMap_MultiValueMap_Impl_::iterator($ctx->request->get_files());
			while($f->hasNext()) {
				$f1 = $f->next();
				$tmpFile = Std::instance($f1, _hx_qtype("ufront.web.upload.TmpFileUpload"));
				if($tmpFile !== null) {
					$_g = $tmpFile->deleteTemporaryFile();
					if($_g->index === 1) {
						$e = _hx_deref($_g)->params[0];
						$ctx->messages->push(_hx_anonymous(array("msg" => $e, "pos" => _hx_anonymous(array("fileName" => "TmpFileUploadMiddleware.hx", "lineNumber" => 125, "className" => "ufront.web.upload.TmpFileUploadMiddleware", "methodName" => "responseOut")), "type" => ufront_log_MessageType::$MError)));
						unset($e);
					}
					unset($_g);
				}
				unset($tmpFile,$f1);
			}
		}
		return ufront_core_SurpriseTools::success();
	}
	static $subDir = "uf-upload-tmp";
	function __toString() { return 'ufront.web.upload.TmpFileUploadMiddleware'; }
}
function ufront_web_upload_TmpFileUploadMiddleware_0(&$dateStr, &$dir1, &$file, &$origFileName, &$postName, &$size, &$tmpFilePath, $pName, $fName) {
	{
		$postName = $pName;
		$origFileName = $fName;
		$size = 0;
		while($file === null) {
			$tmpFilePath1 = _hx_string_or_null($dir1) . _hx_string_or_null($dateStr) . "-";
			$tmpFilePath = _hx_string_or_null($tmpFilePath1) . _hx_string_or_null(ufront_core_Uuid::create()) . ".tmp";
			if(!file_exists($tmpFilePath)) {
				$file = sys_io_File::write($tmpFilePath, null);
			}
			unset($tmpFilePath1);
		}
		return ufront_core_SurpriseTools::success();
	}
}
function ufront_web_upload_TmpFileUploadMiddleware_1(&$file, &$size, $bytes, $pos, $len) {
	{
		$size = $size + $len;
		$file->writeBytes($bytes, $pos, $len);
		return ufront_core_SurpriseTools::success();
	}
}
function ufront_web_upload_TmpFileUploadMiddleware_2(&$ctx, &$file, &$origFileName, &$postName, &$size, &$tmpFilePath) {
	{
		if($file !== null) {
			$file->close();
			$file = null;
			$tmpFile = new ufront_web_upload_TmpFileUpload($tmpFilePath, $postName, $origFileName, $size, null);
			$onEndPart1 = $ctx->request->get_files();
			ufront_core__MultiValueMap_MultiValueMap_Impl_::add($onEndPart1, $postName, $tmpFile);
		}
		return ufront_core_SurpriseTools::success();
	}
}
function ufront_web_upload_TmpFileUploadMiddleware_3($result) {
	{
		switch($result->index) {
		case 0:{
			$s = _hx_deref($result)->params[0];
			return tink_core_Outcome::Success($s);
		}break;
		case 1:{
			$f = _hx_deref($result)->params[0];
			return tink_core_Outcome::Failure(ufront_web_HttpError::wrap($f, null, _hx_anonymous(array("fileName" => "TmpFileUploadMiddleware.hx", "lineNumber" => 96, "className" => "ufront.web.upload.TmpFileUploadMiddleware", "methodName" => "requestIn"))));
		}break;
		}
	}
}
