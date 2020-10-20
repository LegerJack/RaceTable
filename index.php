<!-- Подключаем файл с обработанными данными -->
<?include_once 'JSON_processing.php';?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\style.css">
    <title>Race</title>
</head>

<body>
    <p>Для сортировки нажмите на результаты одной из попыток</p>
    <table class="dintable" id="raceTable">
        <thead>
            <tr class="dinthead">
                <th>Position</th>
                <th>Number</th>
                <th>Name</th>
                <th>Car</th>
                <th>City</th>
                <? $position = 1; //Переменная для отображения места учстника 
                 for($i = 1; $i <= $attempts; $i++): ?>

                <th class="result" onclick="sortResult('<? echo $i ?>')">Result #
                    <?echo $i?>
                </th>

                <?endfor;?>
                <th id="total" onclick="sortResult('<? echo $attempts + 1 ?>')">Total</th>

            </tr>
        </thead>
        <tbody id="tbody">
            
            <?/**
             * Выводим участников из массива в таблицу
             */
            foreach ($drivertotal as $totaldata):?>

            <tr 
            <? /**
             * В зависимости от места выводим стиль строки
             * 1 - золотая строка
             * 2 - серебряная
             * 3 - бронзовая
             */
            switch($position): 
                case 1: ?>
                    class="firstPOS"
                <?break;?>
                <? case 2: ?>
                    class="secondPOS"; 
                <?break;?>
                <? case 3: ?> 
                    class="thirdPOS"
                <?break;?>
                <? endswitch; ?> 
            >
                <td>
                    <?echo $position++?>
                </td>
                <td>
                    <?echo $totaldata['id']?>
                </td>
                <td>
                    <?echo $totaldata['name']?>
                </td>
                <td>
                    <?echo $totaldata['car']?>
                </td>
                <td>
                    <?echo $totaldata['city']?>
                </td>

                <? 
                /**
                 * Выводим результаты каждой попытки
                 * и общего результата 
                 */
                for($i = 0; $i < $attempts; $i++ ): ?>

                <td onclick="">
                    <?echo $totaldata['results'][$i]?>
                </td>

                <? endfor; ?>

                <td onclick="sortTotal('<?$drivertotal?>')">
                    <?echo $totaldata['total']?>
                </td>

            </tr>
            <?endforeach;?>
        </tbody>
    </table>

    <script>
        let attempts = <? echo $attempts; ?>;
        /**
         * Функция вызывающаяся при клике.
         * Сортирует таблицу по всем результатам, как по отдельным ,так и по общему.
         * */
        function sortResult(e) {
            //Записываем объект JSON 
            let driverObj = <? echo json_encode($drivertotal); ?> ;
            /**
             * Сортируем объект по полученному элементу
             * e - число указывающее на попытку по которой будет сортироваться массив  
             */
            if(e <= attempts){
                driverObj.sort((a, b) => b.results[e-1] - a.results[e-1]);
            }

            else {
                driverObj.sort((a, b) => b.total - a.total);
            }

            /**
             * Из тела таблицы удаляем ВСЕ имеющиеся записи для их переопрделения 
             */
            let tbody = document.getElementById('tbody');

            while (tbody.firstChild) {
                tbody.removeChild(tbody.firstChild);
            }

            /**
             * Добавлем элементы таблицы и записываем в них
             * данные отсортированного массива
             */
            for (i = 0; i < driverObj.length; i++) {
                let trow = document.createElement('tr');
            /**
             * В зависимости от места добавляем стиль строки
             * 1 - золотая строка
             * 2 - серебряная
             * 3 - бронзовая
             */
                tbody.appendChild(trow);
                switch(i){
                    case 0:{
                        trow.classList.add('firstPOS');
                        break;
                    };
                    case 1:{
                        trow.classList.add('secondPOS');
                        break;
                    };
                    case 2:{
                        trow.classList.add('thirdPOS');
                        break;
                    };
                }
                /**
                 * Получаем ключи объекта.
                 * По ним определяем количество столбцов в строке.
                 */
                arrKeys = Object.keys(driverObj[i]);

                //Создаем первую ячейку для просмотра занятого участником места
                let td = document.createElement('td');
                td.appendChild(document.createTextNode(i+1));
                trow.appendChild(td);
                //Получаем все остальные ячейки с данными
                for (j = 0; j < arrKeys.length; j++) {
                    //Если появляется ключ с результатами
                    //Просматриваем просматриваем его
                    //И выводим в таблицу
                    //Выводим результаты каждой поптыки участника
                    if(arrKeys[j] == "results"){
                        for(k = 0; k < attempts; k++){
                            td = document.createElement('td');
                            td.appendChild(document.createTextNode(driverObj[i][arrKeys[j]][k] + " "));
                            trow.appendChild(td);
                        }
                    }

                    //Иначе выводим следующие ячейки с данными и общим результатом участника
                    else {
                        td = document.createElement('td');
                        td.appendChild(document.createTextNode('' + driverObj[i][arrKeys[j]]));
                        trow.appendChild(td)
                    }

                }
            }
        }

    </script>
</body>

</html>