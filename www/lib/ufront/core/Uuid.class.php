<?php

class ufront_core_Uuid {
	public function __construct(){}
	static function random($outOf) {
		return Math::floor(Math::random() * $outOf);
	}
	static function srandom() {
		return _hx_char_at("0123456789ABCDEF", Math::floor(Math::random() * 16));
	}
	static function create() {
		$s = (new _hx_array(array()));
		{
			$_g = 0;
			while($_g < 8) {
				$i = $_g++;
				$s[$i] = _hx_char_at("0123456789ABCDEF", Math::floor(Math::random() * 16));
				unset($i);
			}
		}
		$s[8] = "-";
		{
			$_g1 = 9;
			while($_g1 < 13) {
				$i1 = $_g1++;
				$s[$i1] = _hx_char_at("0123456789ABCDEF", Math::floor(Math::random() * 16));
				unset($i1);
			}
		}
		$s[13] = "-";
		$s[14] = "4";
		{
			$_g2 = 15;
			while($_g2 < 18) {
				$i2 = $_g2++;
				$s[$i2] = _hx_char_at("0123456789ABCDEF", Math::floor(Math::random() * 16));
				unset($i2);
			}
		}
		$s[18] = "-";
		$s[19] = "" . _hx_string_or_null(_hx_char_at("89AB", Math::floor(Math::random() * 4)));
		{
			$_g3 = 20;
			while($_g3 < 23) {
				$i3 = $_g3++;
				$s[$i3] = _hx_char_at("0123456789ABCDEF", Math::floor(Math::random() * 16));
				unset($i3);
			}
		}
		$s[23] = "-";
		{
			$_g4 = 24;
			while($_g4 < 36) {
				$i4 = $_g4++;
				$s[$i4] = _hx_char_at("0123456789ABCDEF", Math::floor(Math::random() * 16));
				unset($i4);
			}
		}
		return $s->join("");
	}
	static function isValid($s) {
		return _hx_deref(new EReg("[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}", ""))->match($s);
	}
	function __toString() { return 'ufront.core.Uuid'; }
}
