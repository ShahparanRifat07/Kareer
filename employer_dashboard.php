<?php


$value = array();
for($i=1;$i<6;$i++){
    $value += array($i => $i+10);
}

foreach($value as $v => $v_value) {
    echo "Key=" . $v . ", Value=" . $v_value;
    echo "<br>";
}

$json = json_encode($value, true);

echo $json;

$json1 = json_decode($json, true);

foreach($json1 as $key => $value) {
    echo "Key=" . $key . ", Value=" . $value;
    echo "<br>";
}

// $employees = array();


// $employees += array('employee'=> "RIfat", 'country'=> "Ban");
// $employees += array('employee'=> "RIfrrrat", 'country'=> "Bereran");
// $employees += array('employee'=> "Rt", 'country'=> "Banddd");
// $employees += array('employee'=> "RgdfIfat", 'country'=> "Bfdfean");

// // foreach($employees as $v => $v_value) {
// //     echo "Key=" . $v . ", Value=" . $v_value;
// //     echo "<br>";
// // }

// $json = json_encode($employees, true);

// echo $json;