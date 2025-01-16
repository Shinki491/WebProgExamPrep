<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Task 6</title>
    <link rel="stylesheet" href="index.css" />
</head>

<body>
    <h1>6. Creatures</h1>

    <h2>New creature seen</h2>
    <form action="add.php" method="POST">
        Name of creature: <input type="text" name="creature" required><br>
        Amount seen: <input type="number" name="count" required><br>
        <button type="submit">Save</button>
    </form>

    <h2>Creatures seen so far</h2>
    <?php
    require_once 'storage.php';

    $storage = new Storage(new JsonIO('creatures.json'));
    $creatures = $storage->findAll();
    usort($creatures, fn($a, $b) => strcmp($a['creature'], $b['creature']));

    echo '<ul>';
    foreach ($creatures as $creature) {
        if (isset($creature['hidden']) && $creature['hidden']) continue;
        echo '<li>' . htmlspecialchars($creature['creature']) . ' (' . htmlspecialchars($creature['count']) . ' sightings)';
        echo '<form style="display:inline;" action="delete.php" method="POST">
                <input type="hidden" name="id" value="' . htmlspecialchars($creature['id']) . '">
                <button type="submit">Delete</button>
              </form>';
        echo '<form style="display:inline;" action="hide.php" method="POST">
                <input type="hidden" name="id" value="' . htmlspecialchars($creature['id']) . '">
                <button type="submit">Hide</button>
              </form>';
        echo '</li>';
    }
    echo '</ul>';
    ?>
</body>

</html>