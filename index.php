<?php

$dataFile = 'data.json';

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
	return strToJSON($data);
}

function strToJSON($str) {
	return json_decode($str);
}

function addToArr($newDataArray) {
	$extdArr = readDataFile();
	$extdArr[] = $newDataArray;
	return $extdArr;
}

?>
