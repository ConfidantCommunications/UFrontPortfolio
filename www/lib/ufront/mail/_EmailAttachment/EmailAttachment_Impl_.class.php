<?php

// Generated by Haxe 3.4.4
class ufront_mail__EmailAttachment_EmailAttachment_Impl_ {
	public function __construct(){}
	static function _new($type, $name, $content) {
		$this1 = _hx_anonymous(array("type" => $type, "name" => $name, "content" => $content));
		return $this1;
	}
	static function get_type($this1) {
		return $this1->type;
	}
	static function set_type($this1, $v) {
		return $this1->type = $v;
	}
	static function get_name($this1) {
		return $this1->name;
	}
	static function set_name($this1, $v) {
		return $this1->name = $v;
	}
	static function get_content($this1) {
		return $this1->content;
	}
	static function set_content($this1, $v) {
		return $this1->content = $v;
	}
	static function get_contentBase64($this1) {
		return ufront_mail__EmailAttachment_EmailAttachment_Impl_::base64Encode($this1->content);
	}
	static function base64Decode($str) {
		return haxe_Unserializer::run("s" . _hx_string_rec(strlen($str), "") . ":" . _hx_string_or_null($str));
	}
	static function base64Encode($b) {
		$fullStr = haxe_Serializer::run($b);
		return _hx_substr($fullStr, _hx_index_of($fullStr, ":", null) + 1, null);
	}
	static $__properties__ = array("get_contentBase64" => "get_contentBase64","set_content" => "set_content","get_content" => "get_content","set_name" => "set_name","get_name" => "get_name","set_type" => "set_type","get_type" => "get_type");
	function __toString() { return 'ufront.mail._EmailAttachment.EmailAttachment_Impl_'; }
}
