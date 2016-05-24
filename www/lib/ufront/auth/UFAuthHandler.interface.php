<?php

interface ufront_auth_UFAuthHandler {
	function get_currentUser();
	function isLoggedIn();
	function requireLogin();
	function isLoggedInAs($user);
	function requireLoginAs($user);
	function hasPermission($permission);
	function hasPermissions($permissions);
	function requirePermission($permission);
	function requirePermissions($permissions);
	function toString();
	//;
}
