<?php

$dataFile = 'list.json';
$arrData = readDataFile($dataFile) ? readDataFile($dataFile) : makeNewFile($dataFile);

if (isset($_POST['ajax'])) {
	$ajaxQuery = jsonToArr($_POST['ajax']);

	header('Access-Control-Allow-Origin: *');
	if ($ajaxQuery['method'] == 'add') echo ajaxAdd($ajaxQuery['data'], $dataFile); 
	if ($ajaxQuery['method'] == 'read') echo $arrData;	
} 


function title() {
	echo 'Robots.txt checker';
}

function sitesCol() {
	global $dataFile;

	$dataArr = array();
	$indx = count($dataArr);
	$dataArr[$indx]['site'] = 'Eug';
	$dataArr[$indx]['robourl'] = 'http://robots.txt';
	$dataArr[$indx]['email'] = 'me@mail.ru';	

	// var_dump( addToArr($dataArr[$indx]) );

	echo '<br><br>' ;
	var_dump( readDataFile($dataFile) );
	// saveDataFile(json_encode($dataArr), $dataFile);
}

function findCol() {
	return false;
} 

function saveDataFile($data, $dataFile) {
	$f = fopen($dataFile, 'w');
	fwrite($f, $data);
	fclose($f);
}

function readDataFile($dataFile) {

	if (!is_readable($dataFile)) return false;
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

function writeData($newDataArr, $dataFile) {
	$newArr = addToArr($newDataArr);
	saveDataFile(json_encode($newArr), $dataFile);
}

function ajaxAdd($siteAddData, $dataFile) {
	global $arrDatal;

	if (robotsIsExst($siteAddData['robourl'], $arrData)) {
		return 'Robots.txt is already exist.';
	} else {
		writeData($siteData, $dataFile);
		return 'Robots.txt added.';
	}

}

function makeNewFile($name) {
	saveDataFile('[]', $name);
}

//function ajaxRead() {
//	return false;
//}

?>
