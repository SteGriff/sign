<?php

require 'linker.php';

const SITE_ROOT = '/';
const INDEX = 'index.htm';

$sign = false;
$error = false;

//Get the requested blog post title from the URI:
// The entirety of the URL after BLOG_ROOT is found
// http://blog.com/upblog/NewSchool -> NewSchool
function requested_thing(){

	$request = $_SERVER['REQUEST_URI'];
	$pageNamePosition = strpos($request, SITE_ROOT) + strlen(SITE_ROOT);
	$pageName = substr($request, $pageNamePosition);
	
	//If no request then return configured index page post
	return $pageName ?: INDEX;
}

//Handle routing data and display a sign view/edit page.
//	sign.me.uk/{ID}		View sign with ID
//	sign.me.uk/{Code}	Edit sign with Code
// Returns false if there was no matching sign
function dispatch()
{
	$req = requested_thing();
	global $sign, $error;

	//Go to index page if no real request
	if ($req == null || $req == '' || $req == 'index.htm')
	{
		return false;
	}
	
	//Return "graphics" (css and images) verbatim
	if (stripos($req, '/gfx/') !== false)
	{
		echo file_get_contents($req);
		return true;
	}
	
	$req = str_replace('/', '', $req);
	
	if (is_number($req))
	{
		$sign = dal_sign($req);
		if ($sign === false)
		{
			//Go to index page with error
			$error = "Sign #$req doesn't exist";
			return false;
		}
		require 'view/view.php';
		return true;
	}
	else
	{
		$sign = dal_sign_from_code($req);
		if ($sign === false)
		{	
			//Go to index page with error
			$error = "$req is not a passcode";
			return false;
		}
		require 'view/edit.php';
		return true;
	}
	
	return false;
}

$signFound = dispatch();

//var_dump($signFound);

if (!$signFound)
{
	//Default to the index page
	require 'view/index.php';
}

?>