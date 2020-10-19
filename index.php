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

        <tr class="dinthead">
            <th>Место</th>
            <th>Name</th>
            <th>City</th>
            <th>Car</th>
            <? for($i = 1; $i <= $attempts; $i++): ?>

            <th class="result" >Result #
                <?echo $i?>
            </th>

            <?endfor;?>
            <th id="total">Total</th>

            <?foreach ($drivertotal as $totaldata):?>
        </tr>

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
    </table>

    <script src="script.js"></script>
    <script>
        let arr = <?echo json_encode($drivertotal);?>;
        arr.sort((a,b) => a['results'][1] - b['results'][1]);
        
        console.log(arr);
    </script>
</body>

</html>