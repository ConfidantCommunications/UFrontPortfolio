<?php

class ufront_view_FileViewEngine extends ufront_view_UFViewEngine {
	public function __construct($cachingEnabled = null) {
		if(!php_Boot::$skip_constructor) {
		parent::__construct($cachingEnabled);
	}}
	public $scriptDir;
	public $path;
	public $isPathAbsolute;
	public function get_isPathAbsolute() {
		return StringTools::startsWith($this->path, "/");
	}
	public $viewDirectory;
	public function get_viewDirectory() {
		if($this->get_isPathAbsolute()) {
			return haxe_io_Path::addTrailingSlash($this->path);
		} else {
			return _hx_string_or_null(haxe_io_Path::addTrailingSlash($this->scriptDir)) . _hx_string_or_null(haxe_io_Path::addTrailingSlash($this->path));
		}
	}
	public function getTemplateString($viewRelativePath) {
		$fullPath = _hx_string_or_null($this->get_viewDirectory()) . _hx_string_or_null($viewRelativePath);
		try {
			if(file_exists($fullPath)) {
				return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Success(haxe_ds_Option::Some(sys_io_File::getContent($fullPath))));
			} else {
				return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Success(haxe_ds_Option::$None));
			}
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			$e = $_ex_;
			{
				return $e->asSurpriseError("Failed to load template " . _hx_string_or_null($viewRelativePath));
			}
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
	static function __meta__() { $args = func_get_args(); return call_user_func_array(self::$__meta__, $args); }
	static $__meta__;
	static $__properties__ = array("get_viewDirectory" => "get_viewDirectory","get_isPathAbsolute" => "get_isPathAbsolute");
	function __toString() { return 'ufront.view.FileViewEngine'; }
}
ufront_view_FileViewEngine::$__meta__ = _hx_anonymous(array("obj" => _hx_anonymous(array("rtti" => (new _hx_array(array((new _hx_array(array("scriptDir", "String", "scriptDirectory"))), (new _hx_array(array("path", "String", "viewPath"))))))))));
