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
        <input type="text" name="full_name">
        <span class="error-message"></span>
       
        <label for="wizards">Wizards in family:</label>
        <input type="text" name="wizards">
        <span class="error-message"></span>
       
        <label for="pet">Accompanying pet:</label>
        <select name="pet">
            <option value="owl">Owl</option>
            <option value="cat">Cat</option>
            <option value="toad">Toad</option>
            <option value="rat">>Rat</option>
        </select>
        <span class="error-message"></span>

        <input type="checkbox" name="agree">
        <label for="agree" style="display: inline-block">I consent to the processing of my data.</label>
        <span class="error-message"></span>

        <input type="submit" value="Send application">
    </form>
    
    <div id="success">
        <h2>Thank you for your application!</h2>
        If we decide to admit your child, we will notify you by owl mail shortly.
    </div>

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