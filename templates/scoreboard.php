<!-- Container voor de scorekaart -->
<div class="score-kaart">
    <table class="score-table">
        <!-- Tabelkop met de kolomnamen -->
        <thead>
            <tr><?php 
            $spelers = $_SESSION['game']['spelers'];?>
            <th>Categorie</th>
            <?php foreach($spelers as $index => $spelerNaam): ?>
                <th><?= $spelerNaam ?></th>
                <?php endforeach;?>
                <th>Actie</th>
            </tr>
        </thead>
        
        <tbody>
            <?php foreach($categorieen as $catIndex => $catName): ?>
                <tr>
                    <td><?= $catName ?></td>
                    <?php foreach($_SESSION['game']['spelers'] as $spelerIndex => $spelerNaam):?>
                        <td>
                        <?php $score = $_SESSION['game']['scores'][$spelerIndex][$catIndex] ?? null;
                        echo($score !== null) ? htmlspecialchars($score):'-';?>
                        </td>
                    <?php endforeach?>

                    <td>
                    <?php 
                    $actieveSpeler = $_SESSION['game']['actieveSpeler'] ?? 0;
                    $reedsIngevuld = isset($_SESSION['game']['scores'][$actieveSpeler][$catIndex]);
                    $heeftGegooid   = ($_SESSION['game']['beurt'] ?? 0) > 0;
                    ?>

                    <?php if (!$reedsIngevuld && $heeftGegooid): ?>
                        <form method="POST" action="index.php" style="margin: 0;">
                            <input type="hidden" name="categorie" value="<?= htmlspecialchars($catIndex) ?>">
                            <button type="submit" name="kies_categorie">Kies</button>
                        </form>
                    <?php else: ?>
                        <button disabled>-</button>
                    <?php endif; ?>
                </td>
                </tr>
                <?php endforeach?>
        </tbody>
    </table>
</div>