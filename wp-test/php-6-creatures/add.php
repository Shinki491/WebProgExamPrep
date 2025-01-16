// add.php
<?php
require_once 'storage.php';

$storage = new Storage(new JsonIO('creatures.json'));

$creature_name = $_POST['creature'];
$creature_count = (int)$_POST['count'];

$existing = $storage->findOne(['creature' => $creature_name]);
if ($existing) {
    $existing['count'] += $creature_count;
    $storage->update($existing['id'], $existing);
} else {
    $storage->add(['creature' => $creature_name, 'count' => $creature_count]);
}

header('Location: index.php');
exit;
