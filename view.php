<?php

require 'linker.php';

header("content-type: text/plain");

$sign = null;
$getter = null;

if (isset($_GET['id']))
{
	$id = $_GET['id'];
	$sign = dal_sign($id);
	$getter = ['type' => 'id', 'data' => $id];
}
elseif (isset($_GET['code']))
{
	$code = $_GET['code'];
	$sign = dal_sign_from_code($code);
	$getter = ['type' => 'code', 'data' => $code];
}
else
{
	http_fatal_400('Provide id or code');
}

if ($sign !== false)
{
	echo $sign->Text;
}
else
{
	http_fatal_400("No sign with {$getter['type']} '{$getter['data']}'");	
}