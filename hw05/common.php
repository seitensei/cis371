<?php

// loads file into array, removes first index
function load_array_cleaned($filename) {
    $importdata = file($filename, FILE_IGNORE_NEW_LINES);
    unset($importdata[0]);
    return (is_array($importdata)) ? array_values($importdata) : null;
}

// loads file into array
function load_array($filename) {
    $importdata = file($filename, FILE_IGNORE_NEW_LINES);
    return (is_array($importdata)) ? array_values($importdata) : null;
}

?>