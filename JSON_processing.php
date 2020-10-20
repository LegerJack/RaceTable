<?php
/**
 * Читаем содержимое в JSON файлах
 */
$results = file_get_contents('JSON_db\data_attempts.json');
$drivers = file_get_contents('JSON_db\data_cars.json');
/**
 * Декодируем JSON.
 * Зписываем в переменную для дальнейших 
 * действий.
 */
$dataresult = json_decode($results, true);
$datadriver = json_decode($drivers, true);
/**
 * Из переменных с данными из JSON 
 * Сравниваем данные и заиписываем их в единый многомерный массив 
 */
$i = 0;
foreach ($datadriver as $driver) {
    $attempts = 0; //Переменная для подсчета количества поыток участников гонки
    $results = array();
    foreach ($dataresult as $result) {
        if ($driver['id'] == $result['id']) {
            $total += $result['result'];     //Считаем общее количество очков участника
            $attempts++;
            $results[$i][] = $result['result']; //Отдельно записываем набранные очки в каждой попытке
        }
    };

 /**
  * Заносим полученные данные в массив для его дальнейшей сортировки 
  */
    $drivertotal[$i] = array(
        'id' => $driver['id'],
        'name' => $driver['name'],
        'car' => $driver['car'],
        'city' => $driver['city'],
        'results' => $results[$i],
        'total' => $total
    );
    $i++;
    $total = 0; //Обнуление переменной для следующего подсчета очков участника
};
/**
 * Функция для сортировки массива.
 * Узнаем у кого больше всего очков.
 */
function thisFirst($a,$b){
    
    return ($b['total'] - $a['total']);
}
/**
 * Сортируем массив
 */
usort($drivertotal, "thisFirst");

