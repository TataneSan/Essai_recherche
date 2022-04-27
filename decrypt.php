<?php

require_once "config/configuration.php";
require_once "config/functions.php";

function decrypt()
{
	$hash = $_POST['hash'];
	
	if( strlen($hash) < 32 || strstr($hash, "'") || strstr($hash, "|") || strstr($hash, "\\") || strstr($hash, "#") || strstr($hash, "&") || strstr($hash,"%") || strstr($hash, "=") || strstr($hash, "$") || strstr($hash, "FROM") || strstr($hash, "LIKE") || strstr($hash, "order") || strstr($hash, "ORDER") || strstr($hash, "BY") || strstr($hash, "by") || strstr($hash, ";") || strstr($hash, ")") || strstr($hash, "*") || strstr($hash, "+") || strstr($hash, "/") || strstr($hash, "{") || strstr($hash, "}") || strstr($hash, ">") || strstr($hash, "<") || strstr($hash, '"') || strstr($hash, "!") || strstr($hash, "^") || strstr($hash, "[") || strstr($hash, "]") || strstr($hash, "{") || strstr($hash, ",") || strstr($hash, "£") || strstr($hash, "´") || strstr($hash, "`") || strstr($hash, "~") || strstr($hash, "«") || strstr($hash, "»") || strstr($hash, "¯")) {
		return 0;
	}
	$api = "https://bluecode.info/md5api/?key=EG7nTsrAkRARebhNa63RTahrbFeHr7Yy1ez5ibBGdk34r73hHnNdhyZAHYFkF4Td&login=mineleaks&q=" . $hash;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api);
    curl_setopt($ch, CURLOPT_NOSIGNAL, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $result = curl_exec($ch);
    curl_close($ch);

    if(strlen($result) > 28) {
		$password = explode("\"", $result)[5];
		echo $password;
    }
    else {
        return 0;
    }
}

decrypt()


?>