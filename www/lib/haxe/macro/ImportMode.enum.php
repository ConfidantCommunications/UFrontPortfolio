<?php

// Generated by Haxe 3.4.4
class haxe_macro_ImportMode extends Enum {
	public static $IAll;
	public static function IAsName($alias) { return new haxe_macro_ImportMode("IAsName", 1, array($alias)); }
	public static $INormal;
	public static $__constructors = array(2 => 'IAll', 1 => 'IAsName', 0 => 'INormal');
	}
haxe_macro_ImportMode::$IAll = new haxe_macro_ImportMode("IAll", 2);
haxe_macro_ImportMode::$INormal = new haxe_macro_ImportMode("INormal", 0);