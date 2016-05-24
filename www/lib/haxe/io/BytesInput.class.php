<?php

class haxe_io_BytesInput extends haxe_io_Input {
	public function __construct($b, $pos = null, $len = null) {
		if(!php_Boot::$skip_constructor) {
		if($pos === null) {
			$pos = 0;
		}
		if($len === null) {
			$len = $b->length - $pos;
		}
		if($pos < 0 || $len < 0 || $pos + $len > $b->length) {
			throw new HException(haxe_io_Error::$OutsideBounds);
		}
		$this->b = $b->b;
		$this->pos = $pos;
		$this->len = $len;
		$this->totlen = $len;
	}}
	public $b;
	public $pos;
	public $len;
	public $totlen;
	public function readByte() {
		if($this->len === 0) {
			throw new HException(new haxe_io_Eof());
		}
		$this->len--;
		return ord($this->b[$this->pos++]);
	}
	public function readBytes($buf, $pos, $len) {
		if($pos < 0 || $len < 0 || $pos + $len > $buf->length) {
			throw new HException(haxe_io_Error::$OutsideBounds);
		}
		if($this->len === 0 && $len > 0) {
			throw new HException(new haxe_io_Eof());
		}
		if($this->len < $len) {
			$len = $this->len;
		}
		$buf->b = substr($buf->b, 0, $pos) . substr($this->b, $this->pos, $len) . substr($buf->b, $pos+$len);
		$this->pos += $len;
		$this->len -= $len;
		return $len;
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
	function __toString() { return 'haxe.io.BytesInput'; }
}
