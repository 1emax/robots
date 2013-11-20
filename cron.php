<?php
// file for checking the changes

require 'index.php';

function checkVer($sitesArray) {
	$i = 0;
	foreach ($sitesArray as $index => $siteData) {
		$i++;
		if ($i == 1) continue;
		echo '<br>' . $siteData->robourl;
	}
}

checkVer($arrData);

/*
print_r($arrData[0]);
foreach ($arrData[0] as $key => $value) {
	var_dump($key);
	echo '<br><br>';
	var_dump($value);
}
echo '<br><br><br>';
echo $arrData[0]->site;
*/
echo '<br>5';


?>