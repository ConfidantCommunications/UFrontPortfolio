<?php

// Generated by Haxe 3.4.4
class haxe_ds_Either extends Enum {
	public static function Left($v) { return new haxe_ds_Either("Left", 0, array($v)); }
	public static function Right($v) { return new haxe_ds_Either("Right", 1, array($v)); }
	public static $__constructors = array(0 => 'Left', 1 => 'Right');
	}
