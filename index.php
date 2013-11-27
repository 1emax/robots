<?php

$dataFile = 'list.json';
$arrDataOfFile = readDataFile($dataFile) ? readDataFile($dataFile) : makeNewFile($dataFile);

if (isset($_POST['ajax'])) {
	$ajaxQuery = jsonToArr($_POST['ajax']);

	header('Access-Control-Allow-Origin: *');
	if ($ajaxQuery['method'] == 'add') echo ajaxAdd($ajaxQuery['data'], $dataFile); 
	if ($ajaxQuery['method'] == 'read') echo $arrDataOfFile;	
}


function title() {
	echo 'Robots.txt checker';
}

function sitesCol() {
	// global $dataFile;

	$newDataArr = array();
	$indx = count($newDataArr);
	$newDataArr[$indx]['site'] = 'Eug';
	$newDataArr[$indx]['robourl'] = 'http://robots.txt';
	$newDataArr[$indx]['email'] = 'me@mail.ru';	

	echo showTable( addToArr($newDataArr[$indx]) );

	//echo '<br><br>' ;
	//var_dump( readDataFile($dataFile) );
	// saveDataFile(json_encode($newDataArr), $dataFile);
}

function findCol() {
	return false;
} 

function showTable($sitesList) {
	$i = 0;
	$trStr = '';
	$checkWord = 'проверить сайт';
	//var_dump($sitesList);
	foreach ($sitesList as $site) {
		if ($i == 0) $checkWord = 'Проверить';
		$i++;
		//var_dump($site);
		// echo '<br><br>';
		// echo is_array($site);
		$trStr .= '<tr>';
		$trStr .= '<td>' . $site['site'] . '</td>';
		$trStr .= '<td>' . $site['robourl'] . '</td>';
		$trStr .= '<td>' . $site['email'] . '</td>';
		$trStr .= '<td>' . $checkWord . '</td>';
		$trStr .= '</tr>';
	}
	return $trStr;
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
	return json_decode($str, true);
}

function addToArr($newDataArray) {
	global $arrDataOfFile;
	$extdArr = $arrDataOfFile;
	$extdArr[] = $newDataArray;
	return $extdArr;
}

function robotsIsExst($name, $whereArr) {
	foreach ($whereArr as $key => $siteData) {
		if ($siteData['robourl'] == $name) return true;
	}
	return false;
}

function writeData($newnewDataArr, $dataFile) {
	$newArr = addToArr($newnewDataArr);
	saveDataFile(json_encode($newArr), $dataFile);
}

function ajaxAdd($siteAddData, $dataFile) {
	global $arrDataOfFilel;

	if (robotsIsExst($siteAddData['robourl'], $arrDataOfFile)) {
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
