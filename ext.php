<?php

function http_fatal_400($msg){
	header("HTTP/1.1 400 Bad Request [$msg]");
	die();
}
function http_fatal_500($msg){
	header("HTTP/1.1 500 Server fail [$msg]");
	die();
}
function http_fatal_501($msg){
	header("HTTP/1.1 501 Impossible [$msg]");
	die();
}

function http_200($msg){
	echo $msg;
	header("HTTP/1.1 200 OK [$msg]");
	die();
}
function http_201($type, $id){
	header("HTTP/1.1 201 Created [$type $id]");
	echo $id;
	die();
}

function json($o){
	header("content-type: application/json");
	die(json_encode($o));
}

function is_number($input){
    return(ctype_digit(strval($input)));
}

// Return the favoured content type in simple form, 
// 'html', 'json', or false if no acceptable types
function response_type($request){
	$accepts = parse_accept_header($request->header("Accept"));

	foreach ($accepts as $a){
		$recognised = type_recognised($a);
		if ($recognised !== false){
			return $recognised;
		}
	}
	return false;
}

//Return an array of Accept types by preference
function parse_accept_header($header) {
	$accept = array();
	foreach (preg_split('/\s*,\s*/', $header) as $i => $term) {
		$o = new \stdclass;
		$o->pos = $i;
		if (preg_match(",^(\S+)\s*;\s*(?:q|level)=([0-9\.]+),i", $term, $M)) {
			$o->type = $M[1];
			$o->q = (double)$M[2];
		} else {
			$o->type = $term;
			$o->q = 1;
		}
		$accept[] = $o;
	} 
	usort($accept, function ($a, $b) {
		/* first tier: highest q factor wins */
		$diff = $b->q - $a->q;
		if ($diff > 0) { 
			$diff = 1;
		} else if ($diff < 0) {
			$diff = -1;
		} else {
			/* tie-breaker: first listed item wins */
			$diff = $a->pos - $b->pos;
		}
		return $diff;
	});
	$result = array();
	for ($i = 0; $i < count($accept); $i++){
		$result[$i] = $accept[$i]->type;
	}

	return $result;
}

// Return a simplified form of a recognised content type:
// 'html', 'json', or false for no match
function type_recognised($type){
	switch ($type){
		case "text/html":
		case "application/xhtml+xml":
		case "application/xml":
			return "html";
			break;
		case "application/json":
			return "json";
			break;	
		default:
			return false;
			break;
	}
}
