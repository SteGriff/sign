<?php

require 'linker.php';

header("content-type: text/plain");

if (isset($_POST['text']))
{
	$text = $_POST['text'];
	$signData = dal_create_sign($text);

	header("Location: /{$signData['code']}/");
}
else
{
	http_fatal_400("Can't create, no text supplied");
}
