<?php

// Generated by Haxe 3.4.4
class haxe_ds_TreeNode {
	public function __construct($l, $k, $v, $r, $h = null) {
		if(!php_Boot::$skip_constructor) {
		if($h === null) {
			$h = -1;
		}
		$this->left = $l;
		$this->key = $k;
		$this->value = $v;
		$this->right = $r;
		if($h === -1) {
			$tmp = null;
			$_this = $this->left;
			$tmp1 = null;
			if($_this === null) {
				$tmp1 = 0;
			} else {
				$tmp1 = $_this->_height;
			}
			$_this1 = $this->right;
			$tmp2 = null;
			if($_this1 === null) {
				$tmp2 = 0;
			} else {
				$tmp2 = $_this1->_height;
			}
			if($tmp1 > $tmp2) {
				$_this2 = $this->left;
				if($_this2 === null) {
					$tmp = 0;
				} else {
					$tmp = $_this2->_height;
				}
			} else {
				$_this3 = $this->right;
				if($_this3 === null) {
					$tmp = 0;
				} else {
					$tmp = $_this3->_height;
				}
			}
			$this->_height = $tmp + 1;
		} else {
			$this->_height = $h;
		}
	}}
	public $left;
	public $right;
	public $key;
	public $value;
	public $_height;
	public function toString() {
		$tmp = null;
		if($this->left === null) {
			$tmp = "";
		} else {
			$tmp = _hx_string_or_null($this->left->toString()) . ", ";
		}
		$tmp1 = "" . Std::string($this->key) . "=";
		$tmp2 = _hx_string_or_null($tmp) . _hx_string_or_null((_hx_string_or_null($tmp1) . Std::string($this->value)));
		$tmp3 = null;
		if($this->right === null) {
			$tmp3 = "";
		} else {
			$tmp3 = ", " . _hx_string_or_null($this->right->toString());
		}
		return _hx_string_or_null($tmp2) . _hx_string_or_null($tmp3);
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
	function __toString() { return $this->toString(); }
}
