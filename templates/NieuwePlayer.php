<?php 
$instelStap = $_SESSION['game']['instel_stap'] ?? null;
$isStartVanSpel = ($_SESSION['game']['ronde'] === 0 && $_SESSION['game']['beurt'] === 0);
?>
<?php if ($instelStap === 'start' && $isStartVanSpel): ?>
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
<?php if ($instelStap === 'namen_geven'): ?>
    <form method="POST" action="index.php">
        <?php foreach ($_SESSION['game']['spelers'] as $index => $naam): ?>
            <label for="speler_<?= $index ?>">Speler <?= $index + 1 ?></label>
            <input id="speler_<?= $index ?>" name="speler-naam[]" type="text" value="<?= htmlspecialchars($naam) ?>" required>
        <?php endforeach; ?>
        
        <button type="submit" name="start-met-namen">Start Spel</button>
    </form>

<?php 
// nieuwe toegevoegd om de solo speler naam te geven. Noot: het is verplicht om een naam te krijgen.
elseif ($instelStap === 'naam_vragen'): ?>
    <!-- Pop-up of invoerveld voor de naam -->
     <!-- Gebruik de al bestaande overlay  class van de Errors-->
    <div class="popup-modal">
        <div class="popup-overlay" id="naamGeven-overlay">
            <div class="popup-box naamGeven-card">
                <form method="POST" action="index.php">
                    <h3>Vul je naam in om te beginnen:</h3>
                    <input id="speler" name="speler-naam[]" type="text" value="Speler 1" required autofocus>
                    <button type="submit" name="start-met-namen">Start Spel</button>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>


