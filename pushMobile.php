<?
session_start();
ini_set('display_errors', '1');
include('functions.php');

$string=':{U+1F406}: The energy of an electric eel. :{U+1F406}:';
if (!$string) {
	$jsonRow = array("error"=>true, "message"=>"Nothing to convert!");
	echo json_encode($jsonRow, JSON_PRETTY_PRINT);
	die();
}
$passcode = "";
$cutoff=0;
$passcode = get_string_between($string,":{","}:") ;
while ($passcode) {
	$passcode = str_replace("U ","U+",$passcode);
	$string=pullEmoji($passcode, $string, $mysqli);
	$passcode = get_string_between($string,":{","}:") ;
	$cutoff++;
	if ($cutoff>=10) {
		$passcode = '';
	}
}

$jsonRow = array("error"=>false, "message"=>$string);
echo json_encode($jsonRow, JSON_PRETTY_PRINT);
?>
