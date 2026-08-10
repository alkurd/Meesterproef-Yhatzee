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
    // wordt gebruikt om de pagina overzigtelijk te houden
    <?php require_once __DIR__.'/../templates/Errors.php';?>  
    <h1>Yahtzee</h1>
    <!-- header -->
    <div class="spel-info">
        <label>Ronde: <?= $_SESSION['game']['ronde'] ?></label>
        <label>Beurt: <?= $_SESSION['game']['beurt'] ?></label>
    </div>
    <?php 
    require_once __DIR__.'/../templates/dice_form.php';
    require_once __DIR__.'/../templates/scoreboard.php';
    ?>
    // De reset knop
    <form action="index.php" method="POST" class="reset-spel">
        <button name="reset" type="submit">Nieuwe Spel</button> // Wrdt de actie geroeppen door name te geven
    </form>

    
</body>
</html>