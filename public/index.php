<?php require_once __DIR__."/../config/bootstrap.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Yahtzee</title>
</head>
<body>
    <h1>Yahtzee</h1>
    <!-- header -->
    <div class="spel-info">
        <label>Ronde: <?= $_SESSION['game']['ronde'] ?></label>
        <label>Beurt: <?= $_SESSION['game']['beurt'] ?></label>
    </div>

    
</body>
</html>
