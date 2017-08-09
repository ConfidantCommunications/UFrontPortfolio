<?php

// Generated by Haxe 3.4.2
class haxe_Serializer {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->buf = new StringBuf();
		$this->cache = new _hx_array(array());
		$this->useCache = haxe_Serializer::$USE_CACHE;
		$this->useEnumIndex = haxe_Serializer::$USE_ENUM_INDEX;
		$this->shash = new haxe_ds_StringMap();
		$this->scount = 0;
	}}
	public $buf;
	public $cache;
	public $shash;
	public $scount;
	public $useCache;
	public $useEnumIndex;
	public function toString() {
		return $this->buf->b;
	}
	public function serializeString($s) {
		$x = $this->shash->get($s);
		if($x !== null) {
			$this->buf->add("R");
			$this->buf->add($x);
			return;
		}
		$this->shash->set($s, $this->scount++);
		$this->buf->add("y");
		$s = rawurlencode($s);
		$this->buf->add(strlen($s));
		$this->buf->add(":");
		$this->buf->add($s);
	}
	public function serializeRef($v) {
		{
			$_g1 = 0;
			$_g = $this->cache->length;
			while($_g1 < $_g) {
				$_g1 = $_g1 + 1;
				$i = $_g1 - 1;
				if(_hx_equal($this->cache[$i], $v)) {
					$this->buf->add("r");
					$this->buf->add($i);
					return true;
				}
				unset($i);
			}
		}
		$this->cache->push($v);
		return false;
	}
	public function serializeFields($v) {
		{
			$_g = 0;
			$_g1 = Reflect::fields($v);
			while($_g < $_g1->length) {
				$f = $_g1[$_g];
				$_g = $_g + 1;
				$this->serializeString($f);
				$this->serialize(Reflect::field($v, $f));
				unset($f);
			}
		}
		$this->buf->add("g");
	}
	public function serialize($v) {
		$_g = Type::typeof($v);
		switch($_g->index) {
		case 0:{
			$this->buf->add("n");
		}break;
		case 1:{
			$v1 = $v;
			if($v1 === 0) {
				$this->buf->add("z");
				return;
			}
			$this->buf->add("i");
			$this->buf->add($v1);
		}break;
		case 2:{
			$v2 = $v;
			if(Math::isNaN($v2)) {
				$this->buf->add("k");
			} else {
				if(!Math::isFinite($v2)) {
					$tmp = null;
					if($v2 < 0) {
						$tmp = "m";
					} else {
						$tmp = "p";
					}
					$this->buf->add($tmp);
				} else {
					$this->buf->add("d");
					$this->buf->add($v2);
				}
			}
		}break;
		case 3:{
			$tmp1 = null;
			if($v) {
				$tmp1 = "t";
			} else {
				$tmp1 = "f";
			}
			$this->buf->add($tmp1);
		}break;
		case 4:{
			if(Std::is($v, _hx_qtype("Class"))) {
				$className = Type::getClassName($v);
				$this->buf->add("A");
				$this->serializeString($className);
			} else {
				if(Std::is($v, _hx_qtype("Enum"))) {
					$this->buf->add("B");
					$this->serializeString(Type::getEnumName($v));
				} else {
					$tmp2 = null;
					if($this->useCache) {
						$tmp2 = $this->serializeRef($v);
					} else {
						$tmp2 = false;
					}
					if($tmp2) {
						return;
					}
					$this->buf->add("o");
					$this->serializeFields($v);
				}
			}
		}break;
		case 5:{
			throw new HException("Cannot serialize function");
		}break;
		case 6:{
			$c = _hx_deref($_g)->params[0];
			{
				if((is_object($_t = $c) && ($_t instanceof Enum) ? $_t == _hx_qtype("String") : _hx_equal($_t, _hx_qtype("String")))) {
					$this->serializeString($v);
					return;
				}
				$tmp3 = null;
				if($this->useCache) {
					$tmp3 = $this->serializeRef($v);
				} else {
					$tmp3 = false;
				}
				if($tmp3) {
					return;
				}
				switch($c) {
				case _hx_qtype("Array"):{
					$ucount = 0;
					$this->buf->add("a");
					$l = _hx_field($v, "length");
					{
						$_g1 = 0;
						$_g2 = $l;
						while($_g1 < $_g2) {
							$_g1 = $_g1 + 1;
							$i = $_g1 - 1;
							if($v[$i] === null) {
								$ucount = $ucount + 1;
							} else {
								if($ucount > 0) {
									if($ucount === 1) {
										$this->buf->add("n");
									} else {
										$this->buf->add("u");
										$this->buf->add($ucount);
									}
									$ucount = 0;
								}
								$this->serialize($v[$i]);
							}
							unset($i);
						}
					}
					if($ucount > 0) {
						if($ucount === 1) {
							$this->buf->add("n");
						} else {
							$this->buf->add("u");
							$this->buf->add($ucount);
						}
					}
					$this->buf->add("h");
				}break;
				case _hx_qtype("Date"):{
					$d = $v;
					$this->buf->add("v");
					$tmp4 = $this->buf;
					$tmp4->add($d->getTime());
				}break;
				case _hx_qtype("List"):{
					$this->buf->add("l");
					$v3 = $v;
					{
						$i1 = $v3->iterator();
						while($i1->hasNext()) {
							$i2 = $i1->next();
							$this->serialize($i2);
							unset($i2);
						}
					}
					$this->buf->add("h");
				}break;
				case _hx_qtype("haxe.ds.IntMap"):{
					$this->buf->add("q");
					$v4 = $v;
					{
						$k = $v4->keys();
						while($k->hasNext()) {
							$k1 = $k->next();
							$this->buf->add(":");
							$this->buf->add($k1);
							$this->serialize($v4->get($k1));
							unset($k1);
						}
					}
					$this->buf->add("h");
				}break;
				case _hx_qtype("haxe.ds.ObjectMap"):{
					$this->buf->add("M");
					$v5 = $v;
					{
						$k2 = new _hx_array_iterator(array_values($v5->hk));
						while($k2->hasNext()) {
							$k3 = $k2->next();
							$this->serialize($k3);
							$this->serialize($v5->get($k3));
							unset($k3);
						}
					}
					$this->buf->add("h");
				}break;
				case _hx_qtype("haxe.ds.StringMap"):{
					$this->buf->add("b");
					$v6 = $v;
					{
						$k4 = $v6->keys();
						while($k4->hasNext()) {
							$k5 = $k4->next();
							$this->serializeString($k5);
							$this->serialize($v6->get($k5));
							unset($k5);
						}
					}
					$this->buf->add("h");
				}break;
				case _hx_qtype("haxe.io.Bytes"):{
					$v7 = $v;
					$this->buf->add("s");
					$tmp5 = $this->buf;
					$tmp5->add(Math::ceil($v7->length * 8 / 6));
					$this->buf->add(":");
					$i3 = 0;
					$max = $v7->length - 2;
					$b64 = haxe_Serializer::$BASE64_CODES;
					if($b64 === null) {
						$this1 = (new _hx_array(array()));
						$this1->length = strlen(haxe_Serializer::$BASE64);
						$b64 = $this1;
						{
							$_g11 = 0;
							$_g3 = strlen(haxe_Serializer::$BASE64);
							while($_g11 < $_g3) {
								$_g11 = $_g11 + 1;
								$i4 = $_g11 - 1;
								$b64[$i4] = _hx_char_code_at(haxe_Serializer::$BASE64, $i4);
								unset($i4);
							}
						}
						haxe_Serializer::$BASE64_CODES = $b64;
					}
					while($i3 < $max) {
						$i3 = $i3 + 1;
						$pos = $i3 - 1;
						$this2 = $v7->b;
						$b1 = ord($this2->s[$pos]);
						$i3 = $i3 + 1;
						$pos1 = $i3 - 1;
						$this3 = $v7->b;
						$b2 = ord($this3->s[$pos1]);
						$i3 = $i3 + 1;
						$pos2 = $i3 - 1;
						$this4 = $v7->b;
						$b3 = ord($this4->s[$pos2]);
						{
							$_this = $this->buf;
							$_this->b = _hx_string_or_null($_this->b) . _hx_string_or_null(chr($b64[$b1 >> 2]));
							unset($_this);
						}
						{
							$_this1 = $this->buf;
							$_this1->b = _hx_string_or_null($_this1->b) . _hx_string_or_null(chr($b64[($b1 << 4 | $b2 >> 4) & 63]));
							unset($_this1);
						}
						{
							$_this2 = $this->buf;
							$_this2->b = _hx_string_or_null($_this2->b) . _hx_string_or_null(chr($b64[($b2 << 2 | $b3 >> 6) & 63]));
							unset($_this2);
						}
						{
							$_this3 = $this->buf;
							$_this3->b = _hx_string_or_null($_this3->b) . _hx_string_or_null(chr($b64[$b3 & 63]));
							unset($_this3);
						}
						unset($this4,$this3,$this2,$pos2,$pos1,$pos,$b3,$b2,$b1);
					}
					if($i3 === $max) {
						$i3 = $i3 + 1;
						$pos3 = $i3 - 1;
						$this5 = $v7->b;
						$b11 = ord($this5->s[$pos3]);
						$i3 = $i3 + 1;
						$pos4 = $i3 - 1;
						$this6 = $v7->b;
						$b21 = ord($this6->s[$pos4]);
						{
							$_this4 = $this->buf;
							$_this4->b = _hx_string_or_null($_this4->b) . _hx_string_or_null(chr($b64[$b11 >> 2]));
						}
						{
							$_this5 = $this->buf;
							$_this5->b = _hx_string_or_null($_this5->b) . _hx_string_or_null(chr($b64[($b11 << 4 | $b21 >> 4) & 63]));
						}
						{
							$_this6 = $this->buf;
							$_this6->b = _hx_string_or_null($_this6->b) . _hx_string_or_null(chr($b64[$b21 << 2 & 63]));
						}
					} else {
						if($i3 === $max + 1) {
							$i3 = $i3 + 1;
							$pos5 = $i3 - 1;
							$this7 = $v7->b;
							$b12 = ord($this7->s[$pos5]);
							{
								$_this7 = $this->buf;
								$_this7->b = _hx_string_or_null($_this7->b) . _hx_string_or_null(chr($b64[$b12 >> 2]));
							}
							{
								$_this8 = $this->buf;
								$_this8->b = _hx_string_or_null($_this8->b) . _hx_string_or_null(chr($b64[$b12 << 4 & 63]));
							}
						}
					}
				}break;
				default:{
					if($this->useCache) {
						$this->cache->pop();
					}
					if(_hx_field($v, "hxSerialize") !== null) {
						$this->buf->add("C");
						$this->serializeString(Type::getClassName($c));
						if($this->useCache) {
							$this->cache->push($v);
						}
						$v->hxSerialize($this);
						$this->buf->add("g");
					} else {
						$this->buf->add("c");
						$this->serializeString(Type::getClassName($c));
						if($this->useCache) {
							$this->cache->push($v);
						}
						$this->serializeFields($v);
					}
				}break;
				}
			}
		}break;
		case 7:{
			$e = _hx_deref($_g)->params[0];
			{
				if($this->useCache) {
					if($this->serializeRef($v)) {
						return;
					}
					$this->cache->pop();
				}
				$tmp6 = null;
				if($this->useEnumIndex) {
					$tmp6 = "j";
				} else {
					$tmp6 = "w";
				}
				$this->buf->add($tmp6);
				$this->serializeString(Type::getEnumName($e));
				if($this->useEnumIndex) {
					$this->buf->add(":");
					$this->buf->add(_hx_field($v, "index"));
				} else {
					$this->serializeString(_hx_field($v, "tag"));
				}
				$this->buf->add(":");
				$l1 = count(_hx_field($v, "params"));
				$tmp7 = null;
				if($l1 !== 0) {
					$tmp7 = _hx_field($v, "params") === null;
				} else {
					$tmp7 = true;
				}
				if($tmp7) {
					$this->buf->add(0);
				} else {
					$this->buf->add($l1);
					{
						$_g12 = 0;
						$_g4 = $l1;
						while($_g12 < $_g4) {
							$_g12 = $_g12 + 1;
							$i5 = $_g12 - 1;
							$this->serialize($v->params[$i5]);
							unset($i5);
						}
					}
				}
				if($this->useCache) {
					$this->cache->push($v);
				}
			}
		}break;
		default:{
			throw new HException("Cannot serialize " . Std::string($v));
		}break;
		}
	}
	public function serializeException($e) {
		$this->buf->add("x");
		$this->serialize($e);
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
	static $USE_CACHE = false;
	static $USE_ENUM_INDEX = false;
	static $BASE64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789%:";
	static $BASE64_CODES = null;
	static function run($v) {
		$s = new haxe_Serializer();
		$s->serialize($v);
		return $s->toString();
	}
	function __toString() { return $this->toString(); }
}
