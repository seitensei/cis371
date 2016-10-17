<?php

include('common.php');
include('db.php');
include('config.php');

if($_FILES['uploadfile']['name'] != "customers.txt") {
    // Terminate if incorrect file
    exit("File is not customers.txt");
}

$filestring = "./upload/".basename($_FILES['uploadfile']['name']);

if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $filestring)) {
    // successful upload
} else {
    exit("Upload unsuccessful.");
}

// Check First Line Contents (file sanity)
$check_array = load_array($filestring);
// if not matched, this is just a text file with same name
if($check_array[0] != "id,nameFirst,nameLast,address,city,st,zip,creditCard,balance") {
    exit("Invalid text header.");
}

// If we made it this far, strip the line so we can iterate through rest
$tmp_array = load_array_cleaned($filestring);
$data_array = array();
// Explode this thing
foreach($tmp_array as $item) {
    $outem = explode(",", $item);
    $data_array[] = $outem;
}

// Check Length
if(count($data_array[0]) != 9) {
    // less than nine entries
    // pack up, go home
    exit("Invalid number of data entries;");
}

// Now I assume that the world is made of rainbows and evil people don't exist

// Create PDO object, and add items to db
$dba = new DBAccess($host, $db, $user, $pass);
$dba->drop_customers();
$dba->create_customers();

foreach($data_array as $data) {
    $dba->insert_row($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7],$data[8]);
}

header('Location: '.'output.php',true, ($permanent === true) ? 301 : 302);
exit("<br>Operations Complete. Redirecting.");

?>