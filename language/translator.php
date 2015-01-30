<?php
define('IN_PHPBB', true);
$d = dir("en");
$en_files = array();
while (false !== ($entry = $d->read())) {
   switch ($entry){
	   case ".":
	   case "..":
	   case "acp":
	   case "email":
	   case "iso.txt":
	   case "index.htm":
		   break;
	   default:
		   $en_files[] = $entry;
   }
}
$d->close();

$d = dir("lt");
$lt_files = array();
while (false !== ($entry = $d->read())) {
   switch ($entry){
	   case ".":
	   case "..":
	   case "acp":
	   case "email":
	   case "iso.txt":
	   case "index.htm":
	   case "LICENSE":
	   case "mods":
		   break;
	   default:
		   $lt_files[] = $entry;
   }
}
$d->close();

$lang = array();
foreach($en_files as $file) {
	include("en/".$file);
}
$en_lang = $lang;

$lang = array();
foreach($lt_files as $file) {
	include("lt/".$file);
}
$lt_lang = $lang;

$untranslated = array();
foreach($en_lang as $k=>$v){
	if (!isset($lt_lang[$k])){
		$untranslated[] = array($k, $v);
	}
}
$list = $untranslated;

$fp = fopen('file.csv', 'w');
foreach ($list as $fields) {
    fputcsv($fp, $fields);
}
fclose($fp);
?>