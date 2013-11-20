<?php

$dataFile = 'data.json';
$arrData = readDataFile();

if (isset($_POST['ajax'])) {
	$ajaxQuery = jsonToArr($_POST['ajax']));

	header('Access-Control-Allow-Origin: *');
	if ($ajaxQuery['method'] == 'add') echo ajaxAdd($ajaxQuery['data']); 
	if ($ajaxQuery['method'] == 'read') echo $arrData;	
} 


function title() {
	echo 'Robots.txt checker';
}

function sitesCol() {

	$dataArr = array();
	$indx = count($dataArr);
	$dataArr[$indx]['site'] = 'Eug';
	$dataArr[$indx]['robourl'] = 'http://robots.txt';
	$dataArr[$indx]['email'] = 'me@mail.ru';	

	// var_dump( addToArr($dataArr[$indx]) );

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

function robotsIsExst($name, $whereArr) {
	foreach ($whereArr as $key => $siteData) {
		if ($siteData['robourl'] == $name) return true;
	}
	return false;
}

function writeData($dataArr) {
	$newArr = addToArr($dataArr);
	saveDataFile(json_encode($newArr));
}

function ajaxAdd($siteAddData) {
	global $arrDatal;

	if (robotsIsExst($siteAddData['robourl'], $arrData)) {
		return 'Robots.txt is already exist.';
	} else {
		writeData($siteData);
		return 'Robots.txt added.'
	}

}

//function ajaxRead() {
//	return false;
//}

?>
