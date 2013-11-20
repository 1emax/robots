<?php

$dataFile = 'data.json';
$arrData = readDataFile();

if (isset($_POST['ajax'])) {
	$ajaxQuery = jsonToArr($_POST['ajax']));
	
	if ($ajaxQuery['method'] == 'add') 
} 
//header('Access-Control-Allow-Origin: *');

function title() {
	echo 'Robots.txt checker';
}

function sitesCol() {

	$dataArr = array();
	$indx = count($dataArr);
	$dataArr[$indx]['site'] = 'Eug';
	$dataArr[$indx]['robourl'] = 'http://robots.txt';
	$dataArr[$indx]['email'] = 'me@mail.ru';	

	var_dump( addToArr($dataArr[$indx]) );

	echo '<br><br>' ;
	var_dump( readDataFile() );
	// saveDataFile(json_encode($dataArr));
}

function findCol() {
	return false;
} 

function saveDataFile($data) {
	global $dataFile;
	$f = fopen($dataFile, 'w');
	fwrite($f, $data);
	fclose($f);
}

function readDataFile() {
	global $dataFile;
	if (!is_readable($dataFile)) return 'Not exist';
	$data = file_get_contents($dataFile);
	return jsonToArr($data);
}

function jsonToArr($str) {
	return json_decode($str);
}

function addToArr($newDataArray) {
	global $arrData;
	$extdArr = $arrData;
	$extdArr[] = $newDataArray;
	return $extdArr;
}

function writeData($dataArr) {
	$newArr = addToArr($dataArr);
	saveDataFile(json_encode($newArr));
}

?>
