<?php if (!isset($_POST['gooi']) && !isset($_POST['multi-player']) && !isset($_POST['update_speler'])): ?>
    <form method="POST" action="index.php">
        <button name="multi-player" class="multi-playerBtn" type="submit">Speler Toevoegen</button>
    </form>
<?php endif?>
<?php if($_SESSION['multi-player']): ?>
<form method="POST" action="index.php">
    <label for="aantalSpelers">Aantal spelers (2 t/m 4):</label>
    <select name="aantalSpelres" class="number-players">
        <label>Aantal spelers</label>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
    </select>
    <button name="update_speler" type="submit">Opslaan</button>
</form>
<?php
if(isset($_POST['update_speler']))?>
    <?php $aantalSpelers = (int)($_POST['aantalSpelres'] ?? 2 ); ?>
    <form method="POST" action="index.php">
<?php for($i = 1; $i <= $aantalSpelers; $i++):?>
        <label for="speler">Speler <?=$i?></label>
        <input name="speler-naam[]" type="text" placeholder="Speler Naam" value="Speler <?= $i?>"required>
        <?php endfor?>
        <button type="submit" name="start-met-namen">Start Spel</button>
    </form>
<?php endif?>