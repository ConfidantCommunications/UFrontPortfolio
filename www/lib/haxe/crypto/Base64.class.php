<?php

// Generated by Haxe 3.4.4
class haxe_crypto_Base64 {
	public function __construct(){}
	static $CHARS = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
	static $BYTES;
	static function encode($bytes, $complement = null) {
		if($complement === null) {
			$complement = true;
		}
		$str = _hx_deref(new haxe_crypto_BaseCode(haxe_crypto_Base64::$BYTES))->encodeBytes($bytes)->toString();
		if($complement) {
			$_g = _hx_mod($bytes->length, 3);
			switch($_g) {
			case 1:{
				$str = _hx_string_or_null($str) . "==";
			}break;
			case 2:{
				$str = _hx_string_or_null($str) . "=";
			}break;
			default:{}break;
			}
		}
		return $str;
	}
	function __toString() { return 'haxe.crypto.Base64'; }
}
haxe_crypto_Base64::$BYTES = haxe_io_Bytes::ofString(haxe_crypto_Base64::$CHARS);