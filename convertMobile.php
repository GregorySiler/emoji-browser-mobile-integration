<?
session_start();
ini_set('display_errors', '1');
include('functions.php');

$string='😄 The energy of an electric eel. 😄';
if (!$string) {
	$jsonRow = array("error"=>true, "message"=>'No string to convert!');
	echo json_encode($jsonRow, JSON_PRETTY_PRINT);
	die();
}

$string = json_encode($string);

$sql="SELECT `browser`, `code`,`id` FROM `tbl_emojidata` ORDER BY `bhlen` DESC";
$mysqli->set_charset("utf8mb4");
$rr=$mysqli->query($sql);
$emojicount=$rr->num_rows;
$fcode='';
$emojifound=0;
while ($pp=$rr->fetch_assoc()) {
	$id=$pp['id'];
	$compare=$pp['browser'];
	$compare=json_encode($compare);
	$compare=str_replace('"','',$compare);
	if (strpos($string,$compare)!==false) {
		$fcode=":{" . $pp['code'] . "}:";
		$string=str_replace($compare,$fcode,$string);
		$emojifound++;
	}
	$fcode='';
}
$string=json_decode($string);
$jsonRow = array("error"=>false, "message"=>$string, "searched"=>$emojicount, "replaced"=>$emojifound);
echo json_encode($jsonRow, JSON_PRETTY_PRINT);
?>
