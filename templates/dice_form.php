<!-- Container voor het hele dobbelveld -->
<div class="dobbel-veld">

    <!-- Formulier om dobbelstenen vast te zetten of los te laten -->
    <form method="POST" action="index.php">
        <!-- Loopt door de dobbelstenen: $index is de positie (0 t/m 4) en $waarde is het aantal ogen (1 t/m 6) -->
        <?php foreach($_SESSION['game']['dobbelstenen'] as $index => $waarde): ?>
            
            <!-- Controleert of deze specifieke dobbelsteen is vastgehouden (default: false) -->
            <?php $isvast = $_SESSION['game']['vasthouden'][$index] ?? false; ?>
            
            <!-- Knop per dobbelsteen: krijgt de CSS-class 'vast' als hij vaststaat en stuurt de index mee -->
            <button class="dobbelsteen <?= $isvast ? 'vast':''?>" type="submit" name="wissel_vast" value="<?=$index?>">
                <?= $waarde ?>
            </button>

        <?php endforeach; ?>
    </form>

    <!-- Formulier voor de gooi-knop -->
    <form action="index.php" method="POST">
        <button name="gooi" type="submit">Dobbelsteen gooien</button>
    </form>

</div>