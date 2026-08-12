<?php 
$instelStap = $_SESSION['game']['instel_stap'] ?? null;
$isStartVanSpel = ($_SESSION['game']['ronde'] === 1 && $_SESSION['game']['beurt'] === 0);
?>
<?php if ($instelStap === 'spel_bezig' && $isStartVanSpel): ?>
    <form method="POST" action="index.php">
        <button name="multi-player" class="btn-instel" type="submit">Speler Toevoegen</button>
    </form>
<?php endif?>

<?php if( $instelStap === 'aantal_kiezen'): ?>

<form method="POST" action="index.php">
    <label for="aantalSpelers">Aantal spelers (2 t/m 4):</label>
    <select name="aantalSpelers" class="number-players">
        <label>Aantal spelers</label>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
    </select>
    <button name="update_speler" type="submit">Opslaan</button>
</form>
<?php endif?>
<?php
if($instelStap === 'namen_geven'):?>
<?php $aantalSpelers = $_SESSION['game']['speler']?>
    <form method="POST" action="index.php">
<?php for($i = 1; $i <= $aantalSpelers; $i++):?>
        <label for="speler">Speler <?=$i?></label>
        <input name="speler-naam[]" type="text" placeholder="Speler Naam" value="Speler <?= $i?>"required>
        <?php endfor?>
        <button type="submit" name="start-met-namen">Start Spel</button>
    </form>

<?php endif;
