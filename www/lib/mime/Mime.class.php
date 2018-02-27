<?php

// Generated by Haxe 3.4.4
class mime_Mime {
	public function __construct(){}
	static function db() { $args = func_get_args(); return call_user_func_array(self::$db, $args); }
	static $db;
	static function lookup($path) {
		$extension = null;
		if(_hx_index_of($path, ".", null) > -1) {
			$extension = strtolower(haxe_io_Path::extension($path));
		} else {
			$extension = strtolower($path);
		}
		{
			$_g = 0;
			$_g1 = Reflect::fields(mime_Mime::$db);
			while($_g < $_g1->length) {
				$type = $_g1[$_g];
				$_g = $_g + 1;
				$entry = Reflect::field(mime_Mime::$db, $type);
				$tmp = null;
				if($entry->extensions !== null) {
					$tmp = $entry->extensions->indexOf($extension, null) > -1;
				} else {
					$tmp = false;
				}
				if($tmp) {
					return $type;
				}
				unset($type,$tmp,$entry);
			}
		}
		return null;
	}
	static function extension($type) {
		$this1 = mime_Mime::$db;
		if(!_hx_has_field($this1, $type)) {
			return null;
		}
		$entry = Reflect::field(mime_Mime::$db, $type);
		if($entry->extensions === null) {
			return null;
		}
		return $entry->extensions[0];
	}
	static function init() {}
	function __toString() { return 'mime.Mime'; }
}
mime_Mime::$db = haxe_Json::phpJsonDecode(haxe_Resource::getString("mime-db"));
