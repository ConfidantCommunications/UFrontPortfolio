<?php

// Generated by Haxe 3.4.4
interface tink_io_SourceObject {
	function read($into, $max = null);
	function close();
	function all();
	function prepend($other);
	function append($other);
	function pipeTo($dest, $options = null);
	function idealize($onError);
	function parse($parser);
	function parseWhile($parser, $cond);
	function parseStream($parser, $rest = null);
	function split($delim);
}
