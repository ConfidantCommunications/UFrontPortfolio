<?php

// Generated by Haxe 3.4.4
class tink_io_Pipe {
	public function __construct($source, $dest, $bufferWidth = null, $autoClose = null, $onDone) {
		if(!isset($this->releaseBuffer)) $this->releaseBuffer = array(new _hx_lambda(array(&$this), "tink_io_Pipe_0"), 'execute');
		if(!php_Boot::$skip_constructor) {
		if($autoClose === null) {
			$autoClose = false;
		}
		$tmp = null;
		if($bufferWidth !== null) {
			$tmp = $bufferWidth;
		} else {
			$tmp = 15;
		}
		$this->bufferWidth = $tmp;
		$this->autoClose = $autoClose;
		$this->source = $source;
		$this->dest = $dest;
		$this->onDone = $onDone;
	}}
	public $buffer;
	public $source;
	public $dest;
	public $onDone;
	public $autoClose;
	public $bufferWidth;
	public function terminate($s) {
		$this->onDone($this->buffer, $s);
		$this->releaseBuffer();
	}
	public function releaseBuffer() { return call_user_func($this->releaseBuffer); }
	public $releaseBuffer = null;
	public function suspend() {
		if($this->bufferWidth > 0) {
			$_g = tink_io_Pipe::$suspended->pop();
			if($_g === null) {
				$this->read();
			} else {
				$next = $_g;
				{
					$this->releaseBuffer();
					tink_io_Pipe::$suspended->add($this);
					$next->resume();
				}
			}
		} else {
			$this->read();
		}
	}
	public function resume() {
		if($this->buffer === null) {
			$this->buffer = tink_io_Buffer::alloc($this->bufferWidth);
			$this->releaseBuffer = $this->buffer->retain();
		}
		$this->read();
	}
	public function read() {
		$_gthis = $this;
		$tmp = $this->source->read($this->buffer, 1073741824);
		$tmp->handle(array(new _hx_lambda(array(&$_gthis), "tink_io_Pipe_1"), 'execute'));
	}
	public function flush($repeat = null) {
		if($repeat === null) {
			$repeat = 1;
		}
		$_gthis = $this;
		$tmp = null;
		if(!$this->buffer->writable) {
			$tmp = !$this->autoClose;
		} else {
			$tmp = true;
		}
		if($tmp) {
			$this->dest->write($this->buffer)->handle(array(new _hx_lambda(array(&$_gthis, &$repeat), "tink_io_Pipe_2"), 'execute'));
		} else {
			$this->dest->finish($this->buffer)->handle(array(new _hx_lambda(array(&$_gthis), "tink_io_Pipe_3"), 'execute'));
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
	static $suspended;
	static function make($from, $to, $bufferWidth = null, $options = null, $cb) {
		$tmp = null;
		if($options !== null) {
			$tmp = $options->end;
		} else {
			$tmp = false;
		}
		_hx_deref(new tink_io_Pipe($from, $to, $bufferWidth, $tmp, array(new _hx_lambda(array(&$cb), "tink_io_Pipe_4"), 'execute')))->resume();
	}
	function __toString() { return 'tink.io.Pipe'; }
}
tink_io_Pipe::$suspended = new HList();
function tink_io_Pipe_0(&$__hx__this) {
	{
	}
}
function tink_io_Pipe_1(&$_gthis, $o) {
	{
		switch($o->index) {
		case 0:{
			$_hx_tmp = _hx_deref($o)->params[0] < 0;
			if($_hx_tmp === true) {
				$_gthis->source->close();
				$_gthis->buffer->seal();
				$_gthis->flush(null);
			} else {
				$v = _hx_deref($o)->params[0];
				$tmp1 = null;
				if($v === 0) {
					$tmp1 = $_gthis->buffer->available === 0;
				} else {
					$tmp1 = false;
				}
				if($tmp1) {
					$_gthis->suspend();
				} else {
					$_gthis->flush(null);
				}
			}
		}break;
		case 1:{
			$e = _hx_deref($o)->params[0];
			$_gthis->terminate(tink_io_PipeResult::SourceFailed($e));
		}break;
		}
	}
}
function tink_io_Pipe_2(&$_gthis, &$repeat, $o) {
	{
		switch($o->index) {
		case 0:{
			$_hx_tmp = _hx_deref($o)->params[0] < 0;
			if($_hx_tmp === true) {
				$tmp1 = null;
				if($_gthis->buffer->available > 0) {
					$tmp1 = tink_io_PipeResult::$SinkEnded;
				} else {
					$tmp1 = tink_io_PipeResult::$AllWritten;
				}
				$_gthis->terminate($tmp1);
			} else {
				$v = _hx_deref($o)->params[0];
				if($repeat > 0) {
					$tmp2 = null;
					if($v === 0) {
						$tmp2 = 1;
					} else {
						$tmp2 = 0;
					}
					$_gthis->flush($repeat - $tmp2);
				} else {
					if($_gthis->buffer->writable) {
						$_gthis->read();
					} else {
						$_gthis->flush(null);
					}
				}
			}
		}break;
		case 1:{
			$f = _hx_deref($o)->params[0];
			{
				$_gthis->source->close();
				$_gthis->terminate(tink_io_PipeResult::SinkFailed($f));
			}
		}break;
		}
	}
}
function tink_io_Pipe_3(&$_gthis, $o1) {
	{
		switch($o1->index) {
		case 0:{
			$tmp3 = null;
			if($_gthis->buffer->available > 0) {
				$tmp3 = tink_io_PipeResult::$SinkEnded;
			} else {
				$tmp3 = tink_io_PipeResult::$AllWritten;
			}
			$_gthis->terminate($tmp3);
		}break;
		case 1:{
			$f1 = _hx_deref($o1)->params[0];
			$_gthis->terminate(tink_io_PipeResult::SinkFailed($f1));
		}break;
		}
	}
}
function tink_io_Pipe_4(&$cb, $buf, $res) {
	{
		call_user_func_array($cb, array($buf, $res));
	}
}