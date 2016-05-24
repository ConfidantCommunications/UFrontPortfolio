<?php

interface ufront_auth_UFAuthUser {
	function get_userID();
	function can($permission = null, $permissions = null);
	//;
	//;
}
