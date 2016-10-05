<?php
// assignment specific code/functions

// imports from system
// leave validation to form
$month = intval($_GET["m"]);
$year = intval($_GET["y"]);
$report = intval($_GET["r"]);
$type = intval($_GET["t"]);


// loads file into array, removes first index
function load_array_cleaned($filename) {
    $importdata = file($filename, FILE_IGNORE_NEW_LINES);
    unset($importdata[0]);
    return (is_array($importdata)) ? array_values($importdata) : null;
}

// string to array, with delimiter
// removes first element (i.e. Grand Rapids)
// returned format:
// Month, Day, Year, Avg Temp, Max Temp, Min Temp
function explode_strip($string, $delimiter) {
    $exploded = explode($delimiter, $string);
    unset($exploded[0]);
    return (is_array($exploded)) ? array_values($exploded) : null;
    
}

// load data into usable array
function load_data() {
    
    // load cleaned array
    $data = load_array_cleaned("temperatures.txt");
    
    // array for populating
    $export = array();
    
    foreach($data as $d) {
        array_push($export, explode_strip($d, ","));
    }

    return $export;
}

// get average, $t: 1 - Highs 2 - Averages 3 - Lows
function get_average($m, $y, $t) {
    $source = load_data();
    $out = array();
    $tmpa = array();
    
    // decode given $t into array index, 1 = 4, 2 = 3, 3 = 5
    $idx = 3;
    if($t == 1) { $idx = 4;}
    if($t == 2) { $idx = 3;}
    if($t == 3) { $idx = 5;}
    // populate tmp array
    foreach($source as $i) {
        if ((intval($i[0]) == $m) && (intval($i[2]) == $y)) {
            array_push($tmpa, $i);
        }
    }
    // get average
    $avgc = 0;
    $avgi = 0;
    foreach($tmpa as $j) {
        $avgc = $avgc + $j[$idx];
        $avgi = $avgi + 1;
    }
    
    $avgf = $avgc / $avgi;
    
    // format in out
    // month, year, temp
    $out = array($m, $y, $avgf);
    
    return $out;
}

function get_list($m, $y, $t) {
    $source = load_data();
    $out = array();
    $tmpa = array();
    
    // decode given $t into array index, 1 = 4, 2 = 3, 3 = 5
    $idx = 3;
    if($t == 1) { $idx = 4;}
    if($t == 2) { $idx = 3;}
    if($t == 3) { $idx = 5;}
    // populate tmp array
    foreach($source as $i) {
        if ((intval($i[0]) == $m) && (intval($i[2]) == $y)) {
            array_push($tmpa, $i);
        }
    }
    
    // format out
    foreach($tmpa as $j) {
        array_push($out, array($j[0], $j[1], $j[2], $j[$idx]));
    }
    
    return $out;
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>CIS371 - Homework 04</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="topbar">
            <span class="brand">CIS371 - Homework 04</span>
        </div>
        <div class="container">
            <form action="index.php">
                <input type="submit" value="Back to Form"><br>
            </form>
            <?php
                // EXEC
                // Assume that JS Validation took care of Crazies
                // handle averages
                
                // name thing
                $tname = "Temp";
                if ($type == 1) { $tname = "High"; }
                if ($type == 2) { $tname = "Avg"; }
                if ($type == 3) { $tname = "Low"; }
                if ($report == 1) {
                    echo "<h2 class=\"center\">Average/month-year</h2>";
                    echo "<table>";
                    $avg = get_average($month, $year, $type);
                    echo "<tr><td>Month</td><td>Year</td><td>".$tname."</td></tr>";
                    echo "<tr><td>".$avg[0]."</td><td>".$avg[1]."</td><td>".$avg[2]."</td><tr>";
                    
                }
                // handle list
                if ($report == 2) {
                    echo "<h2 class=\"center\">List/month-year</h2>";
                    echo "<table>";
                    $list = get_list($month, $year, $type);
                    echo "<tr><td>Month</td><td>Day</td><td>Year</td><td>".$tname."</td></tr>";
                    foreach($list as $o) {
                        echo "<tr><td>".intval($o[0])."</td><td>".$o[1]."</td><td>".intval($o[2])."</td><td>".$o[3]."</td><tr>";
                    }
                }
                echo "</table>";
            ?>
        </div>
    </body>
</html>