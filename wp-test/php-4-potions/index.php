<?php
    include_once(__DIR__. '/data.php');
    function getCol($pot){
        if ($pot['rarity'] == 'common'){
            return 'green';
        } elseif ($pot['rarity'] == 'rare'){
            return 'blue';
        } elseif ($pot['rarity'] == 'epic'){
            return 'purple';
        } elseif ($pot['rarity'] == 'legendary'){
            return 'orange';
        }
    }

    $numLeg = 0;
    $totVal = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Task 4</title>
    <link rel="stylesheet" href="index.css" />
</head>

<body>
    <h1>4. Potions</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Color</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($potions as $potion): ?>    
                <tr>
                    <td style="color: <?= getCol($potion)?>"><?= $potion['name']?></td>
                    <td style= "background-color: <?= $potion['color']?>"></td>
                    <td><?= $potion['value']?></td>
                </tr>
                <?php if ($potion['rarity'] == 'legendary'){$numLeg++;} ?>
                <?php $totVal += $potion['value']; ?>
            <?php endforeach ?>
        </tbody>
    </table>

    <b>Number of legendary potions: <?= $numLeg?> <br>
    <b>Total value of all potions: <?= $totVal?> gold
</body>
</html>