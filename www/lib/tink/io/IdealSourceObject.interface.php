<?php

// Generated by Haxe 3.4.4
interface tink_io_IdealSourceObject extends tink_io_SourceObject{
	function allSafely();
	function pipeSafelyTo($dest, $options = null);
	function readSafely($into, $max = null);
	function closeSafely();
}
