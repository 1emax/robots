<?php
// file for checking the changes

require 'index.php';

$listSites = $arrDataOfFile;
$robotsDataFile = 'data.json';

function checkVer($sitesArray) {
	$i = 0;
	foreach ($sitesArray as $index => $siteData) {
		$i++;
		if ($i == 1) continue;
		echo '<br>' . $siteData['robourl'];
	}
}

checkVer($listSites);

// $robotsUrl, $robotsDataFile
function compareRobots($robotUrl, $dataFile) {
	$robotsData = readDataFile($dataFile);
	$robotsRemote = file_get_contents($robourl);

	if ($robotsRemote == $robotsData['robotUrl']) {
		echo 'All the same';
	} else {
		echo 'Files are different';
	}
}

function addRobotsData($data, $robourl, $dataFile) {
	$existData = readDataFile($dataFile) ? readDataFile($dataFile) : makeNewFile($dataFile);
	
}

/*
print_r($listSites[0]);
foreach ($listSites[0] as $key => $value) {
	var_dump($key);
	echo '<br><br>';
	var_dump($value);
}
echo '<br><br><br>';
echo $listSites[0]['site'];
*/
echo '<br>5';


?>
