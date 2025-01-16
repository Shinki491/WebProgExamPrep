<?php

$errors = [];
$data = [
    'full_name' => '',
    'wizards' => '',
    'pet' => '',
    'agree' => false
];

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $data['full_name'] = trim($_GET['full_name'] ?? '');
    $data['wizards'] = $_GET['wizards'] ?? '';
    $data['pet'] = $_GET['pet'] ?? '';
    $data['agree'] = isset($_GET['agree']);


    if (empty($data['full_name'])) {
        $errors['full_name'] = 'Name is required.';
    } elseif (strlen($data['full_name']) < 6) {
        $errors['full_name'] = 'Name must be at least 6 characters.';
    } elseif (strpos($data['full_name'], ' ') === false) {
        $errors['full_name'] = 'Name must contain at least one space.';
    }


    if (empty($data['wizards'])) {
        $errors['wizards'] = 'Number of wizards is required.';
    } elseif (!filter_var($data['wizards'], FILTER_VALIDATE_INT)) {
        $errors['wizards'] = 'Number of wizards must be an integer.';
    } elseif ($data['wizards'] < 1 || $data['wizards'] > 256) {
        $errors['wizards'] = 'Number of wizards must be between 1 and 256.';
    }


    $valid_pets = ['owl', 'cat', 'toad', 'rat'];
    if (!in_array($data['pet'], $valid_pets)) {
        $errors['pet'] = 'Pet must be one of: owl, cat, toad, rat.';
    }


    if (!$data['agree']) {
        $errors['agree'] = 'Consent to data processing is required.';
    }
}


$form_valid = empty($errors);

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 5</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>5. Invitation</h1>
    <form action="index.php" method="GET" novalidate>
        <label for="full_name">Name of child:</label>
        <input type="text" name="full_name" value="<?= htmlspecialchars($data['full_name']) ?>">
        <span class="error-message"><?= $errors['full_name'] ?? '' ?></span>
       
        <label for="wizards">Wizards in family:</label>
        <input type="text" name="wizards" value="<?= htmlspecialchars($data['wizards']) ?>">
        <span class="error-message"><?= $errors['wizards'] ?? '' ?></span>
       
        <label for="pet">Accompanying pet:</label>
        <select name="pet">
            <option value="owl" <?= $data['pet'] == 'owl' ? 'selected' : '' ?>>Owl</option>
            <option value="cat" <?= $data['pet'] == 'cat' ? 'selected' : '' ?>>Cat</option>
            <option value="toad" <?= $data['pet'] == 'toad' ? 'selected' : '' ?>>Toad</option>
            <option value="rat" <?= $data['pet'] == 'rat' ? 'selected' : '' ?>>Rat</option>
        </select>
        <span class="error-message"><?= $errors['pet'] ?? '' ?></span>

        <input type="checkbox" name="agree" <?= $data['agree'] ? 'checked' : '' ?>>
        <label for="agree" style="display: inline-block">I consent to the processing of my data.</label>
        <span class="error-message"><?= $errors['agree'] ?? '' ?></span>

        <input type="submit" value="Send application">
    </form>
    
    <?php if ($form_valid): ?>
    <div id="success">
        <h2>Thank you for your application!</h2>
        If we decide to admit your child, we will notify you by owl mail shortly.
    </div>
    <?php endif; ?>

    <div class="help">
        <h2>Links for testing</h2>
        <ul>
            <li><a href="index.php?">No data sent</a></li>
            <li><a href="index.php?full_name=L&wizards=4&pet=owl&agree=on">Name too short</a></li>
            <li><a href="index.php?full_name=LunaLovegood&wizards=4&pet=owl&agree=on">No space in name</a></li>
            <li><a href="index.php?full_name=Luna%20Lovegood&wizards=four&pet=owl&agree=on">Wizard count is not a number</a></li>
            <li><a href="index.php?full_name=Luna%20Lovegood&wizards=3.14&pet=owl&agree=on">Wizard count is not an integer</a></li>
            <li><a href="index.php?full_name=Luna%20Lovegood&wizards=0&pet=owl&agree=on">Wizard count is too low</a></li>
            <li><a href="index.php?full_name=Luna%20Lovegood&wizards=300&pet=owl&agree=on">Wizard count is too high</a></li>
            <li><a href="index.php?full_name=Luna%20Lovegood&wizards=4&agree=on">Missing pet</a></li>
            <li><a href="index.php?full_name=Luna%20Lovegood&wizards=4&pet=lizard&agree=on">Invalid pet</a></li>
            <li><a href="index.php?full_name=Luna%20Lovegood&wizards=4&pet=owl">Missing consent to data processing</a></li>
            <li><a href="index.php?full_name=Luna%20Lovegood&wizards=4&pet=owl&agree=on">Correct input</a></li>
        </ul>
    </div>
</body>
</html>
