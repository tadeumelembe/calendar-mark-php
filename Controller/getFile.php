<?php
$fileData = file_get_contents($dbFile); //read the file
$rows = explode("\n", $fileData); //create array separate by new line
$markedDays = array_map("trim", $rows); // for removing any unwanted space

$days = array();
$markData = array();
//Get all marked days into array
for ($i = 0; $i < count($markedDays); $i++) {
    $convert = explode("|-|", $markedDays[$i]);
    $markData[$convert[2]] = $convert;
    array_push($days, $convert[2]);
}