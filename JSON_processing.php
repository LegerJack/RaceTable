<?php
$results = file_get_contents('test-junior\data_attempts.json');
$drivers = file_get_contents('test-junior\data_cars.json');

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
        'total' => $total);
        $i++;
    $total = 0;
};

echo '<pre>';
usort($drivertotal, function($a, $b){
    return ($b['total'] - $a['total']);
});
var_dump($drivertotal);
print_r($attempts);
