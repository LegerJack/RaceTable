<?
include_once 'JSON_processing.php';
$place = 1;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\style.css">
    <title>Race</title>
</head>

<body>
    <table class="dintable" id="raceTable">
        <thead>
            <tr class="dinthead">
                <th>Место</th>
                <th>Name</th>
                <th>City</th>
                <th>Car</th>
                <? for($i = 1; $i <= $attempts; $i++): ?>

                <th class="result" onclick="sortResult('<? echo $i ?>')">Result #
                    <?echo $i?>
                </th>

                <?endfor;?>
                <th id="total">Total</th>

            </tr>
        </thead>
        <tbody id="tbody">
            <?foreach ($drivertotal as $totaldata):?>
            <tr>
                <td>
                    <?echo $place++?>
                </td>
                <td>
                    <?echo $totaldata['name']?>
                </td>
                <td>
                    <?echo $totaldata['city']?>
                </td>
                <td>
                    <?echo $totaldata['car']?>
                </td>

                <? for($i = 0; $i < $attempts; $i++ ): ?>

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
        function sortResult(e) {
            let arr = <? echo json_encode($drivertotal); ?> ;
            arr.sort((a, b) => a['results'][e] - b['results'][e]);
            let tbody = document.getElementById('tbody');
            while (tbody.firstChild) {
                tbody.removeChild(tbody.firstChild);
            }
            for (i = 0; i < arr.length - 1; i++) {
                let trow = document.createElement('tr');
                tbody.appendChild(trow);
                arrKeys = Object.keys(arr[i]);
                k = 0;
                for (j = 0; j < arrKeys.length + <? echo $attempts ?> ; j++) {
                    let td = document.createElement('td');
                    if(arrKeys[j] == "results"){
                        td.appendChild(document.createTextNode('' + arr[i]['results'][k]));
                        k++;
                    }
                    else{
                        td.appendChild(document.createTextNode('' + arr[i][arrKeys[j]]));
                        
                    }

                    trow.appendChild(td)
                }
            }
            console.log(Object.keys(arr[1]).length);
            console.log(Object.values(arr[1]['results']));
            console.log(arr);
            console.log(arrKeys);
        }
    </script>
</body>

</html>