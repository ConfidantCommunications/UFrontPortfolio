<?php

// Generated by Haxe 3.4.4
class haxe_macro_TypeDefKind extends Enum {
	public static function TDAbstract($tthis, $from = null, $to = null) { return new haxe_macro_TypeDefKind("TDAbstract", 4, array($tthis, $from, $to)); }
	public static function TDAlias($t) { return new haxe_macro_TypeDefKind("TDAlias", 3, array($t)); }
	public static function TDClass($superClass = null, $interfaces = null, $isInterface = null) { return new haxe_macro_TypeDefKind("TDClass", 2, array($superClass, $interfaces, $isInterface)); }
	public static $TDEnum;
	public static $TDStructure;
	public static $__constructors = array(4 => 'TDAbstract', 3 => 'TDAlias', 2 => 'TDClass', 0 => 'TDEnum', 1 => 'TDStructure');
	}
haxe_macro_TypeDefKind::$TDEnum = new haxe_macro_TypeDefKind("TDEnum", 0);
haxe_macro_TypeDefKind::$TDStructure = new haxe_macro_TypeDefKind("TDStructure", 1);