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
                <th>Position</th>
                <th>Number</th>
                <th>Name</th>
                <th>Car</th>
                <th>City</th>
                <? for($i = 1; $i <= $attempts; $i++): ?>

                <th class="result" onclick="sortResult('<? echo $i ?>')">Result #
                    <?echo $i?>
                </th>

                <?endfor;?>
                <th id="total" onclick="sortResult('<? echo $attempts + 1 ?>')">Total</th>

            </tr>
        </thead>
        <tbody id="tbody">
            <?foreach ($drivertotal as $totaldata):?>
            <tr>
                <td>
                    <?echo $place++?>
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
        let attempts = <? echo $attempts; ?>;
        function sortResult(e) {
            let driverObj = <? echo json_encode($drivertotal); ?> ;

            if(e <= attempts){
                driverObj.sort((a, b) => b.results[e-1] - a.results[e-1]);
            }

            else {
                driverObj.sort((a, b) => b.total - a.total);
            }

            let tbody = document.getElementById('tbody');

            while (tbody.firstChild) {
                tbody.removeChild(tbody.firstChild);
            }

            for (i = 0; i < driverObj.length; i++) {
                let trow = document.createElement('tr');
                tbody.appendChild(trow);
                arrKeys = Object.keys(driverObj[i]);

                let td = document.createElement('td');
                td.appendChild(document.createTextNode(i+1));
                trow.appendChild(td);

                for (j = 0; j < arrKeys.length; j++) {
                    
                    if(arrKeys[j] == "results"){
                        for(k = 0; k < attempts; k++){
                            td = document.createElement('td');
                            td.appendChild(document.createTextNode(driverObj[i][arrKeys[j]][k] + " "));

                            trow.appendChild(td);
                        }
                    }

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