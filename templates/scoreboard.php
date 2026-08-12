<!-- Container voor de scorekaart -->
<div class="score-kaart">
    <table class="score-table">
        <!-- Tabelkop met de kolomnamen -->
        <thead>
            <tr><?php 
            $spelers = $_SESSION['game']['spelers'];?>
            <th>Categorie</th>
            <!-- Dynamische kolomhoofden voor elke speler -->
            <?php foreach($spelers as  $spelerNaam): ?>
                <th><?= $spelerNaam ?></th>
                <?php endforeach;?>
                <th>Actie</th>
            </tr>
        </thead>
        
        <tbody>
            <!-- Doorloop alle categorieën met hun unieke index ($catIndex) en naam ($catName) -->
            <?php foreach($categorieen as $catIndex => $catName): ?>
                <tr>
                    <!-- 1. Categorienaam -->
                    <td><?= $catName ?></td>
                    <!-- 2. Toon de score per speler op basis van hun $spelerIndex en $catIndex -->
                    <?php foreach($_SESSION['game']['spelers'] as $spelerIndex => $spelerNaam):?>
                    <td>
                        <?php
                        // Haal de score op voor deze specifieke speler en categorie-index.
                        // Als er nog geen score is ingevuld, tonen we een streepje ('-').
                        $score = $_SESSION['game']['scores'][$spelerIndex][$catIndex] ?? null;
                        echo($score !== null) ? htmlspecialchars($score):'-';?>
                        </td>
                    <?php endforeach?>

                    <td>
                    <!-- 3. Actiekolom: Knop om categorie te kiezen -->
                    <?php 
                    $actieveSpeler = $_SESSION['game']['actieveSpeler'] ?? 0;
                    // Controleer of de actieve speler hier al een score heeft ingevuld
                    $reedsIngevuld = isset($_SESSION['game']['scores'][$actieveSpeler][$catIndex]);
                    // Controleer of de speler in deze beurt al minstens 1x heeft gegooid
                    $heeftGegooid   = ($_SESSION['game']['beurt'] ?? 0) > 0;
                    ?>
                    <!-- Toon de 'Kies' knop alleen als er gegooid is én het vakje nog leeg is -->
                    <?php if (!$reedsIngevuld && $heeftGegooid): ?>
                        <form method="POST" action="index.php" style="margin: 0;">
                            <!-- Geeft de specifieke $catIndex mee aan $_POST['categorie'] bij het verzenden -->
                            <input type="hidden" name="categorie" value="<?= htmlspecialchars($catIndex) ?>">
                            <button type="submit" name="kies_categorie">Kies</button>
                        </form>
                    <?php else: ?>
                        <button disabled>Kies</button>
                    <?php endif; ?>
                </td>
                </tr>
                <?php endforeach?>
        </tbody>
    </table>
</div>