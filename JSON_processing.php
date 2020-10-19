<?php
$results = file_get_contents('JSON_db\data_attempts.json');
$drivers = file_get_contents('JSON_db\data_cars.json');

$dataresult = json_decode($results, true);
$datadriver = json_decode($drivers, true);

$i = 0;
foreach ($datadriver as $driver) {
    $attempts = 0;
    $results = array();
    foreach ($dataresult as $result) {
        if ($driver['id'] == $result['id']) {
            $total += $result['result'];
            $attempts++;
            $results[$i][] = $result['result'];
        }
    };

    $drivertotal[$i] = array(
        'id' => $driver['id'],
        'name' => $driver['name'],
        'car' => $driver['car'],
        'city' => $driver['city'],
        'results' => $results[$i],
        'total' => $total
    );
    $i++;
    $total = 0;
};
function thisFirst($a,$b){
    
    return ($b['total'] - $a['total']);
}
usort($drivertotal, "thisFirst");

// var_dump($drivertotal);
// print_r($attempts);
