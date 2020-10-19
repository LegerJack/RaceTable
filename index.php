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
    <select name="" id="">
        <option value="" disabled>Фильтр</option>
    </select>
    <table class="dintable" id="raceTable">
        <thead class="dintable_head">
            <th>ID</th>
            <th>Name</th>
            <th>City</th>
            <th>Car</th>
            <? for($i = 1; $i <= $attempts; $i++): ?>
            
            <th class="result" data-id="result-<?echo $i?>">Result #<?echo $i?></th>

            <?endfor;?>
            <th id="total">Total</th>
        </thead>
        <tbody>

            <?foreach ($drivertotal as $totaldata):?>
            <tr>
                <td>
                    <?echo $totaldata['id']?>
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

                <td>
                    <?echo $totaldata['results'][$i]?>
                </td>

                <? endfor; ?>

                <td>
                    <?echo $totaldata['total']?>
                </td>

            </tr>
            <?endforeach;?>
        </tbody>
    </table>

    <script src="script.js"></script>
</body>

</html>