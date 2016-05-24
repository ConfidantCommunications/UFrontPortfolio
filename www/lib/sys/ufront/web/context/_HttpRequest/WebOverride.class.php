<?php

class sys_ufront_web_context__HttpRequest_WebOverride {
	public function __construct(){}
	static function parseMultipart($onPart, $onData) {
		$a = $_POST;
		if(get_magic_quotes_gpc()) {
			reset($a); while(list($k, $v) = each($a)) $a[$k] = stripslashes((string)$v);
		}
		$post = php_Lib::hashOfAssociativeArray($a);
		if(null == $post) throw new HException('null iterable');
		$__hx__it = $post->keys();
		while($__hx__it->hasNext()) {
			unset($key);
			$key = $__hx__it->next();
			call_user_func_array($onPart, array($key, ""));
			$v = $post->get($key);
			if(is_array($v)) {
				$map = php_Lib::hashOfAssociativeArray($v);
				$first = true;
				if(null == $map) throw new HException('null iterable');
				$__hx__it2 = $map->iterator();
				while($__hx__it2->hasNext()) {
					unset($val);
					$val = $__hx__it2->next();
					if(!$first) {
						call_user_func_array($onPart, array($key, ""));
					}
					call_user_func_array($onData, array(haxe_io_Bytes::ofString($val), 0, strlen($val)));
					$first = false;
				}
				unset($map,$first);
			} else {
				call_user_func_array($onData, array(haxe_io_Bytes::ofString($v), 0, strlen($v)));
			}
			unset($v);
		}
		if(!isset($_FILES)) {
			return;
		}
		$parts = new _hx_array(array_keys($_FILES));
		{
			$_g = 0;
			while($_g < $parts->length) {
				$part = $parts[$_g];
				++$_g;
				$info = $_FILES[$part];
				$tmp = $info["tmp_name"];
				$file = $info["name"];
				$err = $info["error"];
				if($err > 0) {
					switch($err) {
					case 1:{
						throw new HException("The uploaded file exceeds the max size of " . _hx_string_or_null(ini_get("upload_max_filesize")));
					}break;
					case 2:{
						throw new HException("The uploaded file exceeds the max file size directive specified in the HTML form (max is" . _hx_string_or_null((_hx_string_or_null(ini_get("post_max_size")) . ")")));
					}break;
					case 3:{
						throw new HException("The uploaded file was only partially uploaded");
					}break;
					case 4:{
						continue 2;
					}break;
					case 6:{
						throw new HException("Missing a temporary folder");
					}break;
					case 7:{
						throw new HException("Failed to write file to disk");
					}break;
					case 8:{
						throw new HException("File upload stopped by extension");
					}break;
					}
				}
				call_user_func_array($onPart, array($part, $file));
				if("" !== $file) {
					$h = fopen($tmp, "r");
					$bsize = 8192;
					while(!feof($h)) {
						$buf = fread($h, $bsize);
						$size = strlen($buf);
						call_user_func_array($onData, array(haxe_io_Bytes::ofString($buf), 0, $size));
						unset($size,$buf);
					}
					fclose($h);
					unset($h,$bsize);
				}
				unset($tmp,$part,$info,$file,$err);
			}
		}
	}
	function __toString() { return 'sys.ufront.web.context._HttpRequest.WebOverride'; }
}
