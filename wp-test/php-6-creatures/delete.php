<?php
require_once 'storage.php';

$storage = new Storage(new JsonIO('creatures.json'));
$id = $_POST['id'];
$storage->delete($id);

header('Location: index.php');
exit;

// hide.php
