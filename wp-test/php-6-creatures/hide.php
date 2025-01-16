<?php
require_once 'storage.php';

$storage = new Storage(new JsonIO('creatures.json'));
$id = $_POST['id'];
$creature = $storage->findById($id);
if ($creature) {
    $creature['hidden'] = true;
    $storage->update($id, $creature);
}

header('Location: index.php');
exit;
