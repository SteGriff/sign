<?php

require 'linker.php';

/*
	If the request is GET -> Display the Edit view
	If it's POST -> Make the changes
*/

// GET
if (isset($_GET['code']))
{
	header("Location: /{$_GET['code']}");
	die();
}

// POST
$sign = null;
$missingTerms = null;
$terms = ['code', 'text'];

//Check for all required terms
foreach($terms as $t)
{
	if (!isset($_POST[$t]))
	{
		$missingTerms[] = $t;
	}
}

//400 error if any required term is missing
if (count($missingTerms) > 0)
{
	$missing = join(', ', $missingTerms);
	http_fatal_400("Missing parameters: $missing");
}

//Update sign
$code = $_POST['code'];
$text = $_POST['text'];
$result = dal_update_sign($code, $text);

if ($result === true)
{
	http_200("Sign updated");
}
if ($result === false)
{
	http_fatal_400("No change to sign '$code'");	
}

