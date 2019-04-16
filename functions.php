<?php
ini_set('display_errors', '1'); 
error_reporting(E_ALL  & ~E_NOTICE & ~E_USER_NOTICE);

$db_host="localhost";
$db_login="YOURUSERNAME";
$db_pswd="YOURPASSWORD";
$db_name="YOURDATABASE";

if (!$mysq_lib_loaded) {
	$mysqli = mysqli_init();
	@$mysqli->real_connect($db_host, $db_login, $db_pswd, $db_name);
	if ($mysqli->connect_errno) {
		die( "<i>Failed to connect to MySQL Database: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error . "</i>");
	}
	$mysq_lib_loaded=1;
}

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

function str_replace_first($from, $to, $content) {
    $from = '/'.preg_quote($from, '/').'/';
    return preg_replace($from, $to, $content, 1);
}

function replace_between($str, $needle_start, $needle_end, $replacement) {
    $pos = strpos($str, $needle_start);
    $start = $pos === false ? 0 : $pos + strlen($needle_start);
    $pos = strpos($str, $needle_end, $start);
    $end = $pos === false ? strlen($str) : $pos;
    return substr_replace($str, $replacement, $start , $end - $start );
}

function pullEmoji($pullstring, $thismsg, $mysqli, $etarget="MOBILE") {
	$sql="SELECT `browser`, `data` FROM `tbl_emojidata` WHERE `code`='$pullstring'";
	$mysqli->set_charset("utf8mb4");
	$rr=$mysqli->query($sql);
	$found=$rr->num_rows;
	if ($found) {
		$pp=$rr->fetch_assoc();
		$browser=$pp['browser'];
		$data=$pp['data'];
		if ($etarget=="DESKTOP") {
			$browser='<img src="' . $data . '">';
		}
		$stringout =  replace_between($thismsg,":{","}:",$browser);
		$stringout=str_replace_first(":{","",$stringout);
		$stringout=str_replace_first("}:","",$stringout);
	} else {
		$stringout =  $thismsg;
	}
	return $stringout;
}

?>
