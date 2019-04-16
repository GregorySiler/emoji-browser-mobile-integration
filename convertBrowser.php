<?
session_start();
ini_set('display_errors', '1');
include('functions.php');

$string='<img id="U+1F604" src="1f604.png"> The energy of an electric eel. <img src="1f604.png">';
if (!$string) {
	$jsonRow = array("error"=>true, "message"=>"Nothing to convert!");
	echo json_encode($jsonRow, JSON_PRETTY_PRINT);
	die();
}

$dom = new DOMDocument;
@$dom->loadHTML($string);
$images = $dom->getElementsByTagName('img');
foreach ($images as $image) {
	$codex=$image->getAttribute('id');
    $frag = $dom->createDocumentFragment(); 
    $frag->appendXML(':{' . $codex . '}:');
	$image->parentNode->insertBefore($frag,$image);
}

$string = $dom->saveHTML();
$outstring=strip_tags(trim($string));
$outstring=str_replace("\n","",$outstring);
$jsonRow = array("error"=>false, "message"=>$outstring);
echo json_encode($jsonRow, JSON_PRETTY_PRINT);
?>
