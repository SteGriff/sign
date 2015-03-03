<?php
// DAL Extensions
// ----- Converters with anti-injection --------------------

function sqlBool($b, $db){
	$b = $db->real_escape_string($b);
	if ($b) return '1';
	else return '0';
}

function sqlText($s, $db){
	//Allow a set of characters in signs, including:
	// @ ! : _ - = + ? . , ' # / [ ] ( )
	$result = preg_replace("/[^a-zA-Z0-9@!: \[\]\(\)_\-\=\+\?\.\,\'\#\/]+/", "", $s);
	return trim($db->real_escape_string($result));
}
	
function sqlCode($s, $db){
	//Allow only alphanum and hyphen - in codes
	$result = preg_replace("/[^a-zA-Z0-9\-]+/", "", $s);
	return trim($db->real_escape_string($result));
}

function sqlInt($i, $db){
	return $db->real_escape_string((int)$i);
}

