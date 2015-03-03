<?php

function dal_sign($id)
{
	global $db, $signs;
	$r = $db->query("select * from $signs where id = $id");
	switch ($r->num_rows){
		case 1:
			$sign = $r->fetch_object();
			return $sign;
		default:
			return false;
	}
}

function dal_sign_from_code($code)
{
	global $db, $signs;
	$code = sqlCode($code, $db);
	$sql = "select * from $signs where Code = '$code'";
	$r = $db->query($sql);
	switch ($r->num_rows){
		case 1:
			$sign = $r->fetch_object();
			return $sign;
		default:
			return false;
	}
}

function dal_create_sign($text)
{
	global $db, $signs, $SQL_db_now;
	$text = sqlText($text, $db);
	$code = generateCode();
	$ip = $_SERVER['REMOTE_ADDR'];
	$sql = "insert into $signs (Text, Code, Added, IP) values ('$text', '$code', $SQL_db_now, '$ip')";

	$r = $db->query($sql);
	if ($r){
		return [
			"id" => $db->insert_id,
			"code" => $code
		];
	}
	return false;
}

function dal_update_sign($code, $text)
{
	global $db, $signs;
	$text = sqlText($text, $db);
	$code = sqlCode($code, $db);
	$sql = "update $signs set Text='$text' where code='$code'";

	$r = $db->query($sql);
	if ($r && $db->affected_rows > 0){
		return true;
	}
	return false;
}