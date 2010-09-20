<?php

//function to get IP address via client ip or x
//forwarded first before falling back on remote addr
function getRealIpAddr() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {  //check ip from share internet
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  //to check ip is pass from proxy
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

//function to check if a user is a
//super admin of the GO application
function isSuperAdmin() {
	//this var is not passed to this function, use the global
	global $goAdmin;
	//if the current user is logged in, check it they are in the admin array
	if(isset($_SESSION["AUTH"]) && in_array($_SESSION["AUTH"]->getId(), $goAdmin)) {
		return true;
	} else {
		return false;
	}
}

// This is copy pasted function to get URL from current page 
function curPageURL() {
	$isHTTPS = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on");
	$port = (isset($_SERVER["SERVER_PORT"]) && ((!$isHTTPS && $_SERVER["SERVER_PORT"] != "80") || ($isHTTPS && $_SERVER["SERVER_PORT"] != "443")));
	$port = ($port) ? ':'.$_SERVER["SERVER_PORT"] : '';
	$url = ($isHTTPS ? 'https://' : 'http://').$_SERVER["SERVER_NAME"].$port.$_SERVER["REQUEST_URI"];
	return $url;
}