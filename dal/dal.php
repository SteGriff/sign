<?php

function db(){
	//Connect to db using MySQLi
	$sv = "db425111171.db.1and1.com";
	$un = "dbo425111171";
	$conn = new mysqli($sv, $un, "PASSWORD", "db425111171");
	if ($conn->connect_error) die("Could not connect to database: " . $conn->connect_error);
	return $conn;
}

$db = db();
$signs = 'sign_signs';
$SQL_db_now = 'CONVERT_TZ(NOW(),\'+01:00\',\'+00:00\')'; //My server is in Germany

require 'dal_ext.php';
require 'signs_dal.php';
require 'corpus.php';

function generateCode()
{
	global $corpus;
	
	$code = '';
	$valid = false;
	
	while(!$valid)
	{
		$code = '';
		
		//Generate a code of 'three-words-and-1' number like that
		for ($i = 0; $i < 3; $i++)
		{
			$code .= $corpus[array_rand($corpus)] . '-';
		}

		$code .= rand(0,9);

		//It's valid if it is NOT found in DB already
		$valid = (dal_sign_from_code($code) === false);
	}
	
	return $code;
}
